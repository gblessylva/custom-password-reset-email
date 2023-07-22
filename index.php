<?php
/*
Plugin Name: Custom Password Reset Email
Plugin URI:  https://github.com/gblessylva
Description: Customizes the password reset email template.
Version:     1.0
Author:      Sylvanus Godbless
Author URI:  https://github.com/gblessylva
License:     GPL2+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class Custom_Password_Reset_Email {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'settings_init' ) );
        add_filter( 'retrieve_password_message', array( $this, 'custom_lost_password_email_message' ), 10, 4 );
        add_filter( 'wp_mail', array( $this, 'custom_lost_password_email_headers' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    private function sanitize_and_escape( $input ) {
        return wp_kses_post( sanitize_textarea_field( $input ) );
    }

    // Add the settings page to the WordPress admin menu
    public function add_settings_page() {
        add_options_page(
            'Custom Password Reset Email Settings',
            'Password Reset Email',
            'manage_options',
            'custom_password_reset_email',
            array( $this, 'settings_page_callback' )
        );
    }

    // Settings page callback function
    public function settings_page_callback() {
        ?>
        <div class="wrap">
            <h1>Custom Password Reset Email Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'custom_password_reset_email_options' );
                do_settings_sections( 'custom_password_reset_email_options' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    // Register and initialize the settings fields
    public function settings_init() {
        register_setting( 'custom_password_reset_email_options', 'custom_password_reset_email_subject' );
        register_setting( 'custom_password_reset_email_options', 'custom_password_reset_email_content' );
        register_setting( 'custom_password_reset_email_options', 'custom_password_reset_email_image' );

        add_settings_section(
            'custom_password_reset_email_section',
            'Customize Password Reset Email',
            '',
            'custom_password_reset_email_options'
        );

        add_settings_field(
            'custom_password_reset_email_subject',
            'Email Subject',
            array( $this, 'subject_callback' ),
            'custom_password_reset_email_options',
            'custom_password_reset_email_section'
        );

        add_settings_field(
            'custom_password_reset_email_content',
            'Email Content',
            array( $this, 'content_callback' ),
            'custom_password_reset_email_options',
            'custom_password_reset_email_section'
        );

        add_settings_field(
            'custom_password_reset_email_image',
            'Email Image',
            array( $this, 'image_callback' ),
            'custom_password_reset_email_options',
            'custom_password_reset_email_section'
        );
    }

    // Settings fields callback functions
    public function subject_callback() {
        $subject = esc_attr( get_option( 'custom_password_reset_email_subject', 'Custom Password Reset Request' ) );
        echo '<input type="text" name="custom_password_reset_email_subject" value="' . $subject . '" class="regular-text">';
    }

    public function content_callback() {
        $content = esc_attr( get_option( 'custom_password_reset_email_content', '' ) );
        ?>
        <p class="description">You can use placeholders like [user-login], [reset-password-url] and [site-name] in the content.</p>
        <textarea name="custom_password_reset_email_content" rows="10" cols="50" class="large-text"><?php echo $content; ?></textarea>
        
        <?php
    }

    public function image_callback() {
        $image_url = esc_attr( get_option( 'custom_password_reset_email_image', 'https://placehold.co/200' ) );
        ?>
        <div class='custom-image-section'>
            <div>
             <p class="description">Click the "Select Image" button to choose an image from the media library.</p>
             <button type="button" class="button" id="custom-password-reset-email-image-button">Select Image</button>
            </div>
          
             <div>
            <input type="hidden" name="custom_password_reset_email_image" id="custom-password-reset-email-image" value="<?php echo $image_url; ?>" class="regular-text">
            <img src="<?php echo $image_url; ?>" alt="" srcset="">
             </div>
            
           
            
        </div>
        <?php
    }
    
    public function enqueue_styles() {
        wp_enqueue_style( 'custom-password-reset-email-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), '1.0' );
    }
    // Enqueue scripts for media library
    public function enqueue_scripts() {
        wp_enqueue_media();
        wp_enqueue_script( 'custom-password-reset-email-media', plugin_dir_url( __FILE__ ) . 'assets/js/main.js', array( 'jquery' ), '1.0', true );
        $this->enqueue_styles();
    }

    // Customize the title and content of the password reset email
    public function custom_lost_password_email_message( $message, $key, $user_login, $user_data ) {
            $content = $this->sanitize_and_escape( get_option( 'custom_password_reset_email_content', '' ));
            $image_url = get_option( 'custom_password_reset_email_image', '' );

        // Replace placeholders with their respective values
        $content = str_replace( '[user-login]', $user_login, $content );
        $content = str_replace( '[site-name]', get_bloginfo( 'name' ), $content );
        $reset_password_url = '<a href="' . esc_url (network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' )) . '">Reset Password</a>';
        $content = str_replace( '[reset-password-url]', $reset_password_url, $content );

            
            $message = $content;
            if ( ! empty( $image_url ) ) {
            $message .= '<img src="' . esc_url( $image_url ) . '" alt="Custom Image" style="max-width: 100%;">';
        }
    
            return $message;
        }

        public function custom_lost_password_email_headers( $mail ) {
            $subject = get_option( 'custom_password_reset_email_subject' );
    
            $mail['subject'] = $subject;
            $mail['headers'] = 'Content-Type: text/html; charset=UTF-8';
    
            return $mail;
        }
   
}

// Instantiate the class
new Custom_Password_Reset_Email();


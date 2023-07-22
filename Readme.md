# Custom Password Reset Email

Custom Password Reset Email is a WordPress plugin that allows you to customize the default "Lost your password" email template. With this plugin, you can easily change the title, content, and add a custom image to the email that users receive when requesting a password reset.

## Features

- Customize the subject of the password reset email.
- Customize the content of the password reset email using placeholders like `[user-login]`, `[site-name]`, and `[reset-password-url]`.
- Upload a custom image from the media library to be included in the email content.
- Easy-to-use settings page in the WordPress admin area.

## Requirements

- WordPress version 4.9 or higher.

## Installation

1. Download the plugin ZIP file from the [GitHub repository](https://github.com/gblessylva/custom-password-reset-email) or clone the repository using Git.
2. Go to your WordPress admin dashboard and navigate to "Plugins" > "Add New".
3. Click the "Upload Plugin" button at the top of the page.
4. Choose the downloaded ZIP file or the cloned plugin directory and click "Install Now".
5. Once the installation is complete, click "Activate" to activate the Custom Password Reset Email plugin.

## Usage

### Settings Page

1. After activating the plugin, you'll find a new menu item "Password Reset Email" under "Settings" in the WordPress admin dashboard.
2. Click on "Password Reset Email" to access the settings page.
3. On the settings page, you can customize the subject and content of the password reset email. Use the following placeholders in the content textarea:
   - `[user-login]`: Replaced with the user's login name.
   - `[site-name]`: Replaced with the name of your WordPress site.
   - `[reset-password-url]`: Replaced with the password reset link for the user.
4. You can also add a custom image by clicking the "Select Image" button to choose an image from the media library. The selected image will be added to the email content.

### Custom CSS

If you want to apply custom styles to the settings page, you can do so by adding your custom CSS rules to the "style.css" file located in the plugin directory.

## Frequently Asked Questions

1. **Can I use HTML tags in the email content?**
   Yes, you can use HTML tags in the email content textarea to format the email as desired.

2. **Can I reset the settings to default values?**
   Yes, if you want to reset the settings to default values, you can simply delete the content of the "Email Subject" and "Email Content" fields and save the changes.

## Support and Bug Reporting

If you encounter any issues or have questions about the Custom Password Reset Email plugin, please open a new issue on the [GitHub repository](https://github.com/gblessylva/custom-password-reset-email).

## Contributions

Contributions are welcome! If you would like to contribute to the development of this plugin, feel free to create a pull request on the [GitHub repository](https://github.com/gblessylva/custom-password-reset-email).

## License

This plugin is licensed under the GNU General Public License v2 or later.

## Credits

This plugin was developed by [Sylvanus Godbless](https://github.com/gblessylva.com).

## Changelog

### Version 1.0

- Initial release of the Custom Password Reset Email plugin.

jQuery( document ).ready( function( $ ) {
    var customUploader;

    $( '#custom-password-reset-email-image-button' ).on( 'click', function( e ) {
        e.preventDefault();

        if ( customUploader ) {
            customUploader.open();
            return;
        }

        customUploader = wp.media.frames.file_frame = wp.media( {
            title: 'Choose an Image',
            button: {
                text: 'Select Image'
            },
            multiple: false
        } );

        customUploader.on( 'select', function() {
            var attachment = customUploader.state().get( 'selection' ).first().toJSON();
            $( '#custom-password-reset-email-image' ).val( attachment.url );
        } );

        customUploader.open();
    } );
} );

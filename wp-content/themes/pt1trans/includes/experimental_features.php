<?php /* Experimental features */
/* Caution: These featires are experimental and may not work as intended or have undesired side effects. */
/* Be sure to uncomment the *include* in functions.php to enable. */

/* Add styles to WYSIWYG post editor */
function wptc_add_editor_styles() {
    global $theme_display_options;
    $stylesheetURI = str_replace( array( '%t%', '%s%' ), array( get_template_directory_uri(), get_stylesheet_directory_uri() ), $theme_display_options['styleSheets'] );
    add_editor_style( $stylesheetURI . 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wptc_add_editor_styles' );

?>

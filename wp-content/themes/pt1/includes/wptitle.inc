<?php /* Necessary for Artisteer offline export */
/* Add title tag support for WordPress versions prior to 4.1 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function wptc_render_title() {
        global $theme_display_options;
?>
<title><?php wp_title( esc_attr( $theme_display_options['browserTitleSeparator'] ), true, ( $theme_display_options['showSiteTitleFirst'] ? 'left' : 'right' ) ); ?></title>
<?php
	}
	add_action( 'wp_head', 'wptc_render_title' );
}

/* Create a title for display in the browser */
function wptc_browser_title( $title, $sep ) {
    global $theme_display_options;
    $sep = esc_attr( $theme_display_options['browserTitleSeparator'] );
    if ( !is_singular() ) :
        $page_title = strip_tags( wptc_archive_page_title() );
        if ( !empty( $page_title ) ) return $theme_display_options['showSiteTitleFirst'] ? get_bloginfo( 'name' ) . ' ' . $sep . ' ' . $page_title : $page_title . ' ' . $sep . ' ' . get_bloginfo( 'name' );
    endif;
    return $theme_display_options['showSiteTitleFirst'] ? get_bloginfo( 'name' ) . ' ' . $sep . ' ' . get_the_title() : get_the_title() . ' ' . $sep . ' ' . get_bloginfo( 'name' );
}
add_filter( 'wp_title', 'wptc_browser_title', 16, 2 );
?>

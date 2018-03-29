<?php /* Style_switcher.inc */

/* Style switcher customizer options */
function wptc_style_switcher_options( $customizer ) {

    if ( defined( 'WPTC_STYLE_SWITCHER' ) && !WPTC_STYLE_SWITCHER ) return $customizer;

    $style_choices = array();

    if ( is_dir( get_template_directory() . '/styles' ) ) :
        $handler = opendir( get_template_directory() . '/styles' ); /* Theme styles directory */
        if ( $handler !== false ) :
            while ( $dir = readdir( $handler ) ) :
                if ( $dir != '.' && $dir != '..' && is_dir( get_template_directory() . '/styles/' . $dir ) )
                    $style_choices['%t%/styles/' . rawurlencode( $dir )] = str_replace( '_', ' ', $dir );
            endwhile;
            closedir( $handler );
        endif;
    endif;
    if ( is_child_theme() && is_dir( get_stylesheet_directory() . '/styles' ) ) :
        $handler = opendir( get_stylesheet_directory() . '/styles' ); /* Child theme styles directory */
        if ( $handler !== false ) :
            while ( $dir = readdir( $handler ) ) :
                if ( $dir != '.' && $dir != '..' && is_dir( get_stylesheet_directory() . '/styles/' . $dir ) )
                    $style_choices['%s%/styles/' . rawurlencode( $dir )] = str_replace( '_', ' ', $dir );
            endwhile;
            closedir( $handler );
        endif;
    endif;

    if ( empty( $style_choices ) && !is_child_theme() ) return $customizer;

    if ( is_child_theme() ) :
        $style_choices = array( '%t%' => 'Theme Default', '%s%' => 'Child Theme Default' ) + $style_choices;
    else :
        $style_choices = array( '%t%' => 'Theme Default' ) + $style_choices;
    endif;

    $style_options = array(
        'title'             => __( 'Style Switcher', 'wptc_theme_td' ),
        'id'                => 'style_switcher_wptc',
        'controls'          => array(
            array(
                'title'     => __( 'Style Sheets', 'wptc_theme_td' ),
                'id'        => 'styleSheets',
                'type'      => 'select',
                'sanitize'  => 'style_switcher_dir_check',
                'choices'   => $style_choices
            )
        )
    );
    array_unshift( $customizer, $style_options );
    return $customizer;
}
add_filter( 'wptc_customizer', 'wptc_style_switcher_options' );

/* Style switcher options defaults */
function wptc_style_switcher_options_defaults( $wptc_theme_display_defaults ) {
    if ( is_child_theme() ) :
        $wptc_theme_display_defaults['styleSheets'] = '%s%';
    else :
        $wptc_theme_display_defaults['styleSheets'] = '%t%';
    endif;
    return $wptc_theme_display_defaults;
}
add_filter( 'wptc_theme_defaults', 'wptc_style_switcher_options_defaults' );

/* Sanitize style switcher */
function style_switcher_dir_check( $input ) {
    if ( is_dir( rawurldecode( str_replace( array( '%t%', '%s%' ), array( get_template_directory(), get_stylesheet_directory() ), $input ) ) ) )
        return $input;
    if ( is_child_theme() )
        return '%s%';
    return '%t%';
}

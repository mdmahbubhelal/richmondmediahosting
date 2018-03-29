<!-- Begin nav-menu.php -->
<?php /* nav-menu.php * Navigation Menu */
$primaryMenu = is_user_logged_in() ? 'primary-menu' : 'guest-menu';
global $post_theme_display_options;
if ( intval( $post_theme_display_options['wptc_menu_select'] ) !== -1 ) :
    echo '<nav class="bar nav"><div class="nav-inner">';
    get_sidebar( 'navfirst' );
    wp_nav_menu( array( 'theme_location'    => ( intval( $post_theme_display_options['wptc_menu_select'] ) == -2 ? $primaryMenu : '' ),
                        'menu'              => ( intval( $post_theme_display_options['wptc_menu_select'] ) > 0 ? $post_theme_display_options['wptc_menu_select'] : '' ),
                        'container'         => '',
                        'menu_class'        => 'menu menu hmenu',
                        'fallback_cb'       => 'wptc_menu_fallback',
                        ) );
    get_sidebar( 'navsecond' );
    echo '</div></nav>';
endif; ?>
<!-- End nav-menu.php -->

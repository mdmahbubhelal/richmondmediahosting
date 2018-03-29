<!-- Begin sidebar-navsecond.php -->
<?php /* sidebar-navsecond.php * Navigation Widget Area */
if ( is_active_sidebar( 'second-nav-widget-area' ) ) :
    echo '<div class="hmenu-extra2">';
    dynamic_sidebar( 'second-nav-widget-area' );
    echo '</div>';
endif;
?>
<!-- End sidebar-navsecond.php -->

<!-- Begin sidebar-navfirst.php -->
<?php /* sidebar-navfirst.php * Navigation Widget Area */
if ( is_active_sidebar( 'first-nav-widget-area' ) ) :
    echo '<div class="hmenu-extra1">';
    dynamic_sidebar( 'first-nav-widget-area' );
    echo '</div>';
endif;
?>
<!-- End sidebar-navfirst.php -->

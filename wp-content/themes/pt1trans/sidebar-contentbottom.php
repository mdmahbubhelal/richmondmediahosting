<!-- Begin sidebar-contentbottom.php -->
<?php /* sidebar-contentbottom.php * First / Second Content Bottom Widget Areas */
if ( is_active_sidebar( 'first-content-bottom-widget-area' ) ) :
    echo '<div class="content-layout">';
    dynamic_sidebar( 'first-content-bottom-widget-area' );
    echo '</div>';
endif;
?>
<!-- End sidebar-bottom.php -->

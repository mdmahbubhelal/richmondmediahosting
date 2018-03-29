<!-- Begin sidebar-pagetop.php -->
<?php /* sidebar-pagetop.php * Page Top Widget Areas */
if ( is_active_sidebar( 'first-page-top-widget-area' ) ) :
    echo '<div class="sidebar-page-top"><div class="content-layout">';
    dynamic_sidebar( 'first-page-top-widget-area' );
    echo '</div></div>';
endif;
?>
<!-- End sidebar-pagetop.php -->

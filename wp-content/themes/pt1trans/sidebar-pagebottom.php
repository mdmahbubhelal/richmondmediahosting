<!-- Begin sidebar-pagebottom.php -->
<?php /* sidebar-pagebottom.php * Page Bottom Widget Areas */
if ( is_active_sidebar( 'first-page-bottom-widget-area' ) ) :
    echo '<div class="sidebar-page-bottom"><div class="content-layout">';
    dynamic_sidebar( 'first-page-bottom-widget-area' );
    echo '</div></div>';
endif;
?>
<!-- End sidebar-pagebottom.php -->

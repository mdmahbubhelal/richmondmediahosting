<!-- Begin sidebar-footer.php -->
<?php /* sidebar-footer.php * Footer Widget Area */
if ( is_active_sidebar( 'first-footer-widget-area' ) ) :
    echo '<div class="content-layout">';
    dynamic_sidebar( 'first-footer-widget-area' );
    echo '</div>';
endif;
?>
<!-- End sidebar-footer.php -->

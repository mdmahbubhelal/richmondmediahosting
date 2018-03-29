<!-- Begin sidebar-contenttop.php -->
<?php /* sidebar-contenttop.php * First / Second Content Top Widget Areas */
if ( is_active_sidebar( 'first-content-top-widget-area' ) ) :
    echo '<div class="content-layout">';
    dynamic_sidebar( 'first-content-top-widget-area' );
    echo '</div>';
endif;
?>
<!-- End sidebar-top.php -->

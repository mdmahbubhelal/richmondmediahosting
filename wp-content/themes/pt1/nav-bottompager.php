<!-- Begin nav-bottompager.php -->
<?php /* nav-bottomppager.php * Bottom Pagination Links */
global $theme_display_options;
if ( !is_singular() ) :
    $pager = wptc_build_pagination_links();
    /* Add bottom pagination */
    if ( $theme_display_options['showBottomPager'] && $pager ) :
        echo '<div id="bottom-pager" class="post article">' . $pager . '</div>';
    endif;
endif;
?>
<!-- End nav-bottompager.php -->

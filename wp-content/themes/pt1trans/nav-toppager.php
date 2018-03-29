<!-- Begin nav-toppager.php -->
<?php /* nav-topppager.php * Top Pagination Links */
global $theme_display_options;
if ( !is_singular() ) :
    $arch_title = wptc_archive_page_title();
    $pager = wptc_build_pagination_links();
    /* Add archive title and top pagination */
    if ( !empty( $arch_title ) ) :
        echo '<div id="top-pager" class="post article"><div class="postcontent">' .
            $arch_title . '</div>' . ( $theme_display_options['showTopPager'] && $pager ? $pager : '' ) . '</div>';
    else :
        if ( $theme_display_options['showTopPager'] && $pager ) :
            echo '<div id="top-pager" class="post article">' . $pager . '</div>';
        endif;
    endif;
endif;
?>
<!-- End nav-toppager.php -->

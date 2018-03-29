<!-- Begin nav-bottomprevnextpost.php -->
<?php /* nav-bottomprevnextpost.php * Bottom Previous / Next Post Links */
global $theme_display_options;
if ( $theme_display_options['showBottomPrevNextPost'] ) :
    echo '<div id="bottom-prevnextpost" class="postcontent clearfix">';
    previous_post_link( '<div ' . ( $theme_display_options['showPrevNextPostStylePager'] ? 'class="pager" ' : '' ) . 'style="float:left;">%link</div>', '&laquo; %title' );
    next_post_link( '<div ' . ( $theme_display_options['showPrevNextPostStylePager'] ? 'class="pager" ' : '' ) . 'style="float:right;">%link</div>', '%title &raquo;' );
    echo '</div>';
endif;
?>

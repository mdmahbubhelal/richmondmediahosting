<?php get_header();
global $theme_display_options; ?>
<!-- Begin search.php -->
<?php get_sidebar( 'pagetop' ); ?>
<div class="content-layout"><div class="content-layout-row">

<div class="layout-cell content">
<?php get_sidebar( 'contenttop' );
if ( have_posts() ) : /* If we have a post */
    get_template_part( 'nav', 'toppager' );
    $cols = 0;
    $row_open = false;
    while ( have_posts() ) : the_post(); /* Start our WordPress loop */
        if ( $theme_display_options['showAsGrid'] ) :
            $cols++;
            if ( $cols == 1 ) :
                $row_open = true;
                echo '<div class="content-layout"><div class="content-layout-row layout-row-grid">';
            endif;
            echo '<div class="layout-cell layout-cell-size' . $theme_display_options['gridColumns'] . ' layout-cell-grid">';
        endif;
        get_template_part( 'content', 'searchresults' );
        if ( $theme_display_options['showAsGrid'] ) :
            echo '</div>';
            if ( $cols == intval( $theme_display_options['gridColumns'] ) ) :
                $row_open = false;
                echo '</div></div>';
                $cols = 0;
            endif;
        endif;
    endwhile;
    if ( $row_open )
        echo '</div></div>';
    get_template_part( 'nav', 'bottompager' );
else :
    get_template_part( 'content', '404' );
endif;
get_sidebar( 'contentbottom' ); ?>
</div>

</div></div>
<?php get_sidebar( 'pagebottom' ); ?>
<!-- End search.php -->
<?php get_footer(); ?>

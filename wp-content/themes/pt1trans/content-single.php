<!-- Begin content-single.php -->
<?php /* content-single.php * Single Content Loop */
global $theme_display_options, $post_theme_display_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php get_template_part( 'nav', 'topprevnextpost' ); ?>
<?php if ( $post_theme_display_options['wptc_title_checkbox'] == 'on' || $post_theme_display_options['wptc_meta_header_checkbox'] == 'on' ) : ?>

<?php if ( $post_theme_display_options['wptc_title_checkbox'] == 'on' ) : ?>
<<?php echo $theme_display_options['singleArticleTag']; ?> class="postheader entry-title">
    <span class="postheadericon">
        <?php the_title(); ?>
    </span>
</<?php echo $theme_display_options['singleArticleTag']; ?>>
<?php endif; ?>


<?php if ( $post_theme_display_options['wptc_meta_header_checkbox'] == 'on' ) :
    get_template_part( 'postmeta', 'header' );
endif; ?>

<?php endif; ?>
<div class="postcontent postcontent-<?php the_ID(); ?> entry-content clearfix">
    <?php the_content(); ?>
</div>
<div class='qt_edit'>
<?php edit_post_link(__('Edit','default')); ?>
</div>
<?php if ( $post_theme_display_options['wptc_meta_footer_checkbox'] == 'on' ) :
    get_template_part( 'postmeta', 'footer' );
endif;
get_template_part( 'nav', 'postpager' );
get_template_part( 'nav', 'bottomprevnextpost' );
comments_template(); ?>
</article>
<!-- End content-single.php -->

<!-- Begin content-archive.php -->
<?php /* content-archive.php * Archive Content Loop */
global $theme_display_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( $theme_display_options['showPostTitles'] || $theme_display_options['showPostMetaHeaders'] ) : ?>

<?php if ( $theme_display_options['showPostTitles'] ) : ?>
<<?php echo $theme_display_options['postsArticleTag']; ?> class="postheader">
    <span class="postheadericon">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </span>
</<?php echo $theme_display_options['postsArticleTag']; ?>>
<?php endif; ?>


<?php if ( $theme_display_options['showPostMetaHeaders'] ) :
    get_template_part( 'postmeta', 'header' );
endif; ?>

<?php endif; ?>
<div class="postcontent postcontent-<?php the_ID(); ?> clearfix">
    <?php if ( $theme_display_options['showExcerpts'] ) :
        if ( $theme_display_options['excerptFeaturedImage'] && has_post_thumbnail() ) :
            $fi_size = $theme_display_options['excerptFeaturedImageSize'];
            if ( $fi_size == 'custom' )
                $fi_size = array( absint( $theme_display_options['excerptFeaturedImageWidth'] ), absint( $theme_display_options['excerptFeaturedImageHeight'] ) );
            the_post_thumbnail( $fi_size, array( 'class' => $theme_display_options['excerptFeaturedImageAlignment'] ) );
        endif;
        the_excerpt();
    else :
        the_content( $theme_display_options['contentReadMoreText'] );
    endif; ?>
</div>
<?php if( $theme_display_options['showPostMetaFooters'] ) :
    get_template_part( 'postmeta', 'footer' );
endif; ?>
</article>
<!-- End content-archive.php -->

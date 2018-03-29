<!-- Begin content-404.php -->
<?php /* content-404.php * 404/Post Not Found */
global $theme_display_options; ?>
<article <?php post_class(); ?>>
<<?php echo $theme_display_options['singleArticleTag']; ?> class="postheader"><?php echo $theme_display_options['404Title']; ?></<?php echo $theme_display_options['singleArticleTag']; ?>>
<?php echo $theme_display_options['404Description'];
if ( $theme_display_options['show404Search'] ) :
    echo '<p>' . get_search_form( false ) . '</p>';
endif; ?>
</article>
<!-- End content-404.php -->

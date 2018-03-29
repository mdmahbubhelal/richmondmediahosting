<?php get_header(); ?>
<!-- Begin single.php -->
<?php get_sidebar( 'pagetop' ); ?>
<div class="content-layout"><div class="content-layout-row">

<div class="layout-cell content">
<?php get_sidebar( 'contenttop' );
if ( have_posts() ) : the_post(); /* If we have a post, start the loop */
    get_template_part( 'content', 'single' );
else :
    get_template_part( 'content', '404' );
endif;
get_sidebar( 'contentbottom' ); ?>
</div>

</div></div>
<?php get_sidebar( 'pagebottom' ); ?>
<!-- End single.php -->
<?php get_footer(); ?>

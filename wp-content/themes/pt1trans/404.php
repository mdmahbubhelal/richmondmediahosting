<?php get_header(); ?>
<!-- Begin 404.php -->
<?php get_sidebar( 'pagetop' ); ?>
<div class="content-layout"><div class="content-layout-row">

<div class="layout-cell content">
<?php get_sidebar( 'contenttop' );
get_template_part( 'content', '404' );
get_sidebar( 'contentbottom' ); ?>
</div>

</div></div>
<?php get_sidebar( 'pagebottom' ); ?>
<!-- End 404.php -->
<?php get_footer(); ?>

<?php get_header();
global $theme_display_options; ?>
<!-- Begin archive.php -->
<?php get_sidebar( 'pagetop' ); ?>
<div class="content-layout"><div class="content-layout-row">

<div class="layout-cell content">
<?php get_sidebar( 'contenttop' ); ?>
<?php 
get_template_part( 'content', 'taxonomy' );
get_sidebar( 'contentbottom' ); ?>
</div>

</div></div>
<?php get_sidebar( 'pagebottom' ); ?>
<!-- End archive.php -->
<?php get_footer(); ?>

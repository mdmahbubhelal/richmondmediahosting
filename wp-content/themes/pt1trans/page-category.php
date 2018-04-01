<?php /* Template Name: Category page*/ ?>
<?php get_header(); ?>
<!-- Begin page.php -->
<?php get_sidebar( 'pagetop' ); ?>
<div class="content-layout"><div class="content-layout-row">

<div class="layout-cell content">
<?php get_sidebar( 'contenttop' );
$args = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => false,
    'parent'            => 0,
);
$terms = get_terms('product_cat', $args);
?>
<article>
	<h1 class="postheader entry-title woocommercePageTitle"> <span class="postheadericon"> Main product categories </span> </h1>
	<?php if ($terms) : ?>
		<div class="categoryContainer">
			<?php foreach ($terms as $term) {
				echo '<div class="oneFourth">';
				echo '<a href="'. get_term_link($term, 'product_cat') .'">';
				echo '<img src="'. wp_get_attachment_thumb_url(get_term_meta($term->term_id, 'thumbnail_id', true)) .'">';
				echo '<p>'. $term->name .'</p>';
				echo '</a>';
				echo '</div>';
				//echo get_term_link($term, 'product_cat');
			} ?>
		</div>
	<?php endif ?>
</article>
<?php
    // get_template_part( 'content', '404' );
get_sidebar( 'contentbottom' ); ?>
</div>

</div></div>
<?php get_sidebar( 'pagebottom' ); ?>
<!-- End page.php -->
<?php get_footer(); ?>

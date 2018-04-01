<?php 
$args = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => false,
    'child_of'          => get_queried_object_id(),
);
$terms = get_terms('product_cat', $args);
if ($terms) :
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
			} ?>
		</div>
	<?php endif ?>
</article>
<?php else: ?>
<?php 
if ( have_posts() ) : /* If we have a post */
    while ( have_posts() ) : the_post(); /* Start our WordPress loop */
    	echo '<div class="categoryContainer">';
        echo '<div class="oneFourth">';
		echo '<a href="'. get_the_permalink() .'">';
		echo '<img src="'. get_the_post_thumbnail_url() .'">';
		echo '<p>'. get_the_title(  ) .'</p>';
		echo '</a>';
		echo '</div>';
		echo '</div>';
    endwhile;
 ?>
<?php endif; ?>
<?php endif; ?>
<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// https://www.youtube.com/watch?v=wqlRtry1L5I
// https://www.youtube.com/watch?v=aen8ieJuB88
// $variation['max_qty'];
// $variation['min_qty'];
// $variation['is_purchasable'];
// $variation['is_in_stock'];
// $variation['display_regular_price'];
?>
<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php post_class('row'); ?>>
	<?php global $product;
	if ($product->is_type( 'variable' )) {  
		echo '<div class="col-sm-4">';
			echo '<img class="img-responsive" src="'. get_the_post_thumbnail_url() .'" alt="product image">'; 
			echo '<div class="productSummery">'. get_the_excerpt() .'</div>';
		echo '</div>';
		
		echo '<div class="col-sm-8">';
			echo '<h2 class="title">'. $product->get_title() .'</h2>';
			$variations =  $product->get_available_variations(); 
			if ($variations) {
				echo '<table class="table table-hover productVariationTable">';
					echo '<thead>';
					echo '<tr>';
						echo '<th>Image</th>';
						echo '<th>SKU</th>';
						echo '<th>Description</th>';
						echo '<th>Price</th>';
						echo '<th>Quantity</th>';
						echo '<th>Favorite</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					foreach ($variations as $variation) {
						if ($variation['is_purchasable'] > 0) {
							echo '<tr>';
								echo '<td><img src="'. $variation['image']['thumb_src'] .'"></td>';
								echo '<td>'. $variation['sku'] .'</td>';
								echo '<td>'. $variation['variation_description'] .'</td>';
								echo '<td>'. $variation['display_price'] .'</td>';
								echo '<td><input type="number" id="" max="'.$variation['max_qty'].'" min="'. $variation['min_qty'] .'" value="1"></td>';
								echo '<td> heart <td>';
							echo '</tr>';
						}
					}
					echo '</tbody>';
				echo '</table>';
			}
			echo '<br><pre>'. print_r($variations, true) .'</pre>';
			// https://nicola.blog/2015/09/18/creating-custom-add-to-cart-url/
			echo '<a herf="'. site_url() .'/?add-to-cart=123&variation_id=117&attribute_size=Small&attribute_color=Black" class="btn btn-info btn-md">ADD TO CART</a>';
			echo '<br><br><br><br><br>';
			echo '<div class="productFooter">';
				echo '<div class="sku"> <strong>SKU:</strong> ' . $product->get_sku() . '</div>';
				$terms = get_the_terms( get_the_ID(), 'product_cat' );
				if ($terms) {
					echo '<ul class="productCatList">';
					echo '<li><strong>Category : </strong></li>';
					foreach ($terms as $term) {
						echo '<li>'. $term->name .'</li>';
					}
					echo '</ul>';
				}
			echo '</div>';
		echo '</div>';
	} else {
		do_action( 'woocommerce_before_single_product_summary' );
		echo '<div class="summary entry-summary">';
			do_action( 'woocommerce_single_product_summary' );
			echo '<a href="' . get_home_url() . '?add-to-cart='. get_the_ID() .'&quantity=2">Add to cart</a>'; 
		echo '</div>';
		do_action( 'woocommerce_after_single_product_summary' );
	}
	?>
</div><!-- #product-<?php the_ID(); ?> -->



<?php do_action( 'woocommerce_after_single_product' ); ?>

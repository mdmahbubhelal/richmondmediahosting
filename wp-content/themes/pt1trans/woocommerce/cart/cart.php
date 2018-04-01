	<?php
	/**
	 * Cart Page
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see     https://docs.woocommerce.com/document/template-structure/
	 * @author  WooThemes
	 * @package WooCommerce/Templates
	 * @version 3.1.0
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	wc_print_notices();
	do_action( 'woocommerce_before_cart' ); ?>
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
			<thead>
				<tr>
					<th class="product-remove hidden">&nbsp;</th>
					<th class="product-thumbnail">Item #</th>
					<th class="product-name"><?php _e( 'Product Name', 'woocommerce' ); ?></th>
					<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
					<th class="product-price"><?php _e( 'List Price', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php _e( 'Total Price', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php _e( 'Discount', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php _e( 'Net Price', 'woocommerce' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="product-remove hidden">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							</td>
							
							<td class="product-item" data-title="<?php esc_attr_e( 'Item', 'woocommerce' ); ?>">
								<?php esc_attr_e( 'Item', 'woocommerce' ); ?>
							</td>

							<td class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail;
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
									}
								?>
								<!-- Product Name -->
								<?php
									if ( ! $product_permalink ) {
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
									} else {
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
									}

									// Meta data
									echo WC()->cart->get_item_data( $cart_item );

									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
									}
								?>
							</td>
							
							<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
								<?php
									if ($_product->is_sold_individually()) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} 
									else{
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->get_max_purchase_quantity(),
											'min_value'   => '0',
										), $_product, false );
									}
									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
								?>
							</td>

							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
								<span class="quantity-button price-button">x</span>
							</td>

							<td class="product-total" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
								<?php esc_attr_e( 'Total', 'woocommerce' ); ?>
							</td>

							<td class="product-discount" data-title="<?php esc_attr_e( 'Discount', 'woocommerce' ); ?>">
								<?php esc_attr_e( 'Discount', 'woocommerce' ); ?>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
							  <?php	echo  apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
							</td>
						</tr>
						 <?php if(is_user_logged_in()){ ?>
						<tr class="hidden">  
							<td></td> 
							<td></td> 
							<td>Discount</td> 
							<td>
							<?php
							  $current_user = wp_get_current_user();
							  $meta= get_user_meta($current_user->ID);  
							  $user_discount_array = array();
							  $user_discount_array['EStimNoPALS']   =$meta['E-Stim (Not PALS)']['0']; 
							  $user_discount_array['cestimhesmed']   =$meta['Ches Med']['0']; 
							  $user_discount_array['generalitem']   =$meta['General Item']['0']; 
							  $user_discount_array['basicssignature']   =$meta['BASICS Signature']['0']; 
							  $discount_type =   get_field('discount_type',$product_id);
							  foreach($user_discount_array as $key=>$value_dis){
								 if($key == $discount_type){
								  echo '<b>' .$value_dis.'%</b> OFF';
								  $pr0_dis= $value_dis;
								 }
							  }	
							?>		
							</td> 
							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							</td>
							<td> <?php 
							   if(is_user_logged_in()) {
								$a=  WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
								$_exact_price= round($cart_item['quantity'] * $_product->get_regular_price(),2) ;
								$discount_price =  ($_exact_price*$pr0_dis)/100;
								$_total_after_discnt =  ($_exact_price) - ($discount_price);
							
								//echo	$_total_after_discnt1= round($_total_after_discnt, 2); 
								//echo	$discount_price1= round($discount_price, 2); 
								echo '$'. number_format((float)$_total_after_discnt, 2, '.', '') ;
								echo '<br><p style="font-size:12px;">You Save $'. number_format((float)$discount_price, 2, '.', '').' on this item.</p>';
							  }
							?></td> 
						</tr>
						 <?php } 
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<tr>
					<td colspan="7" class="actions">
						<button type="submit" class="button buttonUpdateCart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"> <?php esc_attr_e( 'Update cart', 'woocommerce' ); ?> </button> 
						<a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="checkout-button button buttonCheckout"> <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?> </a>
						<?php do_action( 'woocommerce_cart_actions' ); ?>
						<?php wp_nonce_field( 'woocommerce-cart' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>

	<div class="cart-collaterals cartCollaterals">
		<?php
			/**
			 * woocommerce_cart_collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
		?>
	</div>

	<?php do_action( 'woocommerce_after_cart' ); ?>

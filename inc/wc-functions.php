<?php
// products per page
add_filter( 'loop_shop_per_page', function ( $count ) {
	if ( is_shop() ) $count = 6;
	return $count;
} );

/**
*	product image, adding image sizes
*/

function getProductImage( $size = '', $attr = [] ) {
	if ( has_post_thumbnail() ) $img = the_post_thumbnail( $size, $attr );
	else $img = wc_placeholder_img( $size );
	return $img;
}

add_image_size( 'shop_page_loop_img', 349, 349, true );
add_image_size( 'bottom_slider_img', 277, 396, true );
add_image_size( 'cart_img', 228, 228, true );

/**
*	bottom slider, add to cart
*/

function addToCartBottomSlider() {
	global $product;

	if ( $product ) {
		$args = array(
			'quantity'   => 1,
			'class'      => implode( ' ', array_filter( array(
				'button',
				'product_type_' . $product->get_type(),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
			) ) ),
			'attributes' => array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'aria-label'       => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			),
		);

		echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
			sprintf( '<p><a href="%s" data-quantity="%s" class="item_add %s" %s><i></i><span class="item_price">%s</span></a></p>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
				esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
				isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
				$product->get_price_html()
			),
		$product, $args );
	}
}

/**
*	mini cart widget
*/

add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {
	$cart_subtotal = WC()->cart->get_cart_subtotal();
	$cart_count = WC()->cart->get_cart_contents_count();
	ob_start();
	?>
		<div class="cart box_1 widget_shopping_cart">
			<?php if ( $cart_count > 0 ) : ?>
				<a href="/cart">
					<h3>
						<span><?= $cart_subtotal  ?></span>
						<span>( <?= $cart_count ?> )</span>
						<img src="<?= bloginfo( 'template_url' ) ?>/assets/images/bag.png" alt="">
					</h3>
				</a>	
				<p>
					<a href="/cart?empty-cart" class="simpleCart_empty">Empty cart</a>
				</p>
			<?php else : ?>
				<p>
					<img src="<?= bloginfo( 'template_url' ) ?>/assets/images/bag.png" alt="">
					<a href="javascript:;" class="simpleCart_empty"><?= _e( 'Cart is empty', 'shop' ) ?></a>
				</p>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
	<?php
	$fragments['div.widget_shopping_cart'] = ob_get_clean();
	return $fragments;
} );

// empty cart
add_action( 'init', function () {
	global $woocommerce;
	if ( isset( $_GET['empty-cart'] ) ) $woocommerce->cart->empty_cart();
} );

/**
*	breadcrumbs
*/

add_filter( 'woocommerce_breadcrumb_defaults', function ( $args ) {
	if ( ! is_product_category() ) {
		$args = [
			'delimiter'   => '&nbsp;<span>&gt;</span>',
			'wrap_before' => '<div class="dreamcrub"><ul class="breadcrumbs">',
			'wrap_after'  => '</ul><ul class="previous"><li><a href="' . $_SERVER['HTTP_REFERER'] . '">' . __( 'Back to Previous Page', 'shop' ) . '</a></li></ul><div class="clearfix"></div>
</div>',
			'before'      => '',
			'after'       => '</li>',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
		];
	} else {
		$args = [
			'delimiter'   => '&nbsp;<span>&gt;</span>',
			'wrap_before' => '<nav class="woocommerce-breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
		];
	}
	return $args;
} );
	
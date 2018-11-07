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

add_image_size( 'shop_page_loop_img', 349, 349, false );
add_image_size( 'bottom_slider_img', 277, 396, false );

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
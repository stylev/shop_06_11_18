<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
if ( is_shop() ) {
	echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf( '<p><a href="%s" data-quantity="%s" class="item_add %s" %s><i></i><span class="item_price">%s</span></a></p>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			shopGetPriceHtml()
		),
	$product, $args );
} elseif ( is_product_category() ) {
	echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf( '<a href="%s" data-quantity="%s" class="cbp-vm-icon cbp-vm-add item_add %s" %s>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() )
		),
	$product, $args );
}

<?php
// products per page
add_filter( 'loop_shop_per_page', function ( $count ) {
	if ( is_shop() ) $count = 6;
	if ( is_product_category() ) $count = $_GET['ppp']?? 3;
	return $count;
} );

/**
*	product image, adding image sizes
*/

function getImage( $src, $alt = '', $attr = '' ) {
	$attributes = '';
	$class = 'lazy';
	if ( ! empty( $attr ) ) {
		foreach ( $attr as $k => $v ) {
			if ( $k == 'class' ) $class .= ' ' . $v;
			else $attributes .= $k . '="' . $v . '"';
		}
	}
	ob_start();
	?>
		<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="<?= $class ?>" data-src="<?= $src ?>" alt='<?= $alt ?>' <?= $attributes ?>>
	<?php
	$img = ob_get_clean();
	return $img;
}

function getProductImage( $size = '', $attr = '' ) {
	if ( has_post_thumbnail() ) {
		$src = get_the_post_thumbnail_url( get_the_ID(), $size );
		$img = getImage( $src, '', $attr );
	}
	else $img = wc_placeholder_img( $size );
	return $img;
}

add_image_size( 'shop_page_loop_img', 349, 349, true );
add_image_size( 'bottom_slider_img', 277, 396, true );
add_image_size( 'cart_img', 228, 228, true );

/**
*	sale size
*/

function getSaleSize() {
	global $product;
	$reg_price = $product->get_regular_price();
	$sale_price = $product->get_sale_price();
	$sale = ( $sale_price > 0 ) ? ceil( ( $reg_price - $sale_price ) / $reg_price * 100 ) : '';
	return $sale;
}

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
				shopGetPriceHtml()
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
				<a href="<?= wc_get_cart_url() ?>">
					<h3>
						<span><?= $cart_subtotal  ?></span>
						<span>( <?= $cart_count ?> )</span>
						<img src="<?= bloginfo( 'template_url' ) ?>/assets/images/bag.png" alt="">
					</h3>
				</a>	
				<p>
					<a href="<?= wc_get_cart_url() ?>?empty-cart" class="simpleCart_empty"><?php _e( 'Empty cart', 'shop' ) ?></a>
				</p>
			<?php else : ?>
				<p>
					<img src="<?= bloginfo( 'template_url' ) ?>/assets/images/bag.png" alt="">
					<?= _e( 'Cart is empty', 'shop' ) ?>
				</p>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
	<?php
	$fragments['div.widget_shopping_cart'] = ob_get_clean();
	return $fragments;
} );

// empty cart
add_action( 'init', 'shopEmptyCart' );

function shopEmptyCart() {
	global $woocommerce;
	if ( isset( $_GET['empty-cart'] ) ) $woocommerce->cart->empty_cart();
}

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
		$taxonomy = 'product_cat';
		$terms = get_terms( [
			'taxonomy' => $taxonomy,
			'hide_empty' => true
		] );
		$terms_id = [];
		foreach ( $terms as $item ) $terms_id[] = $item->term_id;
		$cur_term = get_queried_object();
		$next_term_pos = array_search( $cur_term->term_id, $terms_id ) + 1;
		if ( $next_term_pos > count( $terms_id ) - 1 ) $next_term_pos = 0;
		$next_term = get_term( $terms_id[$next_term_pos], $taxonomy );
		$next_term_name = $next_term->name;
		$next_term_url = get_term_link( $next_term->term_id, $taxonomy );
		$args = [
			'delimiter'   => '&nbsp;<span>&gt;</span>',
			'wrap_before' => '<div class="new-product-top"><ul class="product-top-list">',
			'wrap_after'  => '</ul><p class="back"><a href="' . $next_term_url . '">' . $next_term_name . '</a></p><div class="clearfix"></div></div>',
			'before'      => '<li>',
			'after'       => '</li>',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
		];
	}
	return $args;
} );	

/**
*	change currency
*/

add_filter( 'woocommerce_get_price_html', function ( $price, $product ) {

	return $price;
}, '', 2 );

function shopGetPriceHtml() {
	global $product;
	$exchange_rate = get_option( 'shop_option_name' )['exchange_rate'];
	$cur_symbol = get_locale() == 'ru_RU' ? get_woocommerce_currency_symbol( 'UAH' ) : get_woocommerce_currency_symbol( 'USD' );
	$reg_price = get_locale() == 'ru_RU' ? number_format( round( $product->get_regular_price() * $exchange_rate, 2 ), 2 ) : number_format( (float)$product->get_regular_price(), 2 );
	$sale_price = get_locale() == 'ru_RU' && $product->get_sale_price() ? number_format( round( $product->get_sale_price() * $exchange_rate, 2 ), 2 ) : number_format( (float)$product->get_sale_price(), 2 );
	if ( get_post_meta( $product->get_id(), '_translation_porduct_type', true ) == 'grouped' ) {
		$prices = [];
		$children = $product->get_children();
		foreach ( $children as $item ) {
			$prices[] = get_post_custom( $item )['_regular_price'][0];
		}
		sort( $prices );
		$first_product_price = get_locale() == 'ru_RU' ? number_format( round( $prices[0] * $exchange_rate, 2 ), 2 ) : number_format( $prices[0], 2 );
		$last_product_price = get_locale() == 'ru_RU' ? number_format( round( $prices[count( $prices ) - 1] * $exchange_rate, 2 ), 2 ) : number_format( $prices[count( $prices ) - 1], 2 );
	} elseif ( get_post_meta( $product->get_id(), '_translation_porduct_type', true ) == 'variable' ) {
		$prices = [];
		$get_prices = get_post_meta( $product->get_id(), '_price', false );
		foreach ( $get_prices as $item ) {
			$prices[] = $item;
		}
		sort( $prices );
		$first_product_price = get_locale() == 'ru_RU' ? number_format( round( $prices[0] * $exchange_rate, 2 ), 2 ) : number_format( $prices[0], 2 );
		$last_product_price = get_locale() == 'ru_RU' ? number_format( round( $prices[count( $prices ) - 1] * $exchange_rate, 2 ), 2 ) : number_format( $prices[count( $prices ) - 1], 2 );
	}
	ob_start();
	?>
		<?php if ( $sale_price > 0 ) : ?>
			<span class="item_price">
				<del>
					<span class="woocommerce-Price-amount amount">
						<span class="woocommerce-Price-currencySymbol"><?= $cur_symbol ?></span><?= $reg_price ?>
					</span>
				</del>
				<ins>
					<span class="woocommerce-Price-amount amount">
						<span class="woocommerce-Price-currencySymbol">&nbsp;<?= $cur_symbol ?></span><?= $sale_price ?>
					</span>
				</ins>
			</span>
		<?php elseif ( get_post_meta( $product->get_id(), '_translation_porduct_type', true ) == 'grouped' || get_post_meta( $product->get_id(), '_translation_porduct_type', true ) == 'variable' ) : ?>
			<span class="item_price">
				<span class="woocommerce-Price-amount amount">
					<span class="woocommerce-Price-currencySymbol"><?= $cur_symbol ?></span><?= $first_product_price ?>
				</span> – <span class="woocommerce-Price-amount amount">
					<span class="woocommerce-Price-currencySymbol"><?= $cur_symbol ?></span><?= $last_product_price ?>
				</span>
			</span>
		<?php else : ?>
			<span class="item_price">
				<span class="woocommerce-Price-amount amount">
					<span class="woocommerce-Price-currencySymbol"><?= $cur_symbol ?></span><?= $reg_price ?>
				</span>
			</span>
		<?php endif; ?>
	<?php
	$price = ob_get_clean();
	return $price;
}

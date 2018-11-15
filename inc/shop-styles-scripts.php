<?php
## Отключаем Emojis в WordPress
if(1){
	## отключаем DNS prefetch
	add_filter('emoji_svg_url', '__return_empty_string');

	/**
	 * Disable the emoji's
	 */
	add_action( 'init', 'disable_emojis' );
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	}

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 *
	 * @param    array  $plugins
	 * @return   array             Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}

add_filter( 'rest_authentication_errors', function( $result ) {
	if ( ! empty( $result ) ) 
		return $result;

	if ( ! is_user_logged_in() ) 
		return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );

	return $result;
});

/**
*	scripts
*/

add_action( 'wp_enqueue_scripts', function () {
	// deconnect select2
	wp_deregister_style( 'select2' );

	// reconnect jquery
	wp_deregister_script( 'jquery' );
	wp_register_script( 
		'jquery',
		'https://code.jquery.com/jquery-1.12.4.min.js',
		[], 
		null, 
		true 
	);
	wp_enqueue_script( 'jquery', true);
	add_filter( 'script_loader_tag', function ( $tag, $handle ) {
		if ( 'jquery' !== $handle ) {
	        return $tag;
	    }	 
	    return str_replace( ' src', ' integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous" src', $tag );
	}, 10, 2 );

	wp_register_script( 
		'shop_bootstrap_scripts', 
		SHOP_DIR_URI . 'assets/js/bootstrap-3.1.1.min.js',
		['jquery'],
		false,
		true
	);
	wp_register_script( 
		'shop_responsiveslides_scripts', 
		SHOP_DIR_URI . 'assets/js/responsiveslides.min.js',
		['jquery'],
		false,
		true
	);
	wp_register_script( 
		'shop_flexisel_scripts', 
		SHOP_DIR_URI . 'assets/js/jquery.flexisel.min.js',
		['jquery'],
		false,
		true
	);
	wp_register_script( 
		'shop_flexslider_scripts', 
		SHOP_DIR_URI . 'assets/js/jquery.flexslider.min.js',
		['jquery'],
		false,
		true
	);
	wp_register_script( 
		'shop_scripts', 
		SHOP_DIR_URI . 'assets/js/shop-scripts.js',
		['jquery'],
		false,
		true
	);
	wp_register_script( 
		'shop_lazyLoad_scripts', 
		SHOP_DIR_URI . 'assets/js/lazy-load.min.js',
		['jquery'],
		false,
		true
	);
	wp_enqueue_script( 'shop_bootstrap_scripts' );
	wp_enqueue_script( 'shop_responsiveslides_scripts' );
	wp_enqueue_script( 'shop_flexisel_scripts' );
	wp_enqueue_script( 'shop_flexslider_scripts' );
	wp_enqueue_script( 'shop_lazyLoad_scripts' );
	wp_enqueue_script( 'shop_scripts' );
	wp_localize_script( 
		'shop_scripts', 
		'shopObj', 
		[
			'bgImage' => get_option( 'shop_option_name' )['bg_image']
		]
	);
} );

/**
*	styles
*/

add_action( 'get_footer', function () {
	wp_register_style( 
		'shop_flexslider_styles', 
		SHOP_DIR_URI . 'assets/css/flexslider.min.css'
	);
	wp_enqueue_style( 'shop_flexslider_styles' );

	if ( is_account_page() || is_checkout() ) {
		wp_register_style( 
			'shop_select2_styles', 
			WP_PLUGIN_URL . '/woocommerce/assets/css/select2.css'
		);
		wp_register_style( 
			'shop_woocommerce_styles', 
			WP_PLUGIN_URL . '/woocommerce/assets/css/woocommerce.css'
		);
		wp_enqueue_style( 'shop_woocommerce_styles' );
	}
} );

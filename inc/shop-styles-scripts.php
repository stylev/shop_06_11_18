<?php
add_action( 'wp_enqueue_scripts', function () {
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
	wp_enqueue_script( 'shop_bootstrap_scripts' );
	wp_enqueue_script( 'shop_responsiveslides_scripts' );
	wp_enqueue_script( 'shop_flexisel_scripts' );
	wp_enqueue_script( 'shop_flexslider_scripts' );
	wp_enqueue_script( 'shop_scripts' );
} );

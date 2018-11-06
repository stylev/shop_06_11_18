<?php
/**
*	create the constants
*/

define( 'SHOP_DIR', get_template_directory() . '/' );
define( 'SHOP_DIR_URI', get_template_directory_uri() . '/' );

/**
*	loading the theme
*/

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
	register_nav_menus( [
		'top' => 'Top menu',
		'sidebar' => 'Sidebar menu',
		'footer' => 'Footer menu'
	] );

	// connect to the adding files
	$files = scandir( SHOP_DIR . 'inc/' );
	foreach ( $files as $file ) {
		if ( $file == '.' || $file == '..' ) continue;
		require_once( SHOP_DIR . 'inc/' . $file );
	}
} );

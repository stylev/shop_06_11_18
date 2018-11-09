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

	// copy locale files into languages dir
	$locale_files_arr = ['shop-ru_RU.mo', 'shop-ru_RU.po'];
	for ( $i = 0; $i < count( $locale_files_arr ); $i++ ) {
		if ( file_exists( SHOP_DIR . 'lang/' . $locale_files_arr[$i] ) ) copy( SHOP_DIR . 'lang/' . $locale_files_arr[$i], WP_CONTENT_DIR . '/languages/themes/' . $locale_files_arr[$i] );
	}
} );

/**
*	delete settings, options, locale files
*/

add_action( 'switch_theme', function () {
	// delete locale files
	$locale_files_arr = ['shop-ru_RU.mo', 'shop-ru_RU.po'];
	for ( $i = 0; $i < count( $locale_files_arr ); $i++ ) {
		$file = WP_CONTENT_DIR . '/languages/themes/' . $locale_files_arr[$i];
		if ( file_exists( $file ) ) unlink( $file );
	}
} );

/**
*	slider post type
*/

add_action( 'init', 'shopSliderPostType' );

function shopSliderPostType() {
	register_post_type( 'slider', [
		'public' => true,
		'supports' => ['title', 'editor', 'thumbnail'],
		'menu_position' => 120,
		'menu_icon' => admin_url() . 'images/media-button-other.gif',
		'labels' => [
			'name' => __( 'Slider', 'shop' ),
			'all_items' => __( 'All slides', 'shop' ),
			'add_new' => __( 'Add new slide', 'shop' ),
			'add_new_item' => __( 'New slide' )
		]
	] );
}

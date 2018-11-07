<?php
// footer widgets
register_sidebar( [
	'name' => __( 'Footer widget', 'shop' ),
	'id' => 'footer_widgets',
	'description' => __( 'Footer widget', 'shop' ),
	'before_widget' => '<div class="col-md-3 span1_of_4">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
] );

add_filter( 'widget_nav_menu_args', function ( $nav_menu_args, $nav_menu, $args, $instance ) {
	if ( $args['id'] == 'footer_widgets' ) {
		$nav_menu_args['container'] = '';
		$nav_menu_args['menu_class'] = 'f_nav';
	}
	return $nav_menu_args;
}, '', 4 );
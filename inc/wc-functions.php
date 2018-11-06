<?php
// products per page
add_filter( 'loop_shop_per_page', function ( $count ) {
	if ( is_shop() ) $count = 6;
	return $count;
} );
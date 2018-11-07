<?php

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="col-md-4 product simpleCart_shelfItem text-center">
	<a href="<?= the_permalink() ?>">
		<?php
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		do_action( 'woocommerce_before_shop_loop_item_title' );
		echo getProductImage( 'shop_page_loop_img' );
		?>
	</a>
	<div class="mask">
		<a href="<?= the_permalink() ?>"><?php _e( 'Quick View', 'shop' ) ?></a>
	</div>
	<a class="product_name" href="<?= the_permalink() ?>"><?= the_title() ?></a>
	<?php
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>

<div class="other-products">
	<div class="container">
		<h3 class="like text-center"><?= _e( 'Featured Collection', 'shop' ) ?></h3>
		<?php $bottom_slider_products = new WP_Query( 'post_type=product&posts_per_page=5&orderby=rand' ) ?>
		<?php if ( $bottom_slider_products->have_posts() ) : ?>
			<ul id="flexiselDemo3">
				<?php while ( $bottom_slider_products->have_posts() ) : $bottom_slider_products->the_post(); ?>
					<li>
						<a href="<?= the_permalink() ?>">
							<?php
							remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
							do_action( 'woocommerce_before_shop_loop_item_title' );
							echo getProductImage( 'bottom_slider_img', ['class' => 'img-responsive'] );
							?>
						</a>
						<div class="product liked-product simpleCart_shelfItem">
							<a class="like_name" href="<?= the_permalink() ?>"><?= the_title() ?></a>
							<?php addToCartBottomSlider() ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>
<div class="products">
	<?php if ( ! dynamic_sidebar( 'sidebar_widget' ) ) : ?>
		<h3><?= _e( 'Sidebar widget is here', 'shop' ) ?></h3>
	<?php endif; ?>
	<div class="latest-bis">
		<?php
		$sale_products = new WP_Query( [
			'post_type' => 'product',
			'posts_per_page' => 1,
			'orderby' => 'rand',
			'meta_query' => [
				'relation' => 'OR',
		        array( // Simple products type
		            'key'           => '_sale_price',
		            'value'         => 0,
		            'compare'       => '>',
		            'type'          => 'numeric'
		        ),
		        array( // Variable products type
		            'key'           => '_min_variation_sale_price',
		            'value'         => 0,
		            'compare'       => '>',
		            'type'          => 'numeric'
		        )
			]
		] );
		?>
		<?php if ( $sale_products->have_posts() ) : ?>
			<?php while ( $sale_products->have_posts() ) : $sale_products->the_post(); ?>
				<a href="<?= the_permalink() ?>">
					<?= getProductImage( '', ['class' => 'img-responsive'] ) ?>
					<div class="offer">
						<p><?= getSaleSize() ?>%</p>
						<small><?= _e( 'Top Offer', 'shop' ) ?></small>
					</div>
				</a>
			<?php endwhile; ?>			
		<?php endif; ?>
	</div> 	
	<div class="tags">
		<h4 class="tag_head"><?= _e( 'Tags Widget', 'shop' ) ?></h4>
		<?php
		$tags = wp_tag_cloud( [
			'smallest'  => 8,
			'largest'   => 22,
			'format'    => 'array',
			'taxonomy'  => 'product_tag',
			'echo'      => false
		] );
		?>
		<ul class="tags_links">
			<?php foreach ( $tags as $tag ) : ?>
				<li><?= $tag ?></li>
			<?php endforeach; ?>
		</ul>					
	</div>
</div>
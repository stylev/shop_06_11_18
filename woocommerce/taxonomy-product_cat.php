<?php
get_header();
?>
	<!-- content-section-starts-here -->
	<div class="container">
		<div class="products-page">
			<?php get_sidebar() ?>
			<div class="new-product">
				<?php
				remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
				do_action( 'woocommerce_before_main_content' );
				?>
				<div class="mens-toolbar">
					<div class="sort">
						<div class="sort-by">
							<label><?= _e( 'Sort By', 'shop' ) ?></label>
							<?php
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
							do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>
					</div>
					<?php do_action( 'woocommerce_after_shop_loop' ) ?>
					<div class="clearfix"></div>		
				</div>
				<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
					<div class="cbp-vm-options">
						<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid" title="grid">Grid View</a>
						<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list" title="list">List View</a>
					</div>
					<div class="pages">   
						<div class="limiter visible-desktop">
							<label><?= _e( 'Show', 'shop' ) ?></label>
							<select class="product-cat-per-page">
								<option value="1" <?php if ( isset( $_GET['ppp'] ) && $_GET['ppp'] == 1 ) echo 'selected' ?>>1</option>
								<option value="2" <?php if ( isset( $_GET['ppp'] ) && $_GET['ppp'] == 2 ) echo 'selected' ?>>2</option>
								<option value="3" <?php if ( ! isset( $_GET['ppp'] ) || $_GET['ppp'] == 3 ) echo 'selected' ?>>3</option>
							</select> <?= _e( 'per page', 'shop' ) ?>       
						</div>
					</div>
					<div class="clearfix"></div>
					<?php if ( have_posts() ) : global $product; ?>
						<ul>
							<?php while ( have_posts() ) : the_post(); ?>
								<li>
									<a class="cbp-vm-image" href="<?= the_permalink() ?>">
										<div class="simpleCart_shelfItem">
											<div class="view view-first">
												<div class="inner_content clearfix">
													<div class="product_image">
														<?php
														remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
														do_action( 'woocommerce_before_shop_loop_item_title' );
														echo getProductImage( '', ['class' => 'img-responsive'] );
														?>
														<div class="mask">
															<div class="info"><?= _e( 'Quick View', 'shop' ) ?></div>
														</div>
														<div class="product_container">
															<div class="cart-left">
																<p class="title"><?= the_title() ?></p>
															</div>
															<div class="pricey">
																<span class="item_price"><?= shopGetPriceHtml() ?></span>
															</div>
															<div class="clearfix"></div>
														</div>		
													</div>
												</div>
											</div>
										</div>
									</a>
									<div class="cbp-vm-details">
										<?= $product->get_short_description() ?>
									</div>
									<?php
									remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
									do_action( 'woocommerce_after_shop_loop_item' );
									?>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- content-section-ends-here -->
<?php
get_template_part( 'template-parts/bottom', 'slider' );
get_search_form();
get_footer();
?>

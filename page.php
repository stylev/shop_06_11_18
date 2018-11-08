<?php
get_header();
?>
	<!-- content-section-starts-here -->
	<?php if ( is_cart() ) : ?>
		<div class="cart-items">
			<div class="container">
				<?php
				remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
				do_action( 'woocommerce_before_main_content' );
				?>
				<h2><?php _e( 'MY SHOPPING BAG', 'shop' ) ?></h2>
				<div class="cart-gd">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content() ?>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php elseif ( is_account_page() || is_checkout() ) : ?>
		<div class="content">
			<div class="container">
				<div class="login-page">
					<?php
					remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
					do_action( 'woocommerce_before_main_content' );
					?>
					<div class="account_grid">
						<div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content() ?>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<?php get_search_form() ?>
		</div>
	<?php endif; ?>
	<!-- content-section-ends-here -->
<?php
if ( is_cart() ) get_search_form();
get_footer();
?>
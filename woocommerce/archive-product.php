<?php
get_header();
get_template_part( 'template-parts/main', 'slider' );
?>
	<!-- content-section-starts-here -->
	<div class="container">
		<div class="main-content">
			<?php get_template_part( 'template-parts/main', 'page-widgets' ) ?>
			<div class="products-grid">
				<header>
					<h3 class="head text-center"><?php woocommerce_page_title(); ?></h3>
				</header>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'woocommerce/content', 'product' ) ?>
				<?php endwhile; ?>
				<?php endif; ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- content-section-ends-here -->
<?php
get_template_part( 'template-parts/bottom', 'slider' );
get_search_form();
get_footer();
?>
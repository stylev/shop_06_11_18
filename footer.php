<div class="footer">
		<div class="container">
			<div class="footer_top">
				<div class="span_of_4">
					<?php if ( ! dynamic_sidebar( 'footer_widgets', 'shop' ) ) : ?>
						<h3><?= _e( 'Footer widgets are here', 'shop' ) ?></h3>
					<?php endif; ?>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="cards text-center">
				<img src="<?= bloginfo( 'template_url' ) ?>/assets/images/cards.jpg" alt="" />
			</div>
			<div class="copyright text-center">
				<p>&copy; <?= date( 'Y' ) ?> <?php printf( __( 'Eshop. All Rights Reserved %s Design by', 'shop' ), '|' ) ?>   <a href="http://w3layouts.com">  W3layouts</a></p>
			</div>
		</div>
	</div>
	<link rel="stylesheet" href="<?= bloginfo( 'template_url' ) ?>/assets/css/flexslider.min.css" type="text/css" media="screen" />
	<?= wp_footer() ?>
</body>
</html>
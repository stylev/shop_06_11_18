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
				<?= getImage( SHOP_DIR_URI . 'assets/images/cards.jpg' ) ?>
			</div>
			<div class="copyright text-center">
				<p>&copy; <?= date( 'Y' ) ?> <?php printf( __( 'Eshop. All Rights Reserved %s Design by', 'shop' ), '|' ) ?>   <a href="http://w3layouts.com">  W3layouts</a></p>
			</div>
		</div>
	</div>
	<?= wp_footer() ?>
</body>
</html>
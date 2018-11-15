<div class="online-strip">
	<div class="col-md-4 follow-us">
		<h3><?= _e( 'follow us', 'shop' ) ?>: <a class="twitter" href="#"></a><a class="facebook" href="#"></a></h3>
	</div>
	<div class="col-md-4 shipping-grid">
		<div class="shipping">
			<?= getImage( SHOP_DIR_URI . 'assets/images/shipping.png' ) ?>
		</div>
		<div class="shipping-text">
			<h3><?= __( 'Free Shipping', 'shop' ) ?></h3>
			<?php
			$exchange_rate = get_option( 'shop_option_name' )['exchange_rate'];
			$cur_symbol = get_locale() == 'ru_RU' ? get_woocommerce_currency_symbol( 'UAH' ) : get_woocommerce_currency_symbol( 'USD' );
			$tax_rate = get_locale() == 'ru_RU' ? 200 : ( round( 200 / $exchange_rate, 2 ) );
			?>
			<p><?= _e( 'on orders over', 'shop' ) . ' ' . $cur_symbol . $tax_rate ?></p>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-md-4 online-order">
		<p>Order online</p>
		<?php
		$tel = get_option( 'shop_option_name' )['phone_number'];
		$tel_link = preg_replace( '/\s|-|\(|\)/', '', $tel );
		?>
		<a href="tel:<?= $tel_link ?>">
			<h3><?= __( 'Tel', 'shop' ) . ':' . $tel ?></h3>
		</a>
	</div>
	<div class="clearfix"></div>
</div>
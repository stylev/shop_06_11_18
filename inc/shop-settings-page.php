<?php
add_action( 'admin_menu', 'shopSettingsPage' );

function shopSettingsPage() {
	add_menu_page( 
		__( 'Shop settings', 'shop' ), 
		__( 'Shop settings', 'shop' ), 
		'manage_options', 
		'shop-settings', 
		function () {
			?>
				<form action="options.php" method="post" enctype="multipart/form-data">
					<?= settings_fields( 'shop_option_group' ) ?>
					<?= do_settings_sections( 'shop-settings' ) ?>
					<?= submit_button() ?>
				</form>
			<?php
		}, 
		'dashicons-groups', 
		27
	);

	register_setting( 
		'shop_option_group', 
		'shop_option_name', 
		function ( $options ) {
			if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
			if ( ! empty( $_FILES['shop_settings_field_bg_image']['tmp_name'] ) ) {
				$file = &$_FILES['shop_settings_field_bg_image'];
				$overrides = array( 'test_form' => false );
				$movefile = wp_handle_upload( $file, $overrides );
				$options['bg_image'] = $movefile['url'];				
			} else {
				$old_options = get_option( 'shop_option_name' );
				$options['bg_image'] = $old_options['bg_image']?? '';
			}
			if ( isset( $_POST['shop_settings_field_bg_image_remove'] ) && $_POST['shop_settings_field_bg_image_remove'] == 'on' ) unset( $options['bg_image'] );
			$clean_options = [];
			foreach ( $options as $k => $v ) {
				$clean_options[$k] = strip_tags( $v );
			}
			return $options;
		}
	);

	add_settings_section( 
		'shop_settings_section_id', 
		'', 
		'', 
		'shop-settings'
	);

	add_settings_field( 
		'shop_settings_exchange_rate', 
		__( 'Exchange_rate', 'shop' ), 
		function ( $args ) {
			$options = get_option( 'shop_option_name' );
			$exchange_rate = $options['exchange_rate']?? '25.5';
			$label = $args['label_for'];
			$name = 'shop_option_name[exchange_rate]';
			$class = 'regular-text';
			?>
				<input type="text" name="<?= $name ?>" id="<?= $label ?>" class="<?= $class ?>" value="<?= $exchange_rate ?>">
			<?php
		}, 
		'shop-settings', 
		'shop_settings_section_id', 
		['label_for' => 'shop_settings_exchange_rate']
	);

	add_settings_field( 
		'shop_settings_field_phone', 
		__( 'Phone number', 'shop' ), 
		function ( $args ) {
			$options = get_option( 'shop_option_name' );
			$phone_number = $options['phone_number']?? '+38 (044) 444-44-44';
			$label = $args['label_for'];
			$name = 'shop_option_name[phone_number]';
			$class = 'regular-text';
			?>
				<input type="tel" name="<?= $name ?>" id="<?= $label ?>" value="<?= $phone_number ?>" class="<?= $class ?>" pattern="\+[0-9]{2}\s\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}">
			<?php
		}, 
		'shop-settings', 
		'shop_settings_section_id', 
		['label_for' => 'shop_settings_field_phone']
	);

	add_settings_field( 
		'shop_settings_field_bg_image', 
		__( 'Background image', 'shop' ), 
		function ( $args ) {
			$options = get_option( 'shop_option_name' );
			$label = $args['label_for'];
			?>
				<input type="file" name="shop_settings_field_bg_image" id="<?= $label ?>">
				<?php if ( isset( $options['bg_image'] ) && ! empty( $options['bg_image'] ) ) : ?>
					<p>
						<img src="<?= $options['bg_image'] ?>" alt="" width="200">
					</p>
				<?php endif; ?>
			<?php
		}, 
		'shop-settings', 
		'shop_settings_section_id', 
		['label_for' => 'shop_settings_field_bg_image']
	);

	add_settings_field( 
		'shop_settings_field_bg_image_remove', 
		__( 'Remove background image', 'shop' ), 
		function ( $args ) {
			$options = get_option( 'shop_option_name' );
			$label = $args['label_for'];
			?>
				<input type="checkbox" name="shop_settings_field_bg_image_remove" id="<?= $label ?>">
			<?php
		}, 
		'shop-settings', 
		'shop_settings_section_id', 
		['label_for' => 'shop_settings_field_bg_image_remove']
	);
}
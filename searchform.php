<div class="news-letter">
	<div class="container">
		<div class="join">
			<h6><?php _e( 'Store search', 'shop' ) ?></h6>
			<div class="sub-left-right">
				<form action="<?= home_url( '/' ) ?>" method="post">
					<input type="text" name="s" value="<?= _e( 'Enter Your Search phrase', 'shop' ) ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?= _e( 'Enter Your Search phrase', 'shop' ) ?>';}" />
					<input type="submit" value="<?= _e( 'Search', 'shop' ) ?>" />
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
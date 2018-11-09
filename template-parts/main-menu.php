<?php if ( is_shop() ) : ?>
<div class="banner-top">
	<div class="container">
<?php else : ?>
<div class="inner-banner">
	<div class="container">
		<div class="banner-top inner-head">
<?php endif; ?>
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="logo">
					<h1><a href="<?= home_url() ?>"><span>E</span> -Shop</a></h1>
				</div>
			</div>
			<!--/.navbar-header-->	
			<?php
			wp_nav_menu( [
				'theme_location' => 'top',
				'container' => 'div',
				'container_class' => 'collapse navbar-collapse',
				'container_id' => 'bs-example-navbar-collapse-1',
				'menu_class' => 'nav navbar-nav',
				'walker' => new ShopWalkerNavMenu
			] );
			?>
			<!--/.navbar-collapse-->
		</nav>
		<!--/.navbar-->
	</div>
</div>
<?php if ( ! is_shop() ) : ?>
</div>
<?php endif; ?>
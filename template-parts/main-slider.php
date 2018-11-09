<div class="banner">
	<div class="container">
		<div class="banner-bottom">
			<div class="banner-bottom-left">
				<?php if ( get_locale() != 'ru_RU' ) : ?>
					<h2>B<br>U<br>Y</h2>
				<?php else : ?>
					<h2>К<br>У<br>П<br>И</h2>
				<?php endif; ?>
			</div>
			<div class="banner-bottom-right">
				<div  class="callbacks_container">
					<?php $slider_posts = new WP_Query( 'post_type=slider&posts_per_page=3&order=ASC' ) ?>
					<?php if ( $slider_posts->have_posts() ) : ?>
						<ul class="rslides" id="slider4">
							<?php while ( $slider_posts->have_posts() ) : $slider_posts->the_post(); ?>
								<li>
									<div class="banner-info">
										<h3><?= the_title() ?></h3>
										<?= the_content() ?>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
				<!--banner-->
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="shop">
			<a href="single.html">SHOP COLLECTION NOW</a>
		</div>
	</div>
</div>
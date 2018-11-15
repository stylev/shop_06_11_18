jQuery(document).ready(function($) {
	// Slideshow 4
	$("#slider4").responsiveSlides({
		auto: true,
		pager:true,
		nav:false,
		speed: 500,
		namespace: "callbacks",
		before: function () {
			$('.events').append("<li>before event fired.</li>");
		},
		after: function () {
			$('.events').append("<li>after event fired.</li>");
		}
	});

	$("#flexiselDemo3").flexisel({
		visibleItems: 4,
		animationSpeed: 1000,
		autoPlay: false,
		autoPlaySpeed: 3000,    		
		pauseOnHover: true,
		enableResponsiveBreakpoints: true,
		responsiveBreakpoints: { 
			portrait: { 
				changePoint:480,
				visibleItems: 1
			}, 
			landscape: { 
				changePoint:640,
				visibleItems: 2
			},
			tablet: { 
				changePoint:768,
				visibleItems: 3
			}
		}
	});

	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails"
	});

	$( '#myTab a' ).click( function ( e ) {
		e.preventDefault();
		$( this ).tab( 'show' );
	} );

	$( '#moreTabs a' ).click( function ( e ) {
		e.preventDefault();
		$( this ).tab( 'show' );
	} );

	// cart
	$('.close1').on('click', function(c){
		$('.cart-header').fadeOut('slow', function(c){
			$('.cart-header').remove();
		});
	});

	$('.close2').on('click', function(c){
		$('.cart-header2').fadeOut('slow', function(c){
			$('.cart-header2').remove();
		});
	});

	$('.close3').on('click', function(c){
		$('.cart-header3').fadeOut('slow', function(c){
			$('.cart-header3').remove();
		});
	});
	
	// bg image
	if (shopObj.bgImage != null) {
		$('.banner').css({
			'background': 'url(' + shopObj.bgImage + ') no-repeat center',
			'background-size': 'cover'
		});
	} else {
		$('.banner').css({
			'background': 'url("../images/banner_img.jpg") no-repeat center',
			'background-size': 'cover'
		});
	}
});

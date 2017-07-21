jQuery(window).load(function() {
					jQuery('#carousel').flexslider({
						animation: "slide",
						controlNav: false,
						animateHeight: true,
						directionNav: true,
						animationLoop: false,
						slideshow: true,
						slideshowSpeed: 7000,
						animationDuration: 600,
												itemWidth: 120,
												itemMargin: 0,
						asNavFor: '#slider'
					});
				   
					jQuery('#slider').flexslider({
						animation: "slide",
							
						controlNav: false,
						animationLoop: false,
						slideshow: false,
						sync: "#carousel"
					});

					// Slider for Testimonails			
		            jQuery('.flexslider').flexslider({
		                animation: "fade",
		                slideDirection: "horizontal",
		                slideshow: true, 
		                slideshowSpeed: 7000,
		                animationDuration: 600,  
		                controlNav: false,
		                directionNav: true,
		                keyboardNav: true,
		                randomize: false,
		                pauseOnAction: true,
		                pauseOnHover: false,	 				
		                animationLoop: true	
		            });
				});
				
				jQuery(document).ready(function() {
					jQuery('.gallery-item').magnificPopup({
						type: 'image',
						gallery:{
							enabled:true
						}
					});
				});
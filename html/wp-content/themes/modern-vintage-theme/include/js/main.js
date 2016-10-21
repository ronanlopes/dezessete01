jQuery(function($){

/* ==================================================
	Toggle Serch
================================================== */



$('.sbutton').click(function(){
    $('.widget_navigation').fadeToggle(350);
});


/* =================================
   Animation
=================================== */
var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       false        // trigger animations on mobile devices (true is default)
  }
);
wow.init();





/* ==================================================
	Widget Last Works
================================================== */


$('a.cont_last_works').hover(function(){
        $(this).find(".tit_last_work").toggleClass("select_last_work");
    });


$('a.cont_last_works').hover(function(){
        $(this).find(".tit_team").toggleClass("select_last_work");
    });



/* ==================================================
	Scroll To Top
================================================== */

jQuery(function() {
	var indieScroll = false;

	var $arrowx = $('#back-to-top');

	$arrowx.click(function(e) {
		$('body,html').animate({ scrollTop: "0" }, 750, 'easeOutExpo' );
		e.preventDefault();
	});

	$(window).scroll(function() {
		indieScroll = true;
	});

	setInterval(function() {
		if( indieScroll ) {
			indieScroll = false;

			if( $(window).scrollTop() > 1000 ) {
				$arrowx.css('display', 'block');
			} else {
				$arrowx.css('display', 'none');
			}
		}
	}, 250);

	});


/* ==================================================
	Flex Slider
================================================== */


$(window).load(function(){
      $('.flexslider').flexslider({
          animation: "fade",
          directionNav: false,
		controlNav: false,
	   //easing:"swing",
		smoothHeight:true,
		directionNav: true,
		reverse:false,
		animationSpeed: 900,
          before: function(sliderx) {
          sliderx.removeClass('loading_slide_portfolio');
        }

      });

        });


/* ==================================================
	Testimonial Sliders
================================================== */

jQuery(function() {

if($('.testimonial').length > 0 ){
	$('.testimonial').flexslider({
		animation:"slide",
		easing:"swing",
		controlNav: false,
		touch: false,
		reverse:false,
		smoothHeight:true,
		directionNav: true,
		controlsContainer: '.indie-testimonials-container',
		animationSpeed: 900
	});
}

});


/* ==================================================
	Animate Gray Scale
================================================== */

$('li.frame').hover(function(){
        $(this).find("img.disabled").toggleClass("grayscalecss");

    });


/* ==================================================
	Portfolio
================================================== */
	if($('.isotopeWrapper').length){
		var $container = $('.isotopeWrapper');
		var $resize = $('.isotopeWrapper').attr('id');
		// initialize isotope

		$container.imagesLoaded(function() {
			$container.isotope({
				itemSelector: '.isotopeItem',
				resizable: false, // disable normal resizing
				masonry: {
					columnWidth: $container.width() / $resize
				}
			});
		});

		var rightHeight = $('#works').height();
		$('#filter a').click(function(){
			$('#works').height(rightHeight);
			$('#filter a').removeClass('current');
			$(this).addClass('current');
			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector,
				animationOptions: {
					duration: 1000,
					easing: 'easeOutQuart',
					queue: false
				}
			});
			return false;
		});

		$(window).smartresize(function(){
			$container.isotope({
				// update columnWidth to a percentage of container width
				masonry: {
					columnWidth: $container.width() / $resize
				}
			});
		});
	}




/* ==================================================
   Mobile Navigation
================================================== */


// Call the Event for Menu
jQuery(function() {

	$('#mobile-nav').on('click', function(e){
		$(this).toggleClass('open');

		$('#navigation-mobile').stop().slideToggle(350, 'easeOutExpo');
		e.preventDefault();
	});
 });

jQuery(function() {
	$('#menu-nav-mobile li').children('.sub-menu').hide().parent().addClass('menu-parent-item');
	$('#menu-nav-mobile .menu-parent-item a').not('.sub-menu a').append('<i class="fa fa-angle-down"></i>');

	$('#menu-nav-mobile .menu-parent-item').on('click', function(e) {
		e.preventDefault();
		$(this).children('.sub-menu').stop().slideToggle(350, 'easeOutExpo');
		$(this).toggleClass('open');
	});

	$('#menu-nav-mobile .sub-menu a').on('click', function(e) {
		e.stopPropagation();
	});
 });




   jQuery(".flexnav").flexNav();







/* ==================================================
   FitVids
================================================== */

$("#vid_container").fitVids();


/* ==================================================
   Tooltip
================================================== */

$('.indietooltip').tooltip()

/* ==================================================
   Accordion - Togle
================================================== */

$(document).ready(function(){
	$('.accordion-toggle').click(function (e){
		$(this).find('.arrow_togle').first().toggleClass('fa-plus fa-minus');
	});
});



$('#accordion .accordion-toggle').click(function (e){
  var chevState = $(e.target).siblings("i.indicator_area").toggleClass('fa-chevron-down fa-chevron-up');
  $("i.indicator_area").not(chevState).removeClass("fa-chevron-up").addClass("fa-chevron-down ");
});



$('#accordionarea .accordion-toggle').click(function (e){
  var Indieaccordion = $(e.target).siblings("i.indicator_area").toggleClass('fa-plus  fa-minus');
  $("i.indicator_area").not(Indieaccordion).removeClass("fa-minus").addClass("fa-plus ");
});


/* ==================================================
   Pretty Photo
================================================== */

$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: false, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true,
			markup: '<div class="pp_pic_holder"> \
						<div class="ppt"></div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous">Previous</a> \
												<p class="currentTextHolder">0/0</p> \
												<a href="#" class="pp_arrow_next">Next</a> \
											</div> \
											<p class="pp_description"></p> \
											{pp_social} \
											<a class="pp_close" href="#">Close</a> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
			gallery_markup: '<div class="pp_gallery"> \
								<a href="#" class="pp_arrow_previous">Previous</a> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="pp_arrow_next">Next</a> \
							</div>',
			image_markup: '<img id="fullResImage" src="{path}" />',
			flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
			quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
			iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
			inline_markup: '<div class="pp_inline">{content}</div>',
			custom_markup: '',
			social_tools: '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>' /* html or false to disable */
		});
	});



/* ==================================================
   End
================================================== */

});
jQuery(document).ready(function($) {

    jQuery('ol.comment-list li:last .comment-content,.postlist-blog article:last,.postlist-cols-1 article:last').css('border','none');

    jQuery('.postlist-cols-1.shortcode_news article:last').css('border-bottom','1px solid #ebebeb');

    if(jQuery('.postlist-blog').find('nav.navigation').length != 0 || jQuery('.postlist-blog').siblings('.load_button').is(':visible')){
        jQuery('.postlist-blog article:last').css('borderBottom','1px solid #ebebeb');
    }

    if(jQuery('.postlist-cols-1').find('nav.navigation').length != 0 || jQuery('.postlist-cols-1').siblings('.load_button').is(':visible')){
        jQuery('.postlist-cols-1 article:last').css('borderBottom','1px solid #ebebeb');
    }

     var default_opts = {
        inline: true,
        firstDay: 0,
        showOtherMonths: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        prevText: 'MM yy',
        nextText: 'MM yy',
        navigationAsDateFormat: true
    };

    var datepicker_opts = jQuery.extend(default_opts, tf_calendar.datepicker_opts);

    jQuery('#calendar').datepicker(datepicker_opts);
    $("table.ui-datepicker-calendar td").addClass('ui-datepicker-unselectable');
    $(".ui-datepicker-next").before($('.ui-datepicker-title'));


    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});

    if(jQuery('.children_mega_nav').parent('li').hasClass('mega-nav-widget'))
        jQuery('.children_mega_nav').parent('li').removeClass('mega-nav-widget');

    //load pagination
    var load_counter = 0;
    jQuery(document).on('click','#load_game_posts',function(){

        jQuery(this).attr('data-posts-per-page',(parseInt(load_counter) + parseInt(display.items)));

        load_counter = jQuery(this).attr('data-posts-per-page');

        var tax = jQuery(this).attr('data-from');
        var post_id = jQuery(this).attr('data-post-id');
        var term_id = jQuery(this).attr('data-term-id');

        var x_data = "action=tfuse_ajax_load_pagination&post_id="+post_id+"&term_id="+term_id+"&tax="+tax+"&counter="+load_counter;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: x_data,
            beforeSend: function(){
                jQuery('#loading_game_posts').show();
                jQuery('#load_game_posts').hide();
            },
            success: function(rsp){
                jQuery('#loading_game_posts').hide();
                jQuery('#load_game_posts').show();

                var obj = jQuery.parseJSON(rsp);

//                var obj = rsp; 
//                console.log(obj);

                jQuery(".ajax_section_load").append( obj.html );

                if(obj.show_pagination) jQuery('.load_button').show();
                else jQuery('.load_button').hide();

                jQuery('a[data-rel]').each(function() {
                jQuery(this).attr('rel', jQuery(this).data('rel'));
                });
                jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});

                jQuery('.postlist-blog article:last,.postlist-cols-1 article:last,.postlist div.post:last').css('border','none');

                if(jQuery('.postlist-blog').siblings('.load_button').is(':visible')){
                    jQuery('.postlist-blog article:last').css('borderBottom','1px solid #ebebeb');
                }

                if(jQuery('.postlist-cols-1').siblings('.load_button').is(':visible')){
                    jQuery('.postlist-cols-1 article:last').css('borderBottom','1px solid #ebebeb');
                }

                if(jQuery('.postlist').parent('.tab-content').siblings('.load_button').is(':visible')){
                    jQuery('.postlist div.post:last').css('borderBottom','1px solid #ebebeb');
                }
            }
        });

        return false;
    });

    //get gallery posts from filter in game post
    jQuery(document).on('click','.terms-game-filter ul li a',function(){
        load_counter = 0;

        //add class active on the clciked tab
        if(!jQuery(this).hasClass('active'))
        {
            jQuery(this).parents('ul').each(function(){
                jQuery(this).find('.active').removeClass('active');
            });

            jQuery(this).addClass('active');
        }

        var term_id = jQuery(this).attr('data-term');
        var post_id = jQuery(this).attr('data-game-post');
        var tax = jQuery(this).parents('.terms-game-filter').attr('id');

        jQuery('#load_game_posts').attr('data-term-id',term_id);

        var x_data = "action=tfuse_ajax_get_filter_game_posts&post_id="+post_id+"&term_id="+term_id+"&tax="+tax;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: x_data,
            beforeSend: function(){
                jQuery('#game-portfolio-list').empty().append('<div class="loading_post"><img src="'+tf_script.TFUSE_THEME_URL+'/images/loading_game.gif" /></div>');
            },
            success: function(rsp){
                jQuery('#game-portfolio-list').empty();

                var obj = jQuery.parseJSON(rsp);

//                var obj = rsp; 
//                console.log(obj);

                jQuery("#game-portfolio-list").append( obj.html );

                if(obj.show_pagination) jQuery('.load_button').show();
                else jQuery('.load_button').hide();

                jQuery('a[data-rel]').each(function() {
                jQuery(this).attr('rel', jQuery(this).data('rel'));
                });
                jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});

                jQuery('.postlist div.post:last').css('border','none');

                if(jQuery('.postlist').parent('.tab-content').siblings('.load_button').is(':visible')){
                    jQuery('.postlist div.post:last').css('borderBottom','1px solid #ebebeb');
                }

            }
        });

        return false;
    });

    //get game posts
    jQuery('.game-filter ul li a').on('click',function(){
        load_counter = 0;

        //add class active on the clciked tab
        if(!jQuery(this).parent('li').hasClass('active'))
        {
            jQuery(this).parents('ul').each(function(){
                jQuery(this).children('li').removeClass('active');
            });

            jQuery(this).parent('li').addClass('active');
        }

        var posts_from = jQuery(this).attr('id');
        var post_id = jQuery(this).parents('ul').attr('data-post-id');

        var x_data = "action=tfuse_ajax_get_game_posts&post_id="+post_id+"&posts_from="+posts_from;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: x_data,
            beforeSend: function(){
                jQuery('#primary .inner').empty().append('<section class="postlist postlist-blog"><div class="loading_post"><img src="'+tf_script.TFUSE_THEME_URL+'/images/loading_game.gif" /></div></section>');
            },
            success: function(rsp){
                jQuery('#primary .inner').empty();

                var obj = jQuery.parseJSON(rsp);
               // var obj = rsp;
                //console.log(obj);

                // console.log(obj.html[1]);

                jQuery("#primary .inner").append( obj.html );

                jQuery('a[data-rel]').each(function() {
                jQuery(this).attr('rel', jQuery(this).data('rel'));
                });
                jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});


                jQuery('.postlist-blog article:last,.postlist-cols-1 article:last,.postlist div.post:last').css('border','none');

                if(jQuery('.postlist-blog').siblings('.load_button').is(':visible')){
                    jQuery('.postlist-blog article:last').css('borderBottom','1px solid #ebebeb');
                }

                if(jQuery('.postlist-cols-1').siblings('.load_button').is(':visible')){
                    jQuery('.postlist-cols-1 article:last').css('borderBottom','1px solid #ebebeb');
                }

                if(jQuery('.postlist').parent('.tab-content').siblings('.load_button').is(':visible')){
                    jQuery('.postlist div.post:last').css('borderBottom','1px solid #ebebeb');
                }
            }
        });

        return false;
    });

    //remove filter item
    jQuery('.top-filter .remove').on('click',function(){
        var id_val = jQuery(this).attr('id'); var new_url;

        var current_url = window.location.href;

        if(id_val !== 'rating')
            new_url = current_url.replace("&"+id_val,'');
        else
        {
            var rating = jQuery(this).attr('data-rating');
            new_url = current_url.replace(rating,'price-range=0%3B10');
        }

        window.location.href = new_url;
    });


 	var $ = jQuery;

        var screenRes = $(window).width(),
        screenHeight = $(window).height(),
        html = $('html');

// IE<8 Warning
    if (html.hasClass("ie6") || html.hasClass("ie7")) {
        $("body").empty().html('Please, Update your Browser to at least IE8');
    }
// styled scrollbar
    $(window).load(function(){
        if ($("div").hasClass("scrollbar")) {
            $(".scrollbar").mCustomScrollbar();
        }
    });

// Disable Empty Links
    $("[href='#']").click(function(event){
        event.preventDefault();
    });

// Show/Hide Dropbox
    $('.dropbox-toggle').click(function(e){
        e.stopPropagation();
        $(this).next(".dropbox-content").fadeToggle(50,"linear", function() {});
    });
    $('.close').click(function(){
        $(this).parent('.dropbox-content').fadeOut(50);
    });

// Body Wrap
    $(".body-wrap").css("min-height", screenHeight);
    $(window).resize(function() {
        screenHeight = $(window).height();
        $(".body-wrap").css("min-height", screenHeight);
    });

// Remove outline in IE
	$("a, input, textarea").attr("hideFocus", "true").css("outline", "none");

// Add gradient to IE
/*
    setTimeout(function () {
        $(".btn span, .btn input, .price_col_head, .carousel-indicators li, .tabs li, .alert, .carousel-image a").addClass("gradient");
    }, 0);
*/
// buttons
    $(".btn-left, .btn-right, .animate").hover(function(){
        $(this).stop().animate({"opacity": 0.7});
    },function(){
        $(this).stop().animate({"opacity": 1});
    });
	$('a.btn, span.btn').on('mousedown', function(){
		$(this).addClass('active')
	});
	$('a.btn, span.btn').on('mouseup mouseout', function(){
		$(this).removeClass('active')
	});

// styled Select, Radio, Checkbox
    if ($("select").hasClass("select_styled")) {
        cuSel({changedEl: ".select_styled", visRows: 8, scrollArrows: true});
    }
    if ($("div,p").hasClass("input_styled")) {
        $(".input_styled input").customInput();
    }

// Menu
    $(".main-navigation li:first-child").addClass("first");
    $(".main-navigation li:last-child").addClass("last");

    $(".main-navigation ul").parents("li").addClass("parent");

    $(".main-navigation li").hover(function(){
        $(this).addClass('hover');
    },function(){
        $(this).removeClass('hover');
    });

// responsive menu made by Meanmenu
    if (screenRes < 768) {
        $(".main-navigation ul .mega-nav-widget").hide();
    }
    $('.main-navigation').meanmenu({
        meanMenuContainer: '.header-second-container',
        meanRevealPosition: "left",
        meanRevealPositionDistance: "5px"
    });

// Toggles
    $('.toggle-link').click(function(){
        $(this).parents('.toggle').removeClass('collapsed');

        if(!$(this).hasClass('collapsed')) {
            $(this).parents('.toggle').addClass('collapsed');
        }
    });

	$(".opened").find(".panel-collapse").addClass("in");
	$(".panel-toggle").click (function() {
		$(this).closest(".toggleitem").toggleClass("opened");;
	});

// Tooltip	
	$("[data-toggle='tooltip']").tooltip();

// Toggle Filters	 		
	$(".toggle-field-trigger").click(function(){
		$(this).parents().next(".toggle-field").slideToggle(300);
		$(this).toggleClass("collapsed");
	});
// carousels
	function carouselInit(carousel) {
		carousel.carouFredSel({
			prev : {
				button: function() {
					return $(this).parents(".carousel").find(".prev");
				}
			},
			next : {
				button: function() {
					return $(this).parents(".carousel").find(".next");
				}
			},
			width: '100%',
			auto: false,
			scroll: {
				items: 1
			}
		});
	};
// prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
    if($('a').is('[data-rel]') && screenRes > 600) {
        $('a[data-rel]').each(function() {
            $(this).attr('rel', $(this).data('rel'));
        });
        $("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
    };

// SyntaxHighlighter
	if ($("pre").hasClass("brush: plain")) {
		SyntaxHighlighter.defaults['gutter'] = false;
		SyntaxHighlighter.defaults['toolbar'] = true;
		SyntaxHighlighter.all();
	}

// Smooth Scroling of ID anchors
    function filterPath(string) {
        return string
            .replace(/^\//,'')
            .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
            .replace(/\/$/,'');
    }
    var locationPath = filterPath(location.pathname);
    var scrollElem = scrollableElement('html', 'body');

    $('a[href*="#"].anchor').each(function() {
        $(this).click(function(event) {
            var thisPath = filterPath(this.pathname) || locationPath;
            if (  locationPath == thisPath
                && (location.hostname == this.hostname || !this.hostname)
                && this.hash.replace(/#/,'') ) {
                var $target = $(this.hash), target = this.hash;
                if (target && $target.length != 0) {
                    var targetOffset = $target.offset().top;
                    event.preventDefault();
                    $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
                        location.hash = target;
                    });
                }
            }
        });
    });
    // use the first element that is "scrollable"
    function scrollableElement(els) {
        for (var i = 0, argLength = arguments.length; i <argLength; i++) {
            var el = arguments[i],
                $scrollElement = $(el);
            if ($scrollElement.scrollTop()> 0) {
                return el;
            } else {
                $scrollElement.scrollTop(1);
                var isScrollable = $scrollElement.scrollTop()> 0;
                $scrollElement.scrollTop(0);
                if (isScrollable) {
                    return el;
                }
            }
        }
        return [];
    };

// Rating Stars
    $(".rating-vote span.star").hover(
        function() {
            $('.rating-vote span.star').removeClass('on').addClass('off');
            $(this).prevAll().addClass('over');
        }
        , function() {
            $(this).removeClass('over');
        }
    );
    $(".rating-vote").mouseleave(function(){
        $(this).parent().find('.over').removeClass('over');
    });
    $(".rating-vote span.star").click( function() {
        $(this).prevAll().removeClass('off').addClass('on');
        $(this).removeClass('off').addClass('on');
    });

// Crop Images in Image Slider
    // adds .naturalWidth() and .naturalHeight() methods to jQuery for retrieving a normalized naturalWidth and naturalHeight.
    (function($){
        var
            props = ['Width', 'Height'],
            prop;

        while (prop = props.pop()) {
            (function (natural, prop) {
                $.fn[natural] = (natural in new Image()) ?
                    function () {
                        return this[0][natural];
                    } :
                    function () {
                        var
                            node = this[0],
                            img,
                            value;

                        if (node.tagName.toLowerCase() === 'img') {
                            img = new Image();
                            img.src = node.src,
                                value = img[prop];
                        }
                        return value;
                    };
            }('natural' + prop, prop.toLowerCase()));
        }
    }(jQuery));

    var
        carousels_on_page = $('.carousel-inner').length,
        carouselWidth,
        carouselHeight,
        ratio,
        imgWidth,
        imgHeight,
        imgRatio,
        imgMargin,
        this_image,
        images_in_carousel;

    for(var i = 1; i <= carousels_on_page; i++){
        $('.carousel-inner').eq(i-1).addClass('id'+i);
    };

    function imageSize() {
        setTimeout(function () {
            for(var i = 1; i <= carousels_on_page; i++){
                carouselWidth = $('.carousel-inner.id'+i+' .item').width();
                carouselHeight = $('.carousel-inner.id'+i+' .item').height();
                ratio = carouselWidth/carouselHeight;

                images_in_carousel = $('.carousel-inner.id'+i+' .item img').length;

                for(var j = 1; j <= images_in_carousel; j++){
                    this_image = $('.carousel-inner.id'+i+' .item img').eq(j-1);
                    imgWidth = this_image.naturalWidth();
                    imgHeight = this_image.naturalHeight();
                    imgRatio = imgWidth/imgHeight;

                    if(ratio <= imgRatio){
                        imgMargin = parseInt((carouselHeight/imgHeight*imgWidth-carouselWidth)/2, 10);
                        this_image.css("cssText", "height: "+carouselHeight+"px; margin-left:-"+imgMargin+"px;");
                    }
                    else{
                        imgMargin = parseInt((carouselWidth/imgWidth*imgHeight-carouselHeight)/2, 10);
                        this_image.css("cssText", "width: "+carouselWidth+"px; margin-top:-"+imgMargin+"px;");
                    }
                }
            };
        },1000);
    };

    imageSize();
    $(window).resize(function() {
        $('.carousel-indicators li:first-child').click();
        imageSize();
    });

    $('.video-slider .video-slider-tabs li').on('click', function () {
        var parent = $(this).closest('.video-slider');
	    parent.find('.video-slider-content .tab-pane.active iframe').each(function () {
		    var that = $(this),
			    src = $(this).attr('src');
		    $(this).attr('src', '');
		    that.attr('src', src);
	    })
    })
});

// mega dropdown menu
function megaMenu(megaMenuSelector) {
    var $=jQuery;

    $(megaMenuSelector).each(function(){
        var liItems = $(this);
        var Sum = 0;
        var liHeight = 0;
        if (liItems.children('li').length > 1){
            $(this).children('li').each(function(i, e){
                Sum += $(e).outerWidth(true);
            });
            $(this).width(Sum);
            liHeight = $(this).innerHeight();
            $(this).children('li').css({"height":liHeight});
        }
        var posLeft = 0;
        var halfSum = Sum/2;
        var screenRes = $(window).width();
        // width of main container to fit in
        if (screenRes > 960 && screenRes < 1200) {
            var mainWidth = 900; // for PC small
        }
        if (screenRes < 960) {
            var mainWidth = 720; // for iPad
        }
        if (screenRes > 1200) {
            var mainWidth = 1200; // for PC large
        }
        var parentWidth = $(this).parent().width();
        var margLeft = $(this).parent().position();
        margLeft = margLeft.left;
        var margRight = mainWidth - margLeft - parentWidth;
        var subCenter = halfSum - parentWidth/2;

        if (margLeft >= halfSum && margRight >= halfSum) {
            liItems.css("left",-subCenter);
        } else if (margLeft < halfSum) {
            liItems.css("left",-margLeft-1);
        } else if (margRight < halfSum) {
            posLeft = Sum - margRight - parentWidth - 10;
            liItems.css("left",-posLeft);
        }
    });
}

jQuery(window).load(function() {
    megaMenu('.main-navigation .mega-nav > ul');
});
jQuery(window).resize(function() {
    megaMenu('.main-navigation .mega-nav > ul');
});
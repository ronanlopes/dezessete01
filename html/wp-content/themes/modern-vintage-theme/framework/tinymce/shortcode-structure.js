function embedSelectedShortcode() {

	var shortcodeHTML;
	var choice = jQuery('#shortcode-select').val();
	if (choice!="") {
		//blog right sidebar
		var blogrightsidebar_category=jQuery('#shortcode-blog-right-sidebar-category').val();

		//blog left sidebar
		var blogleftsidebar_category=jQuery('#shortcode-blog-left-sidebar-category').val();

		//blog full width
		var blogfullwidth_category=jQuery('#shortcode-blog-full-width-category').val();

		//columns
		var column_options=jQuery('#column-options').val();

		//portfolio
		var portfolio_category=jQuery('#portfolio-category').val();
		var portfolio_numitems=jQuery('#portfolio-numitems').val();

		//team single box
		var singlebox_image=jQuery('#single-box-image').val();
		var singlebox_title=jQuery('#single-box-title').val();
		var singlebox_text=jQuery('#single-box-text').val();
		var singlebox_url=jQuery('#single-box-url').val();

		//team single box
		var teamsinglebox_image=jQuery('#team-single-box-image').val();
		var teamsinglebox_title=jQuery('#team-single-box-title').val();
		var teamsinglebox_text=jQuery('#team-single-box-text').val();
		var teamsinglebox_url=jQuery('#team-single-box-url').val();

		//testimonial slider
		var slider_author1=jQuery('#testimonial-slider-author1').val();
		var slider_text1=jQuery('#testimonial-slider-text1').val();
		var slider_author2=jQuery('#testimonial-slider-author2').val();
		var slider_text2=jQuery('#testimonial-slider-text2').val();
		var slider_author3=jQuery('#testimonial-slider-author3').val();
		var slider_text3=jQuery('#testimonial-slider-text3').val();

		//contact info
		var contactinfo_mobile=jQuery('#contact-info-mobile').val();
		var contactinfo_telephone=jQuery('#contact-info-telephone').val();
		var contactinfo_email=jQuery('#contact-info-email').val();
		var contactinfo_web=jQuery('#contact-info-web').val();
		var contactinfo_address=jQuery('#contact-info-address').val();

		//polaroid image
		var polaroid_imageurl=jQuery('#polaroid-light-box-image-url').val();
		var polaroid_imagegroup=jQuery('#polaroid-light-box-image-group').val();
		var polaroid_imagetitle=jQuery('#polaroid-light-box-image-title').val();

		//polaroid video
		var polaroid_videourl=jQuery('#polaroid-light-box-video-url').val();
		var polaroid_videogroup=jQuery('#polaroid-light-box-video-group').val();
		var polaroid_videotitle=jQuery('#polaroid-light-box-video-title').val();
		var polaroid_videoimage=jQuery('#polaroid-light-box-video-image').val();

		//polaroid link
		var polaroid_customlinkurlimageurl=jQuery('#polaroid-custom-link-image-url').val();
		var polaroid_customlinkgroup=jQuery('#polaroid-custom-link-group').val();
		var polaroid_customlinkimagetitle=jQuery('#polaroid-custom-link-image-title').val();
		var polaroid_customlinkurl=jQuery('#polaroid-custom-link-url').val();

		//shortcode page title bar
		var pagetitlebar_title=jQuery('#page-title-bar-title').val();
		var pagetitlebar_subtitle=jQuery('#page-title-bar-subtitle').val();

		//shortcode text divider
		var shortcodetextdivider_text=jQuery('#shortcode-text-divider-text').val();

		//shortcode double divider text
		var shortcodedoubletextdivider_text=jQuery('#shortcode-double-divider-text').val();

		//accordion
		var accordion_title1=jQuery('#accordion-title1').val();
		var accordion_text1=jQuery('#accordion-text1').val();
		var accordion_title2=jQuery('#accordion-title2').val();
		var accordion_text2=jQuery('#accordion-text2').val();
		var accordion_title3=jQuery('#accordion-title3').val();
		var accordion_text3=jQuery('#accordion-text3').val();

		//shortcode double divider text
		var shortcodedoubletextdivider_text=jQuery('#shortcode-double-divider-text').val();

		//shortcode extra heading
		var extraheading_title=jQuery('#extraheading-title').val();

		//tab
		var tab_title1=jQuery('#tab-title1').val();
		var tab_text1=jQuery('#tab-text1').val();
		var tab_title2=jQuery('#tab-title2').val();
		var tab_text2=jQuery('#tab-text2').val();
		var tab_title3=jQuery('#tab-title3').val();
		var tab_text3=jQuery('#tab-text3').val();

		//tooltip
		var tooltip_title=jQuery('#tooltip-title').val();
		var tooltip_text=jQuery('#tooltip-text').val();

		//blockquote
		var blockquote_author=jQuery('#blockquote-author').val();
		var blockquote_text=jQuery('#blockquote-text').val();


		if (choice=='shortcode-portfolio') {
			shortcodeHTML='[portfolio category="' + portfolio_category + '" items="'+portfolio_numitems+'"]';
		}

		if (choice=='shortcode-blog-right-sidebar') {
			shortcodeHTML='[blog_sidebar position="r" category="' + blogrightsidebar_category + '"]';
		}

		if (choice=='shortcode-blog-left-sidebar') {
			shortcodeHTML='[blog_sidebar position="l" category="' + blogleftsidebar_category + '"]';
		}

		if (choice=='shortcode-blog-full-width') {
			shortcodeHTML='[blog_fullwidth category="' + blogfullwidth_category + '"]';
		}

		if (choice=='shortcode-map') {
			shortcodeHTML='[google_maps]';
		}

		if (choice=='shortcode-testimonial-slider') {
			shortcodeHTML='[testimonial_start]';

			if (slider_author1!="" && slider_text1!="") {
				shortcodeHTML+='[testimonial_item author="'+slider_author1+'"]'+slider_text1+'[/testimonial_item]';
			}
			if (slider_author2!="" && slider_text2!="") {
				shortcodeHTML+='[testimonial_item author="'+slider_author2+'"]'+slider_text2+'[/testimonial_item]';
			}
			if (slider_author3!="" && slider_text3!="") {
				shortcodeHTML+='[testimonial_item author="'+slider_author3+'"]'+slider_text3+'[/testimonial_item]';
			}

			shortcodeHTML+='[testimonial_end]';
		}

		if (choice=='shortcode-polaroid-light-box-image') {
			shortcodeHTML='[polaroidimage title="'+polaroid_imagetitle+'" group="'+polaroid_imagegroup+'"]'+polaroid_imageurl+'[/polaroidimage]';
		}

		if (choice=='shortcode-polaroid-custom-link') {
			shortcodeHTML='[polaroidlink url="'+polaroid_customlinkurl+'" title="'+polaroid_customlinkimagetitle+'" group="'+polaroid_customlinkgroup+'"]'+polaroid_customlinkurlimageurl+'[/polaroidlink]';
		}

		if (choice=='shortcode-polaroid-light-box-video') {
			shortcodeHTML='[polaroidvideo image="'+polaroid_videoimage+'" title="'+polaroid_videotitle+'" group="'+polaroid_videogroup+'"]'+polaroid_videourl+'[/polaroidvideo]';
		}

		if (choice=='shortcode-social') {
			shortcodeHTML='[social]';
		}

		if (choice=='shortcode-contacts-info') {
			shortcodeHTML='[contactinfo mobile="'+contactinfo_mobile+'"';
			shortcodeHTML+=' telephone="'+contactinfo_telephone+'"';
			shortcodeHTML+=' email="'+contactinfo_email+'"';
			shortcodeHTML+=' web="'+contactinfo_web+'"';
			shortcodeHTML+=']'+contactinfo_address+'[/contactinfo]';
		}

		if (choice=='shortcode-clear-float') {
			shortcodeHTML='[clear]';
		}

		if (choice=='shortcode-single-box') {
			shortcodeHTML='[single_box image="'+singlebox_image+'" url="'+singlebox_url+'"]'+singlebox_title+'[/single_box]';
		}

		if (choice=='shortcode-team') {
			shortcodeHTML='[team]';
		}

		if (choice=='shortcode-team-single-box') {
			shortcodeHTML='[team-single-box image="'+teamsinglebox_image+'" title="'+teamsinglebox_title+'" url="'+teamsinglebox_url+'"]'+teamsinglebox_text+'[/team-single-box]';
		}

		if (choice=='shortcode-divider') {
			shortcodeHTML='[divider]';
		}

		if (choice=='shortcode-text-divider') {
			shortcodeHTML='[fancy_title row="1"]'+shortcodetextdivider_text+'[/fancy_title]';
		}

		if (choice=='shortcode-double-divider-text') {
			shortcodeHTML='[fancy_title row="2"]'+shortcodedoubletextdivider_text+'[/fancy_title]';
		}

		if (choice=='shortcode-page-title-bar') {
			shortcodeHTML='[pagetitlebar title="'+pagetitlebar_title+'" subtitle="'+pagetitlebar_subtitle+'"]';
		}

		if (choice=='shortcode-columns') {
			shortcodeHTML='';
			if (column_options=='two_halves') {
				shortcodeHTML = "[one_half_first]1/2 Text[/one_half_first][one_half_last]1/2 Text[/one_half_last]";
			} else if (column_options=='three_thirds') {
				shortcodeHTML = "[one_third_first]1/3 Text[/one_third_first][one_third]1/3 Text[/one_third][one_third_last]1/3 Text[/one_third_last]";
			} else if (column_options=='one_third_two_thirds') {
				shortcodeHTML = "[one_third_first]1/3 Text[/one_third_first][two_third_last]2/3 Text[/two_third_last]";
			} else if (column_options=='two_thirds_one_third') {
				shortcodeHTML = "[two_third_first]2/3 Text[/two_third_first][one_third_last]1/3 Text[/one_third_last]";
			} else if (column_options=='four_quarters') {
				shortcodeHTML = "[one_fourth_first]1/4 Text[/one_fourth_first][one_fourth]1/4 Text[/one_fourth][one_fourth]1/4 Text[/one_fourth][one_fourth_last]1/4 Text[/one_fourth_last]";
			} else if (column_options=='one_quarter_three_quarters') {
				shortcodeHTML = "[one_fourth_first]1/4 Text[/one_fourth_first][three_fourth_last]3/4 Text[/three_fourth_last]";
			} else if (column_options=='three_quarters_one_quarter') {
				shortcodeHTML = "[three_fourth_first]3/4 Text[/three_fourth_first][one_fourth_last]1/4 Text[/one_fourth_last]";
			} else if (column_options=='one_quarter_one_quarter_one_half') {
				shortcodeHTML = "[one_fourth_first]1/4 Text[/one_fourth_first][one_fourth]1/4 Text[/one_fourth][one_half_last]1/2 Text[/one_half_last]";
			} else if (column_options=='one_quarter_one_half_one_quarter') {
				shortcodeHTML = "[one_fourth_first]1/4 Text[/one_fourth_first][one_half]1/2 Text[/one_half][one_fourth_last]1/4 Text[/one_fourth_last]";
			} else if (column_options=='one_half_one_quarter_one_quarter') {
				shortcodeHTML = "[one_half_first]1/2 Text[/one_half_first][one_fourth]1/4 Text[/one_fourth][one_fourth_last]1/4 Text[/one_fourth_last]";
			} else if (column_options=='column8offset2') {
				shortcodeHTML = "[offset col='8']content[/offset]";
			} else if (column_options=='column10offset1') {
				shortcodeHTML = "[offset col='10']content[/offset]";
			}
		}

		if (choice=='shortcode-accordion') {
			var area=Math.floor(Math.random()*100000)
			var item=0;

			shortcodeHTML='[accordion_start id="'+area+'"]';
			if (accordion_title1!='' && accordion_text1!='') {
				item=Math.floor(Math.random()*100000)
				shortcodeHTML+='[accordion_item item="'+item+'" area="'+area+'" title="'+accordion_title1+'"]'+accordion_text1+'[/accordion_item]';
			}
			if (accordion_title2!='' && accordion_text2!='') {
				item=Math.floor(Math.random()*100000)
				shortcodeHTML+='[accordion_item item="'+item+'" area="'+area+'" title="'+accordion_title2+'"]'+accordion_text2+'[/accordion_item]';
			}
			if (accordion_title3!='' && accordion_text3!='') {
				item=Math.floor(Math.random()*100000)
				shortcodeHTML+='[accordion_item item="'+item+'" area="'+area+'" title="'+accordion_title3+'"]'+accordion_text3+'[/accordion_item]';
			}
			shortcodeHTML+='[accordion_end]';
		}

		if (choice=='shortcode-extraheading') {
			shortcodeHTML='[extraheading]'+extraheading_title+'[/extraheading]';
		}

		if (choice=='shortcode-tab') {
			var area=Math.floor(Math.random()*100000)
			var item=0;

			shortcodeHTML='[tab_start title1="'+tab_title1+'" title2="'+tab_title2+'" title3="'+tab_title3+'"]';
			if (tab_title1!='' && tab_text1!='') {
				shortcodeHTML+='[tab_item id="1"]'+tab_text1+'[/tab_item]';
			}
			if (tab_title2!='' && tab_text2!='') {
				shortcodeHTML+='[tab_item id="2"]'+tab_text2+'[/tab_item]';
			}
			if (tab_title3!='' && tab_text3!='') {
				shortcodeHTML+='[tab_item id="3"]'+tab_text3+'[/tab_item]';
			}

			shortcodeHTML+='[tab_end]';
		}

		if (choice=='shortcode-tooltip') {
			shortcodeHTML='[tooltip link="'+tooltip_title+'"]'+tooltip_text+'[/tooltip]';
		}

		if (choice=='shortcode-blockquote') {
			shortcodeHTML='[blockquote  author="'+blockquote_author+'"]'+blockquote_text+'[/blockquote]';
		}

		activeEditor = window.tinyMCE.activeEditor.id;
		var tmce_ver=window.tinyMCE.majorVersion;
		if (tmce_ver>="4") {
			window.tinyMCE.execCommand('mceInsertContent', false, shortcodeHTML);
		} else {
			window.tinyMCE.execInstanceCommand(activeEditor, 'mceInsertContent', false, shortcodeHTML);
		}
		tinyMCEPopup.editor.execCommand('mceRepaint');
	}

	tinyMCEPopup.close();

	return;
}



var $ig = jQuery.noConflict();
(function($ig) {
	$ig(document).ready(function() {

		// Setup the array of shortcode options
		$ig.choice = {
			'0' : $ig([]),
			'shortcode-portfolio' : $ig('#shortcode-portfolio'),
			'shortcode-blog-left-sidebar' : $ig('#shortcode-blog-left-sidebar'),
			'shortcode-blog-right-sidebar' : $ig('#shortcode-blog-right-sidebar'),
			'shortcode-blog-full-width' : $ig('#shortcode-blog-full-width'),
			'shortcode-map' : $ig('#shortcode-map'),
			'shortcode-testimonial-slider' : $ig('#shortcode-testimonial-slider'),
			'shortcode-polaroid-light-box-image' : $ig('#shortcode-polaroid-light-box-image'),
			'shortcode-polaroid-light-box-video' : $ig('#shortcode-polaroid-light-box-video'),
			'shortcode-polaroid-custom-link' : $ig('#shortcode-polaroid-custom-link'),
			'shortcode-social' : $ig('#shortcode-social'),
			'shortcode-contacts-info' : $ig('#shortcode-contacts-info'),
			'shortcode-clear-float' : $ig('#shortcode-clear-float'),
			'shortcode-single-box' : $ig('#shortcode-single-box'),
			'shortcode-team' : $ig('#shortcode-team'),
			'shortcode-team-single-box' : $ig('#shortcode-team-single-box'),
			'shortcode-divider' : $ig('#shortcode-divider'),
			'shortcode-text-divider' : $ig('#shortcode-text-divider'),
			'shortcode-double-divider-text' : $ig('#shortcode-double-divider-text'),
			'shortcode-page-title-bar' : $ig('#shortcode-page-title-bar'),
			'shortcode-columns' : $ig('#shortcode-columns'),
			'shortcode-accordion' : $ig('#shortcode-accordion'),
			'shortcode-extraheading' : $ig('#shortcode-extraheading'),
			'shortcode-tab' : $ig('#shortcode-tab'),
			'shortcode-tooltip' : $ig('#shortcode-tooltip'),
			'shortcode-blockquote' : $ig('#shortcode-blockquote')
		};

		// Hide each option section
		$ig.each($ig.choice, function() {
			this.css({display: 'none'});
		});

		// Show the selected option section
		$ig('#shortcode-select').change(function() {
			$ig.each($ig.choice, function() {
				this.css({display: 'none'});
			});
			$ig.choice[$ig(this).val()].css({
				display: 'block'
			});
		});

	});
})($ig);

<?php

	// Require config
	require_once('config.php');

	// Kill user if not logged in and can edit posts
	if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__('You are not allowed to access this page', 'indiegroundframework'));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php _e('Indieground shortcode', 'indiegroundframework');?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/jquery/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/framework/tinymce/shortcode-structure.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<base target="_self" />
		<link href="<?php echo get_template_directory_uri() ?>/framework/tinymce/base.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo get_template_directory_uri() ?>/framework/tinymce/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" id="link" >
		<form name="indiegroundframework_shortcode_form" action="#">
			<div id="shortcode_wrap">
				<div id="shortcode_panel" class="current">
					<fieldset>
						<h4><?php _e('Select a shortcode', 'indiegroundframework');?></h4>
						<div class="option">
							<label for="shortcode-select"><?php _e('Shortcode', 'indiegroundframework');?></label>
							<select id="shortcode-select" name="shortcode-select">
								<option value=""></option>
								<option value="shortcode-columns"><?php _e('Columns', 'indiegroundframework');?></option>
								<option value="shortcode-blog-right-sidebar"><?php _e('Blog Right Sidebar', 'indiegroundframework');?></option>
								<option value="shortcode-blog-left-sidebar"><?php _e('Blog Left Sidebar', 'indiegroundframework');?></option>
								<option value="shortcode-blog-full-width"><?php _e('Blog Full Width', 'indiegroundframework');?></option>
								<option value="shortcode-team"><?php _e('Team', 'indiegroundframework');?></option>
								<option value="shortcode-team-single-box"><?php _e('Team Single Box', 'indiegroundframework');?></option>
								<option value="shortcode-single-box"><?php _e('Single Box', 'indiegroundframework');?></option>
								<option value="shortcode-polaroid-light-box-image"><?php _e('Polaroid Light Box Image', 'indiegroundframework');?></option>
								<option value="shortcode-polaroid-light-box-video"><?php _e('Polaroid Light Box Video', 'indiegroundframework');?></option>
								<option value="shortcode-polaroid-custom-link"><?php _e('Polaroid Custom Link', 'indiegroundframework');?></option>
								<option value="shortcode-testimonial-slider"><?php _e('Testimonial Slider', 'indiegroundframework');?></option>
								<option value="shortcode-portfolio"><?php _e('Portfolio', 'indiegroundframework');?></option>
								<option value="shortcode-map"><?php _e('Map', 'indiegroundframework');?></option>
								<option value="shortcode-social"><?php _e('Social', 'indiegroundframework');?></option>
								<option value="shortcode-contacts-info"><?php _e('Contacts Info', 'indiegroundframework');?></option>
								<option value="shortcode-clear-float"><?php _e('Clear Float', 'indiegroundframework');?></option>
								<option value="shortcode-divider"><?php _e('Divider', 'indiegroundframework');?></option>
								<option value="shortcode-text-divider"><?php _e('Text Divider', 'indiegroundframework');?></option>
								<option value="shortcode-double-divider-text"><?php _e('Double Divider Text', 'indiegroundframework');?></option>
								<option value="shortcode-page-title-bar"><?php _e('Page Title Bar', 'indiegroundframework');?></option>
								<option value="shortcode-accordion"><?php _e('Accordion', 'indiegroundframework');?></option>
								<option value="shortcode-extraheading"><?php _e('Extra Heading', 'indiegroundframework');?></option>
								<option value="shortcode-tab"><?php _e('Tab', 'indiegroundframework');?></option>
								<option value="shortcode-tooltip"><?php _e('Tooltip', 'indiegroundframework');?></option>
								<option value="shortcode-blockquote"><?php _e('Blockquote', 'indiegroundframework');?></option>
							</select>
						</div>


						<!--//////////////////////////////
						////	PORTFOLIO
						//////////////////////////////-->
						<div id="shortcode-portfolio">
							<div class="option">
								<label for="portfolio-category"><?php _e('Category', 'indiegroundframework');?></label>
								<input id="portfolio-category" name="portfolio-category" type="text" value=''/>
								<p class="info">Enter the slug category if would like to see only one in particular</p>
							</div>
							<div class="option">
								<label for="portfolio-numitems"><?php _e('Items number', 'indiegroundframework');?></label>
								<input id="portfolio-numitems" name="portfolio-numitems" type="text" value=''/>
								<p class="info">Select how many items you want to display in your portfolio</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	BLOG RIGHT SIDEBAR
						//////////////////////////////-->
						<div id="shortcode-blog-right-sidebar">
							<div class="option">
								<label for="shortcode-blog-right-sidebar-category"><?php _e('1 .Category', 'indiegroundframework');?></label>
								<input id="shortcode-blog-right-sidebar-category" name="shortcode-blog-right-sidebar-category" type="text" value=''/>
								<p class="info">Enter the category's name to filter post.</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	BLOG LEFT SIDEBAR
						//////////////////////////////-->
						<div id="shortcode-blog-left-sidebar">
							<div class="option">
								<label for="shortcode-blog-left-sidebar-category"><?php _e('1 .Category', 'indiegroundframework');?></label>
								<input id="shortcode-blog-left-sidebar-category" name="shortcode-blog-left-sidebar-category" type="text" value=''/>
								<p class="info">Enter the category's name to filter post.</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	BLOG FULL WIDTH
						//////////////////////////////-->
						<div id="shortcode-blog-full-width">
							<div class="option">
								<label for="shortcode-blog-full-width-category"><?php _e('1 .Category', 'indiegroundframework');?></label>
								<input id="shortcode-blog-full-width-category" name="shortcode-blog-full-width-category" type="text" value=''/>
								<p class="info">Enter the category's name to filter post.</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	MAP
						//////////////////////////////-->
						<div id="shortcode-map"></div>

						<!--//////////////////////////////
						////	TESTIMONIAL SLIDER
						//////////////////////////////-->
						<div id="shortcode-testimonial-slider">
							<div class="option">
								<label for="testimonial-slider-author1"><?php _e('1 .Author', 'indiegroundframework');?></label>
								<input id="testimonial-slider-author1" name="testimonial-slider-author1" type="text" value=''/>
								<p class="info">Enter the first author for the testimonial slider.</p>
							</div>

							<div class="option">
								<label for="testimonial-slider-text1"><?php _e('1. Text', 'indiegroundframework');?></label>
								<textarea id="testimonial-slider-text1" name="testimonial-slider-text1" value=''/></textarea>
								<p class="info">Enter the first text for the testimonial slider.</p>
							</div>

							<div class="option">
								<label for="testimonial-slider-author2"><?php _e('2 .Author', 'indiegroundframework');?></label>
								<input id="testimonial-slider-author2" name="testimonial-slider-author2" type="text" value=''/>
								<p class="info">Enter the second author for the testimonial slider.</p>
							</div>

							<div class="option">
								<label for="testimonial-slider-text2"><?php _e('2. Text', 'indiegroundframework');?></label>
								<textarea id="testimonial-slider-text2" name="testimonial-slider-text2" value=''/></textarea>
								<p class="info">Enter the second text for the testimonial slider.</p>
							</div>

							<div class="option">
								<label for="testimonial-slider-author3"><?php _e('3 .Author', 'indiegroundframework');?></label>
								<input id="testimonial-slider-author3" name="testimonial-slider-author3" type="text" value=''/>
								<p class="info">Enter the third author for the testimonial slider.</p>
							</div>

							<div class="option">
								<label for="testimonial-slider-text3"><?php _e('3. Text', 'indiegroundframework');?></label>
								<textarea id="testimonial-slider-text3" name="testimonial-slider-text3" value=''/></textarea>
								<p class="info">Enter the third text for the testimonial slider.</p>
							</div>

						</div>

						<!--//////////////////////////////
						////	POLAROID LIGHT BOX IMAGE
						//////////////////////////////-->
						<div id="shortcode-polaroid-light-box-image">
							<h5><?php _e('Polaroid Light Box Image', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="polaroid-light-box-image-url"><?php _e('Image', 'indiegroundframework'); ?></label>
								<input id="polaroid-light-box-image-url" name="polaroid-light-box-image-url" type="text" value=""/>
								<p class="info">Provide the URL here for the image that you would like to use.</p>
							</div>

							<div class="option">
								<label for="polaroid-light-box-image-title"><?php _e('Title', 'indiegroundframework'); ?></label>
								<input id="polaroid-light-box-image-title" name="polaroid-light-box-image-title" type="text" value=""/>
							</div>

							<div class="option">
								<label for="polaroid-light-box-image-group"><?php _e('Group', 'indiegroundframework'); ?></label>
								<input id="polaroid-light-box-image-group" name="polaroid-light-box-image-group" type="text" value=""/>
							</div>
						</div>


						<!--//////////////////////////////
						////	POLAROID CUSTOM LINK
						//////////////////////////////-->
						<div id="shortcode-polaroid-custom-link">
							<h5><?php _e('Polaroid Custom Link', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="polaroid-custom-link-image-url"><?php _e('Image', 'indiegroundframework'); ?></label>
								<input id="polaroid-custom-link-image-url" name="polaroid-custom-link-image-url" type="text" value=""/>
								<p class="info">Provide the URL here for the image that you would like to use.</p>
							</div>

							<div class="option">
								<label for="polaroid-custom-link-image-title"><?php _e('Title', 'indiegroundframework'); ?></label>
								<input id="polaroid-custom-link-image-title" name="polaroid-custom-link-image-title" type="text" value=""/>
							</div>

							<div class="option">
								<label for="polaroid-custom-link-url"><?php _e('Link', 'indiegroundframework'); ?></label>
								<input id="polaroid-custom-link-url" name="polaroid-custom-link-url" type="text" value=""/>
							</div>

							<div class="option">
								<label for="polaroid-custom-link-group"><?php _e('Group', 'indiegroundframework'); ?></label>
								<input id="polaroid-custom-link-group" name="polaroid-custom-link-group" type="text" value=""/>
							</div>
						</div>

						<!--//////////////////////////////
						////	POLAROID LIGHT BOX VIDEO
						//////////////////////////////-->
						<div id="shortcode-polaroid-light-box-video">
							<h5><?php _e('Polaroid Light Box Video', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="polaroid-light-box-video-url"><?php _e('Video', 'indiegroundframework'); ?></label>
								<input id="polaroid-light-box-video-url" name="polaroid-light-box-video-url" type="text" value=""/>
								<p class="info">Provide the URL here for the video that you would like to use.</p>
							</div>

							<div class="option">
								<label for="polaroid-light-box-video-title"><?php _e('Title', 'indiegroundframework'); ?></label>
								<input id="polaroid-light-box-video-title" name="polaroid-light-box-video-title" type="text" value=""/>
							</div>

							<div class="option">
								<label for="polaroid-light-box-video-group"><?php _e('Group', 'indiegroundframework'); ?></label>
								<input id="polaroid-light-box-video-group" name="polaroid-light-box-video-group" type="text" value=""/>
							</div>

							<div class="option">
								<label for="polaroid-light-box-video-image"><?php _e('Image', 'indiegroundframework'); ?></label>
								<input id="polaroid-light-box-video-image" name="polaroid-light-box-video-image" type="text" value=""/>
							</div>
						</div>

						<!--//////////////////////////////
						////	SOCIAL
						//////////////////////////////-->
						<div id="shortcode-social"></div>

						<!--//////////////////////////////
						////	CONTACTS INFO
						//////////////////////////////-->
						<div id="shortcode-contacts-info">
							<h5><?php _e('Contact Info', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="contact-info-mobile"><?php _e('Mobile', 'indiegroundframework'); ?></label>
								<input id="contact-info-mobile" name="contact-info-mobile" type="text" value=""/>
								<p class="info">Insert mobile number.</p>
							</div>

							<div class="option">
								<label for="contact-info-telephone"><?php _e('Telephone', 'indiegroundframework'); ?></label>
								<input id="contact-info-telephone" name="contact-info-telephone" type="text" value=""/>
								<p class="info">Insert telephone number.</p>
							</div>

							<div class="option">
								<label for="contact-info-email"><?php _e('Email', 'indiegroundframework'); ?></label>
								<input id="contact-info-email" name="contact-info-email" type="text" value=""/>
								<p class="info">Insert email.</p>
							</div>

							<div class="option">
								<label for="contact-info-web"><?php _e('Site web', 'indiegroundframework'); ?></label>
								<input id="contact-info-web" name="contact-info-web" type="text" value=""/>
								<p class="info">Insert web address.</p>
							</div>

							<div class="option">
								<label for="contact-info-address"><?php _e('Address', 'indiegroundframework'); ?></label>
								<input id="contact-info-address" name="contact-info-address" type="text" value=""/>
								<p class="info">Insert address.</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	CLEAR FLOAT
						//////////////////////////////-->
						<div id="shortcode-clear-float"></div>

						<!--//////////////////////////////
						////	SINGLE BOX
						//////////////////////////////-->
						<div id="shortcode-single-box">
							<h5><?php _e('Single Box', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="single-box-image"><?php _e('Image', 'indiegroundframework'); ?></label>
								<input id="single-box-image" name="single-box-image" type="text" value=""/>
								<p class="info">Provide the URL here for the image that you would like to use.</p>
							</div>

							<div class="option">
								<label for="single-box-title"><?php _e('Title', 'indiegroundframework');?></label>
								<input id="single-box-title" name="single-box-title" type="text" value=''/>
								<p class="info">Enter the title for the team.</p>
							</div>

							<div class="option">
								<label for="single-box-url"><?php _e('URL', 'indiegroundframework');?></label>
								<input id="single-box-url" name="single-box-url" type="text" value=''/>
								<p class="info">Enter the page you want to link</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	TEAM
						//////////////////////////////-->
						<div id="shortcode-team"></div>

						<!--//////////////////////////////
						////	TEAM SINGLE BOX
						//////////////////////////////-->
						<div id="shortcode-team-single-box">
							<h5><?php _e('Team Single Box', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="team-single-box-image"><?php _e('Image', 'indiegroundframework'); ?></label>
								<input id="team-single-box-image" name="team-single-box-image" type="text" value=""/>
								<p class="info">Provide the URL here for the image that you would like to use.</p>
							</div>

							<div class="option">
								<label for="team-single-box-title"><?php _e('Title', 'indiegroundframework');?></label>
								<input id="team-single-box-title" name="team-single-box-title" type="text" value=''/>
								<p class="info">Enter the title for the team.</p>
							</div>

							<div class="option">
								<label for="team-single-box-text"><?php _e('Text', 'indiegroundframework');?></label>
								<input id="team-single-box-text" name="team-single-box-text" type="text" value=''/>
								<p class="info">Enter the text for the team.</p>
							</div>

							<div class="option">
								<label for="team-single-box-url"><?php _e('URL', 'indiegroundframework');?></label>
								<input id="team-single-box-url" name="team-single-box-url" type="text" value=''/>
								<p class="info">Enter the page you want to link</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	DIVIDER
						//////////////////////////////-->
						<div id="shortcode-divider"></div>

						<!--//////////////////////////////
						////	TEXT DIVIDER
						//////////////////////////////-->
						<div id="shortcode-text-divider">
							<h5><?php _e('Text Divider', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="shortcode-text-divider-text"><?php _e('Text', 'indiegroundframework');?></label>
								<input id="shortcode-text-divider-text" name="shortcode-text-divider-text" type="text" value=''/>
								<p class="info">Enter the text</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	DOUBLE DIVIDER TEXT
						//////////////////////////////-->
						<div id="shortcode-double-divider-text">
							<h5><?php _e('Double Divider Text', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="shortcode-double-divider-text"><?php _e('Text', 'indiegroundframework');?></label>
								<input id="shortcode-double-divider-text" name="shortcode-double-divider-text" type="text" value=''/>
								<p class="info">Enter the text</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	PAGE TITLE BAR
						//////////////////////////////-->
						<div id="shortcode-page-title-bar">
							<h5><?php _e('Title', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="page-title-bar-title"><?php _e('Title', 'indiegroundframework');?></label>
								<input id="page-title-bar-title" name="page-title-bar-title" type="text" value=''/>
								<p class="info">Enter the Title</p>
							</div>

							<h5><?php _e('Subtitle', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="page-title-bar-subtitle"><?php _e('Subtitle', 'indiegroundframework');?></label>
								<input id="page-title-bar-subtitle" name="page-title-bar-subtitle" type="text" value=''/>
								<p class="info">Enter the Subtitle</p>
							</div>
						</div>


						<!--//////////////////////////////
						////	COLUMNS
						//////////////////////////////-->
						<div id="shortcode-columns" class="shortcode-option">
							<h5><?php _e('Columns', 'indiegroundframework');?></h5>
							<div class="option">
								<label for="column-options"><?php _e('Layout', 'indiegroundframework');?></label>
								<select id="column-options" name="column-options">
									<option value="0"></option>
									<option value="two_halves"><?php _e('1/2 + 1/2', 'indiegroundframework');?></option>
									<option value="three_thirds"><?php _e('1/3 + 1/3 + 1/3', 'indiegroundframework');?></option>
									<option value="one_third_two_thirds"><?php _e('1/3 + 2/3', 'indiegroundframework');?></option>
									<option value="two_thirds_one_third"><?php _e('2/3 + 1/3', 'indiegroundframework');?></option>
									<option value="four_quarters"><?php _e('1/4 + 1/4 + 1/4 + 1/4', 'indiegroundframework');?></option>
									<option value="one_quarter_three_quarters"><?php _e('1/4 + 3/4', 'indiegroundframework');?></option>
									<option value="three_quarters_one_quarter"><?php _e('3/4 + 1/4', 'indiegroundframework');?></option>
									<option value="one_quarter_one_quarter_one_half"><?php _e('1/4 + 1/4 + 1/2', 'indiegroundframework');?></option>
									<option value="one_quarter_one_half_one_quarter"><?php _e('1/4 + 1/2 + 1/4', 'indiegroundframework');?></option>
									<option value="one_half_one_quarter_one_quarter"><?php _e('1/2 + 1/4 + 1/4', 'indiegroundframework');?></option>
									<option value="column8offset2"><?php _e('column 8 offset 2', 'indiegroundframework');?></option>
									<option value="column10offset1"><?php _e('column 10 offset 1', 'indiegroundframework');?></option>
								</select>
							</div>
						</div>

						<!--//////////////////////////////
						////	ACCORDION
						//////////////////////////////-->
						<div id="shortcode-accordion">
							<h5><?php _e('Accordion', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="accordion-title1"><?php _e('1. Title', 'indiegroundframework');?></label>
								<input id="accordion-title1" name="accordion-title1" type="text" value=''/>
								<p class="info">Enter the first title</p>
							</div>

							<div class="option">
								<label for="accordion-text1"><?php _e('1. Text', 'indiegroundframework');?></label>
								<textarea id="accordion-text1" name="accordion-text1" value=''/></textarea>
								<p class="info">Enter the first text.</p>
							</div>

							<div class="option">
								<label for="accordion-title2"><?php _e('2. Title', 'indiegroundframework');?></label>
								<input id="accordion-title2" name="accordion-title2" type="text" value=''/>
								<p class="info">Enter the second title</p>
							</div>

							<div class="option">
								<label for="accordion-text2"><?php _e('2. Text', 'indiegroundframework');?></label>
								<textarea id="accordion-text2" name="accordion-text2" value=''/></textarea>
								<p class="info">Enter the second text.</p>
							</div>

							<div class="option">
								<label for="accordion-title3"><?php _e('3. Title', 'indiegroundframework');?></label>
								<input id="accordion-title3" name="accordion-title3" type="text" value=''/>
								<p class="info">Enter the third title</p>
							</div>

							<div class="option">
								<label for="accordion-text3"><?php _e('3. Text', 'indiegroundframework');?></label>
								<textarea id="accordion-text3" name="accordion-text3" value=''/></textarea>
								<p class="info">Enter the third text.</p>
							</div>
						</div>


						<!--//////////////////////////////
						////	EXTRA HEADING
						//////////////////////////////-->
						<div id="shortcode-extraheading">
							<h5><?php _e('Title', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="extraheading-title"><?php _e('Title', 'indiegroundframework');?></label>
								<input id="extraheading-title" name="extraheading-title" type="text" value=''/>
								<p class="info">Enter the Title</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	TAB
						//////////////////////////////-->
						<div id="shortcode-tab">
							<h5><?php _e('Tab', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="tab-title1"><?php _e('1. Title', 'indiegroundframework');?></label>
								<input id="tab-title1" name="tab-title1" type="text" value=''/>
								<p class="info">Enter the first title</p>
							</div>

							<div class="option">
								<label for="tab-text1"><?php _e('1. Text', 'indiegroundframework');?></label>
								<textarea id="tab-text1" name="tab-text1" value=''/></textarea>
								<p class="info">Enter the first text.</p>
							</div>

							<div class="option">
								<label for="tab-title2"><?php _e('2. Title', 'indiegroundframework');?></label>
								<input id="tab-title2" name="tab-title2" type="text" value=''/>
								<p class="info">Enter the second title</p>
							</div>

							<div class="option">
								<label for="tab-text2"><?php _e('2. Text', 'indiegroundframework');?></label>
								<textarea id="tab-text2" name="tab-text2" value=''/></textarea>
								<p class="info">Enter the second text.</p>
							</div>

							<div class="option">
								<label for="tab-title3"><?php _e('3. Title', 'indiegroundframework');?></label>
								<input id="tab-title3" name="tab-title3" type="text" value=''/>
								<p class="info">Enter the third title</p>
							</div>

							<div class="option">
								<label for="tab-text3"><?php _e('3. Text', 'indiegroundframework');?></label>
								<textarea id="tab-text3" name="tab-text3" value=''/></textarea>
								<p class="info">Enter the third text.</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	TOOLTIP
						//////////////////////////////-->
						<div id="shortcode-tooltip">
							<h5><?php _e('Tooltip', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="tooltip-text"><?php _e('Text', 'indiegroundframework');?></label>
								<input id="tooltip-text" name="tooltip-text" type="text" value=''/>
								<p class="info">Enter the tooltip text.</p>
							</div>

							<div class="option">
								<label for="tooltip-title"><?php _e('Message', 'indiegroundframework');?></label>
								<textarea id="tooltip-title" name="tooltip-title" value=''/></textarea>
								<p class="info">Enter the message text</p>
							</div>
						</div>

						<!--//////////////////////////////
						////	BLOCKQUOTE
						//////////////////////////////-->
						<div id="shortcode-blockquote">
							<h5><?php _e('Blockquote', 'indiegroundframework'); ?></h5>
							<div class="option">
								<label for="blockquote-author"><?php _e('Author', 'indiegroundframework');?></label>
								<input id="blockquote-author" name="blockquote-author" type="text" value=''/>
								<p class="info">Enter the author</p>
							</div>

							<div class="option">
								<label for="blockquote-text"><?php _e('Text', 'indiegroundframework');?></label>
								<textarea id="blockquote-text" name="blockquote-text" value=''/></textarea>
								<p class="info">Enter the text.</p>
							</div>
						</div>

					</fieldset>
				</div>

				<div class="buttons clearfix">
					<input type="submit" id="insert" name="insert" value="<?php _e('Insert Shortcode', 'indiegroundframework');?>" onClick="embedSelectedShortcode();" />
				</div>

			</div>
		</form>
	</body>
</html>
<?php
	include(get_template_directory().'/framework/shortcode/shortcode-portfolio.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-team.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-google-maps.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-blog.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-single-team-box.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-single-box.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-columns.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-testimonial.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-pagetitlebar.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-contactinfo.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-polaroid.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-social.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-accordion.php' );
	include(get_template_directory().'/framework/shortcode/shortcode-tab.php' );


	/* SHORTCODE GENERATOR SETUP ================================================== */

	// Create TinyMCE s editor button & plugin for Swift Framework Shortcodes
	add_action("init", "indiegroundshortcode_sf_sc_button");

	function indiegroundshortcode_sf_sc_button() {
	   if (current_user_can("edit_posts") &&  current_user_can("edit_pages"))  {
	     add_filter("mce_external_plugins", "indiegroundshortcode_add_tinymce_plugin");
	     add_filter("mce_buttons", "indiegroundshortcode_register_button");
	   }
	}

	function indiegroundshortcode_register_button($button) {
	    array_push($button, "separator", "indiegroundframework_shortcodes" );
	    return $button;
	}

	function indiegroundshortcode_add_tinymce_plugin($plugins) {
	    $plugins["indiegroundframework_shortcodes"] = get_template_directory_uri() . "/framework/tinymce/tinymce.editor.plugin.js";
	    return $plugins;
	}

	function indiegroundshortcode_custom_mce_styles( $init ) {
	    $init["theme_advanced_buttons2_add_before"] = "styleselect";
	    $init["theme_advanced_styles"] = "Impact Text=impact-text";
	    return $init;
	}

	add_filter( "tiny_mce_before_init", "indiegroundshortcode_custom_mce_styles"  );

	/* END SHORTCODE GENERATOR SETUP ================================================== */



	function indiegroundshortcode_portfolio($params, $content = null) {
		extract(shortcode_atts(array(
					'category' => '',
					'items' => 0,
						), $params));

		$output = "";

		if ($category=="") {
			$output .= indiegroundshortcode_create_portfolio_categories();
		}
		$output .= indiegroundshortcode_create_portfolio_item($category,$items);

		return $output;
	}

	function indiegroundshortcode_team($params, $content = null) {
		return indiegroundshortcode_create_team_item($params, $content = null);
	}

	function indiegroundshortcode_divider() {
		return "<div class='divider'></div>\n";
	}

	function indiegroundshortcode_cleardiv() {
		return "<div class='clear'></div>\n";
	}

	function indiegroundshortcode_fancy($params, $content = null) {
		extract(shortcode_atts(array(
					'row' => '1'
						), $params));

		if ($row=="2") {
			$class="fancy";
		} else {
			$class="fancy_one";
		}
		return "<p class='".$class."'><span>".strip_shortcodes($content)."</span></p>\n";
	}

	function indiegroundshortcode_portfolio_recent_works($params, $content = null) {
		extract(shortcode_atts(array(
					'number' => '4'
						), $params));

		return indiegroundshortcode_create_portfolio_item_recent($number);
	}

	function indiegroundshortcode_google_maps() {
		return indiegroundshortcode_create_google_maps();
	}

	function indiegroundshortcode_extraheading($params, $content = null) {
		return "<h2 class='text_intertit'>".do_shortcode($content)."</h2>\n";
	}

	function indiegroundshortcode_tooltip($params, $content = null) {
		extract(shortcode_atts(array(
					'link' => '1'
						), $params));

		return '<a class="indietooltip" href="#" data-toggle="tooltip" title="'.$link.'">'.strip_shortcodes($content).'</a>';
	}

	function indiegroundshortcode_blockquote($params, $content = null) {
		extract(shortcode_atts(array(
					'author' => '1'
						), $params));

        return '<blockquote><p>'.strip_shortcodes($content).'</p><small><cite title="'.$author.'">'.$author.'</cite></small></blockquote>';
	}

	function indiegroundshortcode_offset($params, $content = null) {
		extract(shortcode_atts(array(
					'col' => 10
						), $params));

		if ($col==10) {
			$offset="1";
		} else {
			$offset="2";
		}
		return "<div class='col-md-".$col." col-md-offset-".$offset."'>".do_shortcode($content)."</div>\n";
	}


	add_shortcode('google_maps', 'indiegroundshortcode_create_google_maps');
	add_shortcode('portfolio', 'indiegroundshortcode_portfolio');
	add_shortcode('team', 'indiegroundshortcode_team');
	add_shortcode('divider', 'indiegroundshortcode_divider');
	add_shortcode('clear', 'indiegroundshortcode_cleardiv');
	add_shortcode('fancy_title', 'indiegroundshortcode_fancy');
	add_shortcode('widget','indiegroundshortcode_widget');
	add_shortcode('recent_works', 'indiegroundshortcode_portfolio_recent_works');
	add_shortcode('blog_sidebar', 'indiegroundshortcode_blog_sidebar');
	add_shortcode('blog_fullwidth', 'indiegroundshortcode_blog_fullwidth');
	add_shortcode('single_box', 'indiegroundshortcode_single_box');
	add_shortcode('team-single-box', 'indiegroundshortcode_team_single_box');
	add_shortcode('testimonial_start', 'indiegroundshortcode_testimonial_start');
	add_shortcode('testimonial_item', 'indiegroundshortcode_testimonial_item');
	add_shortcode('testimonial_end', 'indiegroundshortcode_testimonial_end');
	add_shortcode('pagetitlebar', 'indiegroundshortcode_pagetitlebar');
	add_shortcode('contactinfo', 'indiegroundshortcode_contactinfo');
	add_shortcode('polaroidimage', 'indiegroundshortcode_polaroidimage');
	add_shortcode('polaroidlink', 'indiegroundshortcode_polaroidlink');
	add_shortcode('polaroidvideo', 'indiegroundshortcode_polaroidvideo');
	add_shortcode('social', 'indiegroundshortcode_social');
	add_shortcode('accordion_start', 'indiegroundshortcode_accordion_start');
	add_shortcode('accordion_item', 'indiegroundshortcode_accordion_item');
	add_shortcode('accordion_end', 'indiegroundshortcode_accordion_end');
	add_shortcode('accordion_start', 'indiegroundshortcode_accordion_start');
	add_shortcode('accordion_item', 'indiegroundshortcode_accordion_item');
	add_shortcode('accordion_end', 'indiegroundshortcode_accordion_end');
	add_shortcode('extraheading', 'indiegroundshortcode_extraheading');
	add_shortcode('tooltip', 'indiegroundshortcode_tooltip');
	add_shortcode('blockquote', 'indiegroundshortcode_blockquote');
	add_shortcode('tab_start', 'indiegroundshortcode_tab_start');
	add_shortcode('tab_item', 'indiegroundshortcode_tab_item');
	add_shortcode('tab_end', 'indiegroundshortcode_tab_end');
	add_shortcode('offset', 'indiegroundshortcode_offset');
	add_shortcode('one_third_first', 'indiegroundshortcode_one_third_first');
	add_shortcode('one_third', 'indiegroundshortcode_one_third');
	add_shortcode('one_third_last', 'indiegroundshortcode_one_third_last');
	add_shortcode('two_third_first', 'indiegroundshortcode_two_third_first');
	add_shortcode('two_third', 'indiegroundshortcode_two_third');
	add_shortcode('two_third_last', 'indiegroundshortcode_two_third_last');
	add_shortcode('one_half_first', 'indiegroundshortcode_one_half_first');
	add_shortcode('one_half', 'indiegroundshortcode_one_half');
	add_shortcode('one_half_last', 'indiegroundshortcode_one_half_last');
	add_shortcode('one_fourth_first', 'indiegroundshortcode_one_fourth_first');
	add_shortcode('one_fourth', 'indiegroundshortcode_one_fourth');
	add_shortcode('one_fourth_last', 'indiegroundshortcode_one_fourth_last');
	add_shortcode('three_fourth_first', 'indiegroundshortcode_three_fourth_first');
	add_shortcode('three_fourth', 'indiegroundshortcode_three_fourth');
	add_shortcode('three_fourth_last', 'indiegroundshortcode_three_fourth_last');
?>
<?php
	function indiegroundshortcode_single_box($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'image' => '',
					'url' => ''
						), $params));

		$output .= "<div class='move_top wow fadeIn'>\n";
		$output .= "<a href='".$url."' class='cont_last_works wow fadeInDown animated'>\n";
		$output .= "<img alt='' class='cap_border frame_features' src='".$image."' />\n";
		$output .= "<img alt='' class='img_shadow' src='".get_template_directory_uri()."/include/images/retina/shadow/shadow.png'/>\n";

		$output .= "<div class='tit_last_work wow fadeIn'>\n";
		$output .= do_shortcode($content);
		$output .= "</div>\n";
		$output .= "</a>\n";
		$output .= "</div>\n";

		return $output;
	}
?>
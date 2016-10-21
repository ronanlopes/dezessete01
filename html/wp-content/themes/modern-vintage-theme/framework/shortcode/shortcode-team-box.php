<?php
	function indiegroundshortcode_single_box($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'image' => '',
					'title' => '',
					'url' => ''
						), $params));

		$output .= "<a href='".$url."' class='cont_last_works'>\n";
		$output .= "<img alt='' class='cap_border frame_features' src='".$image."' />\n";
		$output .= "<img alt='' class='img_shadow' src='include/images/retina/shadow/shadow.png' />\n";

		$output .= "<div class='tit_last_work'>\n";
		$output .= $title;
		$output .= "</div>\n";
		$output .= "</a>\n";

		return $output;
	}
?>
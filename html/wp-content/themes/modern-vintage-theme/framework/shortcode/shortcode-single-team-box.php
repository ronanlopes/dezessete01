<?php
	function indiegroundshortcode_team_single_box($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'image' => '',
					'title' => '',
					'url' => ''
						), $params));
		$output .= "<div class='move_top wow fadeInDown animated'>\n";
		if (!empty($url)) {
			$output .= "<a  href='".$url."' class='cont_last_works cont_team'>\n";
		}
		$output .= "<div class='team_single'>\n";
		$output .= "<div class='image'>\n";
		$output .= "<img src='".$image."' alt='' title=''>\n";
		$output .= "</div>\n";
		$output .= "</div>\n";
		$output .= "<div class='tit_team wow fadeInDown'>\n";
		$output .= $title;
		$output .= "</div>\n";
		$output .= "<p class='cont_team'>".do_shortcode($content)."</p>\n";
		if ($url!="") {
			$output .= "</a>\n";
		}
		$output .= "</div>\n";

		return $output;
	}
?>
<?php
	function indiegroundshortcode_polaroidimage($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'title' => '',
					'group' => ''
						), $params));

		$output .= "<div class='grid cs-style-3'>\n";
		$output .= "	<div class='polaindie frame lightbox'>\n";
		$output .= "		<a href='".do_shortcode($content)."' rel='prettyPhoto[".$group."]' title='".$title."'>\n";
		$output .= "			<figure>\n";
		$output .= "				<img src='".do_shortcode($content)."' alt=''>\n";
		$output .= "				<figcaption>\n";
		$output .= "					<span>VIEW IMAGE</span>\n";
		$output .= "					<h3>".$title."</h3>\n";
		$output .= "				</figcaption>\n";
		$output .= "			</figure>\n";
		$output .= "		</a>\n";
		$output .= "	</div>\n";
		$output .= "</div>\n";

		return $output;
	}

	function indiegroundshortcode_polaroidlink($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'title' => '',
					'group' => '',
					'url' => ''
						), $params));

		$output .= "<div class='grid cs-style-3'>\n";
		$output .= "	<div class='polaindie frame lightbox'>\n";
		$output .= "		<a href='".$url."' title='".$title."'>\n";
		$output .= "			<figure>\n";
		$output .= "				<img src='".do_shortcode($content)."' alt=''>\n";
		$output .= "				<figcaption>\n";
		$output .= "					<span>VIEW IMAGE</span>\n";
		$output .= "					<h3>".$title."</h3>\n";
		$output .= "				</figcaption>\n";
		$output .= "			</figure>\n";
		$output .= "		</a>\n";
		$output .= "	</div>\n";
		$output .= "</div>\n";

		return $output;
	}

	function indiegroundshortcode_polaroidvideo($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'title' => '',
					'image' => '',
					'group' => ''
						), $params));

		$output .= "<div class='grid cs-style-3'>\n";
		$output .= "	<li class='polaindie frame lightbox'>\n";
		$output .= "		<a href='".do_shortcode($content)."' rel='prettyPhoto[".$group."]' title='".$title."'>\n";
		$output .= "			<figure>\n";
		$output .= "				<img src='".$image."' alt=''>\n";
		$output .= "				<figcaption>\n";
		$output .= "					<span>VIEW VIDEO</span>\n";
		$output .= "					<h3>".$title."</h3>\n";
		$output .= "				</figcaption>\n";
		$output .= "			</figure>\n";
		$output .= "		</a>\n";
		$output .= "	</li>\n";
		$output .= "</div>\n";

		return $output;
	}

?>
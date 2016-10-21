<?php
	function indiegroundshortcode_testimonial_start($params, $content = null) {
		$output = "";

		$output .= "<div class='testimonial-builder white wow bounceInUp'>\n";
		$output .= "<div class='indie-testimonials'>\n";
		$output .= "<div class='indie-testimonials-container'>\n";

		$output .= "<div class='testimonial'>\n";
		$output .= "<ul class='slides'>\n";

		return $output;
	}

	function indiegroundshortcode_testimonial_item($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'author' => ''
						), $params));

		$output .= "<li>\n";
		$output .= "<p class='indie-testimonial-quote'>".do_shortcode($content)."</p>\n";
		$output .= "<span class='indie-testimonial-source'>".$author."</span>\n";
		$output .= "</li>\n";

		return $output;
	}

	function indiegroundshortcode_testimonial_end($params, $content = null) {
		$output = "";

		$output .= "</ul>\n";
		$output .= "</div> <!-- end indie-testimonials-container -->\n";
		$output .= "</div> <!-- end indie-testimonials -->\n";
		$output .= "</div> <!-- end testimonial-builder white -->\n";

		return $output;
	}
?>
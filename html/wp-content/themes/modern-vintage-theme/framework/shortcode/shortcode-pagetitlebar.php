<?php
	function indiegroundshortcode_pagetitlebar($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'title' => '',
					'subtitle' => ''
						), $params));

		if ($subtitle!="") {
			$output .= "<h2 class='introduction center'>".$subtitle."</h2>\n";
		}
		$output .= "<h1 class='text_title_section center'>".$title."</h1>\n";
		$output .= "<div class='section_divider'></div><!-- end section_divider -->\n";

		return $output;
	}

?>
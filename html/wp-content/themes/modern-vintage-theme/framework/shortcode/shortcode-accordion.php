<?php
	function indiegroundshortcode_accordion_start($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'id' => '',
					'title' => ''
						), $params));

		/*$output .= "<script type='text/javascript'>\n";
		$output .= "	jQuery(document).ready(function(){\n";
		$output .= "		jQuery('.accordion-toggle').click(function (e){\n";
		$output .= "			alert(1);\n";
		$output .= "			jQuery(this).find('.arrow_togle').first().toggleClass('fa-plus fa-minus');\n";
		$output .= "		});\n";
		$output .= "	});\n";
		$output .= "</script>\n";*/

		$output .= "\n<div class='accordion' id='accordion-".$id."'>\n";

		return $output;
	}

	function indiegroundshortcode_accordion_item($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'area' => '',
					'title' => '',
					'item' => ''
						), $params));

		$output .= "<div class='accordion-group'>\n";
		$output .= "	<a class='accordion-toggle' data-toggle='collapse' data-parent='accordion-".$area."' href='#item-".$item."'>\n";
		$output .= "		<div class='accordion-heading accordionize'>\n";
		$output .= "			<div class='tittle_toggle'>".$title."</div>\n";
		$output .= "			<i class='indicator_area fa fa-plus arrow_togle'></i>\n";
		$output .= "		</div><!-- end accordion-heading accordionize -->\n";
		$output .= "	</a>\n";

		$output .= "	<div id='item-".$item."' class='accordion-body collapse'>\n";
		$output .= "		<div class='accordion-inner'>".do_shortcode($content)."</div>\n";
		$output .= "		<div class='vintage_bottom'></div>\n";
		$output .= "	</div>\n";
		$output .= "</div>\n";

		return $output;
	}

	function indiegroundshortcode_accordion_end($params, $content = null) {
		$output = "";

		$output .= "</div> <!-- end accordion -->\n";

		return $output;
	}
?>
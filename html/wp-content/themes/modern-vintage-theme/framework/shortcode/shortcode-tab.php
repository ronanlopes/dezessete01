<?php
	function indiegroundshortcode_tab_start($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'id' => '',
					'title1' => '',
					'title2' => '',
					'title3' => ''
						), $params));

		$output .= "<div class='tabbable'>\n";
		$output .= "	<ul class='nav nav-tabs'>\n";
		if ($title1!='') {
			$output .= "		<li class='active'><a href='#tab1' data-toggle='tab'>".$title1."</a></li>\n";
		}
		if ($title2!='') {
			$output .= "		<li><a href='#tab2' data-toggle='tab'>".$title2."</a></li>\n";
		}
		if ($title3!='') {
			$output .= "		<li><a href='#tab3' data-toggle='tab'>".$title3."</a></li>\n";
		}
		$output .= "	</ul>\n";
		//$output .= "	<div class='clear'></div>\n";
		$output .= "	<div class='tab-content'>\n";

		return $output;
	}

	function indiegroundshortcode_tab_item($params, $content = null) {
		$output = "";
		$active = "";

		extract(shortcode_atts(array(
					'id' => ''
						), $params));


		if ($id=="1") {
			$active = "in active";
		}
		$output .= "		<div class='tab-pane fade ".$active."' id='tab".$id."'>".do_shortcode($content)."</div>\n";

		return $output;
	}

	function indiegroundshortcode_tab_end($params, $content = null) {
		$output = "";

		$output .= "	</div>\n";
		$output .= "	<div class='vintage_bottom'></div>\n";
		$output .= "</div>\n";

		return $output;
	}
?>
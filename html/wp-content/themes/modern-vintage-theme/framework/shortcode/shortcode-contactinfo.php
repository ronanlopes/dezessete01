<?php
	function indiegroundshortcode_contactinfo($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'mobile' => '',
					'telephone' => '',
					'email' => '',
					'web' => ''
						), $params));

		$output .= "<div class='widget_contact_footer'>\n";
		$output .= "	<ul>\n";
		$output .= "		<li class='type_contact'>\n";
		$output .= "			<div class='ico_typecont'>\n";
		$output .= "				<i class='fa fa-phone'></i>\n";
		$output .= "			</div>\n";
		$output .= "			<div class='description_wcf'>\n";
		$output .= "				".$mobile."\n";
		$output .= "			</div>\n";
		$output .= "		</li>\n";

		$output .= "		<li class='type_contact'>\n";
		$output .= "			<div class='ico_typecont'>\n";
		$output .= "				<i class='fa fa-user'></i>\n";
		$output .= "			</div>\n";
		$output .= "			<div class='description_wcf'>\n";
		$output .= "				".$telephone."\n";
		$output .= "			</div>\n";
		$output .= "		</li>\n";

		$output .= "		<li class='type_contact'>\n";
		$output .= "			<div class='ico_typecont'>\n";
		$output .= "				<i class='fa fa-envelope'></i>\n";
		$output .= "			</div>\n";
		$output .= "			<div class='description_wcf'>\n";
		$output .= "				".$email."\n";
		$output .= "			</div>\n";
		$output .= "		</li>\n";

		$output .= "		<li class='type_contact'>\n";
		$output .= "			<div class='ico_typecont'>\n";
		$output .= "				<i class='fa fa-globe'></i>\n";
		$output .= "			</div>\n";
		$output .= "			<div class='description_wcf'>\n";
		$output .= "				".$web."\n";
		$output .= "			</div>\n";
		$output .= "		</li>\n";

		$output .= "		<li class='type_contact'>\n";
		$output .= "			<div class='ico_typecont'>\n";
		$output .= "				<i class='fa fa-map-marker'></i>\n";
		$output .= "			</div>\n";
		$output .= "			<div class='description_wcf'>\n";
		$output .= "				".do_shortcode($content)."\n";
		$output .= "			</div>\n";
		$output .= "		</li>\n";

		$output .= "	</ul>\n";
		$output .= "</div>\n";

		return $output;
	}
?>
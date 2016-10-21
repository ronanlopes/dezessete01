<?php
/**
 * Load Theme Styles
 */
function indieground_custom_css(){
	global $indieground_options;
	$css_out = '';
	$css_out.=indieground_custom_parallax('page-sections');
	$css_out.=indieground_custom_parallax('portfolio');
	$css_out.=indieground_custom_parallax('post');
	$bg_image_custom = "";
	$bg_image = "";
	$bg_color = "";
	if(!empty($indieground_options['indieground-general-pattern'])) {
		$bg_image=$indieground_options['indieground-general-pattern'];
		$pos = strrpos($bg_image, "trasparent");
		if ($pos>0) {
			$bg_image="";
		}
	}
	if(!empty($indieground_options['indieground-general-custom-pattern']['url'])) {
		$bg_image_custom=$indieground_options['indieground-general-custom-pattern']['url'];
	}
	if(!empty($indieground_options['indieground-general-bckcolor'])) {
		$bg_color=$indieground_options['indieground-general-bckcolor'];
		$pos = strrpos($bg_color, "transparent");
		if ($pos>=0) {
			$bg_color="";
		}
	}
	$css_out.= ".page_theme {\n";
	if ($bg_image_custom!="") {
		$css_out .= "\tbackground:url('".$bg_image_custom."') repeat $bg_color !important;\n";
	} else if ($bg_image!="") {
		$css_out .= "\tbackground:url('".$bg_image."') repeat $bg_color !important;\n";	} else if ($bg_color!="") {
		$css_out .= "\tbackground-image: none !important; \n";
		$css_out .= "\tbackground-color:".$bg_color.";\n";
	}
	$css_out.= "}\n";
	$bg_image_custom = "";
	$bg_image = "";
	$bg_color = "";
	if(!empty($indieground_options['indieground-header-pattern'])) {
		$bg_image=$indieground_options['indieground-header-pattern'];
		$pos = strrpos($bg_image, "trasparent");
		if ($pos>0) {
			$bg_image="";
		}
	}
	if(!empty($indieground_options['indieground-header-custom-pattern']['url'])) {
		$bg_image_custom=$indieground_options['indieground-header-custom-pattern']['url'];
	}
	if(!empty($indieground_options['indieground-header-bckcolor'])) {
		$bg_color=$indieground_options['indieground-header-bckcolor'];
		$pos = strrpos($bg_color, "transparent");
		if ($pos>=0) {
			$bg_color="";
		}
	}
	$css_out.= ".head_bg {\n";
	if ($bg_image_custom!="") {
		$css_out .= "\tbackground:url('".$bg_image_custom."') repeat $bg_color !important;\n";
	} else if ($bg_image!="") {
		$css_out .= "\tbackground:url('".$bg_image."') repeat $bg_color !important;\n";
	} else if ($bg_color!="") {
		$css_out .= "\tbackground-image: none !important; \n";
		$css_out .= "\tbackground-color:".$bg_color.";\n";
	}
	$css_out.= "}\n";

	return $css_out;
}


function indieground_custom_parallax($section){
	$css_out = "/* parallasse '.$section.'*/\n";
	$query_css = new WP_Query(array('post_type' => $section, 'posts_per_page' => -1, 'order' => 'ASC' ) );
	if($query_css->have_posts()):
		while($query_css->have_posts()) : $query_css->the_post();
			if ($section=='page-sections') {
				$bg_image = get_post_meta(get_the_ID(), 'indieground_bg_image', TRUE);
				$bg_color = get_post_meta(get_the_ID(), 'indieground_bg_color', TRUE);
			}
			$parallax_image = get_post_meta(get_the_ID(), 'indieground_parallax_image', TRUE);
			$class = ".".get_post_type()."-".get_the_ID();
			if(!empty($bg_image) || !empty($bg_color)){
				$css_out .= $class."{\n\t";				if(!empty($bg_image)){
					$css_out .= "\tbackground:url('".$bg_image."') $bg_color !important;\n";
				} else {
					if(!empty($bg_color)){
						$css_out .= "\tbackground-image: none !important; \n";
						$css_out .= "\tbackground-color:".$bg_color.";\n";
					}
				}
				$css_out .= "}\n";
			}
			if(!empty($parallax_image)) {
				$css_out .= "#parallax-section-".get_the_ID()."{\n\t";
				$css_out .= "background: url('".$parallax_image."')  repeat 50% -3px fixed transparent;\n";
				$css_out .= "background-size: cover !important;\n";
				$css_out .= "z-index: -1;\n";
				$css_out .= "}\n";
			}
		endwhile;
	endif;
	return $css_out;
}


//=====================================================================
//=========================== CUSTOMIZER LOGIN ========================
//=====================================================================
function indieground_logincss() {
	global $indieground_options;

	$logo="";
	$bg_color="";
	$bg_pattern="";

	if(!empty($indieground_options['indieground-login-logo']['url'])) {
		$logo=$indieground_options['indieground-login-logo']['url'];
	}
	if(!empty($indieground_options['indieground-login-custom-pattern']['url'])) {
		$bg_pattern=$indieground_options['indieground-login-custom-pattern']['url'];
	}
	if(!empty($indieground_options['indieground-login-color'])) {
		$bg_color=$indieground_options['indieground-login-color'];
	}

	echo "<style type='text/css'>\n";

	if ($bg_color!="" || $bg_pattern!="") {
		echo "body.login {\n";
		if ($bg_pattern!="") {
			echo "\tbackground-image: url('".$bg_pattern."'); \n";
		}
		if ($bg_color!="") {
			echo "\tbackground-color:".$bg_color.";\n";
		}
		echo "}";
	}

	if ($logo!="") {
		echo ".login h1 a {\n";
		echo "	background-image: url('".$logo."');\n";
		echo "	width: 340px !important;\n";
		echo "	height: 90px !important;\n";
		echo " background-size: 280px 80px !important;\n";

		echo "}\n";
	}

	echo "</style>\n";
}
add_action('login_head', 'indieground_logincss');

?>
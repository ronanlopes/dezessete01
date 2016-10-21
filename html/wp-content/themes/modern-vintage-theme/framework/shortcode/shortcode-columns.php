<?php
	function indiegroundshortcode_one_third_first( $atts, $content = null ) {
	   //$output = '<div class="container">';
	   $output = '<div class="row">';
	   $output .= '<div class="col-xs-12 col-sm-4">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_one_third( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-4">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_one_third_last( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-4">'.do_shortcode($content).'</div><div class="clearboth"></div>';
	   $output .= '</div>';
	   return $output;
	}

	function indiegroundshortcode_two_third_first( $atts, $content = null ) {
	   //$output = '<div class="container">';
	   $output = '<div class="row">';
	   $output .= '<div class="col-xs-12 col-sm-8">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_two_third( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-8">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_two_third_last( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-8">'.do_shortcode($content).'</div>';
	   $output .= '</div>';
	   //$output .= '</div>';
	   $output .= '<div class="clearboth"></div>';
	   return $output;
	}

	function indiegroundshortcode_one_half_first( $atts, $content = null ) {
	   //$output = '<div class="container">';
	   $output = '<div class="row">';
	   $output .= '<div class="col-xs-12 col-sm-6">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_one_half( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-6">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_one_half_last( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-6">'.do_shortcode($content).'</div>';
	   $output .= '</div>';
	   //$output .= '</div>';
	   $output .= '<div class="clearboth"></div>';
	   return $output;
	}

	function indiegroundshortcode_one_fourth_first( $atts, $content = null ) {
	   //$output = '<div class="container">';
	   $output = '<div class="row">';
	   $output .= '<div class="col-xs-12 col-sm-3">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_one_fourth( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-3">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_one_fourth_last( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-3">'.do_shortcode($content).'</div>';
	   $output .= '</div>';
	   //$output .= '</div>';
	   $output .= '<div class="clearboth"></div>';
	   return $output;
	}

	function indiegroundshortcode_three_fourth( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-9">'.do_shortcode($content).'</div>';
	   return $output;
	}

	function indiegroundshortcode_three_fourth_last( $atts, $content = null ) {
	   $output = '<div class="col-xs-12 col-sm-9">'.do_shortcode($content).'</div>';
	   $output .= '</div>';
	   //$output .= '</div>';
	   $output .= '<div class="clearboth"></div>';
	   return $output;
	}
?>
<?php

/************************************************************************
* Page Sections template
*************************************************************************/

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'page-sections.php' == basename($_SERVER['SCRIPT_FILENAME'])){
		die ('This file can not be accessed directly!');
	}

	global $bg;

	$section_style_image = get_post_meta(get_the_ID(), 'indieground_bg_image', TRUE);
	$section_style_color = get_post_meta(get_the_ID(), 'indieground_bg_color', TRUE);
	$section_subtitle = get_post_meta(get_the_ID(), 'indieground_subtitle', TRUE);
	$section_title_visibility = get_post_meta(get_the_ID(), 'indieground_title_visibility', TRUE);
	$section_line_visibility = get_post_meta(get_the_ID(), 'indieground_line_visibility', TRUE);
	$section_googlemaps_visibility = get_post_meta(get_the_ID(), 'indieground_googlemaps_visibility', TRUE);
	$section_parallax_image = get_post_meta(get_the_ID(), 'indieground_parallax_image', TRUE);
	$section_revslider = get_post_meta(get_the_ID(), 'indieground_revslider', TRUE);

	if( $bg=='alternate-bg1' ){
		$bg='alternate-bg2';
	}else{
		$bg='alternate-bg1';
	}

	if(!empty($section_style_image) || !empty($section_style_color)){
		$bg = '';
	}

	$current_ID = get_the_ID();


	if(!empty($section_parallax_image)) {
		echo "<section class='parallax parallax-sections-".$current_ID."' id='parallax-section-".$current_ID."' style='background-position: 50% 121px;'>\n";
		echo "<div class='container message'></div>\n";
		echo "</section>\n";

		echo "<scri"."pt type='text/javascr"."ipt'>\n";
		//echo "jQuery(document).ready(function() {\n";
		echo "jQuery(window).load(function() {\n";
		echo "jQuery('#parallax-section-".$current_ID."').parallax('50%', '0.3');\n";
		echo "	});\n";
		echo "</script>\n";
	}

	if ($section_revslider!="") {
		putRevSlider($section_revslider);
	}
?>

	<section class="pad_menu <?php echo get_post_type();?>-<?php the_ID();?> <?php echo (isset($bg)) ? $bg : '';?>" id="<?php echo $post->post_name;?>">
		<div class="container">

			<?php if ($section_title_visibility=='ON') { ?>
				<h2 class="text_intertit center"><?php echo $section_subtitle; ?></h2>
				<h1 class="text_tit center"><?php the_title(); ?></h1>
			<?php } ?>

			<?php if ($section_line_visibility=='ON') { ?>
				<div class="divider"></div>
			<?php } ?>

			<?php the_content(); ?>

		</div>
	</section>

<?php

	if ($section_googlemaps_visibility=="ON") {
		echo indiegroundshortcode_create_google_maps();
	}

?>
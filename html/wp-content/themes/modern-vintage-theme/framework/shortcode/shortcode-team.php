<?php
	function indiegroundshortcode_create_team_item($params, $content = null) {
		global $indieground_options;
		$output = "";
		$columns = "";

		$query_css = new WP_Query(array('post_type' => 'team', 'posts_per_page' => -1, 'order' => 'ASC' ) );

		$columns=$indieground_options['indieground-team-columns'];
		if ($columns=="3") {
			$columns="4";
		} else {
			$columns="3";
		}

		if($query_css->have_posts()):

			$output .= "<div class='row'>\n";

			while($query_css->have_posts()) : $query_css->the_post();

				$social_fb = get_post_meta(get_the_ID(), 'indieground_tlink_facebook', TRUE);
				$social_tw = get_post_meta(get_the_ID(), 'indieground_tlink_twitter', TRUE);
				$social_lk = get_post_meta(get_the_ID(), 'indieground_tlink_linkedin', TRUE);
				$social_pt = get_post_meta(get_the_ID(), 'indieground_tlink_pinterest', TRUE);
				$social_be = get_post_meta(get_the_ID(), 'indieground_tlink_behance', TRUE);


				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'team-thumb');
				$output .= "<div class='col-xs-12 col-sm-".$columns." col-md-".$columns." col-lg-".$columns." move_top'>\n";
				$output .= "<a href='".get_permalink()."' class='cont_last_works cont_team'>\n";
				$output .= "<div class='team_single wow fadeInDown animated'>\n";
				$output .= "<div class='image'>\n";
				$output .= "<img src='".$image_url[0]."'>\n";
				$output .= "</div>\n";
				$output .= "</div>\n";
				$output .= "<div class='tit_team wow fadeInDown animated'>\n";
				$output .= get_the_title(get_the_ID())."\n";
				$output .= "</div>\n";

				$output .= "<p>".excerpt(15)."</p>\n";

				$output .= "</a>\n";

				$output .= "<div class='center team_social wow fadeInDown animated'>\n";

				if (!empty($social_fb) && $social_fb!="") {
					$output .= "<a class='social_icon' target='_blank' href='".$social_fb."'>\n";
					$output .= "    <i class='icon-facebookicon'></i>\n";
					$output .= "</a>\n";
				}
				if (!empty($social_tw) && $social_tw!="") {
					$output .= "<a class='social_icon' target='_blank' href='".$social_tw."'>\n";
					$output .= "    <i class='icon-twittericon'></i>\n";
					$output .= "</a>\n";
				}
				if (!empty($social_lk) && $social_lk!="") {
					$output .= "<a class='social_icon' target='_blank' href='".$social_lk."'>\n";
					$output .= "    <i class='icon-linkedinicon'></i>\n";
					$output .= "</a>\n";
				}
				if (!empty($social_pt) && $social_pt!="") {
					$output .= "<a class='social_icon' target='_blank' href='".$social_pt."'>\n";
					$output .= "    <i class='icon-pinteresticon'></i>\n";
					$output .= "</a>\n";
				}
				if (!empty($social_be) && $social_be!="") {
					$output .= "<a class='social_icon' target='_blank' href='".$social_be."'>\n";
					$output .= "    <i class='icon-behanceicon'></i>\n";
					$output .= "</a>\n";
				}
				$output .= "</div>\n";

				$output .= "</div>\n";

			endwhile;

			$output .= "</div>\n";

		endif;

		wp_reset_postdata();

		return $output;
	}
?>
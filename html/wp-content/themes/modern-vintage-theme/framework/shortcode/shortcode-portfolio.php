<?php
	function indiegroundshortcode_create_portfolio_categories() {
		global $indieground_options;
		$output = "";
		if ($indieground_options['indieground-portfolio-filtersyesno']==1) {
			$output .= "<nav id='filter' class='center'>\n";			$output .= "	<ul>\n";
			$output .= "		<div class='append_img'>\n";
			$output .= "			<li>\n";
			$output .= "				<a href='' class='current btn btn-small' data-filter='*'>All</a>\n";
			$output .= "			</li>\n";
			$output .= "		</div>\n";			$args = array("taxonomy" => "categories");
			$filter_by = get_terms("categories",$args);			foreach ($filter_by as $handle) {				$output .= "		<div class='append_img'>\n";				$output .= "			<li>\n";
				$output .= "				<a href='' class='current btn btn-small' data-filter='.".str_replace(" ","-",$handle->slug)."'>".$handle->name."</a>\n";
				$output .= "			</li>\n";
				$output .= "		</div>\n";
			}			$output .= "	</ul>\n";
			$output .= "</nav>\n";
		}		return $output;
	}
	function indiegroundshortcode_create_portfolio_item($category, $numpost) {
		global $indieground_options;
		$output = "";
		$count=0;

		if (!empty($indieground_options['indieground-portfolio-items-number']) && $numpost<=0) {
			$numpost=$indieground_options['indieground-portfolio-items-number'];
		}

		$args = array(
				  'post_type' => 'portfolio',
				  'posts_per_page' => $numpost,
				  'order' => 'DESC'
			  );
		$query_css = new WP_Query($args);
		if ($numpost<=0) {
			$numpost = 99999;
		}

		if($query_css->have_posts()):			$output .= "<div class='portfolio-items isotopeWrapper' >\n";
			$output .= "	<ul>\n";
			while($query_css->have_posts() && $count<$numpost) : $query_css->the_post();				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
				$image = $image_url[0];
				$pretitle = get_post_meta(get_the_ID(), 'indieground_pretitle', TRUE);
				if ($pretitle=="") {
					$pretitle = "VIEW PROJECT";
				}
				$link = get_post_meta(get_the_ID(), 'indieground_link', TRUE);				if ($link=="") {
					$link=get_permalink();
				}

				$finded = false;
				$idcate = "";
				$terms = get_the_terms(get_the_ID(), "categories");
				if (is_array($terms)) {
					foreach ($terms as $term ) {
						$post_cate=$term->slug;
						$idcate .= str_replace(" ","-",$post_cate)." ";
						if($post_cate==$category && $finded==false) {
							$finded=true;
						}
					}
				}
				if ($category=="" || $finded) {
					if(!empty($image)){
						$image_resized = aq_resize($image, 300, 300, true ); //resize & crop img
						if (empty($image_resized)) {
							$image_resized = $image;
						}					} else {
						$image_resized="";
					}

					$output .= "		<div class='grid cs-style-3 col-full-".$indieground_options['indieground-portfolio-columns']." isotopeItem ".$idcate."' >\n";
					$output .= "			<li class='frame'>\n";
					$output .= "				<a href='".$link."'>\n";
					$output .= "					<figure>\n";
					$output .= "						<img class='disabled' src='".$image_resized."' alt='img04'>\n";
					$output .= "						<figcaption>\n";
					$output .= "							<span>".$pretitle."</span>\n";
					$output .= "							<h3>".get_the_title(get_the_ID())."</h3>\n";
					$output .= "						</figcaption>\n";
					$output .= "					</figure>\n";
					$output .= "				</a>\n";
					$output .= "			</li>\n";
					$output .= "			<img alt='shadow' class='img_shadow portfolio_shadow' src='".get_template_directory_uri()."/include/images/retina/shadow/shadow.png' />\n";
					$output .= "		</div>\n";

					$count+=1;
				}
			endwhile;
			$output .= "	</ul>\n";
			//$output .= "</section>\n";
			$output .= "</div>\n";
		endif;
		wp_reset_postdata();
		return $output;
	}
	function indiegroundshortcode_create_portfolio_item_recent($numpost) {
		$output = "";
		$query_css = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $numpost, 'order' => 'ASC'));
		if($query_css->have_posts()):
			$output .= "<div class='container position_showcase'>\n";
			$output .= "<!-- RECENT WORKS -->\n";
			$output .= "<div class='row'>\n";
			while($query_css->have_posts()) : $query_css->the_post();
				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
				$image = $image_url[0];
				$link = get_post_meta(get_the_ID(), 'indieground_link', TRUE);
				if(!empty($link) || !empty($image)){
					$terms = get_the_terms(get_the_ID(), "categories");
					foreach ( $terms as $term ) {
						$idcate = $term->name;
					}
					$image_resized = aq_resize($image, 300, 300, true ); //resize & crop img
					if (empty($image_resized)) {
						$image_resized = $image;
					}
					$output .= "<div class='col-xs-6 col-sm-3 col-md-3 col-lg-3 img-bottom'><!-- BEGIN col-md-3 -->\n";
					$output .= "<a href='".get_permalink()."' class='cont_last_works'>\n";
					$output .= "<img alt='image resized' class='cap_border frame' src='".$image_resized."' />\n";
					$output .= "<img alt='image shadow' class='img_shadow' src='images/shadow.png' />\n";
					$output .= "<div class='tit_last_work'>\n";
					$output .= get_the_title();
					$output .= "</div>\n";
					$output .= "</a>\n";
					$output .= "</div><!-- END col-md-3 -->\n";
				}
			endwhile;
			$output .= "</div>\n";
			$output .= "</div><!-- END RECENT WORKS -->\n";
		endif;
		wp_reset_postdata();
		return $output;
	}
?>
<?php
	function indiegroundshortcode_blog_sidebar($params, $content = null) {
		$output = "";

		extract(shortcode_atts(array(
					'position' => '',
					'category' => ''
						), $params));


		$output .= "<div class='row'>\n";

		if ($position!="r") {
			$output .= "<div class='col-xs-12 col-sm-4 col-md-4'>\n";
			if (!function_exists('dynamic_sidebar')) {
				$output .= "<h4>Widget Area</h4>";
				$output .= "<p>This section is widgetized. To add widgets here, go to the";
				$output .= "<a href='".admin_url()."widgets.php'>Widgets</a> panel in your WordPress admin, and";
				$output .= " add the widgets you would like to <strong>Right Sidebar</strong>.</p>";
				$output .= "<p><small>*This message will be overwritten after widgets have been added</small></p>";
			} else {
				ob_start();
				dynamic_sidebar('blog_sidebar');
				$output .= ob_get_contents();
				ob_end_clean();
			}
			$output .= "</div>\n";
		}

		$output .= "<div class='col-xs-12 col-sm-8 col-md-8'>\n";
		$output .= "<div id='blogsidebar-content'>\n";
		$output .= indiegroundshortcode_blogsidebar_posts(1,$category);
		$output .= "</div>\n";
		$output .= "<div class='cont_bottom'>\n";
		$output .= "	<div class='indie_botton' id='blogsidebar-loadmore'>\n";
		$output .= "		<div class='special'> load more posts </div>\n";
		$output .= "	</div>\n";
		$output .= "	<div style='display:none' id='blogsidebar-wait'>\n";
		$output .= "		<center><i class='fa fa-refresh fa-spin indi_loading'></i></center>\n";
		$output .= "	</div>\n";
		$output .= "</div>\n";
		$output .= "</div>\n";

		if ($position=="r") {
			$output .= "<div class='col-xs-12 col-sm-4 col-md-4'>\n";
			if (!function_exists('dynamic_sidebar')) {
				$output .= "<h4>Widget Area</h4>";
				$output .= "<p>This section is widgetized. To add widgets here, go to the";
				$output .= "<a href='".admin_url()."widgets.php'>Widgets</a> panel in your WordPress admin, and";
				$output .= " add the widgets you would like to <strong>Right Sidebar</strong>.</p>";
				$output .= "<p><small>*This message will be overwritten after widgets have been added</small></p>";
			} else {
				ob_start();
				dynamic_sidebar('blog_sidebar');
				$output .= ob_get_contents();
				ob_end_clean();
			}
			$output .= "</div>\n";
		}

		$output .= "</div>\n";

		$output .= "<script type='text/javascript'>\n";
		$output .= "	var _pagbs = 1;\n";
		$output .= "	jQuery('#blogsidebar-loadmore').click(function() {\n";
		$output .= "		_pagbs+=1;\n";
		$output .= "		jQuery('#blogsidebar-wait').css('display','block');\n";
		$output .= "		jQuery('#blogsidebar-loadmore').css('display','none');\n";
		$output .= "		jQuery.ajax({\n";
		$output .= "			url: '".site_url()."/wp-admin/admin-ajax.php',\n";
		$output .= "			type:'POST',\n";
		$output .= "			data: 'action=blogsscroll&type=S&page_no='+ _pagbs+'&cat=".$category."',\n";
		$output .= "			success: function(html){\n";
		$output .= "				jQuery('#blogsidebar-wait').css('display','none');\n";
		$output .= "				if (html.trim()!='') {\n";
		$output .= "					jQuery('#blogsidebar-content').append(html);\n";
		$output .= "					jQuery('#blogsidebar-loadmore').css('display','block');\n";
		$output .= "				}\n";
		$output .= "			}\n";
		$output .= "		});\n";
		$output .= "		return false;\n";
		$output .= "	});\n";
		$output .= "</script>\n";


		return $output;
	}

	function indiegroundshortcode_blogsidebar_posts($page,$category) {
		$output = "";
		$cont=0;

		$args = array('posts_per_page' => 4, 'order'=> 'DESC', 'orderby' => 'date', 'paged' => $page,'category_name'=>$category);

		$myposts = get_posts($args);
		if($myposts) {
			foreach ($myposts as $post) :
				setup_postdata($post);

				$content = content_limit($post->post_content,40);

				$image = get_the_post_thumbnail($post->ID, 'thumb-blog-side', array('class' => 'disabled'));

				$output .= "<div class='cont_grid_blog wow fadeInDown'>\n";
				$output .= "	<div class='post_thumbnail col-blog-5'>\n";
				$output .= "		<div class='grid cs-style-3 pol_blog frame'>\n";
				$output .= "			<a class='transition' href='".get_permalink($post->ID)."'>\n";
				$output .= "				<figure>\n";
				$output .= "					".$image."\n";
				$output .= "					<figcaption class='postblog_thumbnail'>\n";
				$output .= "						<span>OPEN ARTICLE</span>\n";
				$output .= "					</figcaption>\n";
				$output .= "				</figure>\n";
				$output .= "			</a>\n";
				$output .= "		</div><!-- endgrid .cs-style-3 .frame -->\n";

				$output .= "		<img alt='' class='img_shadow' src='".get_template_directory_uri()."/include/images/retina/shadow/shadow.png' />\n";
				$output .= "	</div><!-- end cont .post_thumbnail -->\n";

				$output .= "	<div class='col-blog-7'>\n";
				$output .= "		<h2 class='headline'><a href='".get_permalink($post->ID)."' rel='bookmark'>".get_the_title($post->ID)."</a></h2>\n";
				$output .= "		<div class='post_details'>\n";

				$output .= "			<div class='w_blogpost w_blogpost_comments'>\n";
				$output .= "				<a href='".get_permalink($post->ID)."#respond'> <i class='fa fa-comments-o'></i> ".get_comments_popup_link($post->ID,'No Comments', '1 Comment', '% Comments')." </a>\n";
				$output .= "			</div>\n";
				$output .= "		</div><!-- post_details -->\n";

				$output .= "		<div class='article'><!-- BEGIN .article -->\n";
			     if (get_the_excerpt()) {
					$output.= get_the_excerpt();
					} else {
					$output.= "<p>".$content."</p>\n";
				}
		     
				$output .= "		</div><!-- END .article -->\n";

				$output .= "		<p class='align-right read_more'> <a href='".get_permalink($post->ID)."'><i class='fa fa-book'></i>Read the article</a></p>\n";
				$output .= "	</div><!-- col-blog-7 -->\n";

				$output .= "	<div class='clear'></div><!-- end clear -->\n";
				$output .= "	<div class='divider-post'></div><!-- end divider -->\n";
				$output .= "</div><!-- cont_grid_blog -->\n";

				$cont+=1;

			endforeach;
		}

		wp_reset_postdata();

		if ($cont<4) {
			$output .= "<script type='text/javascript'>\n";
			$output .= "	jQuery(document).ready(function(){\n";
			$output .= "		jQuery('#blogsidebar-loadmore').css('display','none');\n";
			$output .= "	});\n";
			$output .= "</script>\n";
		}


		return $output;
	}



	function indiegroundshortcode_blog_fullwidth($params, $content = null) {
		extract(shortcode_atts(array(
					'category' => ''
						), $params));

		$output = "";

		$output .= "<div class='row'>\n";
		$output .= "	<div class='col-xs-12 col-sm-12 col-md-12'>\n";

		$output .= "		<div id='blogfullwidth-content'>\n";
		$output .= "			".indiegroundshortcode_blogfullwidth_posts(1,$category);
		$output .= "		</div>\n";

		$output .= "		<div class='cont_bottom'>\n";
		$output .= "			<div class='indie_botton' id='blogfullwidth-loadmore'>\n";
		$output .= "			<div class='special'> load more posts </div>\n";
		$output .= "		</div>\n";
		$output .= "		<div style='display:none' id='blogfullwidth-wait'>\n";
		$output .= "			<center><i class='fa fa-refresh fa-spin indi_loading'></i></center>\n";
		$output .= "		</div>\n";
		$output .= "	</div>\n";

		$output .= "</div>\n";

		$output .= "<script type='text/javascript'>\n";
		$output .= "	var _pagbs = 1;\n";
		$output .= "	jQuery('#blogfullwidth-loadmore').click(function() {\n";
		$output .= "		_pagbs+=1;\n";
		$output .= "		jQuery('#blogfullwidth-wait').css('display','block');\n";
		$output .= "		jQuery('#blogfullwidth-loadmore').css('display','none');\n";
		$output .= "		jQuery.ajax({\n";
		$output .= "			url: '".site_url()."/wp-admin/admin-ajax.php',\n";
		$output .= "			type:'POST',\n";
		$output .= "			data: 'action=blogsscroll&type=F&page_no='+ _pagbs+'&cat=".$category."',\n";
		$output .= "			success: function(html){\n";
		$output .= "				jQuery('#blogfullwidth-wait').css('display','none');\n";
		$output .= "				if (html.trim()!='') {\n";
		$output .= "					jQuery('#blogfullwidth-content').append(html);\n";
		$output .= "					jQuery('#blogfullwidth-loadmore').css('display','block');\n";
		$output .= "				}\n";
		$output .= "			}\n";
		$output .= "		});\n";
		$output .= "		return false;\n";
		$output .= "	});\n";
		$output .= "</script>\n";

		return $output;
	}

	function indiegroundshortcode_blogfullwidth_posts($page,$category) {
		$output = "";

		$args = array('posts_per_page' => 4, 'order'=> 'DESC', 'orderby' => 'date', 'paged' => $page,'category_name'=>$category);
		$myposts = get_posts($args);

		foreach ($myposts as $post) :
			setup_postdata($post);

			$image = get_the_post_thumbnail($post->ID, 'thumb-blog-full', array('class' => 'disabled'));

			$output .= "		<!-- START The Loop -->\n";
			$output .= "		<div class='cont_grid_blog'>\n";
			$output .= "			<div class='post_thumbnail col-blog-5'>\n";
			$output .= "				<div class='grid cs-style-3 pol_blog frame'>\n";
			$output .= "					<a class='transition' href='".get_permalink($post->ID)."'>\n";
			$output .= "						<figure>\n";
			$output .= "							".$image."\n";
			$output .= "							<figcaption class='postblog_thumbnail'>\n";
			$output .= "								<span>OPEN ARTICLE</span>\n";
			$output .= "							</figcaption>\n";
			$output .= "						</figure>\n";
			$output .= "					</a>\n";
			$output .= "				</div><!-- end grid cs-style-3 frame -->\n";
			$output .= "				<img alt='' class='img_shadow' src='".get_template_directory_uri()."/include/images/retina/shadow/shadow.png' />\n";
			$output .= "			</div><!-- cont post_thumbnail -->\n";
			$output .= "			<div class='col-blog-7'>\n";
			$output .= "				<h2 class='headline'><a href='".get_permalink($post->ID)."' rel='bookmark'>".get_the_title($post->ID)."</a></h2>\n";
			$output .= "				<div class='post_details'>\n";
			//$output .= "					<div class='w_blogpost w_blogpost_date'>\n";
			//$output .= "						<a href='".get_permalink($post->ID)."'> <i class='fa fa-calendar'></i>".get_the_date()."</a>\n";
			//$output .= "					</div>\n";
			//$output .= "					<div class='w_blogpost w_blogpost_author'>\n";
			//$output .= "						<a href='".get_permalink($post->ID)."'><i class='fa fa-user'></i> Created by ".get_the_author()."</a>\n";
			//$output .= "					</div>\n";
			$output .= "					<div class='w_blogpost w_blogpost_comments'>\n";
			$output .= "						<a href='".get_permalink($post->ID)."#respond'> <i class='fa fa-comments-o'></i> ".get_comments_popup_link($post->ID,'No Comments', '1 Comment', '% Comments')." </a>\n";
			$output .= "					</div>\n";
			$output .= "				</div><!-- post_details -->\n";
			$output .= "				<div class='article'><!-- BEGIN .article -->\n";
		     $output .= "<p>".excerpt(40)."</p>\n";
			$output .= "				</div><!-- END .article -->\n";
			$output .= "				<p class='align-right read_more'> <a href='".get_permalink($post->ID)."'><i class='fa fa-book'></i>Read the article</a></p>\n";
			$output .= "			</div><!-- col-blog-7 -->\n";
			$output .= "			<div class='clear'></div><!-- end clear -->\n";
			$output .= "			<div class='divider-post'></div><!-- end divider -->\n";
			$output .= "		</div><!-- END The Loop -->\n";
			$output .= "		<!-- END Loop -->\n";

		endforeach;

		wp_reset_postdata();

		return $output;
	}
?>
<?php
function indieground_register_sidebars(){

		register_sidebar( array(
			'name' => __('Blog Section Sidebar','indieground'),
			'id' => 'blog_sidebar',
			'description' => __('Widgets in this area will be shown on the blog section', 'indieground'),
			'before_title' => '<div class="tit_widget">',
			'after_title' => '</div>',
			'before_widget' => '<div class="cont_widget wow fadeInDown"><div class="box_widget">',
			'after_widget' => '</div></div><div class="tit_widget_bottom wow fadeInDown"></div>',
		));


		register_sidebar(array(
			'name' => __( 'Blog Post Sidebar','indieground'),
			'id' => 'indieground_sidebar_blog_page',
			'description' => __( 'Widgets in this area will be shown on the blog page.','indieground'),
			'before_title' => '<div class="tit_widget">',
			'after_title' => '</div>',
			'before_widget' => '<div class="cont_widget wow fadeInDown"><div class="box_widget">',
			'after_widget' => '</div></div><div class="tit_widget_bottom wow fadeInDown"></div>',

		));


	}

	add_action('init','indieground_register_sidebars');

?>
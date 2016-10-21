<?php
	require_once(get_template_directory().'/framework/widget/widget-social.php');
	require_once(get_template_directory().'/framework/widget/widget-twitter.php');
	require_once(get_template_directory().'/framework/widget/widget-flickr.php');
	require_once(get_template_directory().'/framework/widget/widget-instagram.php');


	// Register and load the widget
	function widget_load() {
		register_widget('Indieground_wSocial');
		register_widget('Indieground_wInstagram');
		register_widget('Indieground_wTwitter');
		register_widget('Quick_Flickr_Widget');
	}


add_action( 'widgets_init', 'widget_load' );

?>
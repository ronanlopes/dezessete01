<?php
class TFuse_Widget_Meta extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_meta', 'description' => __( "Log in/out, admin, feed and WP links","tfuse") );
		parent::__construct('meta', __('TFuse Meta','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Meta','tfuse') : $instance['title'], $instance, $this->id_base);
                $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
                $class = ($b) ? 'widget-boxed' : '';
                
		$before_widget = ' <div class="widget widget_meta '.$class.'">';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';		

		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( $title )
			echo $before_title . $title . $after_title;
?>
			<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0','tfuse')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS','tfuse')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="//wordpress.org/" title="<?php echo esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.','tfuse')); ?>">WordPress.org</a></li>
			<?php wp_meta(); ?>
			</ul>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
                $instance['b'] = isset($new_instance['b']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'footer' => '' ) );
		$title = $instance['title'];

?>
                <p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Boxed','tfuse'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <?php
	}
}

function TFuse_Unregister_WP_Widget_Meta() {
	unregister_widget('WP_Widget_Meta');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Meta');

register_widget('TFuse_Widget_Meta');

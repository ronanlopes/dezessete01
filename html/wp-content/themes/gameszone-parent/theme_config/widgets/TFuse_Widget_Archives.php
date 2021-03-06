<?php
class TFuse_Widget_Archives extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_archive', 'description' => __( 'A monthly archive of your site&#8217;s posts','tfuse') );
		parent::__construct('archives', __('TFuse Archives','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$c = $instance['count'] ? '1' : '0';
		$d = $instance['dropdown'] ? '1' : '0';
                $tfuse_widget_col_before = $tfuse_widget_col_after = '';
                
                $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
                $class = ($b) ? 'widget-boxed' : '';

        		$title = apply_filters('widget_title', empty($instance['title']) ? __('Archives','tfuse') : $instance['title'], $instance, $this->id_base);

		$before_widget = '<div class="widget widget_archive '.$class.'">';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';

		echo $tfuse_widget_col_before .$before_widget;
		$title = tfuse_qtranslate($title);
		if ( $title )?>
        <?php
			echo $before_title . $title . $after_title;

		if ( $d ) {
?>
		<select class="widget_dropdown" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> <option value=""><?php echo esc_attr(__('Select Month','tfuse')); ?></option> <?php wp_get_archives(apply_filters('widget_archives_dropdown_args', array('type' => 'monthly', 'format' => 'option', 'show_post_count' => $c))); ?> </select>
<?php
		} else {
?>
		<ul>
		<?php wp_get_archives(apply_filters('widget_archives_args', array('type' => 'monthly', 'show_post_count' => $c))); ?>
		</ul>
<?php
		}

		echo $after_widget . $tfuse_widget_col_after;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '', 'col_1_2' => '') );
		$instance['title'] = $new_instance['title'];
                $instance['b'] = isset($new_instance['b']);
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;
		if ( in_array( $new_instance['template'], array( 'box_white', 'box_white box_border' ) ) ) {
			$instance['template'] = $new_instance['template'];
		} else {
			$instance['template'] = 'box_white';
		}

		return $instance;
	}
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '', 'image' => '') );
		$title = $instance['title'];
        $image = $instance['image'];
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
		@$template = esc_attr( $instance['template'] );
?>
                                <p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Boxed','tfuse'); ?></label></p>


		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p>
			<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts','tfuse'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" /> <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as a drop down','tfuse'); ?></label>
		</p>
		
<?php
	}
}

function TFuse_Unregister_WP_Widget_Archives() {
	unregister_widget('WP_Widget_Archives');       
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Archives');

register_widget('TFuse_Widget_Archives');
?>
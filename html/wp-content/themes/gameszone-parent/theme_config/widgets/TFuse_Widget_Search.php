<?php

// =============================== Search widget ======================================

class TFuse_Widget_Search extends WP_Widget {

	function __construct() {
            $widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your site","tfuse") );
            parent::__construct('search', __('TFuse Search','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args);
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search','tfuse' ) : $instance['title'], $instance, $this->id_base);
            $template = empty( $instance['template'] ) ? '' : $instance['template'];
            $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
                $class = ($b) ? 'widget-boxed' : '';
            ?>
                    <div class="widget widget_search <?php echo $class;?>">
                            <h3 class="widget-title"><?php echo $title; ?></h3>
                            <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" class="clearfix">
                                <label class="screen-reader-text" for="s"><?php _e('Search for', 'tfuse') ?>:</label>
                                <input type="text" value=""  name="s" id="s" class="inputtext" placeholder="<?php _e('Search this blog', 'tfuse') ?>"/>
                                <button type="submit" class="btn btn-primary"><span class="tficon-search"></span></button>
                            </form>
			</div>
			<?php
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
            $instance['title'] = $new_instance['title'];
            $instance['template'] = strip_tags($new_instance['template']);
            $instance['b'] = isset($new_instance['b']);
            return $instance;
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array(  'template' => 'box_white',) );
            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
            $title = $instance['title'];
            $template = esc_attr( $instance['template'] );
?>
                <p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Boxed','tfuse'); ?></label></p>

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Search() {
	unregister_widget('WP_Widget_Search');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Search');

register_widget('TFuse_Widget_Search');

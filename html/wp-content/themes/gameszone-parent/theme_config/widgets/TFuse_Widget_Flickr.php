<?php

// =============================== Flickr widget ======================================

class TFuse_flickr extends WP_Widget {

	function __construct() {
            $widget_ops = array('description' => '' );
            parent::__construct(false, __('TFuse - Flickr', 'tfuse'),$widget_ops);
	}

	function widget($args, $instance) {
            extract( $args );
            $flickr_id = esc_attr($instance['flickr_id']);
            $instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
            $number = esc_attr($instance['number']);
            $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
            $class = ($b) ? 'widget-boxed' : '';
            
		$instance['title'] = tfuse_qtranslate($instance['title']);?>
<div class="widget widget_flickr <?php echo $class?>">
                    <?php if ( !empty($instance['title']) )
                    { ?>
                         <h3 class="widget-title"><?php echo $instance['title']; ?></h3>
                   <?php } ?>
                     <div class="flickr-inner clearfix">
			<script type="text/javascript" src="//www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>
                </div>
                    </div>
	   <?php
   }

   function update($new_instance, $old_instance) {
       $instance = $old_instance;
	$instance['title'] =  $new_instance['title'] ;
        $instance['flickr_id'] =  $new_instance['flickr_id'] ;
        $instance['number'] =  $new_instance['number'] ;
        $instance['b'] = isset($new_instance['b']);

       return $instance;
   }

   function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'flickr_id' => '', 'number' => '' , 'b' => '') );
		$flickr = esc_attr($instance['flickr_id']);
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = esc_attr($instance['number']);
                $b = esc_attr($instance['b']);
		?>
                <p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Boxed','tfuse'); ?></label></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		
        <p>
            <label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:','tfuse'); ?> (<a href="//www.idgettr.com" target="_blank">idGettr</a>):</label>
            <input type="text" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos','tfuse'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" />
        </p>
		<?php
	}
}
register_widget('TFuse_flickr');

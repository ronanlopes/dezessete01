<?php
class TFuse_Widget_Videos extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_videos' );
		parent::__construct('videos', __('TFuse Videos','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
                $uniq = rand(1,100);
                $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
                $posts = isset($instance['posts']) ? $instance['posts'] : array();
                $b = $instance['b'] = empty( $instance['b'] ) ? '' : $instance['b'];
                $class = ($b) ? 'widget-boxed' : '';
                $before_widget = '<div class="widget widget_text '.$class.'">';
                $after_widget = '</div>';
                $before_title = '<h3 class="widget-title">';
                $after_title = '</h3>';
                $tfuse_title = (!empty($title)) ? $before_title .tfuse_qtranslate($title) .$after_title : '';
                 echo $before_widget;
                // echo widgets title
                echo $tfuse_title;
		echo '
                    <div class="textwidget">
                    <div class="portfolio portfolio-videos">
                        <ul class="portfolio-list">';
                            foreach ($posts as $key => $post)
                            {
                                $video = tfuse_page_options('video_links','',$key);
    
                                $image = get_the_post_thumbnail($key, 'video-thumb');
                                if(!empty($image))
                                echo '<li>
                                        <a data-rel="prettyPhoto" href="'.$video.'">
                                        '.$image.'
                                        </a>
                                        <h4><a class="video_link" href="'.get_permalink($key).'">'.get_the_title($key).'</a></h4>
                                    </li>';
                            }
                echo ' </ul></div>
                    </div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance) {
            $instance = $old_instance;
            $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'', 'posts' => '') );
            $instance['title']      = $new_instance['title'];
            $instance['posts']      = $new_instance['posts'];
            $instance['b'] = isset($new_instance['b']);
                return $instance;
            }

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'posts' => '' ) );
                $title = $instance['title'];
                $posts = tfuse_list_posts();
?>
                <p><input id="<?php echo $this->get_field_id('b'); ?>" name="<?php echo $this->get_field_name('b'); ?>" type="checkbox" <?php checked(isset($instance['b']) ? $instance['b'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('b'); ?>"><?php _e('Boxed','tfuse'); ?></label></p>

<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
		 <label for="<?php echo $this->get_field_id('pages'); ?>"><?php _e('Select Posts','tfuse'); ?></label>
                <br />
            <?php  
			foreach ($posts as $key =>$post) { ?>
                <br/>
                        <?php
                        if ( esc_attr(@$instance['posts'][$key]) ) $checked = ' checked="checked" '; else $checked = '';
			?>
                            <input <?php echo $checked; ?> type="checkbox" name="<?php   echo $this->get_field_name('posts') ?>[<?php echo $key;?>]" value="1" id="<?php echo $this->get_field_id('posts'); ?>" />&nbsp;&nbsp;<?php echo $post; ?>
                        <?php
 			}
                    ?>
    <?php
	}
}


register_widget('TFuse_Widget_Videos');

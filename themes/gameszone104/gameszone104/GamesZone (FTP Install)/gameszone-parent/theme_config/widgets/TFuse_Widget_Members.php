<?php
class TFuse_Widget_Members extends WP_Widget {

	function TFuse_Widget_Members() {
		$widget_ops = array('classname' => 'widget_members' );
		$this->WP_Widget('members', __('TFuse Members','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
                $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
                $posts = isset($instance['posts']) ? $instance['posts'] : array();
                
                if(!empty($posts))
                {
                    
		echo '<div class="widget widget_text">
                            <h3 class="widget-title">'.$title.'</h3>
                            <div class="textwidget">';
                            foreach ($posts as $key => $post)
                            {
                                $image = get_the_post_thumbnail($key, 'members-widget-thumb');
                                $email = tfuse_page_options('member_email','',$key);
                                $job = tfuse_page_options('member_job','',$key);
                                $phone = tfuse_page_options('member_phone','',$key);
                                
                                echo '<div class="contact-person">
                                    '.$image.'
                                    <div class="contact-person-info">
                                        <strong>'.get_the_title($key).'</strong>';
                                        if(!empty($job)) echo '<em>'.$job.'</em>';
                                        if(!empty($phone)) echo '<span>'.$phone.'</span>';
                                        if(!empty($email)) echo '<a href="mailto:'.$email.'">'.$email.'</a>';
                                   echo '</div>
                                </div>';
                            }
                        echo '</div>
                        </div>';
                }
	}

	function update( $new_instance, $old_instance) {
            $instance = $old_instance;
            $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'', 'posts' => '') );
            $instance['title']      = $new_instance['title'];
            $instance['posts']      = $new_instance['posts'];
                return $instance;
            }

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'posts' => '' ) );
                $title = $instance['title'];
                $posts = tfuse_list_posts_members();
?>

<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
		 <label for="<?php echo $this->get_field_id('pages'); ?>"><?php _e('Select Members','tfuse'); ?></label>
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


register_widget('TFuse_Widget_Members');

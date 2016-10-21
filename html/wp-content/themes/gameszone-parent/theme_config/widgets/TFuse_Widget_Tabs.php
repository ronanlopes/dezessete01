<?php

// =============================== Search widget ======================================

class TFuse_Widget_Tabs extends WP_Widget {

	function __construct() {
            $widget_ops = array('classname' => 'widget_tabs', 'description' => __( "Game posts","tfuse") );
            parent::__construct('tabs', __('TFuse Tabs','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args); $rating = array();
            $numb = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search','tfuse' ) : $instance['title'], $instance, $this->id_base);
            ?>
            <?php
                $query = new WP_Query( array ( 'post_type' => 'game', 'orderby' => 'post_date',  'order '=>'DESC', 'posts_per_page'=>$numb ) );
                $posts  = $query->get_posts();
                
                //get top $numb games posts
                $query_top = new WP_Query( array ( 'post_type' => 'game', 'orderby' => 'post_date','posts_per_page'=> -1 ) );
                $all_posts  = $query_top->get_posts();
                
                if(!empty($all_posts))
                    foreach ($all_posts as $post) {
                        $r = tfuse_page_options('rating','', $post->ID);
                        
                        if(!empty($r))
                            $rating[$post->ID] = $r;
                    }
                    
                
            ?>
            <div class="widget widget_tabs">

                <ul class="side-tabs">
                    <li class="active"><a href="#tab_2_1" data-toggle="tab"><?php _e('Top ','tfuse'); echo $numb;?></a></li>
                    <li><a href="#tab_2_2" data-toggle="tab"><?php _e('Recent','tfuse');?></a></li>
                </ul>

                <div class="tab-content">
                    <div id="tab_2_1" class="tab-pane fade in active">
                        <ul class="side-postlist list-numbers">
                            <?php if(!empty($rating)):?>
                                <?php arsort($rating);?>
                                    <?php $c = 0; foreach ($rating as $id => $value):?>
                                        <?php if($c == $numb) break;?>
                                        <?php $terms_genres = wp_get_post_terms( $id, 'genres_game' );?>
                                        <li>
                                            <?php $post_image_src = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));?>
                                            <a href="#" class="post-thumbnail"><img src="<?php echo $post_image_src;?>" alt=""/></a>
                                            <a href="<?php echo get_permalink($id);?>" class="post-title"><?php echo get_the_title($id);?></a>
                                            <?php if(!empty($terms_genres)):?>
                                                <span class="cat-links">
                                                    <?php 
                                                        foreach ($terms_genres as $term) {
                                                            echo $term->name; break;
                                                        }
                                                    ?>
                                                </span>
                                            <?php endif;?>
                                            <?php $terms_platforms = wp_get_post_terms( $id, 'platforms_game' );?>

                                            <?php if(!empty($terms_platforms)):?>
                                                <span class="tag-links">
                                                    <?php $platforms_link = '';
                                                        $k = 0; //tf_print($terms_platforms);
                                                        foreach ($terms_platforms as $term) {  $k++;
                                                            if($k == 3) break;
                                                            
                                                            if(count($terms_platforms) == $k)
                                                                echo $term->name;
                                                            else
                                                                echo $term->name .', ';
                                                            
                                                            $platforms_link .= '&amp;platforms_game'.$term->term_id.'='.$term->term_id;
                                                        }
                                                    ?>
                                                    <?php 
                                                        if(count($terms_platforms) > 3):
                                                        $terms_platforms = array_slice($terms_platforms, 3);
                                                        
                                                        foreach ($terms_platforms as $term)
                                                            $platforms_link .= '&amp;platforms_game'.$term->term_id.'='.$term->term_id;
                                                    ?>
                                                        <a href="<?php echo '?s=~&amp;tax_games=%20'.$platforms_link; ?>"><?php echo count($terms_platforms) .' '. __('more','tfuse');?></a>
                                                    <?php endif;?>
                                                </span>
                                            <?php endif;?>
                                        </li>
                                    <?php $c++; endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div>

                    <div id="tab_2_2" class="tab-pane fade">
                        <ul class="side-postlist">
                            <?php if(!empty($posts)):?>
                                <?php foreach ($posts as $post):?>
                                    <?php $terms_genres = wp_get_post_terms( $post->ID, 'genres_game' );?>
                                    <li>
                                        <?php $post_image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));?>
                                        <a href="#" class="post-thumbnail"><img src="<?php echo $post_image_src;?>" alt=""/></a>
                                        <a href="<?php echo get_permalink($post->ID);?>" class="post-title"><?php echo get_the_title($post->ID);?></a>
                                        <?php if(!empty($terms_genres)):?>
                                            <span class="cat-links">
                                                <?php 
                                                    foreach ($terms_genres as $term) {
                                                        echo $term->name; break;
                                                    }
                                                ?>
                                            </span>
                                        <?php endif;?>
                                        <?php $terms_platforms = wp_get_post_terms( $post->ID, 'platforms_game' );?>
                                
                                        <?php if(!empty($terms_platforms)):?>
                                            <span class="tag-links">
                                                    <?php
                                                    $platforms_links = '';
                                                        $k = 0; //tf_print($terms_platforms);
                                                        foreach ($terms_platforms as $term) {  $k++;
                                                            if($k == 3) break;
                                                            
                                                            if(count($terms_platforms) == $k)
                                                                echo $term->name;
                                                            else
                                                                echo $term->name .', ';
                                                            
                                                            $platforms_links .= '&amp;platforms_game'.$term->term_id.'='.$term->term_id;
                                                        }
                                                    ?>
                                                    <?php 
                                                        if(count($terms_platforms) > 3):
                                                        $terms_platforms = array_slice($terms_platforms, 3);
                                                        
                                                        foreach ($terms_platforms as $term)
                                                            $platforms_links .= '&amp;platforms_game'.$term->term_id.'='.$term->term_id;
                                                    ?>
                                                        <a href="<?php echo '?s=~&amp;tax_games=%20'.$platforms_links; ?>"><?php echo count($terms_platforms) .' '. __('more','tfuse');?></a>
                                                    <?php endif;?>
                                            </span>
                                        <?php endif;?>
                                    </li>
                                <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- widget sidebar tabs -->
            <?php
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
            $instance['title'] = $new_instance['title'];
            return $instance;
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array(  'template' => 'box_white',) );
            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
            $title = $instance['title'];
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Number of posts:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}

register_widget('TFuse_Widget_Tabs');

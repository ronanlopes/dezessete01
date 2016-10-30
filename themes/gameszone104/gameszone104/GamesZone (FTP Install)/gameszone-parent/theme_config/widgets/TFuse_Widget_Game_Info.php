<?php

// =============================== Search widget ======================================

class TFuse_Widget_Game_Info extends WP_Widget {

	function TFuse_Widget_Game_Info() {
            $widget_ops = array('classname' => 'widget_game_info', 'description' => __( "Game Post Info Widget","tfuse") );
            $this->WP_Widget('game_info', __('TFuse Game Info','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args); global $post; $id = '';
            ?>
            <?php if($post->post_type == 'game' || $post->post_type == 'review'):?>
                <?php 
                    if($post->post_type == 'review')
                    { 
                        $game_id = tfuse_page_options('game_select');
                        
                        $game_id = explode(',',$game_id);
                        
                        if(!empty($game_id))
                        {
                            $id = $game_id[0];
                            $title = get_the_title($id);
                        }
                    }
                    else 
                        $id = $post->ID;
                    
                    if(!empty($id)):
                    
                        $image = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                        $published = tfuse_page_options('published','',$id);
                        $published_link = tfuse_page_options('published_link','',$id);
                        $developed = tfuse_page_options('developed','',$id);
                        $developed_link = tfuse_page_options('developed_link','',$id);
                        $description = tfuse_page_options('description','',$id);
                        
                        
                        $g_rating = tfuse_page_options('rating_type','',$id);
                        
                        $esrb = tfuse_page_options('esrb','',$id);
                        
                        $pegi = tfuse_page_options('pegi','',$id);
                        
                        if($g_rating == 'pegi')
                            switch ($pegi)
                            {
                                case '7': 
                                    $img_r = get_template_directory_uri().'/images/7.png';
                                    $content = __('Considered suitable for all age groups but contains some possibly frightening scenes or sounds.','tfuse');
                                    break;
                                case '12': 
                                    $img_r = get_template_directory_uri().'/images/12.png';
                                    $content = __('Videogames that show violence as well as nudity of a slightly more graphic nature.','tfuse');
                                    break;
                                case '16': 
                                    $img_r = get_template_directory_uri().'/images/16.png';
                                    $content = __('A video game where the depiction of violence (or sexual activity) reaches a stage that looks the same as would be expected in real life.','tfuse');
                                    break;
                                case '18': 
                                    $img_r = get_template_directory_uri().'/images/18.png';
                                    $content = __('Any game where the level of violence reaches a stage where it becomes a depiction of gross violence.','tfuse');
                                    break;
                                default: 
                                    $img_r = get_template_directory_uri().'/images/3.png';
                                    $content = __('The content of games given this rating is considered suitable for all age groups.','tfuse');
                                    break;
                            }
                        else    
                            switch ($esrb)
                            {
                                case 'e': 
                                    $img_r = get_template_directory_uri().'/images/ratingsymbol_e.png';
                                    $content = __('Content is generally suitable for all ages. May contain minimal cartoon, fantasy or mild violence and/or infrequent use of mild language.','tfuse');
                                    break;
                                case 'et': 
                                    $img_r = get_template_directory_uri().'/images/ratingsymbol_e10.png';
                                    $content = __('Content is generally suitable for ages 10 and up. May contain more cartoon, fantasy or mild violence, mild language and/or minimal suggestive themes.','tfuse');
                                    break;
                                case 't': 
                                    $img_r = get_template_directory_uri().'/images/ratingsymbol_t.png';
                                    $content = __('Content is generally suitable for ages 13 and up. May contain violence, suggestive themes, crude humor, minimal blood, simulated gambling and/or infrequent use of strong language.','tfuse');
                                    break;
                                case 'm': 
                                    $img_r = get_template_directory_uri().'/images/ratingsymbol_m.png';
                                    $content = __('Content is generally suitable for ages 17 and up. May contain intense violence, blood and gore, sexual content and/or strong language.','tfuse');
                                    break;
                                case 'a': 
                                    $img_r = get_template_directory_uri().'/images/ratingsymbol_ao.png';
                                    $content = __('Content suitable only for adults ages 18 and up. May include prolonged scenes of intense violence, graphic sexual content and/or gambling with real currency.','tfuse');
                                    break;
                                case 'rp': 
                                    $img_r = get_template_directory_uri().'/images/ratingsymbol_rp.png';
                                    $content = __('Not yet assigned a final ESRB rating. Appears only in advertising, marketing and promotional materials related to a game that is expected to carry an ESRB rating, and should be replaced by a game\'s rating once it has been assigned.','tfuse');
                                    break;
                                default: 
                                    $img_r = get_template_directory_uri().'/images/ratingsymbol_ec.png';
                                    $content = __('Content is intended for young children.','tfuse');
                                    break;
                            }
                ?>
                        <div class="widget widget_text widget-boxed">
                            <h3 class="widget-title"><?php echo (!empty($title)) ? $title : get_the_title();?></h3>
                            <div class="textwidget">
                                <div class="game-infobox">
                                    <?php if(!empty($image)):?>
                                        <img src="<?php echo $image;?>" alt="" class="game-thumb"/>
                                    <?php endif;?>

                                    <?php if(!empty($published)):?>
                                        <div class="game-creator"><?php _e('Published by','tfuse');?>: <span><a href="<?php echo $published_link;?>"><?php echo $published;?></a></span></div>
                                    <?php endif;?>

                                    <?php if(!empty($developed)):?>
                                        <div class="game-creator"><?php _e('Developed by','tfuse');?>: <span><a href="<?php echo $developed_link;?>"><?php echo $developed;?></a></span></div>
                                    <?php endif;?>

                                    <?php if(!empty($description)):?>
                                        <div class="game-descr">
                                            <p><?php echo $description;?></p>
                                        </div>
                                    <?php endif;?>

                                    <?php $terms_platforms = wp_get_post_terms($id, 'platforms_game' );?>

                                    <?php if(!empty($terms_platforms)):?>
                                        <h4><?php _e('Available on','tfuse');?></h4>
                                        <div class="game-inforow">
                                            <?php 
                                                $k = 0;
                                                foreach ($terms_platforms as $term) {  $k++;
                                                    if($k == count($terms_platforms))
                                                        echo '<a href="'.get_term_link( $term, 'platforms_game' ).'">'.$term->name.'</a>';
                                                    else
                                                        echo '<a href="'.get_term_link( $term, 'platforms_game' ).'">'.$term->name.'</a> <span class="separator">|</span> ';
                                                }
                                            ?>
                                        </div>
                                    <?php endif;?>

                                    <?php $terms_genres = wp_get_post_terms( $id, 'genres_game' );?>
                                    <?php if(!empty($terms_genres)):?>
                                        <h4><?php _e('Genre','tfuse');?></h4>
                                        <div class="game-inforow">
                                            <?php 
                                                $k = 0;
                                                foreach ($terms_genres as $term) {  $k++;
                                                    if($k == count($terms_genres))
                                                        echo '<a href="'.get_term_link( $term, 'platforms_game' ).'">'.$term->name.'</a>';
                                                    else
                                                        echo '<a href="'.get_term_link( $term, 'platforms_game' ).'">'.$term->name.'</a> <span class="separator">|</span> ';
                                                }
                                            ?>
                                        </div>
                                    <?php endif;?>

                                    <?php if(!empty($esrb)):?>
                                        <h4><?php echo ($g_rating == 'pegi') ? __('PEGI rating','tfuse') : __('ESRB rating','tfuse') ; ?></h4>
                                        <img src="<?php echo $img_r;?>" alt="" width="58" height="79" class="alignleft">
                                        <div class="game-inforow">
                                            <?php echo $content;?>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
            <?php endif;?>
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
?>
<?php
	}
}

register_widget('TFuse_Widget_Game_Info');

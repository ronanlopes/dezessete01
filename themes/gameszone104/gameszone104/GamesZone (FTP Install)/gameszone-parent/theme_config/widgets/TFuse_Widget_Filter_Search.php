<?php

// =============================== Search widget ======================================

class TFuse_Widget_Filter_Search extends WP_Widget {

	function TFuse_Widget_Filter_Search() {
            $widget_ops = array('classname' => 'widget_filter_search', 'description' => __( "A search filter works only for games and reviews categories ","tfuse") );
            $this->WP_Widget('filter_search', __('TFuse Filter Search','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args); global $TFUSE;
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search','tfuse' ) : $instance['title'], $instance, $this->id_base);
            ?>

            <?php if(is_tax('reviews') || is_tax('games') || is_tax('platforms') || is_tax('genres') || is_tax('platforms_game') || is_tax('genres_game')|| is_tax('producers_game') || is_tax('age_ratings') || $TFUSE->request->isset_GET('tax_reviews') || $TFUSE->request->isset_GET('tax_games')):?>
            <?php 
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); 
                $ids = tfuse_get_search_tems();
            ?>
            <!-- widget filters -->
            <div class="widget filter-form">
                <h3 class="widget-title"><?php echo $title;?></h3>
                <form method="get"  action="<?php echo home_url( '/' ) ?>" id="filter-form">
                    <div class="row_form range_field inputtext clearfix">
                        <input type="text"  name="s" id="s" class="inputtext"  placeholder="<?php _e('Search by keywords', 'tfuse') ?>"/>
                    </div>
                    
                    <?php if(is_tax('reviews') || is_tax('platforms') || is_tax('genres') || $TFUSE->request->isset_GET('tax_reviews')):?>
                        <?php 
                            $terms_platforms = get_terms( 'platforms' );
                            $terms_genres = get_terms( 'genres' );
                        ?>
                        <input type="hidden" value="<?php echo ($term) ? $term->term_id :  $TFUSE->request->GET('tax_reviews');?>"  name="tax_reviews" id="s" class="tax_reviews"  placeholder="<?php _e('Search', 'tfuse') ?>"/>
                        <div class="row_form range_field clearfix">
                            <label class="label_title"><?php _e('Review rating','tfuse');?> <span class="toggle-field-trigger"></span></label>
                            <div class="range-slider toggle-field">
                                <?php if(!empty($ids['price-range'])):?>
                                    <input id="rating-range" type="text" name="price-range" value="<?php echo implode(';',$ids['price-range']);?>">
                                <?php else:?>
                                    <input id="rating-range" type="text" name="price-range" value="0;10">
                                <?php endif;?>
                            </div>
                        </div>
                        <?php if(!empty($terms_platforms)):?>
                            <?php $term_platf = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
                            <div class="row_form input_styled checklist">
                                <label class="label_title"><?php _e('Platform','tfuse');?> <span class="toggle-field-trigger"></span></label>
                                <div class="toggle-field">
                                    <?php foreach ($terms_platforms as $term):?>
                                        <?php if(!empty($ids['platforms'])):?>
                                            <?php if (in_array( $term->term_id , $ids['platforms'])):?>
                                                <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                            <?php else:?>
                                                <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                            <?php endif;?>
                                        <?php elseif (!empty($term_platf) && $term_platf->term_id == $term->term_id):?>
                                            <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                        <?php else:?>
                                            <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                        <?php endif;?>
                                        <label for="checkbox_<?php echo $term->term_id;?>"><?php echo $term->name;?> <span>(<?php echo $term->count;?>)</span></label>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if(!empty($terms_genres)):?>
                            <?php $term_genr = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
                            <div class="row_form input_styled checklist">
                                <label class="label_title"><?php _e('Genre','tfuse');?> <span class="toggle-field-trigger"></span></label>
                                <div class="toggle-field">
                                    <?php foreach ($terms_genres as $term): ?>
                                        <?php if(!empty($ids['genres'])):?>
                                            <?php if (in_array( $term->term_id , $ids['genres'])):?>
                                                <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                            <?php else:?>
                                                <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                            <?php endif;?>
                                        <?php elseif (!empty($term_genr) && $term_genr->term_id == $term->term_id):?>
                                            <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                        <?php else:?>
                                            <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                        <?php endif;?>
                                        <label for="checkbox_<?php echo $term->term_id;?>"><?php echo $term->name;?> <span>(<?php echo $term->count;?>)</span></label>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php endif;?>
                        
                    <?php if(is_tax('games') || is_tax('platforms_game') || is_tax('genres_game')|| is_tax('producers_game') || is_tax('age_ratings') || $TFUSE->request->isset_GET('tax_games')):?>
                        <?php 
                            $terms_platforms = get_terms( 'platforms_game' );
                            $terms_producers = get_terms( 'producers_game' );
                            $terms_genres = get_terms( 'genres_game' );
                            $terms_age = get_terms( 'age_ratings' );
                        ?>
                        <input type="hidden" value="<?php echo ($term) ? $term->term_id :  $TFUSE->request->GET('tax_games');?>"  name="tax_games" id="s" class="tax_games"  placeholder="<?php _e('Search', 'tfuse') ?>"/>
                        
                        <?php if(!empty($terms_platforms)):?>
                            <?php $term_pl = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
                            <div class="row_form input_styled checklist">
                                <label class="label_title"><?php _e('Platform','tfuse');?> <span class="toggle-field-trigger"></span></label>
                                <div class="toggle-field">
                                    <?php foreach ($terms_platforms as $term):?>    
                                        <?php if(!empty($ids['platforms'])):?>
                                            <?php if (in_array( $term->term_id , $ids['platforms'])):?>
                                                <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                            <?php else:?>
                                                <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                            <?php endif;?>
                                        <?php elseif (!empty($term_pl) && $term_pl->term_id == $term->term_id):?>
                                                <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                        <?php else:?>
                                            <input type="checkbox" name="platforms_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                        <?php endif;?>
                                        <label for="checkbox_<?php echo $term->term_id;?>"><?php echo $term->name;?> <span>(<?php echo $term->count;?>)</span></label>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endif;?>
                        
                        <?php if(!empty($terms_producers)):?>
                            <?php $term_pr = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
                            <div class="row_form input_styled checklist">
                                <label class="label_title"><?php _e('Producers','tfuse');?> <span class="toggle-field-trigger"></span></label>
                                <div class="toggle-field">
                                    <?php foreach ($terms_producers as $term):?>
                                        <?php if(!empty($ids['producers'])):?>
                                            <?php if (in_array( $term->term_id , $ids['producers'])):?>
                                                <input type="checkbox" name="producers_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                            <?php else:?>
                                                <input type="checkbox" name="producers_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                            <?php endif;?>
                                        <?php elseif (!empty($term_pr) && $term_pr->term_id == $term->term_id):?>
                                                <input type="checkbox" name="producers_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                        <?php else:?>
                                            <input type="checkbox" name="producers_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                        <?php endif;?>
                                        <label for="checkbox_<?php echo $term->term_id;?>"><?php echo $term->name;?> <span>(<?php echo $term->count;?>)</span></label>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endif;?>
                        
                        <?php if(!empty($terms_genres)):?>
                            <?php $term_act = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
                            <div class="row_form input_styled checklist">
                                <label class="label_title"><?php _e('Genre','tfuse');?> <span class="toggle-field-trigger"></span></label>
                                <div class="toggle-field">
                                    <?php foreach ($terms_genres as $term): ?>
                                        <?php if(!empty($ids['genres'])):?>
                                            <?php if (in_array( $term->term_id , $ids['genres'])):?>
                                                <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                            <?php else:?>
                                                <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                            <?php endif;?>
                                        <?php elseif (!empty($term_act) && $term_act->term_id == $term->term_id):?>
                                                <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                        <?php else:?>
                                            <input type="checkbox" name="genres_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                        <?php endif;?>
                                        <label for="checkbox_<?php echo $term->term_id;?>"><?php echo $term->name;?> <span>(<?php echo $term->count;?>)</span></label>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endif;?>
                        
                        <?php if(!empty($terms_age)):?>
                            <?php $term_age = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
                            <div class="row_form input_styled checklist">
                                <label class="label_title"><?php _e('Age rating','tfuse');?> <span class="toggle-field-trigger"></span></label>
                                <div class="toggle-field">
                                    <?php foreach ($terms_age as $term): ?>
                                        <?php if(!empty($ids['age'])):?>
                                            <?php if (in_array( $term->term_id , $ids['age'])):?>
                                                <input type="checkbox" name="age_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                            <?php else:?>
                                                <input type="checkbox" name="age_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                            <?php endif;?>
                                        <?php elseif (!empty($term_age) && $term_age->term_id == $term->term_id):?>
                                            <input type="checkbox" name="age_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" checked> 
                                        <?php else:?>
                                            <input type="checkbox" name="age_<?php echo $term->term_id;?>" id="checkbox_<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>"> 
                                        <?php endif;?>
                                        <label for="checkbox_<?php echo $term->term_id;?>"><?php echo $term->name;?> <span>(<?php echo $term->count;?>)</span></label>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php endif;?>

                    <div class="row_form row_submit">
                        <button type="submit" class="btn btn-primary" id="apply_filters"><?php _e('Apply Filters','tfuse');?></button>
                    </div>
                </form>

                <script type="text/javascript" >
                    jQuery(document).ready(function($) {
                        jQuery('#apply_filters').on('click',function(){
                            var value = jQuery(this).parents('#filter-form').find('.row_form .inputtext').val();
                            
                            if(value.length == '0')
                            {
                                jQuery(this).parents('#filter-form').find('.inputtext').attr('value','~');
                            }
                        });
                        
                        // Rating Range Input
                        jQuery("#rating-range").rangeslider({
                            from: 0,
                            to: 10,
                            limits: 0,
                            scale: ['0', '10'],
                            heterogeneity: ['50/5'],
                            step: 1,
                            smooth: true,
                            dimension: ''
                        });
                    });
                </script>
            </div>
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
            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
            $title = $instance['title'];
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}

register_widget('TFuse_Widget_Filter_Search');

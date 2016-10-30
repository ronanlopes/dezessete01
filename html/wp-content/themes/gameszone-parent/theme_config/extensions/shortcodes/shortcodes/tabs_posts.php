<?php
//Recent / Most Commented Widget

function tfuse_tabs_posts($atts) {   
    extract(shortcode_atts(array('num' => ''), $atts));
    
    $recent_posts  = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'recent',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 62,
                                'image_height' => 62,
                                'image_class' => 'thumb'
                                ));
    
    $popular_posts = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'popular',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 62,
                                'image_height' => 62,
                                'image_class' => 'thumb'
                            ));
    $return_html = '';
    $return_html .='<div class="widget widget_tabs">
        <ul class="side-tabs">
            <li class="active"><a href="#tab_2_1" data-toggle="tab">'.__('Top 5','tfuse').'</a></li>
            <li><a href="#tab_2_2" data-toggle="tab">'.__('Recent','tfuse').'</a></li>
        </ul><div class="tab-content">';

    $return_html .= '<div id="tab_2_1" class="tab-pane fade in active">
                    <ul class="side-postlist list-numbers">';
                       $k=0; foreach ($popular_posts as $post_val) { 
                                if($k == $num) break;
                       
                            $cat = get_the_category($post_val['post_id']);
                            $tags = wp_get_post_tags( $post_val['post_id'] );
                            
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" class="post-title">&nbsp;' . $post_val['post_title'] . '</a>
                                        ';
                            $return_html .=' <span class="cat-links">'.$cat[0]->cat_name.'</span>';
                            if(!empty($tags))
                            {
                                $return_html .=' <span class="tag-links">'; $count = 0;
                                foreach ($tags as $tag) { $count++;
                                    if($count == count($tags))
                                        $return_html .= $tag->name;
                                    else
                                        $return_html .= $tag->name .', ';
                                }
                                
                                $return_html .='</span>';
                            }
                            
                            $k++;
                        }
    $return_html .='</ul>
        </div>

        <div id="tab_2_2" class="tab-pane fade">
                    <ul class="side-postlist">';
                       $c=0; foreach ($recent_posts as $post_val) {
                           if($c == $num) break;
                           
                            $cat = get_the_category($post_val['post_id']);
                            $tags = wp_get_post_tags( $post_val['post_id'] );
                            
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" class="post-title">&nbsp;' . $post_val['post_title'] . '</a>
                                        ';
                            $return_html .=' <span class="cat-links">'.$cat[0]->cat_name.'</span>';
                            if(!empty($tags))
                            {
                                $return_html .=' <span class="tag-links">'; $count = 0;
                                foreach ($tags as $tag) { $count++;
                                    if($count == count($tags))
                                        $return_html .= $tag->name;
                                    else
                                        $return_html .= $tag->name .', ';
                                }
                                
                                $return_html .='</span>';
                            }
                                
                            $return_html .= '</li>';
                            
                            $c++;
                        }
     $return_html .= '</ul>
         </div>
        </div>
    </div>';
    return $return_html;
}

$atts = array(
    'name' => __('Tab Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        array(
            'name' => __('Number of posts','tfuse'),
            'desc' => __('Number of posts to display','tfuse'),
            'id' => 'tf_shc_tabs_posts_num',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('tabs_posts','tfuse_tabs_posts', $atts);
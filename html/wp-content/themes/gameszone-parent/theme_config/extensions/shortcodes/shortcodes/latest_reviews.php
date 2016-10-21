<?php

function tfuse_latest_reviews($atts, $content = null)
{

    extract(shortcode_atts(array('title' => '','items' => ''), $atts));
    
    $query = new WP_Query( array ( 'post_type' => 'review', 'orderby' => 'post_date',  'order '=>'DESC', 'posts_per_page'=>$items ) );
    $posts  = $query->get_posts();
    
    $return_html = $img = '';
    
    if(!empty($posts))
    {        
        $return_html .= '<div class="widget widget_recent_entries">
                            <h3 class="widget-title">Latest Reviews</h3>
                            <ul class="side-postlist">';
                foreach ($posts as $post):
                    $post_image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                                
                    if ( !empty($post_image_src) )
                    {
                        $get_image = new TF_GET_IMAGE();
                        $img = $get_image->properties(array('class' => '', 'alt' => get_the_title($post->ID)))->width(62)->height(62)->src($post_image_src)->resize(true)->get_img();
                    }
                
                    $return_html .= '<li>';
                                        if(!empty($img))
                                        {
                                            $return_html .='<a href="'.get_permalink($post->ID).'" class="post-thumbnail">
                                                '.$img.'
                                            </a>';
                                        }
                                        $return_html .='<a href="'.get_permalink($post->ID).'" class="post-title">'.get_the_title($post->ID).'</a>
                                        <span class="comments-link"><a href="'.get_permalink($post->ID).'#comments">'.tfuse_get_comments( true, $post->ID).'</a></span>
                                    </li>';

                endforeach;

        $return_html .='</ul>
                        </div>';
    }

    return $return_html;
}

$atts = array(
    'name' => __('Latest Reviews','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_latest_reviews_items',
            'value' => '5',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for an shortcode','tfuse'),
            'id' => 'tf_shc_latest_reviews_title',
            'value' => __('Latest Reviews','tfuse'),
            'type' => 'text'
        )
    )
);

tf_add_shortcode('latest_reviews', 'tfuse_latest_reviews', $atts);

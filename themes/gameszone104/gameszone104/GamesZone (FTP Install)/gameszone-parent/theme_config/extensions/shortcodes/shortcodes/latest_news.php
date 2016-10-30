<?php

function tfuse_latest_news($atts, $content = null)
{    
    extract(shortcode_atts(array('posts' => '','title' => '','b_title' => '','b_link' => ''), $atts));
    
    $posts = explode(',',$posts);
    
    $return_html = $img = '';
    
    if(!empty($posts))
    {        
        $return_html .= '<section class="postlist postlist-cols-1 shortcode_news">
                            <h1>'.$title.'</h1>';
                foreach ($posts as $post):
                    $image = wp_get_attachment_url( get_post_thumbnail_id($post, 'post-thumbnails'));
                    $img_pos = tfuse_page_options('single_img_position','',$post);

                    $post_date = get_the_date($post);
                    $time = strtotime($post_date);
                
                    $position = tfuse_page_options('img_pos','',$post);
                    
                    $current_post = get_post( $post );
                    $user_data = get_user_by('id',$current_post->post_author);
                                                
                    $return_html .= '<article class="post">
                                <div class="inner">';
                                    if(!empty($image))
                                    {
                                        $return_html .= '<a class="post-thumbnail" href="'.get_permalink($post).'"><img src="'.$image.'" alt="'.get_the_title($post).'" /></a>';
                                    }
                                    $return_html .='<div class="entry-aside">
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="'.get_permalink($post).'">'.get_the_title($post).'</a></h2>
                                            <div class="entry-meta">
                                                '.__('By ','tfuse').'<span class="author"><a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->user_nicename.'</a></span>
                                                '.__(' on ','tfuse').'<time class="entry-date" datetime="'.date('Y-m-d',$time).'T'.date('g:i:s',$time).'">'.get_the_time( get_option('date_format'), $post ).'</time>
                                            </div>
                                        </header>
                                        <div class="entry-content">';
                                        if ( tfuse_options('post_content') == 'content' ) 
                                        {
                                            $return_html .= '<p>'.$current_post->post_content.'</p>'; 
                                        }
                                        else
                                        {
                                            $return_html .= (!empty($current_post->post_excerpt)) ? '<p>'.$current_post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150)).'</p>';
                                        }
                                       $return_html .='</div>
                                        <footer class="entry-meta">
                                            <a class="btn btn-default btn-xs" href="'.get_permalink($post).'">'.__('Read more','tfuse').'</a>

                                            <span class="comments-link"><a href="'.get_permalink($post).'#comments"><i class="tficon-comment"></i> '.get_comments_number($post).'</a></span>
                                        </footer>
                                    </div>
                                </div>
                            </article>';

                endforeach;
                
                $return_html .= '<div class="load_button">
                                    <a href="'.$b_link.'" class="btn btn-main">'.$b_title.'</a>
                            </div>';

        $return_html .='</section>';
    }

    return $return_html;
}

$atts = array(
    'name' => __('Latest News','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Posts','tfuse'),
            'desc' => __('Select posts','tfuse'),
            'id' => 'tf_shc_latest_news_posts',
            'value' => __('','tfuse'),
            'type' => 'multi',
            'subtype' => 'post'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title','tfuse'),
            'id' => 'tf_shc_latest_news_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Button Title','tfuse'),
            'desc' => __('Specifies button title','tfuse'),
            'id' => 'tf_shc_latest_news_b_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Button Link','tfuse'),
            'desc' => __('Specifies button link','tfuse'),
            'id' => 'tf_shc_latest_news_b_link',
            'value' => '',
            'type' => 'text'
        ),
        
    )
);

tf_add_shortcode('latest_news', 'tfuse_latest_news', $atts);
<?php
function tfuse_shortcode_news($atts, $content = null)
{
    extract(shortcode_atts(array('posts' => ''), $atts));
    
    $out = '';
    
    $posts = explode(',',$posts);
        
    if(!empty($posts))
    {
        $posts = array_reverse($posts);
        $out .= '<section class="postlist postlist-cols-4">';
                        foreach ($posts as $post) {
                            $post_image_src = wp_get_attachment_url( get_post_thumbnail_id($post, 'post-thumbnails'));
                                
                            if ( !empty($post_image_src) )
                            {
                                $img = $post_image_src;
                            }
							
							$current_post = get_post( $post );
							
							$content = (!empty($current_post->post_excerpt)) ? strip_tags(tfuse_shorten_string($current_post->post_excerpt,20)) : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),20));
                            
                            $out .= '<article class="post">
                                        <div class="inner">';
                                            if(!empty($img))
                                            {
                                                $out .='<a class="post-thumbnail" href="'.get_permalink($post).'"><img src="'.$img.'" alt="'.get_the_title($post).'" /></a>';
                                            }
                                        $out .= '<div class="entry-aside">
                                                <header class="entry-header">
                                                    <h2 class="entry-title"><a href="'.get_permalink($post).'">'.get_the_title($post).'</a></h2>
                                                </header>
                                                <div class="entry-content">
                                                    <p>'.$content.'</p>
                                                </div>
                                                <footer class="entry-meta">
                                                    <a class="btn btn-default btn-xs" href="'.get_permalink($post).'">'.__('Read more','tfuse').'</a>

                                                    <span class="comments-link"><a href="'.get_permalink($post).'#comments"><i class="tficon-comment"></i> '.get_comments_number($post).'</a></span>
                                                </footer>
                                            </div>
                                        </div>
                                    </article>';
                        }
            $out .='</section>';
    }
    
    return $out;
}

$atts = array(
    'name' => __('News','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Blog Posts', 'tfuse'),
            'desc' => __('Type post title', 'tfuse'),
            'id' => 'tf_shc_news_posts',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'post',
        )
    )
);

tf_add_shortcode('news', 'tfuse_shortcode_news', $atts);
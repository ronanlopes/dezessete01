<?php

function tfuse_members($atts, $content = null) {
    extract(shortcode_atts(array( 'item' => '','title' => ''), $atts));
    $output = $link = $count = '';  
    $posts = get_posts('post_type=members&posts_per_page=-1');

   if(!empty($posts))
   {
    $output .='<section class="team-widget">
                <header>
                    <h1 class="team-widget-title">'.$title.'</h1>
                </header>
                     <div class="team-content">';
                            foreach($posts as $post){
                                if($count == $item) break; $count++;
                                $img = tfuse_page_options('member_photo','',$post->ID);
                                $id = tfuse_page_options('member_id','',$post->ID);
                                $url = tfuse_page_options('member_link','',$post->ID); 
                                $image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                                
                                if(!empty($url)) $link = $url; else $link = '';
                                $output .='<div class="member">
                                            <div class="member-image"><img src="'.$image_src.'" width="193" height="217" alt=""/></div>
                                                <div class="member-descr">
                                                    <h4 class="member-name">'.get_the_title($post->ID).'</h4>
                                                    <p><a href="'.$link.'">'.$id.'</a></p>
                                                </div>
                                        </div>';
                            }
                 $output .='</ul>
                    </div>';

    $output .='</section>';
   }
    return $output;
}

$atts = array(
    'name' => __('Members','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 20,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_members_item',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_members_title',
            'value' => '',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('members', 'tfuse_members', $atts);

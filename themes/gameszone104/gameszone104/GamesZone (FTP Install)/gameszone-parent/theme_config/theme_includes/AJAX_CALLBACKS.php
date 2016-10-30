<?php 

if ( !function_exists('tfuse_show_guide_download')):

    function tfuse_show_guide_download() {
        global $post;  $has_download = '';
        
        $download = array( 'id' => '' ,'type' => '' );
        
        $terms = wp_get_post_terms( $post->ID ,'guides' );
        
        if(!empty($terms))
        {
            foreach($terms as $term)
            {
                $has_download = tfuse_options('guides_posts','',$term->term_id);
                break;
            }
        }
        
        if($has_download == 'download')
        {
                $download = array(
                                'name' => __('Upload Guide','tfuse'),
                                'desc' => __('Upload Guide.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_upload_guide',
                                'value' => '',
                                'type' => 'upload',
                                'media' => 'file'
                            );
        }
        
        return $download;
            
    }
endif;

//load pagination
if (!function_exists('tfuse_ajax_load_pagination')) :
    function tfuse_ajax_load_pagination(){  
        $post_id = (intval($_POST['post_id'])); 
        //id of clicked term
        $term_id = (int)$_POST['term_id'];
        //taxonomy or gallery or videos
        $tax = ($_POST['tax']);
        $counter = (int)$_POST['counter'];
        
        $show_load_pagination = true;
        $out = $out1 = $out2 = $out3 = $out4 = '';
               
        if($tax == 'game_news')
        {       
            $posts = tfuse_get_game_posts($post_id,'news');
            
            if(!empty($posts))
            {                
                if(($counter + get_option('posts_per_page')) >= count($posts)) $show_load_pagination = false;
                
                $k = 0; 
                $posts = array_slice($posts, $counter);
                
                foreach ($posts as $id)
                {
                    if($k ==  get_option('posts_per_page')) break;

                    $image = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                    $img_pos = tfuse_page_options('single_img_position','',$id);

                    $current_post = get_post( $id );
                    $user_data = get_user_by('id',$current_post->post_author);

                    $out .= '<article class="post">
                        <div class="inner">
                            <div class="entry-aside">
                                <header class="entry-header">
                                    <h1 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h1>
                                    <div class="entry-meta">
                                        '.__('By ','tfuse').'<span class="author">
                                            <a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->display_name.'</a></span>
                                        '.__(' on ','tfuse').' <time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $id ).'</time>
                                    </div>
                                </header>';
                                if(!empty($image))
                                {
                                    $out .= '<a class="post-thumbnail '.$img_pos.' clearfix" href="'.get_permalink($id).'"><img src="'.$image.'" alt="'.get_the_title($id).'"/></a>';
                                }
                                $out .= '<div class="entry-content">';
                                    if ( tfuse_options('post_content') == 'content' ) 
                                    {
                                        $out .= $current_post->post_content; 
                                    }
                                    else
                                    {
                                        $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                    }
                                $out .= '</div>
                                <footer class="entry-meta">
                                    <a class="btn btn-default btn-xs" href="'.get_permalink($id).'">'.__('Read more','tfuse').'</a>

                                    <span class="comments-link"><a href="'.get_permalink($id).'#comments"><i class="tficon-comment"></i> '.get_comments_number($id).'</a></span>
                                </footer>
                            </div>
                        </div>
                    </article>';

                    $k++;
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no news for this game.', 'tfuse').'</h5>';
            }
        }
        //get reviews posts for current game post
        elseif($tax == 'game_reviews')
        {
            $posts = tfuse_get_game_posts($post_id,'reviews');
  
            if(!empty($posts))
            {
                if(($counter + get_option('posts_per_page')) >= count($posts)) $show_load_pagination = false;
                
                $k = 0;
                $posts = array_slice($posts, $counter);                

                foreach ($posts as $id)
                {
                    if($k ==  get_option('posts_per_page')) break;

                    $rating = tfuse_page_options('rating','',$id);
                    $featured = tfuse_page_options('featured','',$id);

                    $current_post = get_post( $id );
                    $user_data = get_user_by('id',$current_post->post_author);

                    $out .= '<article class="post">
                                <div class="inner">
                                    <a class="post-thumbnail" href="'.get_permalink($id).'"><img src="'.wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails')).'" /></a>
                                    <div class="entry-aside">
                                        <header class="entry-header">';
                                            if(!empty($rating))
                                                $out .= '<span class="rating">'.$rating.'</span>';
                                    $out .= '<h1 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h1>
                                            <div class="entry-meta">
                                                '.__('By ','tfuse').'<span class="author"><a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->display_name.'</a></span>
                                                '.__(' on ','tfuse').' <time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $id ).'</time>
                                                '.__(' on ','tfuse').' <span class="cat-links"><a href="#">PS3</a></span>
                                            </div>
                                        </header>
                                        <div class="entry-content">';
                                            if ( tfuse_options('post_content') == 'content' ) 
                                            {
                                                $out .= $current_post->post_content; 
                                            }
                                            else
                                            {
                                                $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                            }
                               $out .= '</div>
                                        <footer class="entry-meta">
                                            <a class="btn btn-default btn-xs" href="'.get_permalink($id).'">'.__('Read more','tfuse').'</a>
                                            <span class="comments-link"><a href="'.get_permalink($id).'#comments"><i class="tficon-comment"></i> '.get_comments_number($id).'</a></span>';
                                            if($featured)
                                                $out .= '<span class="featured-icon"><i class="tficon-star-f"></i> '.__('Featured Review','tfuse').'</span>';
                                $out .= '</footer>
                                    </div>
                                </div>
                            </article>';
                    $k++;
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no reviews for this game.', 'tfuse').'</h5>';
            }
            
        }
        //get galleries posts for current game post
        elseif($tax == 'game_images')
        {
            if($term_id == 0 || $term_id == 'all')
                $posts = tfuse_get_game_posts($post_id,'images');
            else
                $posts = tf_get_game_images_posts($term_id,$post_id,'galleries');

            if(!empty($posts))
            {
                if(($counter + get_option('posts_per_page')) >= count($posts)) $show_load_pagination = false;
                
                $k = 0; 
                $posts = array_slice($posts, $counter);
                
                $pretty = tfuse_options('portf_type');

                foreach ($posts as $id)
                {
                    if($k ==  get_option('posts_per_page')) break;

                    $image =wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                        
                                        if($pretty == 'pretty'){
                                            $rel = 'data-rel="prettyPhoto[gallery]"';
                                            $url = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                        }
                                        else
                                        {
                                            $rel = '';
                                            $url = get_permalink($id);
                                        }

                                        $out .= '<li>
                                                    <a href="'.$url.'" '.$rel.' title="'.get_the_title($id).'">';
                                                        if(!empty($image))
                                                            $out .= '<img src="'.$image.'" />';
                                                        else
                                                        {
                                                            $out .= '<img src="'.get_template_directory_uri().'/images/gallery_small.jpg" width="166" height="166" alt=""/>';
                                                        }
                                                    $out .= '</a>
                                                </li>';
                    $k++;
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no images for this game.', 'tfuse').'</h5>';
            }
        }
        //get videos posts for current game post
        elseif($tax == 'game_videos')
        {
            if($term_id == 0 || $term_id == 'all')
                $posts = tfuse_get_game_posts($post_id,'videos');
            else
                $posts = tf_get_game_images_posts($term_id,$post_id,'videos');

            if(!empty($posts))
            {
                if(($counter + get_option('posts_per_page')) >= count($posts)) $show_load_pagination = false;
                
                $k = 0;
                $posts = array_slice($posts, $counter);         
                foreach ($posts as $id)
                {
                    if($k ==  get_option('posts_per_page')) break;

                    $video = tfuse_page_options('video_links','',$id);

                    $image = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                                
                                                $video_link = !empty($video) ? $video : wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));

                                                $out .= '<li>
                                                            <a data-rel="prettyPhoto"  title="'.get_the_title($id).'" href="'.$video_link.'">';
                                                                if(!empty($image))
                                                                    $out .= '<img src="'.$image.'" />';
                                                                else
                                                                    $out .='<img src="'.get_template_directory_uri().'/images/gallery_medium.jpg" width="333" height="222" alt=""/>';
                                                            $out .= '</a>
                                                            <h4><a class="video_link" href="'.get_permalink($id).'">'.get_the_title($id).'</a></h4>
                                                        </li>';
                    $k++;
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no images for this game.', 'tfuse').'</h5>';
            }
        }
        //get galleries posts for current game post
        elseif($tax == 'game_guides')
        {
            if($term_id == 0 || $term_id == 'all')
                $posts = tfuse_get_game_posts($post_id,'guides');
            else
                $posts = tf_get_game_images_posts($term_id,$post_id,'guides');

            if(!empty($posts))
            {
                if(($counter + get_option('posts_per_page')) >= count($posts)) $show_load_pagination = false;
                
                $download = tfuse_options('guides_posts','',$term_id);
                
                $k = 0; 
                $posts = array_slice($posts, $counter);
                
                if($download == 'download')
                {
                    foreach ($posts as $id)
                    {
                        if($k ==  get_option('posts_per_page')) break;
                        $current_post = get_post( $id );

                        //get download link
                        $file = tfuse_page_options('upload_guide','',$id);
                        //get user data
                        $user_data = get_user_by('id',$current_post->post_author);

                        $out .= '<div class="post">
                                    <h2 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h2>';
                                    if(!empty($file))
                                    {
                                        $out .='<div class="entry-side-btn">
                                            <a class="btn btn-default btn-xs" href="'.$file.'" target="_blank">'.__('Download','tfuse').'</a>
                                        </div>';
                                    }
                                    $out .='<div class="entry-meta">
                                        '. __('By ','tfuse').'<span class="author"><a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->display_name.'</a></span> 
                                        '.__(' on ','tfuse').'<time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $id ).'</time>
                                    </div>

                                </div>';
                        $k++;
                    }
                }
                else
                {
                    foreach ($posts as $id)
                    {
                        if($k ==  get_option('posts_per_page')) break;
                        $current_post = get_post( $id );

                        $out .= '<div class="post">
                                    <h2 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h2>
                                    <div class="entry-content ">';
                                        if ( tfuse_options('post_content') == 'content' ) 
                                        {
                                            $out .= $current_post->post_content; 
                                        }
                                        else
                                        {
                                            $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                        }
                                    $out .='</div>
                                </div>';
                        $k++;
                    }
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no images for this game.', 'tfuse').'</h5>';
            }
        }
        $rsp = array('html'=> $out , 'show_pagination' => $show_load_pagination,'d' => $term_id); 
         
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_load_pagination','tfuse_ajax_load_pagination');
    add_action('wp_ajax_nopriv_tfuse_ajax_load_pagination','tfuse_ajax_load_pagination');
endif;

//get filter posts from game post
if (!function_exists('tfuse_ajax_get_filter_game_posts')) :
    function tfuse_ajax_get_filter_game_posts(){  
        $post_id = (intval($_POST['post_id'])); 
        //id of clicked term
        $term_id = $_POST['term_id'];
        //taxonomy or gallery or videos
        $tax = ($_POST['tax']);
        
        $show_load_pagination = false;
        $out = $out1 = $out2 = $out3 = $out4 = '';
               
        //get galleries posts for clicked filter term in current game post
        if($tax == 'gallery_filter')
        {       
            //get posts for clicked term from game filter
            $posts = tf_get_game_images_posts($term_id,$post_id,'galleries');
            
            //get posts view
            if(!empty($posts))
            {
                
                $k = 0; $pretty = tfuse_options('portf_type');
                foreach ($posts as $id)
                {
                    if($k ==  get_option('posts_per_page')){  $show_load_pagination = true; break;}

                    $image =wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                        
                                        if($pretty == 'pretty'){
                                            $rel = 'data-rel="prettyPhoto[gallery]"';
                                            $url = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                        }
                                        else
                                        {
                                            $rel = '';
                                            $url = get_permalink($id);
                                        }

                                        $out .= '<li>
                                                    <a href="'.$url.'" '.$rel.' title="'.get_the_title($id).'">';
                                                        if(!empty($image))
                                                            $out .= '<img src="'.$image.'" />';
                                                        else
                                                        {
                                                            $out .= '<img src="'.get_template_directory_uri().'/images/gallery_small.jpg" width="166" height="166" alt=""/>';
                                                        }
                                                    $out .= '</a>
                                                </li>';
                    $k++;
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no images in this category.', 'tfuse').'</h5>';
            }
            
        }
        //get videos posts for clicked filter term in current game post
        elseif($tax == 'video_filter')
        {
            //get posts for clicked term from game filter
            $posts = tf_get_game_images_posts($term_id,$post_id,'videos');
            
            if(!empty($posts))
            {                
                $k = 0; 
                foreach ($posts as $id)
                {
                    if($k ==  get_option('posts_per_page')){ $show_load_pagination = true; break;}

                    $video = tfuse_page_options('video_links','',$id);

                    $image = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                                
                                                $video_link = !empty($video) ? $video : wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));

                                                $out .= '<li>
                                                            <a data-rel="prettyPhoto"  title="'.get_the_title($id).'" href="'.$video_link.'">';
                                                                if(!empty($image))
                                                                    $out .= '<img src="'.$image.'" />';
                                                                else
                                                                    $out .='<img src="'.get_template_directory_uri().'/images/gallery_medium.jpg" width="333" height="222" alt=""/>';
                                                            $out .= '</a>
                                                            <h4><a class="video_link" href="'.get_permalink($id).'">'.get_the_title($id).'</a></h4>
                                                        </li>';
                    $k++;
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no images in this category.', 'tfuse').'</h5>';
            }
        }
        elseif($tax == 'guides_filter')
        {
            //get posts for clicked term from game filter
            $posts = tf_get_game_images_posts($term_id,$post_id,'guides');
            
            if(!empty($posts))
            {                                    
                $download = tfuse_options('guides_posts','',$term_id);
                
                $k = 0; 
                if($download == 'download')
                {
                    foreach ($posts as $id)
                    {
                        if($k ==  get_option('posts_per_page')){ $show_load_pagination = true; break;}
                        $current_post = get_post( $id );

                        //get download link
                        $file = tfuse_page_options('upload_guide','',$id);
                        //get user data
                        $user_data = get_user_by('id',$current_post->post_author);

                        $out .= '<div class="post">
                                    <h2 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h2>';
                                    if(!empty($file))
                                    {
                                        $out .='<div class="entry-side-btn">
                                            <a class="btn btn-default btn-xs" href="'.$file.'" target="_blank">'.__('Download','tfuse').'</a>
                                        </div>';
                                    }
                                    $out .='<div class="entry-meta">
                                        '. __('By ','tfuse').'<span class="author"><a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->display_name.'</a></span> 
                                        '.__(' on ','tfuse').'<time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $id ).'</time>
                                    </div>

                                </div>';
                        $k++;
                    }
                }
                else
                {
                    foreach ($posts as $id)
                    {
                        if($k ==  get_option('posts_per_page')){ $show_load_pagination = true; break;}
                        $current_post = get_post( $id );

                        $out .= '<div class="post">
                                    <h2 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h2>
                                    <div class="entry-content ">';
                                        if ( tfuse_options('post_content') == 'content' ) 
                                        {
                                            $out .= $current_post->post_content; 
                                        }
                                        else
                                        {
                                            $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                        }
                                    $out .='</div>
                                </div>';
                        $k++;
                    }
                }
            }
            else
            {
                $out .= '<h5>'.__('Sorry, no images in this category.', 'tfuse').'</h5>';
            }
        }
        $rsp = array('html'=> $out,'show_pagination' => $show_load_pagination); 
         
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_filter_game_posts','tfuse_ajax_get_filter_game_posts');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_filter_game_posts','tfuse_ajax_get_filter_game_posts');
endif;

//get posts on game tab click
if (!function_exists('tfuse_ajax_get_game_posts')) :
    function tfuse_ajax_get_game_posts(){  
        $post_id = (intval($_POST['post_id'])); 
        $posts_from = ($_POST['posts_from']);
        
        $out = $out1 = $out2 = $out3 = $out4 = '';
       
        //get news posts for current game post
        if($posts_from == 'game_news')
        {
            $posts = tfuse_get_game_posts($post_id,'news');
            
            $out1 .= '<section class="postlist postlist-blog ajax_section_load">
                <h1>'. __('News','tfuse').'</h1>';
                if(!empty($posts))
                {
                    $k = 0;
                    foreach ($posts as $id)
                    {
                        if($k ==  get_option('posts_per_page')) break;
                        
                        $image = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                        $img_pos = tfuse_page_options('single_img_position','',$id);

                        $current_post = get_post( $id );
                        $user_data = get_user_by('id',$current_post->post_author);
                        
                        $out .= '<article class="post">
                            <div class="inner">
                                <div class="entry-aside">
                                    <header class="entry-header">
                                        <h1 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h1>
                                        <div class="entry-meta">
                                            '.__('By ','tfuse').'<span class="author">
                                                <a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->display_name.'</a></span>
                                            '.__(' on ','tfuse').' <time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $id ).'</time>
                                        </div>
                                    </header>';
                                    if(!empty($image))
                                    {
                                        $out .= '<a class="post-thumbnail '.$img_pos.' clearfix" href="'.get_permalink($id).'"><img src="'.$image.'" alt="'.get_the_title($id).'"/></a>';
                                    }
                                    $out .= '<div class="entry-content">';
                                        if ( tfuse_options('post_content') == 'content' ) 
                                        {
                                            $out .= $current_post->post_content; 
                                        }
                                        else
                                        {
                                            $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                        }
                                    $out .= '</div>
                                    <footer class="entry-meta">
                                        <a class="btn btn-default btn-xs" href="'.get_permalink($id).'">'.__('Read more','tfuse').'</a>

                                        <span class="comments-link"><a href="'.get_permalink($id).'#comments"><i class="tficon-comment"></i> '.get_comments_number($id).'</a></span>
                                    </footer>
                                </div>
                            </div>
                        </article>';
                        
                        $k++;
                    }
                }
                else
                {
                    $out .= '<h5>'.__('Sorry, no news for this game.', 'tfuse').'</h5>';
                }
            $out2 .= '</section>';
            if(get_option('posts_per_page') < count($posts))
            {
                $out3 .= '<div class="load_button">
                                <button type="submit" class="btn btn-main" id="load_game_posts" data-post-id="'.$post_id.'" data-from="game_news" >'.__('Load More', 'tfuse').'</button>
                                <button type="submit" class="btn btn-main" id="loading_game_posts">'.__('Loading...', 'tfuse').'</button>
                          </div>';
             }
            
        }
        //get reviews posts for current game post
        elseif($posts_from == 'game_reviews')
        {
            $posts = tfuse_get_game_posts($post_id,'reviews');
            
            $out1 .= '<section class="postlist postlist-cols-1 ajax_section_load">
                <h1>'. __('Reviews','tfuse').'</h1>';
                if(!empty($posts))
                {
                    $k = 0;
                    foreach ($posts as $id)
                    {
                        if($k ==  get_option('posts_per_page')) break;
                        
                        $rating = tfuse_page_options('rating','',$id);
                        $featured = tfuse_page_options('featured','',$id);

                        $current_post = get_post( $id );
                        $user_data = get_user_by('id',$current_post->post_author);
                        
                        $out .= '<article class="post">
                                    <div class="inner">
                                        <a class="post-thumbnail" href="'.get_permalink($id).'"><img src="'.wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails')).'" /></a>
                                        <div class="entry-aside">
                                            <header class="entry-header">';
                                                if(!empty($rating))
                                                    $out .= '<span class="rating">'.$rating.'</span>';
                                        $out .= '<h1 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h1>
                                                <div class="entry-meta">
                                                    '.__('By ','tfuse').'<span class="author"><a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->display_name.'</a></span>
                                                    '.__(' on ','tfuse').' <time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $id ).'</time>
                                                    '.__(' on ','tfuse').' <span class="cat-links">'.tfuse_reviews_cat_links($id).'</span>
                                                </div>
                                            </header>
                                            <div class="entry-content">';
                                                if ( tfuse_options('post_content') == 'content' ) 
                                                {
                                                    $out .= $current_post->post_content; 
                                                }
                                                else
                                                {
                                                    $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                                }
                                   $out .= '</div>
                                            <footer class="entry-meta">
                                                <a class="btn btn-default btn-xs" href="'.get_permalink($id).'">'.__('Read more','tfuse').'</a>
                                                <span class="comments-link"><a href="'.get_permalink($id).'#comments"><i class="tficon-comment"></i> '.get_comments_number($id).'</a></span>';
                                                if($featured)
                                                    $out .= '<span class="featured-icon"><i class="tficon-star-f"></i> '.__('Featured Review','tfuse').'</span>';
                                    $out .= '</footer>
                                        </div>
                                    </div>
                                </article>';
                        $k++;
                    }
                }
                else
                {
                    $out .= '<h5>'.__('Sorry, no reviews for this game.', 'tfuse').'</h5>';
                }
            $out2 .= '</section>';
            if(get_option('posts_per_page') < count($posts))
            {
                $out3 .= '<div class="load_button">
                                <button type="submit" class="btn btn-main" id="load_game_posts" data-post-id="'.$post_id.'" data-from="game_reviews">'.__('Load More', 'tfuse').'</button>
                                <button type="submit" class="btn btn-main" id="loading_game_posts">'.__('Loading...', 'tfuse').'</button>
                          </div>';
             }
            
        }
        //get galleries posts for current game post
        elseif($posts_from == 'game_images')
        {
            $posts = tfuse_get_game_posts($post_id,'images');
            
            $terms = tfuse_get_game_filter_terms('gallery','galleries',$post_id);
            
            $out1 .= '<article class="post post-details portfolio">
                        <header class="entry-header">
                            <h1 class="entry-title">'. __('Images','tfuse').'</h1>
                        </header>
                        <div class="entry-content">

                            <div class="top-filter terms-game-filter" id="gallery_filter">
                                <span class="top-filter-title">'. __('Filter','tfuse').':</span>

                                <ul>
                                    <li><a href="" class="btn btn-simple btn-sm active" data-term="all" data-game-post="'.$post_id.'">'.__('All','tfuse').'</a></li>';
                                    if(!empty($terms))
                                    {
                                        foreach ($terms as $term_id) {
                                            $term = get_term_by( 'id' , $term_id , 'galleries');
                                            $out1 .= '<li><a href="" class="btn btn-simple btn-sm" data-term="'.$term->term_id.'" data-game-post="'.$post_id.'">'.$term->name.'</a></li>';
                                        }
                                    }
                        $out1 .= '</ul>
                            </div>

                            <ul class="portfolio-list ajax_section_load" id="game-portfolio-list" >';
                                if(!empty($posts))
                                {
                                    $k = 0; $pretty = tfuse_options('portf_type');
                                    foreach ($posts as $id)
                                    {
                                        if($k ==  get_option('posts_per_page')) break;
                                        
                                        $image =wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                        
                                        if($pretty == 'pretty'){
                                            $rel = 'data-rel="prettyPhoto[gallery]"';
                                            $url = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                        }
                                        else
                                        {
                                            $rel = '';
                                            $url = get_permalink($id);
                                        }

                                        $out .= '<li>
                                                    <a href="'.$url.'" '.$rel.' title="'.get_the_title($id).'">';
                                                        if(!empty($image))
                                                            $out .= '<img src="'.$image.'" />';
                                                        else
                                                        {
                                                            $out .= '<img src="'.get_template_directory_uri().'/images/gallery_small.jpg" width="166" height="166" alt=""/>';
                                                        }
                                                    $out .= '</a>
                                                </li>';
                                        $k++;
                                    }
                                }
                                else
                                {
                                    $out .= '<h5>'.__('Sorry, no images for this game.', 'tfuse').'</h5>';
                                }
                        $out2 .= '</ul>';
                        
                        if(get_option('posts_per_page') < count($posts))
                        {
                            $out3 .= '<div class="load_button">
                                            <button type="submit" class="btn btn-main" data-post-id="'.$post_id.'" data-from="game_images" id="load_game_posts" value="Send">'.__('Load More', 'tfuse').'</button>
                                            <button type="submit" class="btn btn-main" id="loading_game_posts">'.__('Loading...', 'tfuse').'</button>
                                      </div>';
                        }
                            
                        $out4 .= '</article>';
                        
            
            
        }
        //get videos posts for current game post
        elseif($posts_from == 'game_videos')
        {
            $posts = tfuse_get_game_posts($post_id,'videos');
            
            $terms = tfuse_get_game_filter_terms('video','videos',$post_id);
            
            $out1 .= '<article class="post post-details portfolio portfolio-videos">

                                <header class="entry-header">
                                    <h1 class="entry-title">'. __('Videos','tfuse').'</h1>
                                </header>

                                <div class="entry-content">

                                    <div class="top-filter terms-game-filter" id="video_filter">
                                        <span class="top-filter-title">'. __('Filter','tfuse').':</span>

                                        <ul>
                                            <li><a href="" class="btn btn-simple btn-sm active" data-term="all" data-game-post="'.$post_id.'">'.__('All','tfuse').'</a></li>';
                                            if(!empty($terms))
                                            {
                                                foreach ($terms as $term_id) {
                                                    $term = get_term_by( 'id' , $term_id , 'videos');
                                                    $out1 .= '<li><a href="" class="btn btn-simple btn-sm" data-term="'.$term->term_id.'" data-game-post="'.$post_id.'">'.$term->name.'</a></li>';
                                                }
                                            }
                                        $out1 .= '</ul>
                                    </div>

                                    <ul class="portfolio-list ajax_section_load" id="game-portfolio-list">';
                                        if(!empty($posts))
                                        {
                                            $k = 0; 
                                            foreach ($posts as $id)
                                            {
                                                if($k ==  get_option('posts_per_page')) break;

                                                $video = tfuse_page_options('video_links','',$id);
    
                                                $image = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
                                                
                                                $video_link = !empty($video) ? $video : wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));

                                                $out .= '<li>
                                                            <a data-rel="prettyPhoto"  title="'.get_the_title($id).'" href="'.$video_link.'">';
                                                                if(!empty($image))
                                                                    $out .= '<img src="'.$image.'" />';
                                                                else
                                                                    $out .='<img src="'.get_template_directory_uri().'/images/gallery_medium.jpg" width="333" height="222" alt=""/>';
                                                            $out .= '</a>
                                                            <h4><a class="video_link" href="'.get_permalink($id).'">'.get_the_title($id).'</a></h4>
                                                        </li>';
                                                $k++;
                                            }
                                        }
                                        else
                                        {
                                            $out .= '<h5>'.__('Sorry, no images for this game.', 'tfuse').'</h5>';
                                        }
                        $out2 .= '</ul>';
                        
                        if(get_option('posts_per_page') < count($posts))
                        {
                            $out3 .= '<div class="load_button">
                                            <button type="submit" class="btn btn-main" data-post-id="'.$post_id.'" data-from="game_videos" id="load_game_posts" value="Send">'.__('Load More', 'tfuse').'</button>
                                            <button type="submit" class="btn btn-main" id="loading_game_posts">'.__('Loading...', 'tfuse').'</button>
                                      </div>';
                        }
                            
                        $out4 .= '</article>';
        }
        //get galleries posts for current game post
        elseif($posts_from == 'game_guides')
        {
            $posts = '';
            
            $terms = tfuse_get_game_filter_terms('guide','guides',$post_id,true);
            
            if(!empty($terms))
            {
                foreach ($terms as $term_id) {
                    $term = get_term_by( 'id' , $term_id , 'guides');
                    
                    $posts = tfuse_get_game_posts($post_id,'guides',$term->term_id); break;
                }
            }
            
            $out1 .= '<article class="post post-details portfolio">
                        <header class="entry-header">
                            <h1 class="entry-title">'. __('Guides','tfuse').'</h1>
                        </header>
                        <div class="entry-content">

                            <div class="top-filter terms-game-filter" id="guides_filter">
                                <span class="top-filter-title">'. __('Filter','tfuse').':</span>

                                <ul>';
                                    if(!empty($terms))
                                    {
                                        $k = 0; foreach ($terms as $term_id) { $k++;
                                            $term = get_term_by( 'id' , $term_id , 'guides');
                                            if($k == 1)
                                                $out1 .= '<li><a href="" class="btn btn-simple btn-sm active" data-term="'.$term->term_id.'" data-game-post="'.$post_id.'">'.$term->name.'</a></li>';
                                            else
                                                $out1 .= '<li><a href="" class="btn btn-simple btn-sm" data-term="'.$term->term_id.'" data-game-post="'.$post_id.'">'.$term->name.'</a></li>';
                                        }
                                    }
                        $out1 .= '</ul>
                            </div>
                            <div class="tab-content">
                                <div class="postlist postlist-simple ajax_section_load" id="game-portfolio-list">';
                                if(!empty($posts))
                                {
                                    
                                    $download = (!empty($terms)) ? tfuse_options('guides_posts','',$terms[0]) : '';
                                    
                                    $k = 0; 
                                    if($download == 'download')
                                    {
                                        foreach ($posts as $id)
                                        {
                                            if($k ==  get_option('posts_per_page')) break;
                                            $current_post = get_post( $id );
                                            
                                            //get download link
                                            $file = tfuse_page_options('upload_guide','',$id);
                                            //get user data
                                            $user_data = get_user_by('id',$current_post->post_author);

                                            $out .= '<div class="post">
                                                        <h2 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h2>';
                                                        if(!empty($file))
                                                            $out .='<div class="entry-side-btn">
                                                                <a class="btn btn-default btn-xs" href="'.$file.'" target="_blank">'.__('Download','tfuse').'</a>
                                                            </div>';
                                                        $out .='<div class="entry-meta">
                                                            '. __('By ','tfuse').'<span class="author"><a href="'.get_author_posts_url( $current_post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->display_name.'</a></span> 
                                                            '.__(' on ','tfuse').'<time class="entry-date" datetime="">'.get_the_time( get_option('date_format'), $id ).'</time>
                                                        </div>

                                                    </div>';
                                            $k++;
                                        }
                                    }
                                    else
                                        foreach ($posts as $id)
                                        {
                                            if($k ==  get_option('posts_per_page')) break;
                                            $current_post = get_post( $id );

                                            $out .= '<div class="post">
                                                        <h2 class="entry-title"><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></h2>
                                                        <div class="entry-content ">';
                                                            if ( tfuse_options('post_content') == 'content' ) 
                                                            {
                                                                $out .= $current_post->post_content; 
                                                            }
                                                            else
                                                            {
                                                                $out .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                                            }
                                                        $out .='</div>
                                                    </div>';
                                            $k++;
                                        }
                                }
                                else
                                {
                                    $out .= '<h5>'.__('Sorry, no guides for this game.', 'tfuse').'</h5>';
                                }
                        $out2 .= '</div></div>';
                        
                        if(get_option('posts_per_page') < count($posts))
                        {
                            $out3 .= '<div class="load_button">
                                            <button type="submit" class="btn btn-main" data-post-id="'.$post_id.'" data-from="game_guides" id="load_game_posts" >'.__('Load More', 'tfuse').'</button>
                                            <button type="submit" class="btn btn-main" id="loading_game_posts">'.__('Loading...', 'tfuse').'</button>
                                      </div>';
                        }
                            
                        $out4 .= '</article>';
                        
            
            
        }
        $rsp = array('html'=> $out1.$out.$out2.$out3.$out4); 
         
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_game_posts','tfuse_ajax_get_game_posts');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_game_posts','tfuse_ajax_get_game_posts');
endif;

if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     *
     *
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');
            update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
        }
    }
endif;

if (!function_exists('tfuse_get_game_news')) :

function tfuse_get_game_posts($post_id,$type,$term_id = '')
{
    $news_posts = $args = $featured_posts = array();
    
    if($type == 'reviews')
    {
        $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'review',
					'post_status' => array( 'publish')
                );
    }
    elseif($type == 'images')
    {
        $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'gallery',
					'post_status' => array( 'publish')
                );
    }
    elseif($type == 'videos')
    {
        $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'video',
					'post_status' => array( 'publish')
                );
    }
    elseif($type == 'guides')
    {
        
        if(!empty($term_id))
        {
            $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'guide',
					'post_status' => array( 'publish'),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'guides',
                            'field' => 'id',
                            'terms' => array($term_id),
                        )
                    )
                );
        }
        
    }
    else
    {
        $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'post',
					'post_status' => array( 'publish')
                );
    }
    
    $all_posts = new WP_Query( $args );
    $posts = $all_posts->posts;
    
    if(!empty($posts))
        foreach ($posts as $post) {
            $games_posts = explode(',',tfuse_page_options('game_select','',$post->ID));
            
            if(in_array($post_id, $games_posts))
                $news_posts[] = $post->ID;
        }
        
    if($type == 'reviews')
    {
        if(!empty($news_posts))
        {
            foreach ($news_posts as $rev_posts)
            {
                $featured = tfuse_page_options('featured','',$rev_posts);
                if($featured)
                    $featured_posts[] =  $rev_posts;
            }
        
        
            $result_arg = array_diff ( $news_posts , $featured_posts );
                
            $news_posts = array_merge($featured_posts, $result_arg);
        }
    }
        
    return $news_posts;
}

endif;

//get game filter terms which have posts from this game post
if (!function_exists('tfuse_get_game_filter_terms')) :

    function tfuse_get_game_filter_terms($post_type,$tax,$post_id,$guides = '')
    {
        $terms = get_terms( $tax ); 
                                
        $terms_game = array();

        if(!empty($terms))
        {
            foreach ($terms as $term) {
                if($guides)
                {
                    $args = array(
                            'posts_per_page' => -1,
                            'post_type' => $post_type,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $tax,
                                    'field' => 'id',
                                    'terms' => array($term->term_id),
                                )
                            )
                        );
                    
                    $all_posts = new WP_Query( $args );
                    $posts_game = $all_posts->posts;

                }
                else
                {
                   // if($term->parent != 0)
                   // {
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => $post_type,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $tax,
                                    'field' => 'id',
                                    'terms' => array($term->term_id),
                                )
                            )
                        );
                        
                        $all_posts = new WP_Query( $args );
                        $posts_game = $all_posts->posts;
                   // }
                }
                   
                    if(!empty($posts_game))
                        foreach ($posts_game as $post_game) {
                            $games_posts = explode(',', tfuse_page_options('game_select','',$post_game->ID));

                            if(in_array($post_id, $games_posts))
                            {
                                if(!empty($terms_game))
                                {
                                    if(in_array($term->term_id, $terms_game))
                                        continue;
                                    else
                                        $terms_game[] = $term->term_id;
                                }       
                                else
                                    $terms_game[] = $term->term_id;
                            }
                        }
                
            }
        }
        return $terms_game;
    }

endif;

//get gallery posts from clicked term in game single post
if (!function_exists('tfuse_get_game_news')) :

function tf_get_game_images_posts($term_id,$post_id,$tax)
{
    $news_posts = array();
    
    if($term_id == 'all')
    {
        if($tax == 'galleries')
        {
            $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'gallery'
                );
        }
        else
        {
            $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'video'
                );
        }
    }
    else
    {        
        $args = array(
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                            'taxonomy' => $tax,
                            'field' => 'id',
                            'terms' => array((int)$term_id)
                        )
                )
            );
    }
    
    $all_posts = new WP_Query( $args );
    $posts = $all_posts->posts;
    
    if(!empty($posts))
        foreach ($posts as $post) {
            $games_posts = explode(',',tfuse_page_options('game_select','',$post->ID));
            
            if(in_array($post_id, $games_posts))
                $news_posts[] = $post->ID;
        }
        
    return $news_posts;
}

endif;

if (!function_exists('tfuse_archive_events')) :
    function tfuse_archive_events()
    {
        global $q_config;

        if( isset( $_POST['lang'] ) && !empty( $_POST['lang'] ) ) {
            $q_config['language'] = $_POST['lang'];
        }
        
        $cat_ID = (intval($_POST['id'])); 
        $hour = $repeat = $date = '';
        $args = array(
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events',
                    'field' => 'id',
                    'terms' => $cat_ID
                )
            )
        );
        $query = new WP_Query( $args );
        $posts = $query -> posts;
        
        if(!empty($posts))
        {
            $all = $dates = $hours = $repeats = $titles = $links = array();
            $end_hour = '';
            
            foreach($posts as $post){
                $date = tfuse_page_options('event_date','',$post->ID);
                if(!empty($date))
                {
                    $event_hour = tfuse_page_options('event_hour_min', false, $post->ID);
					$end_event_hour = tfuse_page_options('end_hour_min', false, $post->ID);
                    if(!empty($event_hour))
                        $hour .= $event_hour['hour'].':'.$event_hour['minute'].' '.$event_hour['time'];
						
                        if(!empty($end_event_hour))
                            $end_hour .= ' - '.$end_event_hour['hour'].':'.$end_event_hour['minute'].' '.$end_event_hour['time'];
                        else $end_hour = '';
					
                    //repeat event
                    $repeat = tfuse_page_options('event_repeat','',$post->ID);
                    if($repeat != 'no')
                        $repeats[$post->ID] = tfuse_page_options('event_repeat','',$post->ID);
                    
                    if($repeat == 'year')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $date = new DateTime($from);
                        $year = (int)$date->format('Y');
                        $month = $date->format('m');
                        $day = $date->format('d');
                        for($i=0;$i<10;$i++)
                        {
                            $dates[$year+$i.'-'.$month.'-'.$day][][$hour.$end_hour] = get_permalink($post->ID).','.get_the_title($post->ID);
                        }
                    }
                    elseif($repeat == 'month')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $day = strtotime($from);
                        for($i=0;$i<10;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." month");
                            $dates[date("Y-m-d", $to)][][$hour.$end_hour] = get_permalink($post->ID).','.get_the_title($post->ID);
                        }
                    }
                    elseif($repeat == 'week')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $day = strtotime($from);
                        for($i=0;$i<53;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." weeks");
                            $dates[date("Y-m-d", $to)][][$hour.$end_hour] = get_permalink($post->ID).','.get_the_title($post->ID);
                        }
                    }
                    elseif($repeat == 'day')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $day = strtotime($from);
                        for($i=0;$i<365;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." days");
                            $dates[date("Y-m-d", $to)][][$hour.$end_hour] = get_permalink($post->ID).','.get_the_title($post->ID);
                        }
                    }
                    else
                    {
                        //extract event dates
                        $dates[tfuse_page_options('event_date','',$post->ID)][][$hour.$end_hour] = get_permalink($post->ID).','.get_the_title($post->ID);
                    }
                    $hour = ""; $end_hour = "";
                }
            }
			$response = array('date'=>$dates,'repeat'=>$repeats);
			$response = json_encode( $response);
			echo $response;
			die();
        }
		else
		{
			echo '';
			die();
		}
    }
    add_action('wp_ajax_tfuse_archive_events','tfuse_archive_events');
    add_action('wp_ajax_nopriv_tfuse_archive_events','tfuse_archive_events');
endif;

if(!function_exists('tf_is_real_post_save')){
    /**
     * This function is used in 'post_updated' action
     *
     * @param $post_id
     * @return bool
     */
    function tf_is_real_post_save($post_id)
    {
        return !(
            wp_is_post_revision($post_id)
                || wp_is_post_autosave($post_id)
                || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                || (defined('DOING_AJAX') && DOING_AJAX)
        );
    }
}

if (!function_exists('tfuse_find_hour')) :
    function tfuse_find_hour($post_id)
    {   
        global $TFUSE;

        if (!tf_is_real_post_save($post_id)) {
            return;
        }

        $time = array(
            'hour'  => $TFUSE->request->post(TF_THEME_PREFIX.'_event_hour'),
            'minute'  => $TFUSE->request->post(TF_THEME_PREFIX.'_event_minute'),
            'time'  => $TFUSE->request->post(TF_THEME_PREFIX.'_event_time'),
        );
        tfuse_set_page_option('event_hour_min', $time, $post_id);
		
		$endtime = array(
            'hour'  => $TFUSE->request->post(TF_THEME_PREFIX.'_event_hour_end'),
            'minute'  => $TFUSE->request->post(TF_THEME_PREFIX.'_event_minute_end'),
            'time'  => $TFUSE->request->post(TF_THEME_PREFIX.'_event_time_end'),
        );
        tfuse_set_page_option('end_hour_min', $endtime, $post_id);
    }
endif;
add_action( 'save_post_event', 'tfuse_find_hour' );


if ( !function_exists('tfuse_reviews_cat_links')):
    function tfuse_reviews_cat_links($post_id){
        $cats = '';
        $terms = wp_get_post_terms( $post_id, 'reviews' );
        
        if(!empty($terms))
            foreach ($terms as $term) {
                $cats .= '<a href="'.get_term_link( $term, 'reviews' ).'">'.$term->name.'</a>'; break;
            }
            
        $terms_platforms = wp_get_post_terms( $post_id, 'platforms' );
        $terms_genres = wp_get_post_terms( $post_id, 'genres' );
        
        if(!empty($terms_platforms) || !empty($terms_genres))
        {
            $platforms_link = $genres_link = '';
            
            if(!empty($terms_platforms))
            {
                foreach ($terms_platforms as $term) {
                    $platforms_link .= '&platforms_'.$term->term_id.'='.$term->term_id;
                }
            }
            
            if(!empty($terms_genres))
            {
                foreach ($terms_genres as $term) {
                    $genres_link .= '&genres_'.$term->term_id.'='.$term->term_id;
                }
            }
            
            $count = count($terms_platforms) + count($terms_genres);
            $cats .= ', <a href="?s=~&price-range=0%3B10&tax_reviews= '.$platforms_link.$genres_link.'">'.$count .' '.__('More','tfuse').'</a>';
        }
        
        return $cats;
    }
endif;


add_theme_support( 'post-thumbnails', array('post','gallery','video','review','game','members'));

add_image_size( 'feature-image', 9999, 9999, true ); 
add_image_size( 'medium-thumb', 200, 200, true );
add_image_size( 'small-thumb', 166, 166, true );
add_image_size( 'video-thumb', 333, 222, true );
add_image_size( 'review-thumb', 240, 160, true );
add_image_size( 'gallery-widget-thumb', 118, 118, true );
add_image_size( 'members-widget-thumb', 55, 55, true );
add_image_size( 'video-slider-thumb', 75, 75, true );
add_image_size( 'carousel-medium-thumb', 360, 240, true );
add_image_size( 'content-slider-thumb', 430, 297,true );
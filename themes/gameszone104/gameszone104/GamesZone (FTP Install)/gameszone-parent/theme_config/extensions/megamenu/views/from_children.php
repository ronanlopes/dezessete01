<?php
    $get_terms_settings = array(
        'hide_empty'    => false,
    );
    $item = $settings['item_settings'];
    $target = @$item['target'];
    if($target!='') $target = ' target="'.$target.'"';
        $i = 0;
        
        if($item['object']['object'] == 'genres' || $item['object']['object'] == 'platforms' || $item['object']['object'] == 'reviews' || $item['object']['object'] == 'videos' || $item['object']['object'] == 'age_ratings' || $item['object']['object'] == 'genres_game' || $item['object']['object'] == 'producers_game' || $item['object']['object'] == 'platforms_game' || $item['object']['object'] == 'games' || $item['object']['object'] == 'galleries' || $item['object']['object'] == 'category' ) 
        {
            $term = get_term($item['object']['object_id'], $item['object']['object']); 
            if(is_wp_error($term)) return;
            $args = array(
                'hide_empty'    => false,
                'fields'        => 'all',
                'parent'         => $item['object']['object_id']
            );
            $args = wp_parse_args( $get_terms_settings, $args );
            $terms = get_terms($item['object']['object'], $args);
        }
        elseif($item['object']['type'] == 'post_type' && $item['object']['object'] == 'page')
        {
            $posts = get_posts(array('posts_per_page'  => -1,'post_type' => 'page'));
            $terms = array();
            foreach ($posts as $post) {
                if($post->post_parent == $item['object']['object_id'])
                    $terms[] = $post;
            }
        }
        else 
        { ?>
            <a <?php echo $target; ?> href="<?php print $item['url']; ?>">
                <span><?php echo $item['item_title'];?></span>
            </a>
    <?php return;
        }
        ?>

<a <?php echo $target; ?> href="<?php print $item['url']; ?>">
    <span><?php echo $item['item_title'];?></span>
</a>
<?php 
if(!empty($terms)): 
    $visible_childs = $settings['tf_megamenu_num_items'];
?>
    <ul class="children_mega_nav">  
        <?php 
            foreach ($terms as $child) :
                if($item['object']['object'] == 'genres' || $item['object']['object'] == 'platforms' || $item['object']['object'] == 'reviews' || $item['object']['object'] == 'videos' || $item['object']['object'] == 'age_ratings' || $item['object']['object'] == 'genres_game' || $item['object']['object'] == 'producers_game' || $item['object']['object'] == 'platforms_game' || $item['object']['object'] == 'games' || $item['object']['object'] == 'galleries' || $item['object']['object'] == 'category')
                {
                    $title = $child->name;
                    $link = get_term_link($child);
                }
                elseif($item['object']['type'] == 'post_type' && $item['object']['object'] == 'page')
                {
                    $title = $child->post_title;
                    $link = get_permalink($child->ID);
                }
        ?>
                <li>
                    <a <?php echo $target; ?> href="<?php print $link; ?>">
                        <span><?php echo $title;?></span>
                    </a>
                </li>
                <?php $i++; if($i == $visible_childs) {break;} ?>
        <?php 
            endforeach; 
        ?>

    </ul>   
<?php endif;?>


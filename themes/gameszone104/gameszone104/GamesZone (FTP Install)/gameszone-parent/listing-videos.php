<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Gamezone 1.0
 */
 global $more,$post;
    $more = apply_filters('tfuse_more_tag',0);

$video = tfuse_page_options('video_links');
    
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
?>
<li>
    <a data-rel="prettyPhoto"  title="<?php echo get_the_title();?>" href="<?php echo !empty($video) ? $video : wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));?>">
        <?php if(!empty($image)):?>
            <img src="<?php echo $image;?>" alt=""/>
        <?php else:?>
            <img src="<?php echo get_template_directory_uri().'/images/gallery_medium.png'?>" width="333" height="222" alt=""/>
        <?php endif;?>
    </a>
    <h4><a class="video_link" href="<?php the_permalink();?>"><?php echo get_the_title();?></a></h4>
</li>
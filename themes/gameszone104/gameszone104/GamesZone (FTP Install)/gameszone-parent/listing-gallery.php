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
    
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    
$img_size = tfuse_options('gallery_type','',$term->term_id);

$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));

$pretty = tfuse_options('portf_type');

    if($pretty == 'pretty'){
	    $rel = 'data-rel="prettyPhoto[gallery]"';
	    $url = wp_get_attachment_url( get_post_thumbnail_id($id, 'post-thumbnails'));
	}
	else
	{
	    $rel = '';
	    $url = get_permalink($id);
	}
?>
<li>
    <a href="<?php echo $url; ?>" <?php echo $rel; ?> title="<?php echo get_the_title();?>">
        <?php if(!empty($image)):?>
             <?php if($img_size == 'med'):?>
                <img src="<?php echo $image;?>" width="200" height="200" alt=""/>
            <?php else:?>
                <img src="<?php echo $image;?>" width="166" height="166" alt=""/>
            <?php endif;?>
        <?php else:?>
            <?php if($img_size == 'med'):?>
                <img src="<?php echo get_template_directory_uri().'/images/gallery_medium.png'?>" width="200" height="200" alt=""/>
            <?php else:?>
                <img src="<?php echo get_template_directory_uri().'/images/gallery_small.png'?>" width="166" height="166" alt=""/>
            <?php endif;?>
        <?php endif;?>
    </a>
</li>
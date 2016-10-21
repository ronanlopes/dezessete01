<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Gamezone 1.0
 */
?>
<li>
    <a href="<?php the_permalink();?>" class="post-thumbnail"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));?>" /></a>
    <a href="<?php the_permalink();?>" class="post-title"><?php echo get_the_title();?></a>
</li>
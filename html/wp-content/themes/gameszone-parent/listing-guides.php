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
?>
<div class="post">
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h2>
    <div class="entry-content ">
        <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
    </div>
    <span id="post-<?php the_ID(); ?>" <?php post_class(); ?>></span>
</div>
<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Gamezone 1.0
 */
 global $more;
    $more = apply_filters('tfuse_more_tag',0);
    
    $file = tfuse_page_options('upload_guide');
?>
<div class="post">
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h2>
    <?php if(!empty($file)):?>
        <div class="entry-side-btn">
            <a class="btn btn-default btn-xs" href="<?php echo $file;?>" target="_blank"><?php _e('Download','tfuse');?></a>
        </div>
    <?php endif;?>
    <div class="entry-meta">
        <?php _e('By ','tfuse');?><span class="author"><?php the_author_posts_link() ?></span> 
        <?php _e(' on ','tfuse');?> <time class="entry-date" datetime=""><?php echo get_the_date(); ?></time>
    </div>

</div>
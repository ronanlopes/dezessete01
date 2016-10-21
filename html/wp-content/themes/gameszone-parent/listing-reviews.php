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
    
$rating = tfuse_page_options('rating');

$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
?>
<article class="post">
    <div class="inner">
        <a class="post-thumbnail" href="<?php the_permalink();?>">
            <img src="<?php echo $image;?>" alt=""/>
        </a>
        <div class="entry-aside">
            <header class="entry-header">
                <?php if(!empty($rating)):?>
                    <span class="rating"><?php echo $rating;?></span>
                <?php endif;?>
                <h1 class="entry-title"><a href="<?php the_permalink();?>"><?php echo get_the_title();?></a></h1>
                <div class="entry-meta">
                    <?php _e('By','tfuse');?> <span class="author"><?php the_author_posts_link() ?></span> 
                </div>
            </header>
            <div class="entry-content">
                <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
            </div>
            <footer class="entry-meta">
                <a class="btn btn-default btn-xs" href="<?php the_permalink();?>"><?php _e('Read more','tfuse');?></a>
                <span class="comments-link"><a href="<?php comments_link(); ?>"><i class="tficon-comment"></i> <?php comments_number(); ?></a></span>
            </footer>
        </div>
    </div>
</article>
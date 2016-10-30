<?php 
global $is_tf_blog_page;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php tfuse_shortcode_content('before');?>
<div class="main-row content-row">
    <div class="container">
        <?php if ($sidebar_position == 'left') : ?>
           <div class="middle-main sidebar-left">
        <?php endif;?>
        <?php if ($sidebar_position == 'right') : ?>
            <div class="middle-main content-cols2">
        <?php endif;?>
        <?php if ($sidebar_position == 'full') : ?>
            <div class="middle-main content-full">
        <?php endif; ?> 
                    <div id="primary" class="content-area">
                        <div class="inner">
                            <article class="post post-details">
                                <?php if(!tfuse_page_options('hide_title')):?>
                                    <header class="entry-header">
                                        <h1 class="entry-title"><?php echo get_the_title();?></h1>
                                    </header>
                                <?php endif;?>
                                <div class="entry-content">
                                    <?php  while ( have_posts() ) : the_post();?>
                                        <?php the_content(); ?>
                                    <?php break; endwhile; // end of the loop. ?>
                                </div>
                            </article>
                            <?php if ( comments_open() ) : ?>
                                <?php tfuse_comments(); ?>
                            <?php endif;?>
                        </div>
                    </div>
                <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                    <div id="secondary" class="sidebar widget-area">
                        <div class="inner">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                <?php endif; ?>
            </div> 
    </div>
</div>
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>
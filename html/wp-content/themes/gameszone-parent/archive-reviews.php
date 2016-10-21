<?php get_header(); ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
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
                            <section class="postlist postlist-cols-1">
                                <h1><?php echo single_term_title();?></h1>
                                    <?php if (have_posts()) 
                                     { $count = 0;
                                        while (have_posts()) : the_post(); $count++;
                                            get_template_part('listing','reviews');
                                        endwhile;
                                     } 
                                     else 
                                     { ?>
                                         <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                               <?php } ?>
                                <?php  tfuse_pagination();?>
                            </section>
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
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>
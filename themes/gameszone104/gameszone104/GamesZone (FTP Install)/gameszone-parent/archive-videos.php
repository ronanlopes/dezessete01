<?php get_header(); ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));    
    $custom_title = tfuse_options('custom_title','',$term->term_id);
?>
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
                            <article class="post post-details portfolio portfolio-videos">

                                <header class="entry-header">
                                    <h1 class="entry-title"><?php echo (!empty($custom_title)) ? $custom_title : single_term_title();?></h1>
                                </header>

                                <div class="top-filter">
                                    <span class="top-filter-title"><?php _e('Filter','tfuse')?>:</span>
                                    <ul>
                                        <?php tfuse_show_filter();?>
                                    </ul>
                                </div>

                                <ul class="portfolio-list">
                                    <?php if (have_posts()) 
                                     { $count = 0;
                                        while (have_posts()) : the_post(); $count++;
                                            get_template_part('listing','videos');
                                        endwhile;
                                     } 
                                     else 
                                     { ?>
                                         <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                               <?php } ?>
                                </ul>
                                <?php  tfuse_pagination();?>
                            </article>
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
<?php get_header(); ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>

<?php 
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $type = tfuse_options('guides_posts','',$term->term_id);
    //get all terms
    $terms = get_terms( 'guides' );
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
                            <article class="post post-details portfolio">
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php echo single_term_title();?></h1>
                                </header>
                                
                                <div class="entry-content">

                                    <?php if(!empty($terms)):?>
                                        <div class="top-filter">
                                            <span class="top-filter-title"><?php _e('Filter','tfuse')?>:</span>

                                            <ul class="">
                                                <?php foreach ($terms as $term_filter): ?>
                                                    <li class="<?php echo ($term->term_id == $term_filter->term_id) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_bloginfo('url').'/?'.$term_filter->taxonomy.'=' .$term_filter->slug; ?>" class="btn btn-simple btn-sm <?php echo ($term->term_id == $term_filter->term_id) ? 'active' : ''; ?>"><?php echo $term_filter->name; ?></a></li>
                                                <?php endforeach;?>
                                            </ul>
                                        </div>
                                    <?php endif;?>
                                    <div class="tab-content">
                                        <div class="postlist postlist-simple">
                                            <?php if (have_posts()) 
                                             { $count = 0;
                                                 while (have_posts()) : the_post(); $count++;
                                                    if($type == 'download')
                                                        get_template_part('listing', 'guides-download');
                                                    else
                                                        get_template_part('listing', 'guides');
                                                 endwhile;
                                             } 
                                             else 
                                             { ?>
                                                 <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                                       <?php } ?>
                                        </div>
                                        <?php  tfuse_pagination();?>
                                    </div>
                                </div>
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


<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Gameszone 1.0
 */
global $post;
$featured = tfuse_page_options('featured');

$good_list = tfuse_page_options('content_tabs_table');
$bad_list = tfuse_page_options('content_tabs_table_s');

$rating = tfuse_page_options('rating');
?>
<article class="post post-details">
    <header class="entry-header">
        <?php if(!tfuse_page_options('hide_title')):?>
            <h1 class="entry-title"><?php echo get_the_title();?></h1>
        <?php endif;?>
        <div class="entry-meta">
            <?php _e('By ','tfuse');?><span class="author"><?php the_author_posts_link() ?></span>
            <?php _e(' on ','tfuse');?><time class="entry-date" datetime=""><?php echo get_the_date(); ?></time>
            <?php _e(' on ','tfuse');?><span class="cat-links"><?php echo tfuse_review_cat_links($post->ID);?></span>
        </div>
    </header>

    <div class="entry-meta-share">
        <script>
                (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/<?php echo get_locale() ?>/sdk.js#xfbml=1&version=v2.0";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="post-social fb-like" data-href="<?php the_permalink(); ?>" data-locale="<?php echo get_locale(); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>

        <div class="post-social">
                <a href="https://twitter.com/share" class="twitter-share-button" data-dnt="true" data-count="none" data-via="twitterapi">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>

        <div class="post-social">
                <g:plusone size="medium"></g:plusone>
                <script type="text/javascript">
                        window.___gcfg = {
                                lang: '<?php echo get_locale() ?>'
                        };
                        (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                </script>
        </div>

        <span class="comments-link"><a href="<?php comments_link(); ?>" class="anchor"><i class="tficon-comment"></i> <?php comments_number(); ?></a></span>
        <?php if($featured):?>
            <span class="featured-icon"><i class="tficon-star-f"></i> <?php _e('Featured Review','tfuse');?></span>
        <?php endif;?>
    </div>
    <div class="entry-content">
        <?php the_content(); ?>
            <?php if(!empty($good_list[0]['tab_title']) || !empty($bad_list[0]['tab_title'])):?>
                    <!-- good and bad list -->
                    <div class="good-bad-list clearfix">
                        <div class="row">
                            <?php if(!empty($good_list[0]['tab_title']) && !empty($bad_list[0]['tab_title'])):?>
                                <div class="col-sm-6">
                                    <h3 class="text-primary"><?php _e('The Good','tfuse');?></h3>
                                    <div class="list-plus list-primary">
                                        <ul>
                                            <?php foreach ($good_list as $value):?>
                                                <li><?php echo $value['tab_title'];?></li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h3 class="text-secondary"><?php _e('The Bad','tfuse');?></h3>
                                    <div class="list-minus list-secondery">
                                        <ul>
                                            <?php foreach ($bad_list as $value):?>
                                                <li><?php echo $value['tab_title'];?></li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            <?php elseif(!empty($good_list[0]['tab_title'])):?>
                                <div class="col-sm-12">
                                    <h3 class="text-primary"><?php _e('The Good','tfuse');?></h3>
                                    <div class="list-plus list-primary">
                                        <ul>
                                            <?php foreach ($good_list as $value):?>
                                                <li><?php echo $value['tab_title'];?></li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            <?php elseif(!empty($bad_list[0]['tab_title'])):?>
                                <div class="col-sm-6">
                                    <h3 class="text-secondary"><?php _e('The Bad','tfuse');?></h3>
                                    <div class="list-minus list-secondery">
                                        <ul>
                                            <?php foreach ($bad_list as $value):?>
                                                <li><?php echo $value['tab_title'];?></li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                        <?php if(!empty($rating)):?>
                            <div class="rating"><?php echo $rating;?></div>
                        <?php endif;?>
                    </div>
            <!-- good and bad list -->
        <?php endif;?>
        <div class="clear"></div>
        <?php wp_link_pages(); ?>
        <?php if ( tfuse_options('disable_author_info') ) : ?>
            <?php get_template_part('content','author');?>
        <?php endif; ?>
    </div>

</article>
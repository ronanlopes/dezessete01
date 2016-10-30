<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Gameszone 1.0
 */

$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
$img_pos = tfuse_page_options('single_img_position');
?>
<article class="post post-details">
    <header class="entry-header">
        <?php if(!tfuse_page_options('hide_title')):?>
            <h1 class="entry-title"><?php echo get_the_title();?></h1>
        <?php endif;?>
        <div class="entry-meta">
            <?php _e('By ','tfuse');?><span class="author"><?php the_author_posts_link() ?></span>
            <?php _e(' on ','tfuse');?><time class="entry-date" datetime=""><?php echo get_the_date(); ?></time>
            <?php _e(' on ','tfuse');?><span class="cat-links"><?php echo tfuse_cat_links($post->post_type,$post->ID);?></span>
            <?php $tag = get_the_tags(); if (!empty($tag)):?>
                <span class="tag-links"><?php the_tags( '', ', ', '' ); ?></span>
            <?php endif;?>
        </div>
    </header>

    <div class="entry-meta-share">
        <script>
                (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.0";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="post-social fb-like" data-href="<?php the_permalink(); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>

        <div class="post-social">
                <a href="https://twitter.com/share" class="twitter-share-button" data-dnt="true" data-count="none" data-via="twitterapi">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>

        <div class="post-social">
                <g:plusone size="medium"></g:plusone>
                <script type="text/javascript">
                        window.___gcfg = {
                                lang: 'en-US'
                        };
                        (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                </script>
        </div>

        <span class="comments-link"><a href="<?php comments_link(); ?>" class="anchor"><i class="tficon-comment"></i> <?php comments_number("0", "1", "%"); ?></a></span>
    </div>
    <?php if($post->post_type == 'video'):?>
        <div class="video_embed" >
            <?php 
                $video = new TF_GET_EMBED(); 
                $o = $video->width()->height()->source('video_links')->get();
                
                echo $o;
            ?>
        </div>
    <?php else:?>
        <?php if(!empty($image)):?>
            <div class="post-thumbnail <?php echo $img_pos;?>" href="<?php the_permalink(); ?>"><img src="<?php echo $image;?>" alt=""/></div>
        <?php endif;?>
    <?php endif;?>
    <div class="entry-content">
        <?php the_content(); ?> 
        <div class="clear"></div>
        <?php wp_link_pages(); ?>
    </div>

</article>

<?php if ( tfuse_options('disable_author_info') ) : ?>
    <?php get_template_part('content','author');?>
<?php endif; ?>
<?php get_header(); ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<div class="main-top">
    <div class="main-top-inner">
        <?php 
            $game_id = tfuse_page_options('game_select');
            $game_id = explode(',',$game_id);
        ?>
        <!-- fullwith image -->
        <?php $video_link = tfuse_page_options('video_links');?>
        <?php $header_img = tfuse_page_options('game_header','',$game_id[0]);?>
        
        <div class="fullwidth-image" <?php echo (!empty($header_img)) ? 'style="background-image: url('.$header_img.')"' : ''?>>

            <div class="layer-full"></div><div class="layer-center"></div>

            <div class="fullwidth-content">
                
                <?php if(!empty($video_link)):?>
                    <div class="rating play-video"><i class="tficon-play"></i></div>
                <?php endif;?>
                <?php  while ( have_posts() ) : the_post();?>
                    <?php if(!empty($game_id)):
                        $id = $game_id[0]; ?>
                        <h2><?php echo get_the_title($id);?></h2>
                    <?php endif;?>

                    <div class="fullwidth-meta">
                        <?php _e('By ','tfuse');?> <span class="author"><?php the_author_posts_link() ?></span> 
                        <?php _e(' on ','tfuse');?> <time class="entry-date" datetime=""><?php echo get_the_date(); ?></time> 
                        <?php _e(' on ','tfuse');?> <span class="cat-links"><?php echo tfuse_review_cat_links($post->ID);?></span>
                    </div>
                <?php endwhile; // end of the loop. ?> 
            </div>
            
            <?php if(!empty($video_link)):?>
                <div class="top-video">
                    <span class="close-video"><?php _e('close','tfuse'); ?> [x]</span>
                    <?php 
                        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_link, $video_id);
                        
                        $findme   = 'vimeo.com';
                        $pos2 = strpos($video_link, $findme);
                        
                        if(!empty($video_id)) 
                            echo  '<iframe id="player" src="//www.youtube.com/embed/'.$video_id[0].'?enablejsapi=1" width="782" height="440" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        elseif ($pos2!='')
                            echo '<iframe id="player" src="'.$video_link.'" width="782" height="440" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        else 
                            echo '<iframe id="player" src="'.$video_link.'?enablejsapi=1" width="782" height="440" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                    ?>
                </div>
                    
                <?php if ($pos2!=''):?>
                    <script src="//f.vimeocdn.com/js_opt/froogaloop2.min.js"></script>
                        <script>
                            var iframe = document.getElementById('player');
                            // $f == Froogaloop
                            var player = $f(iframe);

                            jQuery(document).ready(function($) {
                                    $(".play-video").click(function() {
                                            $(".fullwidth-content").fadeOut(100);
                                            $(".layer-full").addClass("overlay");
                                            $(".top-video").fadeIn();
                                            player.api("play");
                                    });
                                    $(".close-video").click(function() {
                                            player.api("pause");
                                            $(".top-video").fadeOut(100);
                                            $(".layer-full").removeClass("overlay");
                                            $(".fullwidth-content").fadeIn(500);								
                                    });
                            });
                        </script>
                <?php else:?>
                    <script src="//www.youtube.com/player_api"></script>
                    <script>
		      var player;
		      function onYouTubeIframeAPIReady() {       
		       player = new YT.Player('player');       
		      }      
		      jQuery(document).ready(function(cash) {
		       $(".play-video").click(function() {
		        $(".fullwidth-content").fadeOut(100);
		        $(".layer-full").addClass("overlay");
		        $(".top-video").fadeIn(); 
		        player.playVideo();        
		       });
		       $(".close-video").click(function() {
		        player.stopVideo();
		        $(".top-video").fadeOut(100);
		        $(".layer-full").removeClass("overlay");
		        $(".fullwidth-content").fadeIn(500);        
		       });
		      });
                    </script>
                <?php endif;?>
                
            <?php endif;?>

        </div>
        <!-- fullwidth image -->

    </div>
</div><!-- .main-top -->

<?php
if(!empty($game_id)):
    $id = $game_id[0];
?>
    <div class="main-row main-row-bg main-row-slim">
        <div class="container">

            <ul class="nav top-tabs nav-justified">
                <li class="game_back_link"><a href="<?php echo get_permalink($id);?>"><i class="tficon-arrow-left-f"></i><?php _e('Back to Game','tfuse');?></a></li>
            </ul>

        </div>
    </div>
<?php endif;?>
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
                            <?php  while ( have_posts() ) : the_post();?>
                                    <?php get_template_part('content','single-review');?>
                            <?php endwhile; // end of the loop. ?> 
                            <?php if ( comments_open() ) : ?>
                               <?php  tfuse_comments(); ?>
                            <?php endif; ?>
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
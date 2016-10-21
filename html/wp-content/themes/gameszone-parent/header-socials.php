<?php $h_socials = tfuse_options('header_socials');?>
<?php if($h_socials == 'header' || $h_socials == 'both'):?>

    <?php
        $title = tfuse_options('header_socials_title'); 
        $fb = tfuse_options('header_facebook');
        $tw = tfuse_options('header_twitter');
        $db = tfuse_options('header_dribbble');
        $lk = tfuse_options('header_linkedin');
        $fl = tfuse_options('header_flickr');
    ?>
    <div class="header-socials">
        <?php if(!empty($title)):?>
            <span class="social-title"><?php echo $title;?></span>
        <?php endif;?>
        <span class="social-icons">
            <?php if(!empty($fb)):?>
                <a href="<?php echo $fb;?>" target="_blank" title="<?php _e('Facebook','tfuse');?>"><i class="tficon-facebook"></i> <span><?php _e('Facebook','tfuse');?></span></a>
            <?php endif;?>
            <?php if(!empty($tw)):?>
                <a href="<?php echo $tw;?>" target="_blank" title="<?php _e('Twitter','tfuse');?>"><i class="tficon-twitter"></i> <span><?php _e('Twitter','tfuse');?></span></a>
            <?php endif;?>
            <?php if(!empty($db)):?>
                <a href="<?php echo $db;?>" target="_blank" title="<?php _e('Dribbble','tfuse');?>"><i class="tficon-dribbble"></i> <span><?php _e('Dribbble','tfuse');?></span></a>
            <?php endif;?>
            <?php if(!empty($lk)):?>
                <a href="<?php echo $lk;?>" target="_blank" title="<?php _e('LinkedIn','tfuse');?>"><i class="tficon-linkedin"></i> <span><?php _e('LinkedIn','tfuse');?></span></a>
            <?php endif;?>
            <?php if(!empty($fl)):?>
                <a href="<?php echo $fl;?>" target="_blank" title="<?php _e('Flickr','tfuse');?>"><i class="tficon-flickr"></i> <span><?php _e('Flickr','tfuse');?></span></a>
            <?php endif;?>
        </span>
    </div>
<?php endif;?>
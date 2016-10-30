<?php $footer_widgets = tfuse_options('footer_widgets'); ?>

<?php if($footer_widgets):?>
    <div class="main-row main-row-bg-2 main-row-slim">
        <div class="container">
            <?php tfuse_footer(); ?>
        </div>
    </div>
<?php endif;?>
</div>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-footer-container">
            <div class="footer-info">
                <div class="footer-info-container">
                    
                    <div class="col-sm-8 copyright">
                        <?php echo tfuse_options('footer_copyright');?>
                    </div>
                    
                    <?php $footer_socials = tfuse_options('header_socials');?>
                    <?php if($footer_socials == 'footer' || $footer_socials == 'both'):?>
                    
                        <?php
                            $fb = tfuse_options('header_facebook');
                            $tw = tfuse_options('header_twitter');
                            $db = tfuse_options('header_dribbble');
                            $lk = tfuse_options('header_linkedin');
                            $fl = tfuse_options('header_flickr');
                        ?>
                        <div class="col-sm-4 footer-socials">
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

                </div>
            </div>

        </div>
    </footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
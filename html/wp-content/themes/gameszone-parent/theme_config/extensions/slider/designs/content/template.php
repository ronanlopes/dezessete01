<!-- carousel slider -->
<?php $uniq = rand(1,100);?>
<div class="carousel carousel-one">
    <ul id="carousel-one-<?php echo $uniq;?>">
        <?php foreach ($view_variables['slides'] as $slide):?>
            <?php if($view_variables['type'] == 'custom'):?>
                <li class="slide-item <?php echo ( $slide['slide_align_img'] == 'alignleft' ) ? '' : 'image-right';?>">
            <?php else:?>
                <li class="slide-item <?php echo $slide['slide_align_img'];?>">
            <?php endif;?>
                <div class="slide-image">
                    <?php if($view_variables['type'] == 'custom'):?>
                        <?php if(!empty($slide['slide_video'])):?>
                            <?php 
                                if ( !empty($slide['slide_video'])) :
                                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $slide['slide_video'], $video_id);
                                    if(!empty($video_id)) 
                                    echo  '<iframe src="//www.youtube.com/embed/'.$video_id[0].'?wmode=transparent" width="782" height="440" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                    elseif(strpos($slide['slide_video'],"iframe") == true)
                                        echo $slide['slide_video'];
                                    else echo '<iframe src="'.$slide['slide_video'].'" width="782" height="440" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                            ?>
                            <?php endif;?>
                        <?php else:?>
                            <a href="<?php echo $slide['slide_url'];?>"><img src="<?php echo $slide['slide_src'];?>" alt="<?php echo $slide['slide_title'];?>"/></a>
                        <?php endif;?>
                    <?php else:?>
                        <a href="<?php echo $slide['slide_url'];?>"><?php echo $slide['slide_src'];?></a>
                    <?php endif;?>
                </div>
                <div class="slide-content">
                    <h2><?php echo $slide['slide_title'];?></h2>
                    <p><?php echo $slide['slide_content'];?></p>
                    <a class="btn btn-primary" href="<?php echo $slide['slide_url'];?>"><?php _e('Read More','tfuse');?></a>
                </div>
            </li>
        <?php endforeach;?>
    </ul>

    <a href="#" class="prev"><i class="tficon-chevron-left"></i></a>
    <a href="#" class="next"><i class="tficon-chevron-right"></i></a>
</div>

<?php
    $auto = 'false';
    if(isset($view_variables['general']['slider_interval'])){
        if($view_variables['general']['slider_interval']>0){
            $auto = $view_variables['general']['slider_interval'];
        }
    }
?>
<script>
    jQuery(document).ready(function($) {

        function carouselInit(carousel) {
            carousel.carouFredSel({
                prev : {
                    button: function() {
                        return jQuery(this).parents(".carousel").find(".prev");
                    }
                },
                next : {
                    button: function() {
                        return jQuery(this).parents(".carousel").find(".next");
                    }
                },
                width: "100%",
                response: true,
                auto: <?php echo $auto; ?>,
                scroll: {
                    items: 1
                }
            });
        };
        var carousel1 = jQuery("#carousel-one-<?php echo $uniq;?>");
        carouselInit(carousel1);
        // on windows resize
        jQuery(window).resize(function() {
            carouselInit(carousel1);
        });
    });
</script>
<!-- carousel: small thumbs -->
<div class="carousel carousel-small">
    <ul id="carousel-small">
        <?php foreach ($view_variables['slides'] as $slide):?>
            <?php if(!empty($slide['slide_src'])):?>
                <li class="slide-item">
                    <a href="<?php echo $slide['slide_url'];?>"><?php echo $slide['slide_src'];?></a>
                    <div class="caption"><a href="<?php echo $slide['slide_url'];?>"><?php echo $slide['slide_title'];?></a></div>
                    <?php if($slide['slide_enable_rating']):?>
                        <span class="rating"><?php echo $slide['slide_rating'];?></span>
                    <?php endif;?>
                </li>
            <?php endif;?>
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
                        return $(this).parents(".carousel").find(".prev");
                    }
                },
                next : {
                    button: function() {
                        return $(this).parents(".carousel").find(".next");
                    }
                },
                width: '100%',
                height: "auto",
                auto: <?php echo $auto; ?>,
                scroll: {
                    items: 1
                }
            });
        };
        var carousel5 = jQuery("#carousel-small");
        carouselInit(carousel5);
        // on windows resize
        jQuery(window).resize(function() {
            carouselInit(carousel5);
        });
    });
</script>
<!-- carousel: small thumbs -->
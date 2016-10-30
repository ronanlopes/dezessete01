<div class="carousel carousel-medium">
    <ul id="carousel-medium">
        <?php foreach ($view_variables['slides'] as $slide):?>
            <li class="slide-item">
                <a href="<?php echo $slide['slide_url'];?>">
                    <?php if($view_variables['type'] == 'custom'):?>
                        <img src="<?php echo $slide['slide_src'];?>" alt=""/>
                    <?php else:?>
                        <?php echo $slide['slide_src'];?>
                    <?php endif;?>
                </a>
                <div class="caption"><a href="<?php echo $slide['slide_url'];?>"><?php echo $slide['slide_title'];?></a></div>
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
                width: '100%',
                height: "auto",
                auto: <?php echo $auto; ?>,
                scroll: {
                    items: 1
                }
            });
        };
        var carousel3 = jQuery("#carousel-medium");
        carouselInit(carousel3);
        // on windows resize
        jQuery(window).resize(function() {
            carouselInit(carousel3);
        });
    });
</script>
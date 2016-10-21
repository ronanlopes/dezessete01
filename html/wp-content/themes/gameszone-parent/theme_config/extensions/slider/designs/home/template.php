<?php $uniq = rand(1,100);?>
<div class="slider-full invisible" id="slider-full">

    <ul id="fullslider">
        <?php foreach ($view_variables['slides'] as $slide):?>
            <li class="slide-item" style="background-image: url(<?php echo $slide['slide_src'];?>);">
                <div class="layer-full"></div><div class="layer-center"></div>
                <div class="slide-content"  style="display:none;">
                    <h2 class="ani-item fadeInDown animated"><?php echo $slide['slide_title'];?></h2>
                    <p class="ani-item fadeInLeft animated"><?php echo $slide['slide_content'];?></p>
                    <div class="ani-item fadeInUp animated"><a class="btn btn-primary" href="<?php echo $slide['slide_url'];?>"><?php echo $slide['slide_button'];?></a></div>
                </div>
            </li>
        <?php endforeach;?>
    </ul>

    <div class="slider-controls">
        <div id="fullslider_pag" class="slider-pages"></div>
        <a href="#" id="fullslider_prev" class="prev"><i class="tficon-chevron-left"></i></a>
        <a href="#" id="fullslider_next" class="next"><i class="tficon-chevron-right"></i></a>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {

        jQuery('#slider-full').prepend('<img src="<?php echo $slide['slide_src'];?>" alt="" class="preloadimg hidden">');

        jQuery('.preloadimg').load(function(){
            jQuery(".preloadimg").remove();
            jQuery("#slider-full").removeClass("invisible");
            var fullslider = jQuery('#fullslider');
            fullslider.find(".slide-content").hide();

            fullslider.carouFredSel({
                pagination : "#fullslider_pag",
                prev : "#fullslider_prev",
                next: "#fullslider_next",
                auto : true,
                responsive: true,
                items: {
                    visible: 1/*,
                    width: 1920,
                    height: 230*/
                },
                onCreate: function (data) {
                    data.items.eq(0).addClass("current");
                    jQuery('#fullslider').children(".current").children(".slide-content").show();
                },
                scroll: {
                    pauseOnHover: true,
                    fx: "fade",
                    duration: 800,
                    timeoutDuration: <?php if(isset($view_variables['general']['slider_interval'])) echo $view_variables['general']['slider_interval']; else echo '10000';?>,
                    onBefore: function (data) {
                        data.items.old.removeClass("current");
                        jQuery('#fullslider').find(".slide-content").hide();
                    },
                    onAfter: function (data) {
                        data.items.visible.eq(0).addClass("current");
                        jQuery('#fullslider').children(".current").children(".slide-content").show();
                    }
                }

            });
        });

    });
</script>
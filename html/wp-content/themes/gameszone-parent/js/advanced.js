jQuery(document).ready(function($) {
   
    
    jQuery('.over_thumb ').bind('click', function(){
 
       window.setTimeout(function(){
           var sel = jQuery('#slider_design_type').val(); 
           if(sel == 'carousel_medium' || sel == 'content' || sel == 'home'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option><option value="categories">Automatically, fetch images from categories</option><option value="posts">Automatically, fetch images from posts</option>');            }
            else if(sel == 'carousel' || sel == 'video')
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type<option value="categories">Automatically, fetch images from categories</option><option value="posts">Automatically, fetch images from posts</option>');
            }
               
       },12);
    });

    /*-----------------------------------------*/

   

jQuery('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = jQuery(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });

  

    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 $("#slider_slideSpeed,#slider_play,#slider_pause,#gameszone_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    jQuery('#gameszone_map_lat,#gameszone_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

   

    var options = new Array();
    
    options['sliders_posts_from'] = jQuery('#sliders_posts_from').val();
    jQuery('#sliders_posts_from').bind('change', function() {
        options['sliders_posts_from'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gameszone_rating_type'] = jQuery('#gameszone_rating_type').val();
    jQuery('#gameszone_rating_type').bind('change', function() {
        options['gameszone_rating_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gameszone_logo_type'] = jQuery('#gameszone_logo_type').val();
    jQuery('#gameszone_logo_type').bind('change', function() {
        options['gameszone_logo_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gameszone_header_socials'] = jQuery('#gameszone_header_socials').val();
    jQuery('#gameszone_header_socials').bind('change', function() {
        options['gameszone_header_socials'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gameszone_homepage_category'] = jQuery('#gameszone_homepage_category').val();
    jQuery('#gameszone_homepage_category').bind('change', function() {
        options['gameszone_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    //blog page
    options['gameszone_blogpage_category'] = jQuery('#gameszone_blogpage_category').val();
     jQuery('#gameszone_blogpage_category').bind('change', function() {
         options['gameszone_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('#gameszone_pegi,#gameszone_esrb,.categories_select_video,.posts_select_video,.categories_select_category,.posts_select_post,.categories_select_game,.categories_select_review,.posts_select,.posts_select_review,#gameszone_logo,#gameszone_logo_text,#gameszone_home_page,#gameszone_categories_select_categ,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('#gameszone_home_page,#gameszone_categories_select_categ,.homepage_category_header_element').parents('.form-field').hide();        
        
         //logo type select
        if(options['gameszone_rating_type']=='esrb')
            jQuery('#gameszone_esrb').parents('.option-inner').show();
        else
            jQuery('#gameszone_pegi').parents('.option-inner').show();


        //carousel slider select
        if(options['sliders_posts_from']=='game')
        {
            jQuery('.posts_select').parents('.option-inner').show();
            jQuery('.categories_select_game').parents('.option-inner').show();
        }
        else if(options['sliders_posts_from']=='video')
        {
            jQuery('.posts_select_video').parents('.option-inner').show();
            jQuery('.categories_select_video').parents('.option-inner').show();
        }
        else if(options['sliders_posts_from']=='post')
        {
            jQuery('.posts_select_post').parents('.option-inner').show();
            jQuery('.categories_select_category').parents('.option-inner').show();
        }
        else
        {           
            jQuery('.posts_select_review,.categories_select_review').parents('.option-inner').show();
        }

        //logo type select
        if(options['gameszone_logo_type']=='text')
            jQuery('#gameszone_logo_text').parents('.option-inner').show();
        else
            jQuery('#gameszone_logo').parents('.option-inner').show();
        
        //socials in header and footer
        if(options['gameszone_header_socials']=='no')
        {
            jQuery('#gameszone_header_socials_title,#gameszone_header_facebook,#gameszone_header_twitter,#gameszone_header_dribbble,#gameszone_header_linkedin,#gameszone_header_flickr').parents('.option-inner').hide();
            jQuery('.gameszone_header_socials,.gameszone_header_socials_title').next().hide();
        }
        else if (options['gameszone_header_socials']=='both' || options['gameszone_header_socials']=='header')
        {
            jQuery('#gameszone_header_socials_title,#gameszone_header_facebook,#gameszone_header_twitter,#gameszone_header_dribbble,#gameszone_header_linkedin,#gameszone_header_flickr').parents('.option-inner').show();
            jQuery('.gameszone_header_socials,.gameszone_header_socials_title').next().show();
        }
        else
        {
            jQuery('#gameszone_header_socials_title').parents('.option-inner').hide()
            jQuery('#gameszone_header_facebook,#gameszone_header_twitter,#gameszone_header_dribbble,#gameszone_header_linkedin,#gameszone_header_flickr').parents('.option-inner').show();
            jQuery('.gameszone_header_socials_title').next().hide();
        }
        
        
        /*--------------------------------------------------*/

        //homepage
       if(options['gameszone_homepage_category']=='specific'){
            jQuery('.gameszone_display_type_home').show();
            jQuery('.gameszone_categories_select_categ').next().show();
            jQuery('#gameszone_categories_select_categ').parents('.option-inner').show();
            jQuery('#gameszone_categories_select_categ').parents('.form-field').show();
            
            jQuery('#gameszone_content_top').parents('.postbox').show();
        }
        else if (options['gameszone_homepage_category']=='all')
        {
            jQuery('.gameszone_display_type_home').show();
            jQuery('.gameszone_categories_select_categ').next().show();
            if($('#gameszone_use_page_options').is(':checked')) 
                jQuery('#homepage-header,#homepage-shortcodes').removeAttr('style');
            
            jQuery('#gameszone_content_top').parents('.postbox').show();
        }
        else if(options['gameszone_homepage_category']=='page'){
            jQuery('#gameszone_home_page').parents('.option-inner').show();
            jQuery('#gameszone_home_page').parents('.form-field').show();
            jQuery('.gameszone_categories_select_categ').next().hide();
            
            jQuery('#gameszone_content_top').parents('.postbox').hide();
        } 
        
        
        //blog page
        if(options['gameszone_blogpage_category']=='all'){
            jQuery('.gameszone_categories_select_categ_blog').hide();
        }
        else if(options['gameszone_blogpage_category']=='specific'){
            jQuery('.gameszone_categories_select_categ_blog').show();
        } 
    }
});
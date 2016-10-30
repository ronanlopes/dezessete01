function custom_generator_room_types(type,options) {
    shortcode='[room_types reservation="'+options['reservation']+'"]';
    for(i in options.array) {
        shortcode+='[room_typ post="'+options.array[i]['post']+'" subtitle="' + options.array[i]['subtitle']  + '" desc="' + options.array[i]['desc']  + '" ][/room_typ]';
    }
    shortcode+='[/room_types]';
    return shortcode;
}

function custom_obtainer_room_types(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['reservation']= opt_get('tf_shc_room_types_reservation',cont);
    
    cont.find('[name="tf_shc_room_types_post"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        post=opt_get(jQuery(this).attr('name'),div); 
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_room_types_desc"]').first().parents('.option');
        desc=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_room_types_desc"]').first().attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_room_types_subtitle"]').first().parents('.option');
        subtitle=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_room_types_subtitle"]').first().attr('name'),div);        tmp={};
        
        
        tmp['post']=post;
        tmp['desc']=desc;
        tmp['subtitle']=subtitle;
        
        
        sh_options['array'].push(tmp);
        });
    
    return sh_options;
}


function custom_generator_slideshow(type,options) {
    shortcode='[slideshow type_size="'+options['type_size']+'"]';
    for(i in options.array) {
        shortcode+="[slide type='"+options.array[i]["type"]+"' content='" + options.array[i]["content"] +"'"+"][/slide]";
    }
    shortcode+='[/slideshow]';
    return shortcode;
}

function custom_obtainer_slideshow(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['type_size']= opt_get('tf_shc_slideshow_type_size',cont);

    cont.find('[name="tf_shc_slideshow_type"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        type=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_slideshow_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_slideshow_content"]').first().attr('name'),div);
        
        tmp={};
        
        tmp['type']=type;
        tmp['content']=content;
        
        sh_options['array'].push(tmp);
    });
    
    return sh_options;
}



function custom_generator_tickets(type,options) {
    shortcode='[tickets title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+='[ticket tickettitle="'+options.array[i]['tickettitle']+'" price="' + options.array[i]['price'] +'" desc="' + options.array[i]['desc'] + '" available="' + options.array[i]['available'] + '" link="' + options.array[i]['link'] + '"][/ticket]';
    }
    shortcode+='[/tickets]';
    return shortcode;
}

function custom_obtainer_tickets(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_option={};
    sh_option['array']=[];
    sh_option['title']= opt_get('tf_shc_tickets_title',cont);

    cont.find('[name="tf_shc_tickets_tickettitle"]').each(function(i)
    { 
        div=jQuery(this).parents('.option');
        tickettitle=opt_get(jQuery(this).attr('name'),div);   
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_desc"]').first().parents('.option');
        desc=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_desc"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_available"]').first().parents('.option');
        available=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_available"] option:selected').val();
  
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_price"]').first().parents('.option');
        price=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_price"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_link"]').first().parents('.option');
        link=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tickets_link"]').first().attr('name'),div);
        
        tm={};
        tm['tickettitle']=tickettitle;
        tm['available']=available;
        tm['desc']=desc;
        tm['price']=price;
        tm['link']=link;
        
        sh_option['array'].push(tm);
        
        });
    
    return sh_option;
}


function custom_generator_resources(type,options) {
    shortcode='[resources]';
    for(i in options.array) {
        shortcode+='[resource cat="'+options.array[i]['cat']+'" title="' + options.array[i]['title']  + '" icon="' + options.array[i]['icon']  + '" icon_hover="' + options.array[i]['icon_hover']  + '"  '+'][/resource]';
    }
    shortcode+='[/resources]';
    return shortcode;
}

function custom_obtainer_resources(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    cont.find('[name="tf_shc_resources_cat"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        cat=opt_get(jQuery(this).attr('name'),div); 
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_resources_title"]').first().parents('.option');
        title=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_resources_title"]').first().attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_resources_icon"]').first().parents('.option');
        icon=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_resources_icon"]').first().attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_resources_icon_hover"]').first().parents('.option');
        icon_hover=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_resources_icon_hover"]').first().attr('name'),div);
        
        tmp={};
        tmp['title']=title;
        tmp['icon']=icon;
        tmp['icon_hover']=icon_hover;
        tmp['cat']=cat;
        
        
        sh_options['array'].push(tmp);
        });
    
    return sh_options;
}
function custom_generator_partners(type,options) {
    shortcode='[partners title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+='[partner src="'+options.array[i]['src']+'" link="' + options.array[i]['link'] + '" '+'][/partner]';
    }
    shortcode+='[/partners]';
    return shortcode;
}

function custom_obtainer_partners(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']= opt_get('tf_shc_partners_title',cont);

    cont.find('[name="tf_shc_partners_src"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        src=opt_get(jQuery(this).attr('name'),div); 

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_partners_link"]').first().parents('.option');
        link=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_partners_link"]').first().attr('name'),div);
        
        tmp={};
        
        tmp['src']=src;
        tmp['link']=link;
        
        
        sh_options['array'].push(tmp);
        });
    
    return sh_options;
}


function custom_generator_imagegallery(type,options) {
    shortcode='[imagegallery width="'+options['width']+'" height="'+options['height']+'"]';
    for(i in options.array) {
        shortcode+="[image title='"+options.array[i]["title"]+"' src='" + options.array[i]["src"] +"'"+"][/image]";
    }
    shortcode+='[/imagegallery]';
    return shortcode;
}

function custom_obtainer_imagegallery(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['width']= opt_get('tf_shc_imagegallery_width',cont);
    sh_options['height']= opt_get('tf_shc_imagegallery_height',cont);

    cont.find('[name="tf_shc_imagegallery_title"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_imagegallery_src"]').first().parents('.option');
        src=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_imagegallery_src"]').first().attr('name'),div);

        tmp={};

        tmp['title']=title;
        tmp['src']=src;

        sh_options['array'].push(tmp);
    });

    return sh_options;
}

function custom_generator_faq(type,options) {
    shortcode='[faq title="'+options.title+'"]';
    for(i in options.array) {
        shortcode+='[faq_question]'+options.array[i]['question']+'[/faq_question]';
        shortcode+='[faq_answer]'+options.array[i]['answer']+'[/faq_answer]';
    }
    shortcode+='[/faq]';
    return shortcode;
}

function custom_obtainer_faq(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']=opt_get('tf_shc_faq_title',cont);
    cont.find('[name="tf_shc_faq_question"]').each(function(i) {
        question=jQuery(this).val();
        answer=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_faq_answer"]:first').val();
        tmp={};
        tmp['question']=question;
        tmp['answer']=answer;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

function custom_generator_tabs(type,options) {
    shortcode='[tabs class="'+options['class']+'" size="'+options['size']+'"]';
    for(i in options.array) {
        shortcode+='[tab active="'+options.array[i]['active']+'" title="'+options.array[i]['title']+'"]'+options.array[i]['content']+'[/tab]';
    }
    shortcode+='[/tabs]';
    return shortcode;
}

function custom_obtainer_tabs(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['class']= opt_get('tf_shc_tabs_class',cont);
    sh_options['size']= opt_get('tf_shc_tabs_size');
    cont.find('[name="tf_shc_tabs_title"]').each(function(i) {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().attr('name'),div);
        active=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_active"] option:selected').val();
        tmp={};
        tmp['title']=title;
        tmp['active']=active;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

jQuery(document).ready(function($) {
    var $=jQuery;
    
    $('#tf_rf_display').live('change',function () {
        val = $(this).val();
        if(val !='popup')
            $('.tf_rf_button,.tf_rf_color').hide();
        else
            $('.tf_rf_button,.tf_rf_color').show();
    });

    $('#tf_shc_prettyPhoto_type').live('change',function () {
        val = $(this).val();
        if(val !='image')
            $('.tf_shc_prettyPhoto_thumb').hide();
        else
            $('.tf_shc_prettyPhoto_thumb').show();
    });

    $('#tf_shc_text_styles_type').live('change',function () {
        val = $(this).val();
        if(val !='link')
            $('.tf_shc_text_styles_link,.tf_shc_text_styles_target').hide();
        else
            $('.tf_shc_text_styles_link,.tf_shc_text_styles_target').show();
    });
    
    
     $('#tf_shc_toggle_content_type').live('change',function () {
        val = $(this).val();
        if(val =='simple')
        {
            $('.tf_shc_toggle_content_class').hide();
            $('.tf_shc_toggle_content_box').show();
        }
        else if(val == 'accordion')
        {
             $('.tf_shc_toggle_content_box').hide();
             $('.tf_shc_toggle_content_class').show();
        }
        else if(val == 'default')
        {
            $('.tf_shc_toggle_content_class').show();
            $('.tf_shc_toggle_content_box').show();
        }
    });
});

jQuery(document).ready(function($) {
    
     jQuery(document).on('change','#tf_shc_section_sect',function () {
        val = $(this).val();
        if(val =='top')
            jQuery('.tf_shc_section_bg,.tf_shc_section_row').hide();
        else
            jQuery('.tf_shc_section_bg,.tf_shc_section_row').show();
    });
    
});
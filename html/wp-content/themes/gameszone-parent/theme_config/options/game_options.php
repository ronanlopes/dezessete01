<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */
     /* Post Media */
    array('name' => __('Game Info', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Published by','tfuse'),
        'desc' => __('Game Published by..','tfuse'),
        'id' => TF_THEME_PREFIX . '_published',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Published by Link','tfuse'),
        'desc' => __('Game Published by link','tfuse'),
        'id' => TF_THEME_PREFIX . '_published_link',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Developed by','tfuse'),
        'desc' => __('Game Developed by..','tfuse'),
        'id' => TF_THEME_PREFIX . '_developed',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Developed by Link','tfuse'),
        'desc' => __('Game Developed by link','tfuse'),
        'id' => TF_THEME_PREFIX . '_developed_link',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Short Description','tfuse'),
        'desc' => __('Game Short Description','tfuse'),
        'id' => TF_THEME_PREFIX . '_description',
        'value' => '',
        'type' => 'textarea',
        'divider' => true
    ),
    array('name' => __('Rating System','tfuse'),
        'desc' => __(' Please select the game rating system','tfuse'),
        'id' => TF_THEME_PREFIX . '_rating_type',
        'value' => '',
        'options' => array('esrb' => 'ESRB','pegi' => 'PEGI'),
        'type' => 'select'
    ),
    array('name' => __('ESRB Rating','tfuse'),
        'desc' => __('Game ESRB rating','tfuse'),
        'id' => TF_THEME_PREFIX . '_esrb',
        'value' => '',
        'options' => array('c' => __('EC - EARLY CHILDHOOD','tfuse'),'e' => __('E - EVERYONE','tfuse'),
            'et' => __('E - EVERYONE 10+','tfuse'),'t' => __('T - TEEN','tfuse'),'m' => __('M - MATURE','tfuse'),
            'a' => __('AO - ADULTS ONLY','tfuse'),'rp' => __('RP - RATING PENDING','tfuse')),
        'type' => 'select'
    ),
    array('name' => __('PEGI Rating','tfuse'),
        'desc' => __('Game PEGI rating','tfuse'),
        'id' => TF_THEME_PREFIX . '_pegi',
        'value' => '3',
        'options' => array('3' => 'PEGI 3','7' => 'PEGI 7',
            '12' => 'PEGI 12','16' => 'PEGI 16','18' => 'PEGI 18'),
        'type' => 'select'
    ),
    
        
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Header Image','tfuse'),
        'desc' => __('Upload game post header image','tfuse'),
        'id' => TF_THEME_PREFIX . '_game_header',
        'value' => '',
        'type' => 'upload',
        'divider' => true
    ),
    array('name' => __('Rating','tfuse'),
        'desc' => __('Give your rating for this game..','tfuse'),
        'id' => TF_THEME_PREFIX . '_rating',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Shortcodes on Top','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_on_top',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
);

?>
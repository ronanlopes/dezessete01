<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */   
    /* Post Media */
    array('name' => __('Media','tfuse'),
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Custom Post Video
    array('name' => __('Video','tfuse'),
        'desc' => __('Copy paste the video URL or embed code. The video URL works only for Vimeo and YouTube videos. Read ','tfuse').'<a target="_blank" href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">'.__('prettyPhoto documentation','tfuse').'</a> '.__('for more info on how to add video or flash in this text area','tfuse').'',
        'id' => TF_THEME_PREFIX . '_video_links',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Video Settings', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Select Game','tfuse'),
        'desc' => __('Select game post for this video post by starting typing game post title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_game_select',
        'value' => '',
        'type' => 'multi',
        'limit' => 1,
        'subtype' => 'game'
    ),
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Hide Title','tfuse'),
        'desc' => __('Hide title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_hide_title',
        'value' => '',
        'type' => 'checkbox',
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
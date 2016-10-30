<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */
    array('name' => __('Event Settings', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),

	 array('name' => __('Beginning Hour','tfuse'),
        'desc' => __('Select event beginning hour.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_hour_min',
        'value' => '',
        'type' => 'callback',
        'callback'	=> 'select_hour'
    ),
	
	array('name' => __('End Hour','tfuse'),
        'desc' => __('Select event end hour.','tfuse'),
        'id' => TF_THEME_PREFIX . '_end_hour_min',
        'value' => '',
        'type' => 'callback',
        'callback'	=> 'select_hour_end'
    ),
    array('name' => __('Select day','tfuse'),
        'desc' => __('Select event date.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_date',
        'value' => '',
        'type' => 'datepicker'
    ),

    // Element of Hedear
    array('name' => __('Repeat','tfuse'),
        'desc' => __('Select type of event repetition.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_repeat',
        'value' => 'no',
        'options' => array('no' => __('No Repeat','tfuse'),'day' => __('Every day','tfuse'),'week' => __('Every week','tfuse'),'month' => __('Every month','tfuse'),'year' => __('Every year','tfuse')),
        'type' => 'select'
    ),
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Hide title','tfuse'),
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
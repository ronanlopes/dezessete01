<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    array('name' => __('Posts Type','tfuse'),
        'desc' => __('Choose with download button if you need to upload a file for users to download. Used for walkthroughs, guides','tfuse'),
        'id' => TF_THEME_PREFIX . '_guides_posts',
        'value' => '',
        'options' => array('simple' => __('Default View','tfuse'),'download' => __('With Download Button','tfuse')),
        'type' => 'select'
    ),
   array('name' => __('Shortcodes on Top','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_on_top',
        'value' => '',
        'type' => 'textarea'
    ),
   // Bottom Shortcodes
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
   
);

?>
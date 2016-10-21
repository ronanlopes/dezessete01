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
        'desc' => __('Copy paste the video URL or embed code. The video URL works only for Vimeo and YouTube videos','tfuse'),
        'id' => TF_THEME_PREFIX . '_video_links',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Review Settings', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Select Game','tfuse'),
        'desc' => __('Select game post for this review by starting typing game post title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_game_select',
        'value' => '',
        'type' => 'multi',
        'limit' => 1,
        'subtype' => 'game',
        'divider' => true
    ),
    array('name' => __('Rating','tfuse'),
        'desc' => __('Give your rating for this review..','tfuse'),
        'id' => TF_THEME_PREFIX . '_rating',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Featured','tfuse'),
        'desc' => __('Set as featured review.','tfuse'),
        'id' => TF_THEME_PREFIX . '_featured',
        'value' => false,
        'type' => 'checkbox',
        'divider' => true
    ),
    array(
        'name' => __('The Good List','tfuse'),
            'id' => TF_THEME_PREFIX . '_content_tabs_table',
            'desc' => __('Add the good list items.','tfuse'),
            'btn_labels'=>array('Add Row','Delete Row'),
            'class' => 'tf-post-table ',
            'style' => '',
            'default_value' => array(
                'tab_title'=>'',
                'tab_content'=>''
            ),
            'value' => array(
                array(
                    'tab_title'=>'',
                    'tab_content'=>''
                )
            ),
            'type' => 'div_table',
            'columns' => array(
                array(
                    'id' =>  'tab_title',
                    'type' => 'text',
                    'properties' => array('placeholder' => __('Add Item', 'tfuse'))
                )
            ),
            'divider' => true
        ),
    array(
        'name' => __('The Bad List','tfuse'),
            'id' => TF_THEME_PREFIX . '_content_tabs_table_s',
            'desc' => __('Add the bad list items.','tfuse'),
            'btn_labels'=>array('Add Row','Delete Row'),
            'class' => 'tf-post-table ',
            'style' => '',
            'default_value' => array(
                'tab_title'=>'',
                'tab_content'=>''
            ),
            'value' => array(
                array(
                    'tab_title'=>'',
                    'tab_content'=>''
                )
            ),
            'type' => 'div_table',
            'columns' => array(
                array(
                    'id' =>  'tab_title',
                    'type' => 'text',
                    'properties' => array('placeholder' => __('Add Item', 'tfuse'))
                )
            )
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
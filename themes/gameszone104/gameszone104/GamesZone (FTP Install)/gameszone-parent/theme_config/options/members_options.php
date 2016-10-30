<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */

  
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Media */
    array('name' => __('Memeber Info','tfuse'),
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Twitter User Id','tfuse'),
        'desc' => __('Twitter User Id.','tfuse'),
        'id' => TF_THEME_PREFIX . '_member_id',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Twitter Link','tfuse'),
        'desc' => __('Twitter Link.','tfuse'),
        'id' => TF_THEME_PREFIX . '_member_link',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Email','tfuse'),
        'desc' => __('Member Email.','tfuse'),
        'id' => TF_THEME_PREFIX . '_member_email',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Phone Number','tfuse'),
        'desc' => __('Member Phone Number.','tfuse'),
        'id' => TF_THEME_PREFIX . '_member_phone',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    array('name' => __('Job','tfuse'),
        'desc' => __('Member Job.','tfuse'),
        'id' => TF_THEME_PREFIX . '_member_job',
        'value' => '',
        'type' => 'text'
    ),
);

?>
<?php

/**
 * WARNING: This file is part of the core ThemeFuse Framework. It is not recommended to edit this section
 *
 * @package ThemeFuse
 * @since 2.0
 */
require_once(get_template_directory() . '/framework/BootsTrap.php');
require_once(get_template_directory() . '/theme_config/theme_includes/AJAX_CALLBACKS.php');


if (!function_exists('tfuse_delete_type_metabox')):
    if(is_admin()){
       
        function tfuse_delete_type_metabox()
        {
            remove_meta_box('typesdiv', 'room', 'side');
        }
         add_action('admin_menu', 'tfuse_delete_type_metabox');
    }
endif;
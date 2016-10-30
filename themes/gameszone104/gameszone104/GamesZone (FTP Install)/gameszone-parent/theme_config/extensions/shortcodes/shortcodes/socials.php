<?php

/**
 * HighLight
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * class: custom css class e.g. highlight_yellow, highlight_brown, highlight_blue, highlight_black, highlight_purple
 * style: custom css style e.g. color:#ffffff; background:#cc1d00
 */
function tfuse_socials($atts, $content) {
    extract(shortcode_atts(array('fb' => '', 'tw' => '','fl' => '', 'db' => '','go' => '', 'lk' => ''), $atts));
    
    $out = '';
    
    $out .= '<div class="widget widget-socials widget-boxed-2">
                <span class="social-icons">';
    
    if(!empty($fb))
        $out .= '<a href="'.$fb.'" target="_blank" title="'.__('Facebook','tfuse').'"><i class="tficon-facebook"></i> <span>'.__('Facebook','tfuse').'</span></a>';
    
    if(!empty($tw))
        $out .= '<a href="'.$tw.'" target="_blank" title="'.__('Twitter','tfuse').'"><i class="tficon-twitter"></i> <span>'.__('Twitter','tfuse').'</span></a>';
    
    if(!empty($db))
        $out .= '<a href="'.$db.'" target="_blank" title="'.__('Dribbble','tfuse').'"><i class="tficon-dribbble"></i> <span>'.__('Dribbble','tfuse').'</span></a>';
    
    if(!empty($lk))
        $out .= '<a href="'.$lk.'" target="_blank" title="'.__('LinkedIn','tfuse').'"><i class="tficon-linkedin"></i> <span>'.__('LinkedIn','tfuse').'</span></a>';
    
    if(!empty($fl))
        $out .= '<a href="'.$fl.'" target="_blank" title="'.__('Flickr','tfuse').'"><i class="tficon-flickr"></i> <span>'.__('Flickr','tfuse').'</span></a>';
    
    if(!empty($go))
        $out .= '<a href="'.$go.'" target="_blank" title="'.__('Google +','tfuse').'"><i class="tficon-google-plus"></i> <span>'.__('Google +','tfuse').'</span></a>';

    $out .= '   </span>
            </div>';

    return $out;
}

$atts = array(
    'name' => __('Socials','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Facebook','tfuse'),
            'desc' => __('Facebook Link','tfuse'),
            'id' => 'tf_shc_socials_fb',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Twitter','tfuse'),
            'desc' => __('Twitter Link','tfuse'),
            'id' => 'tf_shc_socials_tw',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Dribbble','tfuse'),
            'desc' => __('Dribbble Link','tfuse'),
            'id' => 'tf_shc_socials_db',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('LinkedIn','tfuse'),
            'desc' => __('LinkedIn Link','tfuse'),
            'id' => 'tf_shc_socials_lk',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Flickr','tfuse'),
            'desc' => __('Flickr Link','tfuse'),
            'id' => 'tf_shc_socials_fl',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Google+','tfuse'),
            'desc' => __('Google+ Link','tfuse'),
            'id' => 'tf_shc_socials_go',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('socials', 'tfuse_socials', $atts);

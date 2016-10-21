<?php
function tfuse_section($atts, $content = null) {
    
    extract(shortcode_atts(array('bg' => '','sect' => '' ,'row' => ''), $atts));
        
    $output = '';
    
    switch($bg)
    {
        case 'default' : $back = ''; break;
        case 'white' : $back = 'main-row-bg'; break;
        default : $back = ''; break;
    }
    
    switch($row)
    {
        case 'thin' : $row_type = 'main-row-thin'; break;
        case 'slim' : $row_type = 'main-row-slim'; break;
        default : $row_type = ''; break;
    }
    
    if($sect == 'top')
    {
        $output .=  '<div class="main-top">
            <div class="main-top-inner">';
            $output .= do_shortcode($content);
        $output .= '</div></div>';
    }
    else 
    {
        $output .=  '<div class="main-row '.$back.' '.$row_type.'">
            <div class="container">';
            $output .= do_shortcode($content);
        $output .= '</div></div>';
    }
        
    
    

    
    return $output;
}

$atts = array(
    'name' => __('Section', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Section', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_sect',
            'value' => 'row',
            'options' => array('row' => __('Row Section','tfuse'),'top' => __('Top Section','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Background', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_bg',
            'value' => 'default',
            'options' => array('default' => __('Default','tfuse'),'white' => __('White Background','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Row', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_row',
            'value' => 'default',
            'options' => array('default' => __('Default','tfuse'),'thin' => __('Thin','tfuse'),'slim' => __('Slim','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_content',
            'value' => '',
            'type' => 'textarea',
        ),

    )
);

tf_add_shortcode('section', 'tfuse_section', $atts);
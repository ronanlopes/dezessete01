<?php
function tfuse_text_info($atts, $content = null)
{
    extract( shortcode_atts(array('link' => '','img' => '','color' => '', 'title' => '','link_title' => ''), $atts) );
    
    $out = '<div class="block-item">
                    <div class="block-image">
                        <img src="'.TF_GET_IMAGE::get_src_link($img,300,280).'" alt=""/>
                        <div class="block-caption"><h2 style="color:'.$color.'">'.$title.'</h2></div>
                    </div>
                    <div class="block-aside">
                        '.do_shortcode($content).'
                    </div>
                    <div class="block-meta">
                        <a href="'.$link.'">'.$link_title.'</a>
                    </div>
            </div>';
    
    
    return $out;
}

$atts = array(
    'name' => __('Info', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Shortcode Title','tfuse'),
            'id' => 'tf_shc_text_info_title',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Shortcode Image','tfuse'),
            'id' => 'tf_shc_text_info_img',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Description','tfuse'),
            'desc' => __('Short description','tfuse'),
            'id' => 'tf_shc_text_info_content',
            'value' => '',
            'type' => 'textarea',
            'divider' => true
        ),
        array(
            'name' => __('Link title','tfuse'),
            'desc' => __('Shortcode link title','tfuse'),
            'id' => 'tf_shc_text_info_link_title',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Color','tfuse'),
            'desc' => __('Link Title Color','tfuse'),
            'id' => 'tf_shc_text_info_color',
            'value' => '',
            'type' => 'colorpicker',
            'divider' => true
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Shortcode custom link','tfuse'),
            'id' => 'tf_shc_text_info_link',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
    )
);

tf_add_shortcode('text_info', 'tfuse_text_info', $atts);

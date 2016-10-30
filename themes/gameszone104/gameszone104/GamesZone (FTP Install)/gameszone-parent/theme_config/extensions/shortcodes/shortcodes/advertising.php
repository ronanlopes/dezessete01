<?php
//Advertising Shortcode
function tfuse_ad($atts, $content = null) 
{
    extract(shortcode_atts(array( 'type' => '',
                                'src' => '',
                                'link' => '',
                                'adsense' => '',
                                'align' => ''), $atts));
	$out ='';
    switch(strtolower($type))
    {
        case '728x90':
            $before = '<div class="adv-728 '.$align.'">';
            $after = '</div>';
			$width = 'width="728"';
			$height = 'height="90"';
            break;
        case '336x280':
            $before = '<div class="adv-336 '.$align.'">';
            $after = '</div>';
			$width = 'width="336"';
			$height = 'height="280"';
            break;
        case '300x250':
            $before = '<div class="adv-300 '.$align.'">';
            $after = '</div>';
			$width = 'width="300"';
			$height = 'height="250"';
            break;
        case '250x250':
            $before = '<div class="adv-250 '.$align.'">';
            $after = '</div>';
			$width = 'width="250"';
			$height = 'height="250"';
            break;
        case '468x60': 
            $before = '<div class="adv-468 '.$align.'">';
            $after = '</div>';
			$width = 'width="468"';
			$height = 'height="60"';
            break;
        case '125x125':
            $before = '<div class="adv-125 '.$align.'">';
            $after = '</div>';
			$width = 'width="125"';
			$height = 'height="125"';
            break;
        default: $before =  $after = $width = $height = '';
            break;
    }
	if(!empty($adsense))
	{
		$out .= '<div class="adv_content">'.$adsense.'</div>';
	}
	elseif(empty($adsense) && !empty($src))
	{
		$out .= $before.'<a href="'.$link.'"><img src="'.$src.'" '.$width. $height.' alt=""></a>'.$after;
	}
	return $out;
}

$atts = array(
    'name' => __('Advertising', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Type', 'tfuse'),
            'desc' => __('Specify the type of your ad.', 'tfuse'),
            'id' => 'tf_shc_ad_type',
            'value' => 'ad_300x250',
            'options' => array(
                '728x90' => 'ad_728x90',
                '336x280' => 'ad_336x280',
                '300x250' => 'ad_300x250',
                '250x250' => 'ad_250x250',
                '468x60' => 'ad_468x60',
                '125x125' => 'ad_125x125',
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Align', 'tfuse'),
            'desc' => __('Ad Alignment.', 'tfuse'),
            'id' => 'tf_shc_ad_align',
            'value' => '',
            'options' => array(
                '' => 'No Align',
                'aligncenter' => 'Center',
                'alignleft' => 'Left',
                'alignright' => 'Right'
            ),
            'type' => 'select'
        ),
		array(
            'name' => __('Image Location', 'tfuse'),
            'desc' => __('Image Location.', 'tfuse'),
            'id' => 'tf_shc_ad_src',
            'value' => '',
            'type' => 'text'
        ),
		array(
            'name' => __('Target link', 'tfuse'),
            'desc' => __('Target link.', 'tfuse'),
            'id' => 'tf_shc_ad_link',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Adsense', 'tfuse'),
            'desc' => __('Ad your adsense code.', 'tfuse'),
            'id' => 'tf_shc_ad_adsense',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('ad', 'tfuse_ad', $atts);
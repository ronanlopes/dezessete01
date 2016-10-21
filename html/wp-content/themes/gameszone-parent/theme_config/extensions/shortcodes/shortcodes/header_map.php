<?php
function tfuse_shortcode_header_map($atts, $content = null)
{
    extract(shortcode_atts(array('location' => '','address' => '','email' => '','phone' => '','zoom' => ''), $atts));
    
    $out = ''; $uniq = rand(1,100);
    
    $coords = explode(':', $location);
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);
    }
    
    if(!empty($tmp_conf['post_coords']['lat']) && !empty($tmp_conf['post_coords']['lng']))
    {
        $out .= '<div class="main-top">
            <div class="main-top-inner">

                <div id="contact_map" class="map"></div>
                <script>
                    jQuery(window).ready(function () {
                        jQuery("#contact_map").gMap({
                            markers: [{
                                latitude: '.$tmp_conf['post_coords']['lat'].',
                                longitude: '.$tmp_conf['post_coords']['lng'].',
                                title: "Company Name LTD",
                                html:"'.$address.'",
                                popup: false,
                                icon: {
                                    image: "",
                                    iconsize: [25, 34],
                                    iconanchor: [12,34],
                                    infowindowanchor: [0, 0]
                                }
                            }],
                            maptype: google.maps.MapTypeId.TERRAIN,
                            zoom: '.$zoom.',
                            scrollwheel: false
                        });
                    });
                </script>

            </div>
        </div>';
        
     
        if(!empty($address) || !empty($email) || !empty($phone))
        {
            $out .='<div class="main-row main-row-bg main-row-slim">
                <div class="container">

                    <div class="row">';
                        if(!empty($address))
                        {
                        $out .='<div class="col-sm-5">
                                    <div class="texticon tficon-lg">
                                        <strong><i class="tficon-home"></i> '.$address.'</strong>
                                    </div>
                                </div>';
                        }
                        if(!empty($email))
                        {
                            $out .='<div class="col-sm-4">
                                    <div class="texticon tficon-lg">
                                        <strong><i class="tficon-envelope"></i> '.$email.'</strong>
                                    </div>
                                </div>';
                        }
                        if(!empty($phone))
                        {
                            $out.='<div class="col-sm-3">
                               <div class="texticon tficon-lg">
                                    <strong><i class="tficon-phone"></i> '.$phone.'</strong>
                                </div>
                            </div> ';
                        }
                    $out.='</div>
                </div>
            </div>';
        }
    }
    
    return $out;
}

$atts = array(
    'name' => __('Header Map','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Map position','tfuse'),
            'desc' => __('Map position','tfuse'),
            'id' => 'tf_shc_header_map_location',
            'value' => '',
            'type' => 'maps'
        ),
        array(
            'name' => __('Zoom','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_zoom',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Adress','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_address',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Email','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_email',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Phone','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_phone',
            'value' => '',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('header_map', 'tfuse_shortcode_header_map', $atts);

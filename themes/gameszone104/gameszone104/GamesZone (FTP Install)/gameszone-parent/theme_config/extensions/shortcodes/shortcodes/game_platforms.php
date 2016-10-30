<?php
function tfuse_shortcode_game_platforms($atts, $content = null)
{
    extract(shortcode_atts(array('cat' => '','title' => '','img' => '','desc' => ''), $atts));
    
    $out = '';
    
    $categories = explode(',',$cat);
    
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    
    if($term) $id_term = $term->term_id;
    else $id_term  = '%20';
        
    if(!empty($categories))
    {
		$platforms_links  ='';
        foreach ($categories as $categ)
        {
            $term = get_term_by( 'id' , $categ , 'platforms_game');
			if($term)
            $platforms_links .= '&amp;platforms_game'.$term->term_id.'='.$term->term_id;
        }
		        
        if($term && !empty($term))
        {
            $out .= '
                    <div class="col-sm-4">
                            <div class="textbox textbox-style2">';
                                    if(!empty($img))
                                            $out .= '<div class="textbox-thumbnail"><img src="'.$img.'" width="100" height="100" alt=""/></div>';
                                    $out .='<div class="textbox-aside">
                                            <h3 class="textbox-title">'.$title.'</h3>
                                            <div class="textbox-text">
                                                    <p>'.$desc.'</p>
                                            </div>
                                            <div class="textbox-foot clearfix">
                                                    <a class="btn btn-default btn-xs" href="?s=~&amp;tax_games='.$id_term.$platforms_links.'">'.__('View Games','tfuse').'</a>
                                            </div>
                                    </div>
                            </div>
                    </div>';
        }
    }
    
    return $out;
}

$atts = array(
    'name' => __('Platforms','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => __('Platform Title', 'tfuse'),
            'id' => 'tf_shc_game_platforms_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Image', 'tfuse'),
            'desc' => __('Image url', 'tfuse'),
            'id' => 'tf_shc_game_platforms_img',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Description', 'tfuse'),
            'desc' => __('Short description', 'tfuse'),
            'id' => 'tf_shc_game_platforms_desc',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Platforms', 'tfuse'),
            'desc' => __('Type platforms name', 'tfuse'),
            'id' => 'tf_shc_game_platforms_cat',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'platforms_game',
        ),
        
    )
);

tf_add_shortcode('game_platforms', 'tfuse_shortcode_game_platforms', $atts);
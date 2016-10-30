<?php
function tfuse_shortcode_blog_categories($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '','cat' => ''), $atts));
    
    $out = '';
    
    $categories = explode(',',$cat);
        
    if(!empty($categories))
    {
        $categories = array_reverse($categories);
        $out .= '<div class="widget widget_categories">
                    <h3 class="widget-title">'.$title.'</h3>
                    <ul>';
                        foreach ($categories as $category) {
                            $term = get_term_by( 'id' , $category , 'category');
                            $out .= '<li><a href="'.get_category_link($category).'">'.get_cat_name($category).' <span class="count">('.$term->count.')</span></a></li>';
                        }
            $out .='</ul>
                </div>';
    }
    
    return $out;
}

$atts = array(
    'name' => __('Categories','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Category', 'tfuse'),
            'desc' => __('Type category name', 'tfuse'),
            'id' => 'tf_shc_blog_cat',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'category',
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter title','tfuse'),
            'id' => 'tf_shc_blog_title',
            'value' => '',
            'type' => 'text'
        ),
        
    )
);

tf_add_shortcode('blog', 'tfuse_shortcode_blog_categories', $atts);

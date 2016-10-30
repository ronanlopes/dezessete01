<?php
/**
 * Play slider's configurations
 *
 * @since Gamezone 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings', 'tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings', 'tfuse'),
                    'options' => array(
                        array('name' => __('Slider Title', 'tfuse'),
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)', 'tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Slides Interval','tfuse'),
                            'desc' => __('Enter the slides interval','tfuse'),
                            'id' => 'slider_interval',
                            'value' => '0',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array('name' => __('Resize images?', 'tfuse'),
                            'desc' => __('Want to let our script to resize the images for you? Or do you want to have total control and upload images with the exact slider image size?', 'tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => 'false',
                            'type' => 'checkbox')
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides', 'tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => __('Add New Slide', 'tfuse'), #do not change
                    'options' => array(
                        
                    )
                )
            )
        ),
        array(
            'name' => __('Category Setup', 'tfuse'),
            'id' => 'slider_type_categories',
            'headings' => array(
                array(
                    'name' => __('Category options', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Posts From', 'tfuse'),
                            'desc' => __('Select Posts From:', 'tfuse'),
                            'id' => 'sliders_posts_from',
                            'value' => 'game',
                            'options' => array('game' => __('Games Categories','tfuse') , 'review' => __('Reviews Categories','tfuse')),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific categories', 'tfuse'),
                            'desc' => __('Pick one or more
categories by starting to type the category name. If you leave blank the slider will fetch images
from all <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit-tags.php?taxonomy=games">Events Categories</a>.',
                            'id' => 'categories_select_game',
                            'type' => 'multi',
                            'subtype' => 'games'
                        ),
                        array(
                            'name' => __('Select specific categories', 'tfuse'),
                            'desc' => __('Pick one or more
categories by starting to type the category name. If you leave blank the slider will fetch images
from all <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit-tags.php?taxonomy=reviews">Events Categories</a>.',
                            'id' => 'categories_select_review',
                            'type' => 'multi',
                            'subtype' => 'reviews'
                        ),
                        array(
                            'name' => __('Enable Rating', 'tfuse'),
                            'desc' => __('Enable posts rating', 'tfuse'),
                            'id' => 'sliders_posts_rating',
                            'value' => true,
                            'type' => 'checkbox'
                        ),
                        array(
                            'name' => __('Number of images in the slider', 'tfuse'),
                            'desc' => __('How many images do you want in the slider?', 'tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Posts Setup', 'tfuse'),
            'id' => 'slider_type_posts',
            'headings' => array(
                array(
                    'name' => __('Posts options', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Posts From', 'tfuse'),
                            'desc' => __('Select Posts From:', 'tfuse'),
                            'id' => 'sliders_posts_from',
                            'value' => 'game',
                            'options' => array('game' => __('Games','tfuse') , 'review' => __('Reviews','tfuse')),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php?post_type=game">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
you selected.',
                            'id' => 'posts_select',
                            'type' => 'multi',
                            'subtype' => 'game'
                        ),
                        array(
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php?post_type=review">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
you selected.',
                            'id' => 'posts_select_review',
                            'type' => 'multi',
                            'subtype' => 'review'
                        ),
                        array(
                            'name' => __('Enable Rating', 'tfuse'),
                            'desc' => __('Enable posts rating', 'tfuse'),
                            'id' => 'sliders_posts_rating',
                            'value' => true,
                            'type' => 'checkbox'
                        )
                    )
                )
            )
        )
    )
);
$options['extra_options'] = array();
?>
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
                        array('name' => __('Title', 'tfuse'),
                            'desc' => __('The Title is displayed on the image and will be visible by the users.', 'tfuse'),
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                         array('name' => __('Url', 'tfuse'),
                            'desc' => __('Slide Url.', 'tfuse'),
                            'id' => 'slide_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Content', 'tfuse'),
                            'desc' => __('Short Description.', 'tfuse'),
                            'id' => 'slide_content',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true),
                        array('name' => __('Position', 'tfuse'),
                            'desc' => __('Select your preferred video/image alignment', 'tfuse'),
                            'id' => 'slide_align_img',
                            'value' => '',
                            'type' => 'images',
                            'options' => array(
                                'alignleft'  => array($url . 'left_off.png', __('Align to the left', 'tfuse')),
                                'alignright' => array($url . 'right_off.png', __('Align to the right', 'tfuse')) )
                            ),
                        array('name' => __('Video', 'tfuse'),
                            'desc' => __('Copy paste the video URL or embed code. The video URL works only for Vimeo and YouTube videos', 'tfuse'),
                            'id' => 'slide_video',
                            'value' => '',
                            'type' => 'textarea',
                            'required' => TRUE),
                        array('name' => __('Image <br />(360px × 240px)', 'tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.', 'tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                            'required' => TRUE)
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
                            'options' => array('review' => __('Reviews Categories','tfuse'),'post' => __('Categories','tfuse')),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Select specific categories', 'tfuse'),
                            'desc' => __('Pick one or more
categories by starting to type the category name. If you leave blank the slider will fetch images
from all <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit-tags.php?taxonomy=reviews">Reviews Categories</a>.',
                            'id' => 'categories_select_review',
                            'type' => 'multi',
                            'subtype' => 'reviews'
                        ),
                        array(
                            'name' => __('Select specific categories', 'tfuse'),
                            'desc' => __('Pick one or more
categories by starting to type the category name. If you leave blank the slider will fetch images
from all <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit-tags.php?taxonomy=category">Categories</a>.',
                            'id' => 'categories_select_category',
                            'type' => 'multi',
                            'subtype' => 'category'
                        ),
                        array('name' => __('Position', 'tfuse'),
                            'desc' => __('Select your preferred video/image alignment', 'tfuse'),
                            'id' => 'posts_select_align',
                            'value' => '',
                            'type' => 'images',
                            'options' => array(
                                'alignleft'  => array($url . 'left_off.png', __('Align to the left', 'tfuse')),
                                'alignright' => array($url . 'right_off.png', __('Align to the right', 'tfuse')) )
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
                            'options' => array('review' => __('Reviews','tfuse'),'post' => __('Posts','tfuse')),
                            'type' => 'select'
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
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
you selected.',
                            'id' => 'posts_select_post',
                            'type' => 'multi',
                            'subtype' => 'post'
                        ),
                        
                        array('name' => __('Position', 'tfuse'),
                            'desc' => __('Select your preferred video/image alignment', 'tfuse'),
                            'id' => 'posts_select_align',
                            'value' => '',
                            'type' => 'images',
                            'options' => array(
                                'alignleft'  => array($url . 'left_off.png', __('Align to the left', 'tfuse')),
                                'alignright' => array($url . 'right_off.png', __('Align to the right', 'tfuse')) )
                            ),
                    )
                )
            )
        )
    )
);
$options['extra_options'] = array();
?>
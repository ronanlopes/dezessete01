<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for admin area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    'tabs' => array(
        array(
            'name' => __('General','tfuse'),
            'type' => 'tab',
            'id' => TF_THEME_PREFIX . '_general',
            'headings' => array(
                
                array(
                    'name' => __('General Settings','tfuse'),
                    'options' => array(/* 1 */
                        array(
                            'name' => __('Logo Type','tfuse'),
                            'desc' => __('Select logo type','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_type',
                            'value' => 'text',
                            'options' => array('text' => __('Text logo','tfuse'), 'img' => __('Image logo','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Logo Option
                        array(
                            'name' => __('Custom Logo','tfuse'),
                            'desc' => __('Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo',
                            'value' => '',
                            'type' => 'upload'
                        ),
                        array(
                            'name' => __('Text Logo','tfuse'),
                            'desc' => __('Enter your text for logo','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text',
                            'value' => 'Games<span>Zone</span>',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Custom Favicon Option
                        array(
                            'name' => __('Custom Favicon','tfuse').' <br /> (16px x 16px)',
                            'desc' =>  __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_favicon',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                      
                         // Change default avatar
                        array(
                            'name' => __('Default Avatar','tfuse'),
                            'desc' => __('For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their e-mail address.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_default_avatar',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Tracking Code Option
                        array(
                            'name' => __('Tracking Code','tfuse'),
                            'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_google_analytics',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Custom CSS Option
                        array(
                            'name' => __('Custom CSS','tfuse'),
                            'desc' => __('Quickly add some CSS to your theme by adding it to this block.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_css',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    ) /* E1 */
                ),
                array(
                    'name' => __('Gallery','tfuse'),
                    'options' => array(
                         
                        array('name' => __('Gallery Type','tfuse'),
                            'desc' => __('Select your preferred  display type for Gallery posts.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_portf_type',
                            'value' => 'pretty',
                            'options' => array(
                                'pretty' => __('Gallery','tfuse'),
                                'single' => __('Single Image','tfuse'),
                                ),
                            'type' => 'select'
                        )
                    )
                ),
                array(
                    'name' => __('Socials','tfuse'),
                    'options' => array(
                        array('name' => __('Socials Location','tfuse'),
                            'desc' => __('Select socials location','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_socials',
                            'value' => 'both',
                            'options' => array('no' => __('Disable socials','tfuse'),'both' => __('Header and Footer','tfuse')
                                                ,'header' => __('Header','tfuse'),'footer' => __('Footer','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Socials Title','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_socials_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' =>true
                        ),
                        array('name' => __('Facebook','tfuse'),
                            'desc' => __('Facebook Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_facebook',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Twitter','tfuse'),
                            'desc' => __('Twitter Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_twitter',
                            'value' => '',
                            'type' => 'text'
                            ),
                        array('name' => __('Dribbble','tfuse'),
                            'desc' => __('Dribbble Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_dribbble',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('LinkedIn','tfuse'),
                            'desc' => __('LinkedIn Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_linkedin',
                            'value' => '',
                            'type' => 'text'
                            ),
                        
                        array('name' => __('Flickr','tfuse'),
                            'desc' => __('Flickr Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_flickr',
                            'value' => '',
                            'type' => 'text'
                            ),
                    )
                ),
                array(
                    'name' => __('404 Page Shortcodes','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes on Top','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_404_content_on_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_404_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_404_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
                array(
                    'name' => __('Search Page Shortcodes','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes on Top','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_content_on_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
                	array(
                    'name' => __('Twitter','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Consumer Key','tfuse'),
                            'desc' => __('Set your' ,'tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter' ,'tfuse').'</a> '.__('application' ,'tfuse').' <a href="http://screencast.com/t/yb44HiF2NZ">'.__('consumer key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_key',
                            'value' => 'XW7t8bECoR6ogYtUDNdjiQ',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Consumer Secret','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a> '.__('application','tfuse').' <a href="http://screencast.com/t/eaKJHG1omN">'.__('consumer secret key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_secret',
                            'value' => 'Z7UzuWU8a4obyOOlIguuI4a5JV4ryTIPKZ3POIAcJ9M',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Token','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a> '.__('application','tfuse').' <a href="http://screencast.com/t/QEEG2O4H">'.__('access token key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_token',
                            'value' => '1510587853-ugw6uUuNdNMdGGDn7DR4ZY4IcarhstIbq8wdDud',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Secret','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a>  '.__('application','tfuse').' <a href="http://screencast.com/t/Yv7nwRGsz">'.__('access token secret key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_secret',
                            'value' => '7aNcpOUGtdKKeT1L72i3tfdHJWeKsBVODv26l9C0Cc',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('RSS','tfuse'),
                    'options' => array(
                        // RSS URL Option
                        array('name' => __('RSS URL','tfuse'),
                            'desc' => __('Enter your preferred RSS URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // E-Mail URL Option
                        array('name' => __('E-Mail URL','tfuse'),
                            'desc' => __('Enter your preferred E-mail subscription URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_id',
                            'value' => '',
                            'type' => 'text','divider'=>true
                        ),
                    )
                ),
                array(
                    'name' => __('Enable Theme settings','tfuse'),
                    'options' => array(
                        array('name' => __('Author Info', 'tfuse'),
                            'desc' => __('Enable Author Info?', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_author_info',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable SEO
                        array('name' => __('SEO Tab','tfuse'),
                            'desc' => __('Enable SEO option?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_tfuse_seo_tab',
                            'value' => true,
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Enable Dynamic Image Resizer Option
                        array('name' => __('Dynamic Image Resizer','tfuse'),
                            'desc' => __('This will Enable the thumb.php script that dynamicaly resizes images on your site. We recommend you keep this enabled, however note that for this to work you need to have "GD Library" installed on your server. This should be done by your hosting server administrator.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_resize',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Remove wordpress versions for security reasons
                        array(
                            'name' => __('Remove Wordpress Versions','tfuse'),
                            'desc' => __('Remove Wordpress versions from the source code, for security reasons.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_remove_wp_versions',
                            'value' => TRUE,
                            'type' => 'checkbox'
                        )
                    )
                )
            )
        ), array(
            'name' => __('Styles','tfuse'),
            'id' => TF_THEME_PREFIX . '_styles',
            'headings' => array(
                array(
                    'name' => __('Theme Fonts','tfuse'),
                    'options' => array(
                    array('name' => __('Headings Font','tfuse'),
                            'desc' => __('Select the headings font. You can preview it on ','tfuse').'<a href="https://www.google.com/fonts" target="_blank">'.__(' Google Fonts','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_h_font',
                            'value' => 'roboto',
                            'options' => array('roboto' => __('Roboto Slab','tfuse'),
                                               'cabin' => 'Cabin',
                                               'droid_sans' => 'Droid Sans',
                                               'gafata' => 'Gafata',
                                               'oxygen' => 'Oxygen',
                                               'philosopher' => 'Philosopher',
                                               'questrial' => 'Questrial',
                                               'raleway' => 'Raleway',
                                               'signika' => 'Signika',
                                               'ubuntu' => 'Ubuntu',
                                               'georgia' => 'Georgia',
                                               'arial' => 'Arial',
                                               'arbutus' => 'Arbutus Slab',
                                               'bitter' => 'Bitter',
                                               'coustard' => 'Coustard',
                                               'droid_serif' => 'Droid Serif',
                                               'eb' => 'EB Garamond',
                                               'goudy' => 'Goudy Bookletter 1911',
                                               'kotta' => 'Kotta One',
                                               'playfair' => 'Playfair Display',
                                               'vidaloka' => 'Vidaloka',
                                               ),
                            'type' => 'select',
                            'divider' => true
                            
                        ),
                        array('name' => __('Body Font','tfuse'),
                            'desc' => __('Select the body font. You can preview it on ','tfuse').'<a href="https://www.google.com/fonts" target="_blank">'.__(' Google Fonts','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_body_font',
                            'value' => 'gafata',
                            'options' => array('roboto' => __('Roboto Slab','tfuse'),
                                               'cabin' => 'Cabin',
                                               'droid_sans' => 'Droid Sans',
                                               'gafata' => 'Gafata',
                                               'oxygen' => 'Oxygen',
                                               'philosopher' => 'Philosopher',
                                               'questrial' => 'Questrial',
                                               'raleway' => 'Raleway',
                                               'signika' => 'Signika',
                                               'ubuntu' => 'Ubuntu',
                                               'georgia' => 'Georgia',
                                               'arial' => 'Arial',
                                               'arbutus' => 'Arbutus Slab',
                                               'bitter' => 'Bitter',
                                               'coustard' => 'Coustard',
                                               'droid_serif' => 'Droid Serif',
                                               'eb' => 'EB Garamond',
                                               'goudy' => 'Goudy Bookletter 1911',
                                               'kotta' => 'Kotta One',
                                               'playfair' => 'Playfair Display',
                                               'vidaloka' => 'Vidaloka',
                                               ),
                            'type' => 'select'
                        )
                        
                    )
                ),
                array(
                    'name' => __('Theme Styles','tfuse'),
                    'options' => array(
                    array('name' => __('Website Background Color','tfuse'),
                            'desc' => __('Select Background Color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_bg_color',
                            'value' => '#ededed',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                         array('name' => __('Primary Color','tfuse'),
                            'desc' => __('Select Primary Color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_primary_color',
                            'value' => '#66cc33',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array('name' => __('Main Menu Gradient','tfuse'),
                            'desc' => __('Select Main Menu Top Color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_menu_color',
                            'value' => '#000000',
                            'type' => 'colorpicker'
                        ),
                        array('name' => __('','tfuse'),
                            'desc' => __('Select Main Menu Bottom Color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_menu_color_bot',
                            'value' => '#343434',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        
                        array('name' => __('Top Section Background','tfuse'),
                            'desc' => __('Select Top Section Background','tfuse'),
                            'id' => TF_THEME_PREFIX . '_top_section',
                            'value' => '#403f3f',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array('name' => __('Text Color','tfuse'),
                            'desc' => __('Select Text Color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_text_color',
                            'value' => '#666666',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        
                        array('name' => __('Link Color','tfuse'),
                            'desc' => __('Select Link Color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_link_color',
                            'value' => '#f25d3c',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array('name' => __('Footer Top Background','tfuse'),
                            'desc' => __('Select Footer Top Background','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_color',
                            'value' => '#0b0b0b',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array('name' => __('Footer Bottom Background','tfuse'),
                            'desc' => __('Select Footer Bottom Background','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_color_bot',
                            'value' => '#0e0e0e',
                            'type' => 'colorpicker'
                        )
                        
                        
                    )
                )
            )
        ),
        array(
            'name' => __('Homepage','tfuse'),
            'id' => TF_THEME_PREFIX . '_homepage',
            'headings' => array(
                array(
                    'name' => __('Homepage Population','tfuse'),
                    'options' => array(
                        array('name' => __('Homepage Population','tfuse'),
                            'desc' => __(' Select which categories to display on homepage. More over you can choose to load a specific page or change the number of posts on the homepage from ','tfuse').'<a target="_blank" href="' . network_admin_url('options-reading.php') . '">'.__('here','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_homepage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse'),'page' =>__('From Specific Page','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on homepage','tfuse'),
                            'desc' => __('Pick one or more 
                            categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        // page on homepage
                        array('name' => __('Select Page','tfuse'),
                            'desc' => __('Select the page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_page',
                            'value' => 'image',
                            'options' =>tfuse_list_page_options(),
                            'type' => 'select',
                        )
                    )
                ),
                array(
                    'name' => __('Homepage Shortcodes','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes on Top','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_on_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Blog','tfuse'),
            'id' => TF_THEME_PREFIX . '_blogpage',
            'headings' => array(
                array(
                    'name' => __('Blog Page Population','tfuse'),
                    'options' => array(
                        // Select the Blog Page
                        array('name' => __('Select Blog Page','tfuse'),
                            'desc' => __('Select the blog page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Blog Page Population','tfuse'),
                            'desc' => __(' Select which categories to display on blogpage. More over you can choose to load a specific page or change the number of posts on the blogpage from ','tfuse').'<a target="_blank" href="' . network_admin_url('options-reading.php') . '">'.__('here','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_blogpage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on blogpage','tfuse'),
                            'desc' => __('Pick one or more
                            categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ_blog',
                            'type' => 'multi',
                            'subtype' => 'category',
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Shortcodes','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes on Top','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_on_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
            )
        ),
        array(
            'name' => __('Posts','tfuse'),
            'id' => TF_THEME_PREFIX . '_posts',
            'headings' => array(
                array(
                    'name' => __('Default Post Options','tfuse'),
                    'options' => array(
                        // Post Content
                        array('name' => __('Post Content', 'tfuse'),
                            'desc' => __('Select if you want to show the full content (use <em>more</em> tag) or the excerpt on posts listings (categories).','tfuse'),
                            'id' => TF_THEME_PREFIX . '_post_content',
                            'value' => 'excerpt',
                            'options' => array('excerpt' => __('The Excerpt','tfuse'), 'content' => __('Full Content','tfuse')),
                            'type' => 'select'
                        )
                    )
                )
            )
        ),
       
        array(
            'name' => __('Footer','tfuse'),
            'id' => TF_THEME_PREFIX . '_footer',
            'headings' => array(
                
                array(
                    'name' => __('Footer Content','tfuse'),
                    'options' => array(
                        array('name' => __('Enable Footer Widgets','tfuse'),
                            'desc' => __('Enable Footer Widgets','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_widgets',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        array('name' => __('Copyright','tfuse'),
                            'desc' => __('Change Copyright','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_copyright',
                            'value' => '',
                            'type' => 'text'
                        )
                    )
                )
            )
        )
    )
);

?>
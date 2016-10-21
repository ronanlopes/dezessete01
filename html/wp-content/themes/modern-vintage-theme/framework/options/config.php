<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "indieground_options";


    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Indie Panel', 'redux-framework-demo' ),
        'page_title'           => __( 'Indie Panel', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.


        'menu_icon' => get_template_directory_uri().'/framework/options/custom/images/logo_panel.png', // Specify a custom URL to an icon



        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
         'footer_credit'     => false,                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'http://tiny.cc/pyo3yx',
        'title' => 'Visit our site',
        'icon'  => 'el el-icon-shopping-cart'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'http://tiny.cc/pyo3yx',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://tiny.cc/pyo3yx',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://tiny.cc/pyo3yx',
        'title' => 'Find us on behance',
        'icon'  => 'el el-behance'
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */




// GENERAL SETTINGS





    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-cog',
                        'title' => __('General Settings', 'indieground'),
                        'fields' => array(

                    array(
                        'id' => 'indieground-general-style',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('choose theme style', 'indieground'),
                        'subtitle' => __('Select a default color scheme.', 'indieground'),
                        'options' => array(

                             'classic' => array('alt' => 'Classic', 'img' => ReduxFramework::$_url . '../images/orange.jpg'),


                             'denim' => array('alt' => 'Denim', 'img' => ReduxFramework::$_url . '../images/denim.jpg'),

                             'record' => array('alt' => 'Yellow', 'img' => ReduxFramework::$_url . '../images/record.jpg'),

                             'bakery' => array('alt' => 'Chocolate', 'img' => ReduxFramework::$_url . '../images/bakery.jpg'),



                        ),

                        'default' => 'classic'
                    ),


                    array(
                        'id' => 'indieground-icon-favicon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Favicon', 'indieground'),
                        'compiler' => 'true',
                        'desc' => __('', 'indieground'),
                        'subtitle' => __('Upload the icon for your site that will be shown on the browser.', 'indieground'),
                        'default' => array('url' => ''),
                      ),

                    array(
                        'id' => 'indieground-backtotop-yesno',
                        'type' => 'switch',
                        'title' => __('BACK TO TOP BUTTON?', 'indieground'),
                        'subtitle' => __('Enable/Disable the "Back to Top" Button. ', 'indieground'),
                        "default" => 1,
                      ),


                         array(
                        'id' => 'indieground-preloader',
                        'type' => 'switch',
                        'title' => __('Do you want Preloader?', 'indieground'),
                        'subtitle' => __('Enable/Disable preloader page for your site.', 'indieground'),
                        "default" => 0,
                      ),









                         array(
                        'id' => 'indieground-backgroundColor-color',
                        'type' => 'color',
                        'required' => array('indieground-preloader', '=', '1'),

                        'title' => __('Preloader background Color', 'indieground'),
                        'subtitle' => __('Choose a color for background preloader', 'indieground'),
                    ),

      array(
                        'id' => 'indieground-percentage-color',
                        'type' => 'color',
                        'required' => array('indieground-preloader', '=', '1'),

                        'title' => __('Preloader background Color', 'indieground'),
                        'subtitle' => __('Choose a color for percentage text', 'indieground'),
                    ),





                         array(
                        'id' => 'indieground-bar-color',
                        'type' => 'color',
                        'required' => array('indieground-preloader', '=', '1'),

                        'title' => __('Preloader bar Color', 'indieground'),
                        'subtitle' => __('Choose a color for preloader bar', 'indieground'),
                    ),



                         array(
		                'id' => 'indieground-custom-analytics',
		                'type' => 'textarea',
		                'title' => __('Tracking Code', 'indieground'),
		                'sub_desc' => __('Paste your Google Analytics (or other) tracking code here.<br/> It will be inserted before the closing head tag of your theme.',  'indieground'),
		                'desc' => ''
		            ),


                    array(
                        'id'        => 'indieground-custom-css',
                        'type'      => 'ace_editor',
                        'title' => __('Custom CSS', 'indieground'),
                        'subtitle' => __('If you have any custom CSS you would like added to the site, please enter it here.', 'indieground'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc' => __('', 'indieground'),
                        'default'   => "#example{\nmargin: 0 auto;\n}"
                        ),

                    array(
                        'id' => 'indieground-general-pattern',
                        'type' => 'image_select',
                        'tiles' => true,
                        'title' => __('PAGES BACKGROUND PATTERN', 'indieground'),
                        'subtitle' => __('Choose a pattern to fill the background of the single pages of the site (not the homepage sections). Leave blank if you want the default background of your current color-scheme.', 'indieground'),
                        'options' => $sample_patterns[]
                        = array(

                                '0' => ReduxFramework::$_url.'../images/bg_trasparent.jpg',

                                '1' => ReduxFramework::$_url . '../images/bg1_classic.jpg',
                                '2' => ReduxFramework::$_url . '../images/bg2_classic.jpg',

                                '3' => ReduxFramework::$_url . '../images/bg1_bakery.jpg',
                                '4' => ReduxFramework::$_url . '../images/bg2_bakery.jpg',

                                '5' => ReduxFramework::$_url . '../images/bg1_denim.jpg',
                                '6' => ReduxFramework::$_url . '../images/bg2_denim.jpg',

                                '7' => ReduxFramework::$_url . '../images/bg1_record.jpg',
                                '8' => ReduxFramework::$_url . '../images/bg2_record.jpg',

                                                      ),

                      ),

                    array(
                        'id' => 'indieground-general-custom-pattern',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Upload your Custom pattern.', 'indieground'),
                        'compiler' => 'true',
                        'desc' => __('', 'indieground'),
                        'subtitle' => __('Upload your image.', 'indieground'),
                        'default' => array('url' => '')
                        )

                     )




     )
);






// HOME SECTION

    Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-home',
                'title' => __('Header', 'indieground'),
                'fields' => array(
                    array(
                        'id' => 'indieground-switch-custom',
                        'type' => 'switch',
                        'title' => __('USE IMAGE LOGO ?', 'indieground'),
                        'subtitle' => __('Upload a logo for your theme. Otherwise you will see a plain text logo. ', 'indieground'),
                        "default" => 0,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                      ),

                    array(
                        'id' => 'indieground-logo-head-retina',
                        'type' => 'media',
                        'required' => array('indieground-switch-custom', '=', '1'),
                        'url' => true,
                        'title' => __('Retina Logo Upload', 'indieground'),
                        'compiler' => 'true',
                        'desc' => __('', 'indieground'),
                        'subtitle' => __('Upload a Retina-friendly logo if you want it to be correctly displayed on Retina Devices. Please note the logo must be twice of the normal size (example: if you want to show a 60x60 px logo on the website, the size of the image must be 120x120 px).', 'indieground'),
                        'default' => array('url' => ''),
                        'hint' => array(
                        'title'     => 'Hint Title',
                        'content'   => 'This is a <b>hint</b> for the media field with a Title.','default' => 0,
                        )
                      ),


                        array(
                        'id' => 'indieground-logo-head-size-width',
                        'type'          => 'slider',
                        'required' => array('indieground-switch-custom', '=', '1'),

                        'title' => __('Logo Width', 'indieground'),
                        'subtitle' => __('Specify the width of the logo. Enter only number value.', 'indieground'),
                        'desc'          => __('width: Min: 0, max: 600, step: 1, default value: 250', 'indieground'),
                        'default'       => 250,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 600,
                        'display_value' => 'text'
                    ),



                   array(
                        'id' => 'indieground-logo-head-size-height',
                        'type'          => 'slider',
                        'required' => array('indieground-switch-custom', '=', '1'),

                        'title' => __('Logo Height', 'indieground'),
                        'subtitle' => __('Specify the height of the logo. Enter only number value.', 'indieground'),
                        'desc'          => __('height: Min: 0, max: 300, step: 1, default value: 70', 'indieground'),
                        'default'       => 70,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 300,
                        'display_value' => 'text'
                    ),


    array(
                        'id' => 'indieground-logo-head-margin-top',
                        'type'          => 'slider',
                        'required' => array('indieground-switch-custom', '=', '1'),

                        'title' => __('Logo margin top', 'indieground'),
                        'subtitle' => __('Specify the margin top of the logo. Enter only number value.', 'indieground'),
                        'desc'          => __('height: Min: 0, max: 100, step: 1, default value: 10', 'indieground'),
                        'default'       => 10,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text'
                    ),



                         array(
                        'id' => 'indieground-home-logoyesno',
                        'type' => 'switch',
                        'title' => __('Logo in header ?', 'indieground'),
                        'subtitle' => __('Choose if you want to display your logo on the top of the site.', 'indieground'),
                        "default" => 1,
	                    ),


                    array(
                        'id' => 'indieground-sticky-yesno',
                        'type' => 'switch',
                        'title' => __('Sticky menu?', 'indieground'),
                        'subtitle' => __('Enable/Disable the option for the navigation menu to follow the website scrolling.', 'indieground'),
                        "default" => 1,
                      ),


                    array(
                        'id' => 'indieground-search-header',
                        'type' => 'switch',
                        'title' => __('Search Option on Menu?', 'indieground'),
                        'subtitle' => __('Enable/Disable the Search field on the navigation bar', 'indieground'),
                        "default" => 1,
                      ),

                         array(
                        'id' => 'indieground-head-social',
                        'type' => 'switch',
                        'title' => __('SOCIAL ICONS?', 'indieground'),
                        'subtitle' => __('Choose if you want to display the social media icons on the navigation menu.', 'indieground'),
                        'default' => 1,
                    ),



                    array(
                        'id' => 'indieground-header-pattern',
                        'type' => 'image_select',
                        'tiles' => true,
                        'title' => __('HEADER LOGO PATTERN', 'indieground'),
                        'subtitle' => __('Choose a custom background patter for the top logo section (if you have enabled this option).', 'indieground'),

                      'options'  => array(

                    			 '0' => array(
			                     'img'  => ReduxFramework::$_url.'../images/bg_trasparent.jpg'
			                     ),

                                    '1' => array(
                                    'img'   => ReduxFramework::$_url.'../images/bg1_classic.jpg'
                                    ),

			                     '2' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg2_classic.jpg'
			                     ),

			                     '3' => array(
			                     'img'  => ReduxFramework::$_url.'../images/bg1_bakery.jpg'
			                     ),

			                     '4' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg2_bakery.jpg'
			                     ),

			                     '5' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg1_denim.jpg'
			                     ),

			                     '6' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg2_denim.jpg'
			                     ),


			                     '7' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg1_record.jpg'
			                     ),

			                     '8' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg2_record.jpg'
			                     ),

			                     '9' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg1_light.jpg'
			                     ),

			                     '10' => array(
			                     'img'   => ReduxFramework::$_url.'../images/bg2_light.jpg'

			                      )

			                      ),
			                      'default' => '2'
                      ),


                    array(
                        'id' => 'indieground-header-custom-pattern',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('CUSTOM HEADER LOGO PATTERN', 'indieground'),
                        'compiler' => 'true',
                        'desc' => __('', 'indieground'),
                        'subtitle' => __('Upload your image.', 'indieground'),
                        'default' => array('url' => '')
                       )

                )


              )
            );


// PORTFOLIO


    Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-th',
                'title' => __('Portfolio Options', 'indieground'),
                'fields' => array(


                    array(
                        'id' => 'indieground-portfolio-columns',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('Portfolio columns', 'indieground'),
                        'subtitle' => __('Select if you want to display 3 or 4 images per row.', 'indieground'),
                        'options' => array(
                        '3' => array('alt' => '3 Columns', 'img' => ReduxFramework::$_url . '../images/portfolio-3-columns.jpg'),
                        '4' => array('alt' => '4 Columns', 'img' => ReduxFramework::$_url . '../images/portfolio-4-columns.jpg'),
                        ),
                        'default' => '4'
                      ),

                    array(
                        'id' => 'indieground-portfolio-items-number',
                        'type' => 'text',
                        'title' => __('PORTFOLIO ITEMS NUMBER', 'indieground'),
                        'subtitle' => __('Select how many items you want to display in your portfolio', 'indieground'),
                         'default' => '12'
                      ),

                    array(
                        'id' => 'indieground-portfolio-page-layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('PORTFOLIO PAGES LAYOUT', 'indieground'),
                        'subtitle' => __('Choose a layout for your portfolio single pages', 'indieground'),
                        'options' => array(
                        '1' => array('alt' => '3 Columns', 'img' => ReduxFramework::$_url . '../images/portfolio-full.jpg'),
                        '2' => array('alt' => '4 Columns', 'img' => ReduxFramework::$_url . '../images/portfolio-l-sider.jpg'),
                        '3' => array('alt' => '4 Columns', 'img' => ReduxFramework::$_url . '../images/portfolio-r-sider.jpg'),
                        ),
                        'default' => '2'
                      ),

                    array(
                        'id' => 'indieground-portfolio-socialsharing',
                        'type' => 'switch',
                        'title' => __('social sharing?', 'indieground'),
                        'subtitle' => __('Enable/Disable social share', 'indieground'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'indieground-portfolio-filtersyesno',
                        'type' => 'switch',
                        'title' => __('ENABLE FILTER ?', 'indieground'),
                        'subtitle' => __('Enable/Disable portfolio filter', 'indieground'),
                        "default" => 1,

                       )
                    )


                    )
                 );

// FOOTER SETTINGS

    Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-minus',
                'title' => __('Footer', 'indieground'),
                'fields' => array(



                    array(
                        'id' => 'indieground-footer-site-name',
                        'type' => 'switch',
                        'title' => __('Name site', 'indieground'),
                        'subtitle' => __('Do you want to display your name site on the footer ?', 'indieground'),
                        'default' => 1,
                    ),



                    array(
                        'id' => 'logo-footer-switch-custom',
                        'type' => 'switch',
                        'title' => __('FOOTER LOGO ?', 'indieground'),

                        'subtitle' => __('Choose if you want to upload an image as your logo to be displayed into the footer.', 'indieground'),
                        "default" => 0,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                      ),



                    array(
                        'id' => 'indieground-logofooter-retina',
                        'type' => 'media',
                        'required' => array('logo-footer-switch-custom', '=', '1'),
                        'url' => true,
                        'title' => __('Retina Logo Upload', 'indieground'),
                        'compiler' => 'true',
                        'desc' => __('', 'indieground'),
                        'subtitle' => __('Upload a Retina-friendly logo if you want it to be correctly displayed on Retina Devices. Please note the logo must be twice of the normal size (example: if you want to show a 60x60 px logo on the website, the size of the image must be 120x120 px)', 'indieground'),
                        'default' => array('url' => ''),
                        'hint' => array(
                        'title'     => 'Hint Title',
                        'content'   => 'This is a <b>hint</b> for the media field with a Title.','default' => 0,
                        )
                      ),


                        array(
                        'id' => 'indieground-logo-footer-size-width',
                        'type'          => 'slider',
                        'required' => array('logo-footer-switch-custom', '=', '1'),

                        'title' => __('Logo Width', 'indieground'),
                        'subtitle' => __('Specify the width of the logo. Enter only number value.', 'indieground'),
                        'desc'          => __('width: Min: 0, max: 600, step: 1, default value: 250', 'indieground'),
                        'default'       => 250,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 600,
                        'display_value' => 'text'
                    ),



                   array(
                        'id' => 'indieground-logo-footer-size-height',
                        'type'          => 'slider',
                        'required' => array('logo-footer-switch-custom', '=', '1'),

                        'title' => __('Logo Height', 'indieground'),
                        'subtitle' => __('Specify the height of the logo. Enter only number value.', 'indieground'),
                        'desc'          => __('height: Min: 0, max: 300, step: 1, default value: 70', 'indieground'),
                        'default'       => 70,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 300,
                        'display_value' => 'text'
                    ),

                    array(
                        'id' => 'indieground-footer-social',
                        'type' => 'switch',
                        'title' => __('SOCIAL ICONS', 'indieground'),
                        'subtitle' => __('Do you want to display your social icons on the footer?', 'indieground'),
                        'default' => 1,
                    ),

                    array(
                        'id' => 'indieground-footer-custom-copy',
                        'type' => 'textarea',
                        'title' => __('FOOTER TEXT', 'indieground'),
                        'subtitle' => __('Enter the text that you want to be displayed into the footer. HTML is allowed.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'html_custom',
                        'default' => 'Copyright <a href="http://www.indieground.it/">Indieground</a> Design All Rights Reserved 2014	',
                        'allowed_html' => array(
                             'a' => array(
                             'href' => array(),
                             'title' => array()
                        ),
                             'br' => array(),
                             'em' => array(),
                             'strong' => array()
                        )

                    ),

                    array(
                        'id' => 'indieground-footer-color',
                        'type' => 'background',
                        'output' => array('footer'),
                        'title' => __('Footer background color', 'indieground'),
                        'subtitle' => __('Choose a flat background color', 'indieground'),
                        'default' => '',
                        'validate' => 'color',
                        'background-repeat' => 'false',
                        'background-position' => 'false',
                        'background-attachment' => 'false',
                        'background-size' => 'false',
                        'preview_media' => 'false',
                        'preview' => 'false',
                        'transparent' => 'false',
                        'background-image' => 'false',

                    ),


                    array(
                        'id' => 'indieground-footer-stitched',
                        'type' => 'switch',
                        'title' => __('Stitched Footer?', 'indieground'),
                        'subtitle' => __('Enable/Disable stitched style Footer', 'indieground'),
                        'default' => 1
                    )
                )


                )
            );

// BLOG OPTIONS

    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-tag',
                        'title' => __('Blog Options', 'indieground'),
                        'fields' => array(


                    array(
                        'id' => 'indieground-page-blog-layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('BLOT POST LAYOUT', 'indieground'),
                        'subtitle' => __('Choose a layout for the single blog post pages.', 'indieground'),
                        'options' => array(
                        '3' => array('alt' => 'Full', 'img' => ReduxFramework::$_url . '../images/blog-full.jpg'),
                        '4' => array('alt' => 'sidebar right', 'img' => ReduxFramework::$_url . '../images/blog-r-sider.jpg'),
                        '5' => array('alt' => 'sidebar left', 'img' => ReduxFramework::$_url . '../images/blog-l-sider.jpg'),
                        ),
                        'default' => '3'
                    ),


                    array(
                        'id' => 'indieground-social-blog-sharingx',
                        'type' => 'switch',
                        'title' => __('social sharing?', 'indieground'),
                        'subtitle' => __('Enable/Disable social share options', 'indieground'),
                        "default" => 1,
                    )
                )

                )
            );


// TEAM OPTIONS

    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-group-alt',
                        'title' => __('Team Options', 'indieground'),
                        'fields' => array(

                    array(
                        'id' => 'indieground-team-columns',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('TEAM COLUMNS', 'indieground'),
                        'subtitle' => __('Select if you want to display 3 or 4 team elements per row.', 'indieground'),
                        'options' => array(
                        '3' => array('alt' => '3 Columns', 'img' => ReduxFramework::$_url . '../images/portfolio-3-columns.jpg'),
                        '4' => array('alt' => '4 Columns', 'img' => ReduxFramework::$_url . '../images/portfolio-4-columns.jpg'),
                        ),
                        'default' => '4'
                      ),



                    array(
                        'id' => 'indieground-team-socialsharing',
                        'type' => 'switch',
                        'title' => __('social sharing?', 'indieground'),
                        'subtitle' => __('Enable/Disable social share options', 'indieground'),
                        "default" => 1,
                    )
                )



                )
            );



// WP LOGIN

    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-screen',
                        'title' => __('WP Login Layout', 'indieground'),
                        'fields' => array(

						array(
							'id' => 'indieground-login-logo',
							'type' => 'media',
							'url' => true,
							'title' => __('WP Login Logo', 'indieground'),
							'compiler' => 'true',
							'desc' => __('', 'indieground'),
							'subtitle' => __('Choose a logo or img you want to display on the login pannel', 'indieground'),
							'default' => array('url' => ''),
							'hint' => array(
							'title'     => 'Hint Title',
							'content'   => 'This is a <b>hint</b> for the media field with a Title.',
							)
						),


						array(
							'id' => 'indieground-login-color',
							'type' => 'color',
							'title' => __('Login background color', 'indieground'),
							'subtitle' => __('Choose a flat background color', 'indieground'),
							'default' => '',
							'validate' => 'color'
						),
						array(
							'id' => 'indieground-login-custom-pattern',
							'type' => 'media',
							'url' => true,
							'title' => __('Custom background pattern', 'indieground'),
							'compiler' => 'true',
							'desc' => __('', 'indieground'),
							'subtitle' => __('Upload your image.', 'indieground'),
							'default' => array('url' => '')
						)
                )

                )
            );


// SOCIAL KEY

    Redux::setSection( $opt_name, array(
						'icon' => 'el-icon-key',
						'title' => __('Social Key ', 'indieground'),
						'fields' => array(



						array(
		                        'id' => 'indieground-info-home-section',
		                        'type' => 'info',
		                        'title' => __('INFO TWITTER', 'indieground'),

		                        'desc' => __('You can generate all the keys you need from this external link <a href="https://apps.twitter.com/"target="_blank"> Twitter Apps </a>', 'indieground'),
						),


						array(
							'id' => 'indieground-twitter',
							'type' => 'text',
							'title' => __('TWITTER KEY', 'indieground'),
							'subtitle' => __('', 'indieground'),
							'desc' => __('', 'indieground'),
							'data' => 'post_type',
							'options' => array(1=>'Consumer Key',
										   2=>'Secret',
										   3=>'Access Token',
										   4=>'Token Secret',
										   5=>'Username',
										   6=>'Count'
										   ),

							'default' => array(
								1=>'',
								2=>'',
								3=>'',
								4=>'',
								5=>'',
								6=>'6'
							),
						),



						array(
		                        'id' => 'indieground-info-home-section',
		                        'type' => 'info',
		                        'title' => __('INFO INSTAGRAM', 'indieground'),

		                        'desc' => __('You can generate all the keys you need from this external link <a href="http://www.pinceladasdaweb.com.br/instagram/access-token/"target="_blank"> key instagram generator </a>




		                        ', 'indieground'),
						),

						array(
							'id' => 'indieground-instagram',
							'type' => 'text',
							'title' => __('INSTAGRAM', 'indieground'),
							'subtitle' => __('', 'indieground'),
							'desc' => __('', 'indieground'),
							'data' => 'post_type',
							'options' => array(
										   1=>'Instagram-ID',
										   2=>'Access-Token',
										   3=>'Count'
							),
							'default' => array(
								1=>'',
								2=>'',
								3=>'9'
							),
						),


						array(
		                        'id' => 'indieground-info-home-section',
		                        'type' => 'info',
		                        'title' => __('INFO FLICKR', 'indieground'),

		                        'desc' => __('You can generate all the keys you need from this external link <a href="http://idgettr.com/"target="_blank"> key flickr generator </a>', 'indieground'),
						),

						array(
							'id' => 'indieground-flickr',
							'type' => 'text',
							'title' => __('FLICKR', 'indieground'),
							'subtitle' => __('', 'indieground'),
							'desc' => __('', 'indieground'),
							'data' => 'post_type',
							'options' => array(
										   1=>'Flickr-ID',
										   2=>'Count',
										   3=>'Tag',
							),
							'default' => array(
								1=>'',
								2=>'9',
								3=>''
							),
						)
					)


					)
			);




// SOCIAL CONFIGURATION

    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-phone',
                        'title' => __('Social Configuration', 'indieground'),
                        'fields' => array(

                    array(
                        'id' => 'indieground-social-facebook',
                        'type' => 'text',
                        'title' => __('Facebook url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-twitter',
                        'type' => 'text',
                        'title' => __('Twitter url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-google',
                        'type' => 'text',
                        'title' => __('Google+ url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-behance',
                        'type' => 'text',
                        'title' => __('Behance url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-dribbble',
                        'type' => 'text',
                        'title' => __('Dribbble url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-linkedin',
                        'type' => 'text',
                        'title' => __('LinkedIn url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-flickr',
                        'type' => 'text',
                        'title' => __('Flickr url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-vimeo',
                        'type' => 'text',
                        'title' => __('Vimeo url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-soundcloud',
                        'type' => 'text',
                        'title' => __('SoundCloud url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-ustream',
                        'type' => 'text',
                        'title' => __('Ustream url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-deviantart',
                        'type' => 'text',
                        'title' => __('DeviantArt url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-instagram',
                        'type' => 'text',
                        'title' => __('Instagram url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),
                    array(
                        'id' => 'indieground-social-pinterest',
                        'type' => 'text',
                        'title' => __('Pinterest url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),

                      array(
                        'id' => 'indieground-social-youtube',
                        'type' => 'text',
                        'title' => __('youtube url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    ),

                    array(
                        'id' => 'indieground-social-tumblr',
                        'type' => 'text',
                        'title' => __('Tumblr url', 'indieground'),
                        'subtitle' => __('This must be a URL.', 'indieground'),
                        'desc' => __('', 'indieground'),
                        'validate' => 'url',
                        'default' => '',
                        'text_hint' => array(
                            'title' => '',
                            'content' => 'Please enter a valid <strong>URL</strong> in this field.'
                        )
                    )
                )



                )
            );


// MAP SETTINGS

    Redux::setSection( $opt_name, array(
                        'icon' => ' el-icon-map-marker',
                        'title' => __('Map Settings', 'indieground'),
                        'fields' => array(


                	array(
                        'id' => 'indieground-maps-title',
                        'type' => 'text',
                        'title' => __('Title', 'indieground'),
                        'desc' => __('Enter here your text of Title Marker.', 'indieground'),
                        'default' => '',
                    ),
                    array(
                        'id' => 'indieground-maps-zoom',
                        'type' => 'select',
                        'title' => __('Default Map Zoom Level', 'indieground'),
                        'desc' => __('Value should be between 1-18, 1 being the entire earth and 18 being right at street level.', 'indieground'),
                        'options' => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18'),
                        'default' => '10'
                    ),
                    array(
                        'id' => 'indieground-maps-type',
                        'type' => 'select',
                        'title' => __('Default Map View', 'indieground'),
                        'desc' => __('Map view', 'indieground'),
                        'options' => array('1'=>'Satellite','2'=>'Maps'),
                        'default' => '10'
                    ),
                	array(
                        'id' => 'indieground-maps-latitude',
                        'type' => 'text',
                        'title' => __('Map Center Latitude', 'indieground'),
                        'desc' => __('Enter the latitude for the maps center point. ', 'indieground'),
                        'default' => '',
                    ),
                	array(
                        'id' => 'indieground-maps-longitude',
                        'type' => 'text',
                        'title' => __('Map Center Longitude', 'indieground'),
                        'desc' => __('Enter the longitude for the maps center point. ', 'indieground'),
                        'default' => '',
                    ),
                    array(
                        'id' => 'indieground-maps-text',
                        'type' => 'textarea',
                        'title' => __('Map Infowindow Text', 'indieground'),
                        'subtitle' => __('If you would like to display any text in an info window for location, please enter it here. HTML is allowed.', 'indieground'),
                        'default' => 'Some HTML is allowed in here.',

                          'validate' => 'html_custom',



                        'allowed_html' => array(
                             'a' => array(
                             'href' => array(),
                             'title' => array()
                        ),
                             'br' => array(),
                             'em' => array(),
                             'strong' => array()
                        )

                    ),



                    array(
                        'id' => 'indieground-maps-marker',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Marker Icon Upload', 'indieground'),
                        'compiler' => 'true',
                        'desc' => __('Upload an image that will be used for the marker on your map.<br><img src="http://www.themelist.org/ert.jpg">', 'indieground'),
                        'default' => array('url' => '')
                    )
                )

                )
            );






// End Indieground



/* =================================  END  ==================================*/



    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = false;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }



// Custom style



function addPanelCSS() {
    wp_register_style(
        'redux-custom-css',
        get_template_directory_uri()."/framework/options/custom/custom-redux.css",
        array( 'redux-admin-css' ), // Be sure to include redux-admin-css so it's appended after the core css is applied
        time(),
        'all'
    );
    wp_enqueue_style('redux-custom-css');
}
// This example assumes your opt_name is set to redux_demo, replace with your opt_name value
add_action( 'redux/page/indieground_options/enqueue', 'addPanelCSS' );

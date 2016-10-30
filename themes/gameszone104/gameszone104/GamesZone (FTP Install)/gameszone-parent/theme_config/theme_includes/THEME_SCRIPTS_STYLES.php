<?php

add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
 */
    function tfuse_add_css()
    {
    	global $TFUSE;

        wp_register_style( 'bootstrap',  tfuse_get_file_uri('/css/bootstrap.css', false, '') );
        wp_enqueue_style( 'bootstrap' );
        
        wp_register_style( 'bootstrap-theme',  tfuse_get_file_uri('/css/bootstrap-theme.css', false, '') );
        wp_enqueue_style( 'bootstrap-theme' );
        
        if($TFUSE->request->isset_GET('color'))
        {
        	if($TFUSE->request->GET('color')=='red')
        	{
        		wp_register_style( 'style',  tfuse_get_file_uri('/style-red.css', true, '') );
                        wp_enqueue_style( 'style' );
        	}
        	elseif($TFUSE->request->GET('color')=='blue')
        	{
        	       wp_register_style( 'style',  tfuse_get_file_uri('/style-blue.css', true, '') );
                        wp_enqueue_style( 'style' );
        	}
        	elseif($TFUSE->request->GET('color')=='green')
        	{
        		wp_register_style( 'style',  tfuse_get_file_uri('/style-green.css', true, '') );
                        wp_enqueue_style( 'style' );
        	}
        	else
        	{
        	   wp_register_style( 'style', get_stylesheet_uri());
            	   wp_enqueue_style( 'style' );
        	}
        }
        else
        {
      	    wp_register_style( 'style', get_stylesheet_uri());
            wp_enqueue_style( 'style' );
        }

        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'animate.min',  tfuse_get_file_uri('/css/animate.min.css', true, '') );
        wp_enqueue_style( 'animate.min' );
        
        wp_register_style( 'shCore',  tfuse_get_file_uri('/css/shCore.css', true, '') );
        wp_enqueue_style( 'shCore' );
        
        wp_register_style( 'meanmenu',  tfuse_get_file_uri('/css/meanmenu.css', true, '') );
        wp_enqueue_style( 'meanmenu' );
        
        wp_register_style( 'shThemeDefault',  tfuse_get_file_uri('/css/shThemeDefault.css', true, '') );
        wp_enqueue_style( 'shThemeDefault' );
        
        wp_register_style( 'mCustomScrollbar',  tfuse_get_file_uri('/css/jquery.mCustomScrollbar.css', true, '') );
        wp_enqueue_style( 'mCustomScrollbar' );
    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
 */
    function tfuse_add_js()
    {

        wp_enqueue_script( 'jquery' );
        
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr' );
        
         wp_register_script( 'modernizr.min', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr.min' );
		
        wp_register_script( 'respond', tfuse_get_file_uri('/js/libs/respond.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'respond' );	

        wp_register_script( 'jquery-ui.custom', tfuse_get_file_uri('/js/libs/jquery-ui.custom.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery-ui.custom' );
        
        wp_register_script( 'bootstrap', tfuse_get_file_uri('/js/libs/bootstrap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap' ); 

        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', true );
        wp_enqueue_script( 'general' );
        
	wp_register_script( 'events', tfuse_get_file_uri('/js/events.js'), array('jquery'), '', true );
        wp_enqueue_script( 'events' );
        
        wp_register_script( 'cusel-min',  tfuse_get_file_uri('/js/cusel.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'cusel-min' );
        
        wp_register_script( 'jquery.carouFredSel',  tfuse_get_file_uri('/js/jquery.carouFredSel.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.carouFredSel' );
        
        wp_register_script( 'jquery.customInput',  tfuse_get_file_uri('/js/jquery.customInput.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.customInput' );
        
        wp_register_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
        wp_enqueue_script('maps.google.com');
        
        wp_register_script( 'jquery.gmap.min',  tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.gmap.min' );
        
        wp_register_script( 'jquery.mCustomScrollbar.concat.min',  tfuse_get_file_uri('/js/jquery.mCustomScrollbar.concat.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.mCustomScrollbar.concat.min' );
		
	wp_register_script( 'jquery.meanmenu',  tfuse_get_file_uri('/js/jquery.meanmenu.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.meanmenu' );
        
        wp_register_script( 'jquery.placeholder',  tfuse_get_file_uri('/js/jquery.placeholder.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.placeholder' );
        
	wp_register_script( 'jquery.slider.bundle',  tfuse_get_file_uri('/js/jquery.slider.bundle.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.slider.bundle' );
        
        wp_register_script( 'jquery.slider',  tfuse_get_file_uri('/js/jquery.slider.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.slider' );
        
        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', true );
        wp_enqueue_script( 'prettyPhoto' );
        
        // JS is include on the footer
        wp_register_script( 'shCore', tfuse_get_file_uri('/js/shCore.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shCore' );
        
        wp_register_script( 'shBrushPlain', tfuse_get_file_uri('/js/shBrushPlain.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shBrushPlain' );
        
        wp_register_script( 'sintaxHighlighter', tfuse_get_file_uri('/js/sintaxHighlighter.js'), array('jquery'), '', true );
        wp_enqueue_script( 'sintaxHighlighter' );
        
        if( function_exists('qtrans_getLanguage') ){
            wp_localize_script('events', 'tf_qtrans_lang', array(
                'lang' => qtrans_getLanguage()
            ));
        }
        
        do_action('tf_scripts_added');
    }
endif;
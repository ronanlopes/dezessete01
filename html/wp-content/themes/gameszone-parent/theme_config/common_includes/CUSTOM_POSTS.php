<?php
/**
 * Create custom posts types
 *
 * @since  Gameszone 1.0
 */

if ( !function_exists('tfuse_create_custom_post_types') ) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_create_custom_post_types()
    {
		//Reservation_form
		        $labels = array(
                        'name' => __('Reservation', 'tfuse'),
                        'singular_name' => __('Reservation', 'tfuse'),
                        'add_new' => __('Add New', 'tfuse'),
                        'add_new_item' => __('Add New Reservation', 'tfuse'),
                        'edit_item' => __('Edit Reservation info', 'tfuse'),
                        'new_item' => __('New Reservation', 'tfuse'),
                        'all_items' => __('All Reservations', 'tfuse'),
                        'view_item' => __('View Reservation info', 'tfuse'),
                        'parent_item_colon' => ''
                );
                $reservationform_rewrite=apply_filters('tfuse_reservationform_rewrite','reservationform_list');
                $res_args = array(
                                'labels' => $labels,
                                'public' => true,
                                'publicly_queryable' => false,
                                'show_ui' => false,
                                'query_var' => true,
                                'exclude_from_search'=>true,
                                //'menu_icon' => get_template_directory_uri() . '/images/icons/doctors.png',
                                'has_archive' => true,
                                'rewrite' => array('slug'=> $reservationform_rewrite),
                                'menu_position' => 6,
                                'supports' => array(null)
                        );
               register_taxonomy('reservations', array('reservations'), array(
                            'hierarchical' => true,
                            'labels' => array(
                                'name' => __('Reservation Forms', 'tfuse'),
                                'singular_name' => __('Reservation Form', 'tfuse'),
                                'add_new_item' => __('Add New Reservation Form', 'tfuse'),
                            ),
                            'show_ui' => false,
                            'query_var' => true,
                            'rewrite' => array('slug' => $reservationform_rewrite)
                        ));
                        register_post_type( 'reservations' , $res_args );
        
        // Games
        $labels = array(
                'name' => __('Games', 'tfuse'),
                'singular_name' => __('Game', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Game', 'tfuse'),
                'edit_item' => __('Edit Games info', 'tfuse'),
                'new_item' => __('New Game', 'tfuse'),
                'all_items' => __('All Games', 'tfuse'),
                'view_item' => __('View Game info', 'tfuse'),
                'search_items' => __('Search Games', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $gamelist_rewrite = apply_filters('tfuse_gamelist_rewrite','all-game-list');
        
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $gamelist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $gamelist_taxonomy_rewrite = apply_filters('tfuse_gamelist_taxonomy_rewrite','game-list');
        register_taxonomy('games', array('game'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $gamelist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Platforms','tfuse' ),
            'singular_name' => __('Platform', 'tfuse'),
            'search_items' => __('Search Platforms','tfuse'),
            'popular_items' => __( 'Popular Platforms','tfuse' ),
            'all_items' => __('All Platforms','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Platform','tfuse'),
            'update_item' => __('Update Platform','tfuse'),
            'add_new_item' => __('Add New Platform','tfuse'),
            'new_item_name' => __('New Platform Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate platforms with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove platforms','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used platforms','tfuse' ),
        );
		
            $platformslist_taxonomy_tags_rewrite = apply_filters('tfuse_reviewlist_taxonomy_platforms_rewrite','platform-list'); 
		
            register_taxonomy('platforms_game', 'game', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $platformslist_taxonomy_tags_rewrite)
            ));   
            
        $labels = array(
            'name' => __('Producers','tfuse' ),
            'singular_name' => __('Producer', 'tfuse'),
            'search_items' => __('Search Producers','tfuse'),
            'popular_items' => __( 'Popular Producers','tfuse' ),
            'all_items' => __('All Producers','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Producer','tfuse'),
            'update_item' => __('Update Producer','tfuse'),
            'add_new_item' => __('Add New Producer','tfuse'),
            'new_item_name' => __('New Producer Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate producers with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove producers','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used producers','tfuse' ),
        );
		
            $producerlist_taxonomy_tags_rewrite = apply_filters('tfuse_gamelist_taxonomy_producers_rewrite','producer-list'); 
		
            register_taxonomy('producers_game', 'game', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $producerlist_taxonomy_tags_rewrite)
            ));   
            
            
        $labels = array(
            'name' => __('Genres','tfuse' ),
            'singular_name' => __('Genre', 'tfuse'),
            'search_items' => __('Search Genres','tfuse'),
            'popular_items' => __( 'Popular Genres','tfuse' ),
            'all_items' => __('All Genres','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Genre','tfuse'),
            'update_item' => __('Update Genre','tfuse'),
            'add_new_item' => __('Add New Genre','tfuse'),
            'new_item_name' => __('New Genre Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate genres with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove genres','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used genres','tfuse' ),
        );
		
            $genreslist_taxonomy_tags_rewrite = apply_filters('tfuse_gamelist_taxonomy_genres_rewrite','genre-list'); 
		
            register_taxonomy('genres_game', 'game', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $genreslist_taxonomy_tags_rewrite)
            ));   
            
        $labels = array(
            'name' => __('Age rating','tfuse' ),
            'singular_name' => __('Age rating', 'tfuse'),
            'search_items' => __('Search Age ratings','tfuse'),
            'popular_items' => __( 'Popular Age ratings','tfuse' ),
            'all_items' => __('All Age ratings','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Age rating','tfuse'),
            'update_item' => __('Update Age rating','tfuse'),
            'add_new_item' => __('Add New Age rating','tfuse'),
            'new_item_name' => __('New Age rating Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate age ratings with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove age ratings','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used age ratings','tfuse' ),
        );
		
            $age_ratingslist_taxonomy_tags_rewrite = apply_filters('tfuse_gamelist_taxonomy_age_ratings_rewrite','age_ratings-list'); 
		
            register_taxonomy('age_ratings', 'game', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $age_ratingslist_taxonomy_tags_rewrite)
            )); 
            
        register_post_type( 'game' , $args );
        
        // Reviews
        $labels = array(
                'name' => __('Reviews', 'tfuse'),
                'singular_name' => __('Review', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Review', 'tfuse'),
                'edit_item' => __('Edit Reviews info', 'tfuse'),
                'new_item' => __('New Review', 'tfuse'),
                'all_items' => __('All Reviews', 'tfuse'),
                'view_item' => __('View Review info', 'tfuse'),
                'search_items' => __('Search Reviews', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $reviewlist_rewrite = apply_filters('tfuse_reviewlist_rewrite','all-review-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $reviewlist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','excerpt','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $eventlist_taxonomy_rewrite = apply_filters('tfuse_reviewlist_taxonomy_rewrite','review-list');
        register_taxonomy('reviews', array('review'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $eventlist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Platforms','tfuse' ),
            'singular_name' => __('Platform', 'tfuse'),
            'search_items' => __('Search Platforms','tfuse'),
            'popular_items' => __( 'Popular Platforms','tfuse' ),
            'all_items' => __('All Platforms','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Platform','tfuse'),
            'update_item' => __('Update Platform','tfuse'),
            'add_new_item' => __('Add New Platform','tfuse'),
            'new_item_name' => __('New Platform Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate platforms with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove platforms','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used platforms','tfuse' ),
        );
		
            $platformlist_taxonomy_tags_rewrite = apply_filters('tfuse_reviewlist_taxonomy_platforms_rewrite','platform-review-list'); 
		
            register_taxonomy('platforms', 'review', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $platformlist_taxonomy_tags_rewrite)
            ));   
            
            
        $labels = array(
            'name' => __('Genres','tfuse' ),
            'singular_name' => __('Genre', 'tfuse'),
            'search_items' => __('Search Genres','tfuse'),
            'popular_items' => __( 'Popular Genres','tfuse' ),
            'all_items' => __('All Genres','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Genre','tfuse'),
            'update_item' => __('Update Genre','tfuse'),
            'add_new_item' => __('Add New Genre','tfuse'),
            'new_item_name' => __('New Genre Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate genres with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove genres','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used genres','tfuse' ),
        );
		
            $genrelist_taxonomy_tags_rewrite = apply_filters('tfuse_reviewlist_taxonomy_genres_rewrite','genre-review-list'); 
		
            register_taxonomy('genres', 'review', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $genrelist_taxonomy_tags_rewrite)
            ));   
            
            
        register_post_type( 'review' , $args );
        
        // Guides
        $labels = array(
                'name' => __('Guides', 'tfuse'),
                'singular_name' => __('Guide', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Guide info', 'tfuse'),
                'new_item' => __('New Guide', 'tfuse'),
                'all_items' => __('All Guides', 'tfuse'),
                'view_item' => __('View Guides info', 'tfuse'),
                'search_items' => __('Search Guides', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $guidelist_rewrite = apply_filters('tfuse_guidelist_rewrite','all-guide-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $guidelist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $guidelist_taxonomy_rewrite = apply_filters('tfuse_guidelist_taxonomy_rewrite','guide-list');
        register_taxonomy('guides', array('guide'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $guidelist_taxonomy_rewrite)
        ));
            

        register_post_type( 'guide' , $args );
                        
        // Gallery
        $labels = array(
                'name' => __('Gallery', 'tfuse'),
                'singular_name' => __('Gallery', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Gallery', 'tfuse'),
                'edit_item' => __('Edit Gallery info', 'tfuse'),
                'new_item' => __('New Gallery', 'tfuse'),
                'all_items' => __('All Galleries', 'tfuse'),
                'view_item' => __('View Gallery info', 'tfuse'),
                'search_items' => __('Search Gallery', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $gallerylist_rewrite = apply_filters('tfuse_gallerylist_rewrite','all-gallery-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $gallerylist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category','tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $gallerylist_taxonomy_rewrite = apply_filters('tfuse_gallerylist_taxonomy_rewrite','gallery-list');
        register_taxonomy('galleries', array('gallery'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $gallerylist_taxonomy_rewrite)
        ));
       

        register_post_type( 'gallery' , $args );              
                        
        // Videos
        $labels = array(
                'name' => __('Videos', 'tfuse'),
                'singular_name' => __('Video', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Video info', 'tfuse'),
                'new_item' => __('New Video', 'tfuse'),
                'all_items' => __('All Videos', 'tfuse'),
                'view_item' => __('View Video info', 'tfuse'),
                'search_items' => __('Search Video', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $videolist_rewrite = apply_filters('tfuse_videolist_rewrite','all-video-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $videolist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $videolist_taxonomy_rewrite = apply_filters('tfuse_videolist_taxonomy_rewrite','video-list');
        register_taxonomy('videos', array('video'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $videolist_taxonomy_rewrite)
        ));
            

        register_post_type( 'video' , $args );
        
         // Members
        $labels = array(
                'name' => __('Members', 'tfuse'),
                'singular_name' => __('Member', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Member', 'tfuse'),
                'edit_item' => __('Edit Member', 'tfuse'),
                'new_item' => __('New Member', 'tfuse'),
                'all_items' => __('All Members', 'tfuse'),
                'view_item' => __('View Member', 'tfuse'),
                'search_items' => __('Search Members', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','thumbnail')
        ); 

        register_post_type( 'members' , $args );
        
        // Events
        $labels = array(
                'name' => __('Events', 'tfuse'),
                'singular_name' => __('Event', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Event info', 'tfuse'),
                'new_item' => __('New Event', 'tfuse'),
                'all_items' => __('All Events', 'tfuse'),
                'view_item' => __('View Events info', 'tfuse'),
                'search_items' => __('Search Events', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $eventlist_rewrite = apply_filters('tfuse_eventlist_rewrite','all-event-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $eventlist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $eventlist_taxonomy_rewrite = apply_filters('tfuse_eventlist_taxonomy_rewrite','event-list');
        register_taxonomy('events', array('event'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $eventlist_taxonomy_rewrite)
        ));
            

        register_post_type( 'event' , $args );
        
        // TESTIMONIALS
        $labels = array(
                'name' => __('Testimonials', 'tfuse'),
                'singular_name' => __('Testimonial', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Testimonial', 'tfuse'),
                'edit_item' => __('Edit Testimonial', 'tfuse'),
                'new_item' => __('New Testimonial', 'tfuse'),
                'all_items' => __('All Testimonials', 'tfuse'),
                'view_item' => __('View Testimonial', 'tfuse'),
                'search_items' => __('Search Testimonials', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'testimonials' , $args );

    }
    tfuse_create_custom_post_types();

endif;

add_action('category_add_form', 'taxonomy_redirect_note');
add_action('specialties_add_form', 'taxonomy_redirect_note');
function taxonomy_redirect_note($taxonomy){
    echo '<p><strong>Note:</strong> More options are available after you add the '.$taxonomy.'. <br />
        Click on the Edit button under the '.$taxonomy.' name.</p>';
}

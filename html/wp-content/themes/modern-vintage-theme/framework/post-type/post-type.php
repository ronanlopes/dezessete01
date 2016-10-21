<?php

add_action('init', 'indieground_post_type');

function indieground_post_type()  {


//======================================================================
//========================= Page Section ===============================
//======================================================================


	$labels = array(
		'name' => __('Page Sections', 'indieground'),
		'singular_name' => __('Page Sections', 'indieground'),
		'add_new' => __('Add New Section', 'indieground'),
		'add_new_item' => __('Add New Section', 'indieground'),
		'edit_item' => __('Edit section', 'indieground'),
		'new_item' => __('New section', 'indieground'),
		'view_item' => __('View section', 'indieground'),
		'search_items' => __('Search sections', 'indieground'),
		'not_found' =>  __('No sections found', 'indieground'),
		'not_found_in_trash' => __('No sections found in Trash', 'indieground'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'show_in_nav_menus' => true,
		'hierarchical' => false,
		'exclude_from_search' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-list-view',
		'supports' => array('title','editor')
	);
	register_post_type('page-sections',$args);



//======================================================================
//========================= Portfolio Section ==========================
//======================================================================


	$labels = array(
		'name' => __('Portfolio', 'indieground'),
		'singular_name' => __('Portfolio', 'indieground'),
		'add_new' => __('Add Portfolio', 'indieground'),
		'add_new_item' => __('Add Portfolio', 'indieground'),
		'edit_item' => __('Edit Portfolio', 'indieground'),
		'new_item' => __('New Portfolio', 'indieground'),
		'view_item' => __('View Portfolio', 'indieground'),
		'search_items' => __('Search Portfolio', 'indieground'),
		'not_found' =>  __('No Portfolio found', 'indieground'),
		'not_found_in_trash' => __('No Portfolio found in Trash', 'indieground'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'show_in_nav_menus' => false,
		'hierarchical' => false,
		'exclude_from_search' => true,
		'menu_position' => 6,
		'menu_position' => 6,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array('title','editor','thumbnail')
	);
	register_post_type('portfolio',$args);

    register_taxonomy("categories",
					"portfolio",
					array(
						"hierarchical" => true,
						"label" => __( "Categories", 'indieground'),
						"singular_label" => __( "Categories", 'indieground'),
						"rewrite" => array( 'slug' => 'categories', 'hierarchical' => true),
						'show_in_nav_menus' => false,
						)
				    );



//=================================================================
//========================= Team Section ==========================
//=================================================================


	$labels = array(
		'name' => __('Team', 'indieground'),
		'singular_name' => __('Team', 'indieground'),
		'add_new' => __('Add Member', 'indieground'),
		'add_new_item' => __('Add Member', 'indieground'),
		'edit_item' => __('Edit member', 'indieground'),
		'new_item' => __('New member', 'indieground'),
		'view_item' => __('View member', 'indieground'),
		'search_items' => __('Search member', 'indieground'),
		'not_found' =>  __('No member found', 'indieground'),
		'not_found_in_trash' => __('No member found in Trash', 'indieground'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'show_in_nav_menus' => false,
		'hierarchical' => false,
		'exclude_from_search' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-groups',
		'supports' => array('title','editor','thumbnail')
	);
	register_post_type('team',$args);


}

//=================================================================
//========================= Meta ==================================
//=================================================================


add_action('admin_init', 'indieground_set_user_metaboxes');
function indieground_set_user_metaboxes($user_id=NULL) {

    // These are the metakeys we will need to update
    $meta_key['order'] = 'meta-box-order_post';
    $meta_key['hidden'] = 'metaboxhidden_post';

    // So this can be used without hooking into user_register
    if ( ! $user_id)
        $user_id = get_current_user_id();

    // Set the default order if it has not been set yet
    if (!get_user_meta( $user_id, $meta_key['order'], true) ) {
        $meta_value = array(
            'side' => 'submitdiv,formatdiv,categorydiv,postimagediv',
            'normal' => 'postexcerpt,tagsdiv-post_tag,postcustom,commentstatusdiv,commentsdiv,trackbacksdiv,slugdiv,authordiv,revisionsdiv',
            'advanced' => '',
        );
        update_user_meta( $user_id, $meta_key['order'], $meta_value );
    }

    // Set the default hiddens if it has not been set yet
    if ( ! get_user_meta( $user_id, $meta_key['hidden'], true) ) {
        $meta_value = array('postcustom','trackbacksdiv','commentstatusdiv','commentsdiv','slugdiv','authordiv','revisionsdiv');
        update_user_meta($user_id, $meta_key['hidden'], $meta_value );
    }
}

?>
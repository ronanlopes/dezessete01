<?php




//==========================================================================
//========================= Function Indieground =============================
//==========================================================================
	require(get_template_directory().'/framework/include/aq_resizer.php' );
	require(get_template_directory().'/framework/include/functions.php' );

	include(get_template_directory().'/framework/meta/meta-boxes.php' );

	include(get_template_directory().'/framework/meta/meta-boxes-gallery.php' );
	include(get_template_directory().'/framework/include/theme-style.php');
	include(get_template_directory().'/framework/include/function-slider.php');
	include(get_template_directory().'/framework/sidebar/sidebar.php');



	if (!class_exists('ReduxFramework' ) && file_exists(get_template_directory().'/framework/options/core/framework.php' ) ) {
		require_once(get_template_directory().'/framework/options/core/framework.php' );
	}
	if (!isset( $redux_demo ) && file_exists(get_template_directory().'/framework/options/config.php' ) ) {
		require_once(get_template_directory().'/framework/options/config.php' );
	}

	if ( ! isset( $content_width ) ) {
		$content_width = 600;
	}





//=====================================================================
//=========================== PLUGIN ACTIVATION =======================
//=====================================================================

require_once(get_template_directory().'/framework/plugin-activation/init.php' );



//==========================================================================
//========================= THEME SETUP ====================================
//==========================================================================
if (!function_exists('tema_wp_setup')) {
	function indieground_wp_setup() {
		require(get_template_directory().'/framework/post-type/post-type.php');
		require(get_template_directory().'/framework/shortcode/shortcode.php');
		require(get_template_directory().'/framework/widget/widget.php');
	}

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'framework' ),
	));
}
add_action('after_setup_theme', 'indieground_wp_setup');


if ( ! function_exists('sort_sections') ){
	function sort_sections(){

		if(!has_nav_menu( 'primary' )){
			return;
		}

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['primary'] ) ) {
			$menu = wp_get_nav_menu_object( $locations['primary'] );
			$items  = wp_get_nav_menu_items($menu->term_id);
			$sections = array();
			foreach((array) $items as $key => $menu_items){
				if('page-sections' == $menu_items->object){
					$sections[] = $menu_items->object_id;
				}
			}
			return $sections;
		}
	}
}



//==========================================================================
//========================= NAV MENU OBJECT ================================
//==========================================================================
add_filter('wp_nav_menu_objects', 'nav_section_page' );
function nav_section_page($links) {
	foreach ($links as $link) {
		if('page-sections' == $link->object){
			$current_post = get_post($link->object_id);
			$menu_title = "#".$current_post->post_name;
				if(!is_home()){
					$link->url = home_url( '/' ).$menu_title;
				}else{
					$link->url = $menu_title;
				}
		}elseif('custom' == $link->type && !is_home()){
			if( 1 === preg_match('/^#([^\/]+)$/', $link->url , $matches)){
			 	$link->url = home_url( '/' ).$link->url;
			}
		}
	}
	return $links;
}

function indieground_enqueue_scripts() {
	global $indieground_options;

	//JS
	wp_enqueue_script('instafeed', get_template_directory_uri().'/include/js/instafeed.js', array(),'',false);
	wp_enqueue_script('jquery', get_template_directory_uri().'/include/js/jquery-1.10.1.min.js', array(),'',false);
	wp_enqueue_script('main', get_template_directory_uri().'/include/js/main.js', array(),'',true);
	wp_enqueue_script('plugin', get_template_directory_uri().'/include/js/plugin.js', array(),'',false);
	wp_enqueue_script('isotope', get_template_directory_uri().'/include/js/jquery.isotope.js', array(),'',true);
	wp_enqueue_script('hover', get_template_directory_uri().'/include/js/jquery-hover-effect.js', array(),'',true);
	wp_enqueue_script('modernizr', get_template_directory_uri().'/include/js/modernizr.custom.js', array(),'',true);
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/include/js/bootstrap.min.js', array(),'',true);
	wp_enqueue_script('nav', get_template_directory_uri().'/include/js/jquery.nav.js', array(),'',true);
	wp_enqueue_script('prettyPhoto-js', get_template_directory_uri().'/include/js/jquery.prettyPhoto.js', array(),'',true);
	wp_enqueue_script('wow-js', get_template_directory_uri().'/include/js/wow.min.js', array(),'',true);
	wp_enqueue_script('gmaps', 'http://maps.google.com/maps/api/js?sensor=false', array(),'',true);

	//CSS
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/include/css/bootstrap.min.css');
	wp_enqueue_style('prettyPhoto', get_template_directory_uri().'/include/css/prettyPhoto.css');
	wp_enqueue_style('animate-css', get_template_directory_uri().'/include/css/animate.css');

	wp_enqueue_style('style', get_template_directory_uri().'/style.css');


	$style="classic";
	if(!empty($indieground_options['indieground-general-style'])) {
		$style=$indieground_options['indieground-general-style'];
	}
	wp_enqueue_style('generalstyle', get_template_directory_uri().'/include/themes/'.$style.'/css/style.css');


	//CSS
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('prettyPhoto');
	wp_enqueue_style('style');
	wp_enqueue_style('generalstyle');
	wp_enqueue_style('animate-css');

	// Loads the javascript required for threaded comments
	if( is_singular() && comments_open() && get_option( 'thread_comments') )
        wp_enqueue_script( 'comment-reply' );

}
add_action('wp_enqueue_scripts', 'indieground_enqueue_scripts');

//==========================================================================
//========================= HEAD ADMIN SIDE ================================
//==========================================================================
function indieground_wpadmin_head() {

	//JS
	wp_register_script('main-option', get_template_directory_uri().'/framework/js/main-options.js', array('jquery'));
	wp_register_script('bootstrap-options', get_template_directory_uri().'/framework/js/bootstrap-options.js', array('jquery'));
	wp_register_script('jquery-tabslet', get_template_directory_uri().'/framework/js/jquery.tabslet.min.js', array('jquery'));
	wp_register_script('jquery-mobile', get_template_directory_uri().'/framework/js/jquery.mobile.custom.js', array('jquery'));
	wp_register_script('color-picker', get_template_directory_uri().'/framework/js/jquery.minicolors.js', array('jquery'));
	wp_register_script('jquery-ui-sortable', get_template_directory_uri().'/framework/js/jquery-ui.min.js', array('jquery-ui'));
	wp_register_script('gallery', get_template_directory_uri().'/framework/js/wp-gallery-admin.js', array('jquery'));

	//CSS
	wp_enqueue_style('mobile-custom-structure', get_template_directory_uri().'/framework/css/jquery.mobile.custom.structure.css');
	wp_enqueue_style('mobile-custom-theme', get_template_directory_uri().'/framework/css/jquery.mobile.custom.theme.css');
	wp_enqueue_style('mini-colors', get_template_directory_uri().'/framework/css/jquery.minicolors.css');
	wp_enqueue_style('gallery-css', get_template_directory_uri().'/framework/css/wp-gallery-admin.css');

	//JS
	wp_enqueue_script('main-option');
	wp_enqueue_script('bootstrap-options');
	wp_enqueue_script('jquery-tabslet');
	wp_enqueue_script('jquery-mobile');
	wp_enqueue_script('color-picker');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('gallery');
	//CSS
	wp_enqueue_script('mobile-custom-structure');
	wp_enqueue_script('mobile-custom-theme');
	wp_enqueue_script('mini-colors');
	wp_enqueue_script('gallery-css');



}
add_action('admin_init', 'indieground_wpadmin_head');






//==========================================================================
//============================ DYNAMIC STYLES  ==========================
//==========================================================================


function indie_enqueue_dynamic_css() {

	wp_register_style('custom_css', get_template_directory_uri() . '/include/css/custom.css.php', 'style');


	wp_enqueue_style('custom_css');
}

add_action('wp_print_styles', 'indie_enqueue_dynamic_css');









//==========================================================================
//============================ ADD THEME SUPPORT  ==========================
//==========================================================================
	add_theme_support('automatic-feed-links' );
	add_theme_support('post-thumbnails' );
	add_theme_support('post-thumbnails');
	add_theme_support('menus');

	add_image_size('indie', 1020, 300, true);
	add_image_size('thumb-blog-side', 215, 215, true );
	add_image_size('thumb-blog-full', 350, 200, true );
	add_image_size('index-thumb', 600, 999 );
	add_image_size('team-thumb', 150, 150, true );


//==========================================================================
//============================ TAG CLOUD  ==================================
//==========================================================================
function custom_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
add_filter('widget_tag_cloud_args', 'custom_tag_cloud_widget' );


//=======================================================================
//=========================== COMMENT STYLE =============================
//=======================================================================
if (!function_exists('indieground_comment')) {

	function indieground_comment($comment, $args, $depth) {
        $isByAuthor = false;
        if($comment->comment_author_email == get_the_author_meta('email')) {
            $isByAuthor = true;
        }

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-section">
                <div class="comment-side">
                	<?php echo get_avatar($comment,$size='60'); ?>
                	<div class="bot_polar"></div>
                </div>

                <div class="comment-cont">
                    <div class="comment-author">
                        <cite class="fn"><?php echo get_comment_author_link(); ?></cite>
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __('%1$s at %2$s', 'indieground'), get_comment_date(),  get_comment_time() ); ?></a>

                        <?php if( $isByAuthor ) { ?><span class="badge_author"></span><?php } ?>
                    </div>

                        <div class="comment-body">
                        <?php comment_text() ?>
                    </div>
                    <div class="comment-meta commentmetadata"><?php edit_comment_link(__('Edit', 'indieground'), '','') ?>  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    <?php if ( $comment -> comment_approved == '0') : ?>
                        <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'indieground') ?></em><br />
                    <?php endif; ?>
				</div>
            </div>
	<?php
	}
}



//=====================================================================
//=========================== NAVIGATION POST =========================
//=====================================================================
if (!function_exists('indie_pagination')) :
	function indie_pagination() {

		global $wp_query;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		echo paginate_links(array(
			'base' => @add_query_arg('page','%#%'),
			'format' => '?page=%#%',
			'current' => $current,
			'total' => $wp_query->max_num_pages
		) );
	}
endif;


//=====================================================================
//=========================== INFINITE SCROLL =========================
//=====================================================================
function wp_blogsscroll(){
    $paged = $_POST['page_no'];
    $type = $_POST['type'];
    $category = $_POST['cat'];

    if ($type=="S") {
    	echo indiegroundshortcode_blogsidebar_posts($paged,$category);
    } else if ($type=="F") {
    	echo indiegroundshortcode_blogfullwidth_posts($paged,$category);
    }
    die();
}
add_action('wp_ajax_blogsscroll', 'wp_blogsscroll');
add_action('wp_ajax_nopriv_blogsscroll', 'wp_blogsscroll');


//=====================================================================
//=========================== Custom Excerpt ==========================
//=====================================================================

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function content_limit($content, $limit) {
  $content = explode(' ', $content, $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}





?>
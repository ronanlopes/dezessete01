<?php
if ( ! isset( $content_width ) ) $content_width = 900;

function tf_time_passed($timestamp)
{
     $diff = time() - (int)$timestamp;

     if ($diff == 0) 
          return 'just now';

     $intervals = array
     (
         1                   => array('year',    31556926),
         $diff < 31556926    => array('month',   2628000),
         $diff < 2629744     => array('week',    604800),
         $diff < 604800      => array('day',     86400),
         $diff < 86400       => array('hour',    3600),
         $diff < 3600        => array('minute',  60),
         $diff < 60          => array('second',  1)
     );

      $value = floor($diff/$intervals[1][1]);
      return $value.' '.$intervals[1][0].($value > 1 ? 's' : '').' ago';
}


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
/**
 * tfuse_count_post_visits.
 * 
 * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;

        global $post;

        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        $views = intval($views);
        tf_update_post_meta( $post->ID, TF_THEME_PREFIX . '_post_viewed', ++$views);
    }
    add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;


if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;


if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
        comments_template( '' );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('no comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' comments','tfuse');
            } else {
                $comments = __('1 comment','tfuse');
            }
            $write_comments = $comments;
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }

endif;

if (!function_exists('tfuse_pagination')):
    
function tfuse_pagination( $args = array(), $query = '' ) {
   
    global $wp_rewrite, $wp_query;
        if ( $query ) {

            $wp_query = $query;

        } // End IF Statement
        /* If there's not more than one page, return nothing. */ 
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        
        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );  

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) ){
                if( isset($_GET['tax_games']) || isset($_GET['tax_reviews']) ){
                    $defaults['base'] = home_url() . '/page/%#%';
                }
                else{
                    $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
                }
            }
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults ); 

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );
		
		$permalink_structure = get_option('permalink_structure');
        if( (isset($_GET['tax_games']) && $permalink_structure!='') || (isset($_GET['tax_reviews']) && $permalink_structure!='')){
            $page_links2 = explode("\n", $page_links);
            $get_params = '?s=~';
            foreach($_GET as $key=>$value){
                if($key!='s'){
                    $get_params .= '&'.$key.'='.$value;
                }
            }
            $final = array();
            $home_url = home_url();
            foreach($page_links2 as $key=>$string){
                if(strpos( $string, "</a>" ) != false ){
                    $xml = new SimpleXMLElement($string);
                    if(isset($xml[0])){
                        $final[$key] = '<a class="page-numbers" href="'.$home_url.'/page/'.$xml[0].'/'.$get_params.'">'.$xml[0].'</a>';
                    }
                }
                else{
                    $final[$key] = $string;
                }
            }
            $page_links = implode("\n", $final);
        }

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <div class="pagination loop-pagination">
                        <?php echo get_previous_posts_link(__('<div class="prev page-numbers"><i class="tficon-chevron-left"></i></div>','tfuse'));?> 
                        <?php echo $page_links; ?>
                        <?php echo $next_posts = get_next_posts_link(__('<div class="next page-numbers"><i class="tficon-chevron-right"></i></div>','tfuse')); ?>	   
                </div>
            </nav>
            <?php
}
endif;

if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$TFUSE;
        $types = $TFUSE->request->isset_GET('types') ? $TFUSE->request->GET('types') : '';
        
        if($position == 'before') $position = 'content_top';
        elseif($position == 'after') $position =  'content_bottom';
        else $position = 'content_on_top';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {  
            if(tfuse_options('homepage_category')=='page'){
                $page_id = tfuse_options('home_page'); 
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
            $page_shortcodes = tfuse_options($position);
        }
        elseif($is_tf_blog_page)
        { 
            $position ='blog_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } 
        elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        } 
        elseif(is_search() && $TFUSE->request->isset_GET('tax_games'))
        { 
            $page_shortcodes = tfuse_options($position,'',$TFUSE->request->GET('tax_games'));
        }
        elseif(is_search() && $TFUSE->request->isset_GET('tax_reviews'))
        { 
            $page_shortcodes = tfuse_options($position,'',$TFUSE->request->GET('tax_reviews'));
        }
        elseif(is_search())
        { 
           $position ='search_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_tax()) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }
        elseif(is_404())
        { 
           $position ='404_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        
        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes;
        else
        {
            if((($position == 'content_bottom') && !empty($page_shortcodes)) || (($position == 'blog_content_bottom') && !empty($page_shortcodes)) || (($position == '404_content_bottom') && !empty($page_shortcodes)) || (($position == 'search_content_bottom') && !empty($page_shortcodes)))
                echo $page_shortcodes;
            elseif((($position == 'content_top') && !empty($page_shortcodes)) || (($position == 'blog_content_top') && !empty($page_shortcodes)) || (($position == '404_content_top') && !empty($page_shortcodes)) || (($position == 'search_content_top') && !empty($page_shortcodes)))
                    echo $page_shortcodes;
            elseif((($position == 'content_on_top') && !empty($page_shortcodes)) || (($position == 'blog_content_on_top') && !empty($page_shortcodes)) || (($position == '404_content_on_top') && !empty($page_shortcodes)) || (($position == 'search_content_on_top') && !empty($page_shortcodes)))
                echo '<div class="adv-head">'.$page_shortcodes.'</div>';
        }
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;           
            
            $specific = tfuse_options('categories_select_categ');

            $ids = explode(",",$specific);
            $posts = array(); 
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
                        
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');

            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive.php';

            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
 
    }

// End function tfuse_category_on_front_page()
endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page; 
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        else
        {  
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();

            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;

add_filter('get_archives_link','wid_link',99);
if (!function_exists('wid_link')) :
    function wid_link($url) {
        $url = str_replace( '</a>&nbsp;', '&nbsp;', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

add_filter('wp_list_bookmarks','wid_link1',99);
if (!function_exists('wid_link1')) :
    function wid_link1($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

if (!function_exists('tfuse_action_footer')) :

/**
 * Dsiplay footer content
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_footer() {

    ?>
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-4'); ?>
            </div>
        <?php
    }
    add_action('tfuse_footer', 'tfuse_action_footer');
endif;

    
function new_excerpt_more( $more ) {
    $more = '';
        return $more;
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if (!function_exists('tfuse_group_title')) :
    function tfuse_group_title(){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $ID = $term->term_id;
        $title = tfuse_options('group_title',null,$ID);
        echo $title;
    }
endif;

if(!function_exists('tfuse_feedFilter')) :

    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');

    function tfuse_feedContentFilter($content) {
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }

endif;

if (!function_exists('tfuse_aasort')) :
    /**
     *
     *
     * To override tfuse_aasort() in a child theme, add your own tfuse_aasort()
     * to your child theme's file.
     */
    function tfuse_aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        if (!$array){$array = array();}
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        return $ret;
    }
endif;

function tfuse_change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/',' class="submenu-1" ',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','tfuse_change_submenu_class');


//display logo
if (!function_exists('tfuse_type_logo')) :
    function tfuse_type_logo() { 
        $logo_type = tfuse_options('logo_type');
    
        if($logo_type == 'img')
        {
            $logo_upload = tfuse_options('logo');
            if(!empty($logo_upload)) 
            {  ?> 
                  <h1 class="site-title"><a href="<?php echo home_url(); ?>"><img src="<?php echo tfuse_options('logo'); ?>"  border="0" /></a></h1>
      <?php }
        }
        else
        { ?>
            <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php echo tfuse_options('logo_text','Games<span>Zone</span>'); ?></a></h1>
      <?php  }
    }
endif;

if (!function_exists('tfuse_shorten_string')) :
    /**
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_shorten_string($string, $wordsreturned)

{
    $retval = $string;

    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)

    {
        $retval = $string;
    }
    else

    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)." ...";
    }
    return $retval;
}

endif;


if (!function_exists('tfuse_user_has_gravatar')){
    function tfuse_user_has_gravatar( $email_address ) {
        // Build the Gravatar URL by hasing the email address
        $url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim ( $email_address ) ) ) . '?d=404';
        // Now check the headers
        $headers = @get_headers( $url );
        // If 200 is found, the user has a Gravatar; otherwise, they don't.
        return preg_match( '|200|', $headers[0] ) ? true : false;
    }
}


if (!function_exists('tfuse_filter_get_avatar')){
    function tfuse_filter_get_avatar($avatar, $id_or_email, $size, $default, $alt){
        $avatar_src = tfuse_options('default_avatar', false);
        if(empty($avatar_src)) {
            return $avatar;
        }

        $email = '';
        if ( is_numeric($id_or_email) ) {
            $id = (int) $id_or_email;
            $user = get_userdata($id);
            if ( $user )
                $email = $user->user_email;
        } elseif ( is_object($id_or_email) ) {
            // No avatar for pingbacks or trackbacks
            $allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
            if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
                return false;

            if ( !empty($id_or_email->user_id) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_userdata($id);
                if ( $user)
                    $email = $user->user_email;
            } elseif ( !empty($id_or_email->comment_author_email) ) {
                $email = $id_or_email->comment_author_email;
            }
        } else {
            $email = $id_or_email;
        }

        if(!tfuse_user_has_gravatar($email)){
            $avatar = "<img alt='' src='".TF_GET_IMAGE::get_src_link($avatar_src, $size, $size)."' class='avatar avatar-".$size." photo avatar-default' height='".$size."' width='".$size."' />";
        }

        return $avatar;
    }
    add_filter('get_avatar', 'tfuse_filter_get_avatar',10,5);
}


add_theme_support( 'automatic-feed-links' );


function tfuse_feedburner_url($output, $feed)
{
    $feedburner_url = tfuse_options('feedburner_url');
    if($feedburner_url && (($feed == 'rss2') || ($feed == '' && false === strpos($output, '/comments/feed/'))) )
        return $feedburner_url;
    return $output;
}
add_filter('feed_link','tfuse_feedburner_url',10,2);


if ( !function_exists('tfuse_show_filter')):
    function tfuse_show_filter(){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $group = $term->taxonomy;
        $term_id = $term->term_id;
        $template_slug= $term->slug;
        $template_parent= $term->parent;
        $args = array( 'taxonomy' => $group );
        $terms = get_terms($group, $args);

        $count = count($terms);
        $i=0;
        if($template_parent==0) $template_parent = $term_id;

            if ($count > 0)
            {
                    $term_list='';$term_list_view_all ='';
                foreach ($terms as $term)
                {                      
                    $i++;
                    if($template_parent != $term->parent)
                        if($term->slug==$template_slug)
                        {
                            $term_list_view_all .= '<li class="current-menu-item"><a href="'.get_bloginfo('url').'/?'.$term->taxonomy.'=' .$term->slug.  '" class="btn btn-simple btn-sm active">' . $term->name . '</a></li>';
                        }
                        elseif($template_parent==$term->term_id)
                        {

                            $term_list_view_all .= '<li><a href="'.get_bloginfo('url').'/?'.$term->taxonomy.'=' .$term->slug.  '" class="btn btn-simple btn-sm">' . $term->name . '</a></li>';
                        }

                        if( $template_parent==$term->parent)
                        {
                            if($term->slug == $template_slug)
                            {		
                                $term_list .= '<li class="current-menu-item"><a href="'.get_bloginfo('url').'/?'.$term->taxonomy.'=' .$term->slug.  '" class="btn btn-simple btn-sm active">' . $term->name . '</a></li>';
                            }
                            else
                            {

                                $term_list .= '<li><a href="'.get_bloginfo('url').'/?'.$term->taxonomy.'=' .$term->slug.  '" class="btn btn-simple btn-sm">' . $term->name . '</a></li>';
                            }
                        }
                }
                    echo $term_list_view_all.$term_list;
            }
    }
endif;

if ( !function_exists('tfuse_cat_links')):
    function tfuse_cat_links($post_type,$id){
        if($post_type == 'post')
            return get_the_category_list(', ');
        elseif($post_type == 'gallery')
            return get_the_term_list($id,'galleries', '', ', ' );
        elseif($post_type == 'event')
            return get_the_term_list($id,'events', '', ', ' );
        elseif($post_type == 'guide')
            return get_the_term_list($id,'guides', '', ', ' );
        else
            return get_the_term_list($id,'videos', '', ', ' );
    }
endif;

if ( !function_exists('tfuse_game_cat_links')):
    function tfuse_game_cat_links($post_id){
    
            
        $terms_platforms = wp_get_post_terms( $post_id, 'platforms_game' );
        $terms_genres = wp_get_post_terms( $post_id, 'genres_game' );
        $terms_producers = wp_get_post_terms( $post_id, 'producers_game' );
        $terms_age = wp_get_post_terms( $post_id, 'age_ratings' );
        
        if(!empty($terms_platforms) || !empty($terms_genres) || !empty($terms_producers) || !empty($terms_age))
        {
            $platforms_link = $genres_link = $producers_link = $age_link = '';
            
            if(!empty($terms_platforms))
            {
                foreach ($terms_platforms as $term) {
                    $platforms_link .= $term->name.', ';
                }
            }
            
            if(!empty($terms_genres))
            {
                foreach ($terms_genres as $term) {
                    $genres_link .= $term->name.', ';
                }
            }
            
            if(!empty($terms_producers))
            {
                foreach ($terms_producers as $term) {
                    $producers_link .= $term->name.', ';
                }
            }
            
            if(!empty($terms_age))
            {
                foreach ($terms_age as $term) {
                    $age_link .= $term->name.', ';
                }
            }
            
            echo substr($platforms_link.$genres_link.$producers_link.$age_link, 0, -2);
        }
    }
endif;

if ( !function_exists('tfuse_review_cat_links')):
    function tfuse_review_cat_links($post_id){
    
        $terms = wp_get_post_terms( $post_id, 'reviews' );
        
        if(!empty($terms))
            foreach ($terms as $term) {
                echo '<a href="'.get_term_link( $term, 'reviews' ).'">'.$term->name.'</a>'; break;
            }
            
        $terms_platforms = wp_get_post_terms( $post_id, 'platforms' );
        $terms_genres = wp_get_post_terms( $post_id, 'genres' );
        
        if(!empty($terms_platforms) || !empty($terms_genres))
        {
            $platforms_link = $genres_link = '';
            
            if(!empty($terms_platforms))
            {
                foreach ($terms_platforms as $term) {
                    $platforms_link .= '&platforms_'.$term->term_id.'='.$term->term_id;
                }
            }
            
            if(!empty($terms_genres))
            {
                foreach ($terms_genres as $term) {
                    $genres_link .= '&genres_'.$term->term_id.'='.$term->term_id;
                }
            }
            
            $count = count($terms_platforms) + count($terms_genres);
            echo ', <a href="?s=~&price-range=0%3B10&tax_reviews= '.$platforms_link.$genres_link.'">'.$count .' '.__('More','tfuse').'</a>';
        }
    }
endif;

if (!function_exists('tfuse_pre_get_posts')) :
    
function tfuse_pre_get_posts($query){
    global $TFUSE; $ids = $p_ids = array();
    
    if(($query->is_search && $TFUSE->request->isset_GET('tax_games')) || ($query->is_search && $TFUSE->request->isset_GET('tax_reviews')))
    {        
        $search = $TFUSE->request->GET('s');
		
		if($search == '~') 
		{
			$all_posts = tfuse_get_search_posts();
			
			$all_posts->is_search = true;
			$all_posts->is_archive = false;
			global $wp_query;
			$wp_query = $all_posts;
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'tfuse_pre_get_posts');

endif;

if (!function_exists('tfuse_get_search_posts')) :
    
function tfuse_get_search_posts(){
    global $TFUSE; $ids = $p_ids = $all_posts = array(); 

    if($TFUSE->request->isset_GET('tax_reviews'))
    {
        $ids = tfuse_get_search_tems();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $search = $TFUSE->request->GET('s');
		
		$searched_query = ($search !== '~') ? array('s' => $search) : '';

        if(!empty($ids['platforms']) && !empty($ids['genres']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'review',
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                            'taxonomy' => 'platforms',
                            'field' => 'id',
                            'terms' => $ids['platforms']
                    ),
                    array(
                            'taxonomy' => 'genres',
                            'field' => 'id',
                            'terms' => $ids['genres'],
                    )
                )
            );
        }
        elseif(!empty($ids['platforms']) && empty($ids['genres']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'review',
                'tax_query' => array(
                    array(
                            'taxonomy' => 'platforms',
                            'field' => 'id',
                            'terms' => $ids['platforms']
                        )
                )
            );
        }
        elseif(empty($ids['platforms']) && !empty($ids['genres']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'review',
                'tax_query' => array(
                    array(
                            'taxonomy' => 'genres',
                            'field' => 'id',
                            'terms' => $ids['genres']
                        )
                )
            );
        }
        else
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'review'
            );
        }
        
        if(is_array($searched_query))
			$args = array_merge($args,$searched_query);
										
		$all_posts = new WP_Query( $args );
        
    }
    
    if($TFUSE->request->isset_GET('tax_games'))
    {        
		$ids = tfuse_get_search_tems();
		
        $search = $TFUSE->request->GET('s');
		
		$searched_query = ($search !== '~') ? array('s' => $search) : '';

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		        
        $platforms_args = array(
                            'taxonomy' => 'platforms_game',
                            'field' => 'id',
                            'terms' => $ids['platforms']
                        );
        $genres_args = array(
                            'taxonomy' => 'genres_game',
                            'field' => 'id',
                            'terms' => $ids['genres'],
                        );
        $producers_args = array(
                            'taxonomy' => 'producers_game',
                            'field' => 'id',
                            'terms' => $ids['producers'],
                        );
        $age_args = array(
                        'taxonomy' => 'age_ratings',
                        'field' => 'id',
                        'terms' => $ids['age'],
                    );
        
        if(!empty($ids['platforms']) && !empty($ids['genres']) && !empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $platforms_args,
                    $genres_args,
                    $producers_args,
                    $age_args
                )
            );
        }
        elseif(!empty($ids['platforms']) && !empty($ids['genres']) && !empty($ids['producers']) && empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $platforms_args,
                    $genres_args,
                    $producers_args,
                )
            );
        }
        elseif(!empty($ids['platforms']) && empty($ids['genres']) && !empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                        $platforms_args,
                        $producers_args,
                        $age_args
                )
            );
        }
        elseif(empty($ids['platforms']) && !empty($ids['genres']) && !empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                        $genres_args,
                        $producers_args,
                        $age_args
                )
            );
        }
        elseif(!empty($ids['platforms']) && !empty($ids['genres']) && empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $platforms_args,
                    $genres_args,
                    $age_args
                )
            );
        }
        elseif(!empty($ids['platforms']) && !empty($ids['genres']) && empty($ids['producers']) && empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $platforms_args,
                    $genres_args
                )
            );
        }
        elseif(!empty($ids['platforms']) && empty($ids['genres']) && !empty($ids['producers']) && empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $platforms_args,
                    $producers_args
                )
            );
        }
        elseif(!empty($ids['platforms']) && empty($ids['genres']) && empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $platforms_args,
                    $age_args
                )
            );
        }
        elseif(empty($ids['platforms']) && !empty($ids['genres']) && !empty($ids['producers']) && empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $genres_args,
                    $producers_args
                )
            );
        }
        elseif(empty($ids['platforms']) && !empty($ids['genres']) && empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $genres_args,
                    $age_args
                )
            );
        }
        elseif(empty($ids['platforms']) && empty($ids['genres']) && !empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    'relation' => 'OR',
                    $producers_args,
                    $age_args
                )
            );
        }
        elseif(!empty($ids['platforms']) && empty($ids['genres']) && empty($ids['producers']) && empty($ids['age']))
        {
            $args = array(
               'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    $platforms_args
                )
            );
        }
        elseif(empty($ids['platforms']) && !empty($ids['genres']) && empty($ids['producers']) && empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    $genres_args
                )
            );
        }
        elseif(empty($ids['platforms']) && empty($ids['genres']) && !empty($ids['producers']) && empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    $producers_args
                )
            );
        }
        elseif(empty($ids['platforms']) && empty($ids['genres']) && empty($ids['producers']) && !empty($ids['age']))
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
                'tax_query' => array(
                    $age_args
                )
            );
        }
        else
        {
            $args = array(
                'paged' => $paged,
                'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
                'post_type' => 'game',
            );
        }
        
        if(is_array($searched_query))
			$args = array_merge($args,$searched_query);
										
		$all_posts = new WP_Query( $args );
    }
	return $all_posts;
}

endif;

if (!function_exists('tfuse_get_search_tems')) :

function tfuse_get_search_tems()
{
    global $TFUSE; $ids = array();
    if((is_search() && $TFUSE->request->isset_GET('tax_reviews')))
    {
        $platforms = $genres = array();
        
        $gets = $TFUSE->request->GET();
        
        $price_range = $TFUSE->request->GET('price-range'); 
        
        foreach ($gets as $key => $value) {
            if (strpos($key, 'platforms') !== false)
                $platforms[] = $value;
            
            if (strpos($key, 'genres') !== false)
                $genres[] = $value;
        }
        
        $ids['price-range'] = explode(';',$price_range);
        
        $ids['platforms'] = $platforms;
        $ids['genres'] = $genres;
    }
    
    if((is_search() && $TFUSE->request->isset_GET('tax_games')))
    {
        $platforms = $genres = $producers = $age = array();
        
        $gets = $TFUSE->request->GET();
        
        foreach ($gets as $key => $value) {
            if (strpos($key, 'platforms') !== false)
                $platforms[] = $value;
            
            if (strpos($key, 'genres') !== false)
                $genres[] = $value;
            
            if (strpos($key, 'producers') !== false)
                $producers[] = $value;
            
            if (strpos($key, 'age_') !== false)
                $age[] = $value;
        }
        
        $ids['platforms'] = $platforms;
        $ids['genres'] = $genres;
        $ids['producers'] = $producers;
        $ids['age'] = $age;
    }
    
    return $ids;
}

endif;

if (!function_exists('tf_get_search_sidebar')) :
    
function tf_get_search_sidebar($placeholder_id) { 
    global $TFUSE;
    $saved_sidebars = get_option(TF_THEME_PREFIX . '_tfuse_sidebars');
    
    if($TFUSE->request->isset_GET('tax_reviews'))
    {
        if(!empty($saved_sidebars['settings']['by_id_reviews'][$TFUSE->request->GET('tax_reviews')]['sidebars']))
            $sidebars = $saved_sidebars['settings']['by_id_reviews'][$TFUSE->request->GET('tax_reviews')]['sidebars'];
        elseif(!empty($saved_sidebars['settings']['default_reviews']['sidebars']))
            $sidebars = $saved_sidebars['settings']['default_reviews']['sidebars'];
        else
            $sidebars = $TFUSE->ext->sidebars->current_sidebars;
    }
    elseif($TFUSE->request->isset_GET('tax_games'))
    {
        if(!empty($saved_sidebars['settings']['by_id_games'][$TFUSE->request->GET('tax_games')]['sidebars']))
            $sidebars = $saved_sidebars['settings']['by_id_games'][$TFUSE->request->GET('tax_games')]['sidebars'];
        elseif(!empty($saved_sidebars['settings']['default_games']['sidebars']))
            $sidebars = $saved_sidebars['settings']['default_games']['sidebars'];
        else
            $sidebars = $TFUSE->ext->sidebars->current_sidebars;
    }
    else
        $sidebars = $TFUSE->ext->sidebars->current_sidebars;
    
    if (count($sidebars) > 0) {
        $cfg = $TFUSE->get->ext_config('SIDEBARS', 'base');
        $colors = $cfg['sidebars_colors'];
        $colors_flipped = array_flip($colors);
        if (is_string($placeholder_id)) {
            
            
            if (isset($sidebars[$colors_flipped[$placeholder_id] - 1])) {
                $i = $k = 0;
                
                foreach ($sidebars[$colors_flipped[$placeholder_id] - 1] as $key => $val) {  
                    
                    $i++;
                    if (!is_active_sidebar($val)) {
                        $k++;
                    }
                    else
                        dynamic_sidebar($val);
                }
                if ($i == $k) {
                    $TFUSE->load->ext_view('SIDEBARS', 'no_widgets_message');
                }
            }
        }
    }
}

endif;

//get blog posts that relates to current game post
if (!function_exists('tfuse_get_game_news')) :

function tfuse_get_game_news($post_id)
{
    $news_posts = array();
    $args = array(
                'posts_per_page' => -1,
                'post_type' => 'post'
            );
    
    $all_posts = new WP_Query( $args );
    $posts = $all_posts->posts;
    
    if(!empty($posts))
        foreach ($posts as $post) {
            $games_posts = explode(',',tfuse_page_options('game_select','',$post->ID));
            
            if(in_array($post_id, $games_posts))
                $news_posts[] = $post->ID;
        }
        
    return $news_posts;
}

endif;

if ( !function_exists('tfuse_js_posts_per_page')):

    function tfuse_js_posts_per_page() {
        $items = get_option('posts_per_page');

        wp_localize_script(
                'general',
                'display',
                array(
                    'items' => $items
                )
            );
    }
    add_action('wp_print_scripts', 'tfuse_js_posts_per_page', 1000);
endif;



if ( !function_exists('tfuse_render_view')):

function tfuse_render_view($file_path, $view_variables = array()) {
	extract($view_variables, EXTR_REFS);

	ob_start();

	require $file_path;

	return ob_get_clean();
}
endif;

if ( ! function_exists( 'tfuse_get_slides_from_posts' ) ):
/**
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */
    function tfuse_get_slides_from_posts( $posts=array(), $slider = array() )
    {
        global $post;
        
        $slides = array();
        $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? $slider['general']['slider_image_resize'] : false;
        $k = 0;
        foreach ($posts as $k => $post) : $k++;
            setup_postdata( $post );  

            $tfuse_image = $image = null;

            $image = new TF_GET_IMAGE();
            
            if($slider['design'] == 'carousel')
            {
            
                if($slider_image_resize)
                    $tfuse_image = get_the_post_thumbnail($post->ID, 'medium-thumb');
                else
                    $tfuse_image = ' <img src="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails')).'" width="200" style="height:200px" alt=""/>';

                $title = get_the_title($post->ID);
                
                $slides[$k]['slide_title'] = $title;
                $slides[$k]['slide_src'] = $tfuse_image;
                $slides[$k]['slide_url'] = get_permalink();
                $slides[$k]['slide_rating'] = tfuse_page_options('rating','',$post->ID);
                $slides[$k]['slide_enable_rating'] = ( isset($slider['general']['sliders_posts_rating']) && $slider['general']['sliders_posts_rating'] == 'true' ) ? $slider['general']['sliders_posts_rating'] : false;
            }
            elseif($slider['design'] == 'carousel_medium'){
                if($slider_image_resize)
                    $tfuse_image = get_the_post_thumbnail($post->ID, 'carousel-medium-thumb');
                else
                    $tfuse_image = ' <img src="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails')).'" width="360" style="height:240" alt=""/>';
                
                $title = get_the_title($post->ID);
                if (mb_strlen($title, 'UTF-8') > 20)  $title = substr($title, 0 ,30);
                $slides[$k]['slide_title'] = $title;
                $slides[$k]['slide_src'] = $tfuse_image;
                $slides[$k]['slide_url'] = get_permalink();
            }
            elseif($slider['design'] == 'video'){
                
                $cats = '';
                
                if($slider['general']['sliders_posts_from'] == 'video')
                    $terms = wp_get_post_terms( $post->ID ,'videos');
                else
                    $terms = wp_get_post_terms( $post->ID ,'platforms');
                
                if(!empty($terms))
                    foreach ($terms as $term) {
                        $cats .= $term->name.', ';
                    }

                $tfuse_image = ' <img src="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails')).'" width="75" style="height:75" alt=""  class="video-thumb"/>';
                
                $title = get_the_title($post->ID);
                $slides[$k]['slide_title'] = $title;
                $slides[$k]['slide_src'] = $tfuse_image;
                $slides[$k]['slide_rating'] = tfuse_page_options('rating','',$post->ID);
                $slides[$k]['slide_video'] = tfuse_page_options('video_links','',$post->ID);
                $slides[$k]['slide_cats'] = substr($cats, 0, -2);;
            }
            elseif($slider['design'] == 'content'){
                
                if($slider_image_resize)
                    $tfuse_image = get_the_post_thumbnail($post->ID, 'content-slider-thumb');
                else
                    $tfuse_image = ' <img src="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails')).'" width="430" style="height:297" alt=""/>';

                
                $title = get_the_title($post->ID);
                $slides[$k]['slide_title'] = $title;
                $slides[$k]['slide_src'] = $tfuse_image;
                $slides[$k]['slide_align_img'] = ( isset($slider['general']['posts_select_align']) && $slider['general']['posts_select_align'] == 'alignleft' ) ? '' : 'image-right';
                $slides[$k]['slide_url'] = get_permalink();
                $slides[$k]['slide_content'] = tfuse_substr( get_the_excerpt(), 300 );
            }
            elseif($slider['design'] == 'home'){
                $img = tfuse_page_options('game_header','',$post->ID);
                
                if(empty($img)) continue;
                
                if($slider_image_resize)
                {
                    $image = new TF_GET_IMAGE();
                    $tfuse_image = $image->width(1349)->height(430)->src($img)->resize($slider_image_resize)->get_src();
                }
                else
                    $tfuse_image = $img;

                
                $title = get_the_title($post->ID);
                $slides[$k]['slide_title'] = $title;
                $slides[$k]['slide_src'] = $tfuse_image;
                $slides[$k]['slide_url'] = get_permalink();
                $slides[$k]['slide_button'] = __('READ MORE','tfuse');
                $slides[$k]['slide_content'] = tfuse_page_options('description','',$post->ID);
            }
        endforeach;
		wp_reset_postdata();
                
        return $slides;
    }
endif;


if ( !function_exists('tfuse_cat_title')):

function tfuse_cat_title() {
    global $is_tf_front_page,$is_tf_blog_page;
    
    if($is_tf_front_page)
    {
        $select = tfuse_options('homepage_category');
        
        if($select == 'all')
            _e('Latest News','tfuse');
        elseif($select == 'specific')
        {
            $cats = tfuse_options('categories_select_categ');
            
            $cats = explode(',', $cats);
            
            if(count($cats) == 1)
                echo get_cat_name($cats[0]);
            else
                _e('Latest News','tfuse');
        }
    }
    elseif($is_tf_blog_page)
    {
        $select = tfuse_options('blogpage_category');
        
        if($select == 'all')
            _e('Latest News','tfuse');
        elseif($select == 'specific')
        {
            $cats = tfuse_options('categories_select_categ_blog');
            
            $cats = explode(',', $cats);
            
            if(count($cats) == 1)
                echo get_cat_name($cats[0]);
            else
                _e('Latest News','tfuse');
        }
    }
    else
        single_cat_title();
}
endif;

if( !function_exists('tf_events_calendar_options') )
{
    function tf_events_calendar_options()
    {

        $general_opts['datepicker_opts']    = array(
            'firstDay'          => 0,
            'currentText'       => __('Today', 'tfuse'),
            'monthNames'        => array(__('January', 'tfuse'), __('February', 'tfuse'), __('March', 'tfuse'), __('April', 'tfuse'), __('May', 'tfuse'), __('June', 'tfuse'), __('July', 'tfuse'), __('August', 'tfuse'), __('September', 'tfuse'), __('October', 'tfuse'),__('November', 'tfuse'), __('December', 'tfuse')),
            'monthNamesShort'   => array(__('Jan', 'tfuse'), __('Feb', 'tfuse'), __('Mar', 'tfuse'), __('Apr', 'tfuse'), __('May', 'tfuse'), __('Jun', 'tfuse'), __('Jul', 'tfuse'), __('Aug', 'tfuse'), __('Sep', 'tfuse'), __('Oct', 'tfuse'), __('Nov', 'tfuse'), __('Dec', 'tfuse')),
            'dayNames'          => array(__('Sunday', 'tfuse'), __('Monday', 'tfuse'), __('Tuesday', 'tfuse'), __('Wednesday', 'tfuse'), __('Thursday', 'tfuse'), __('Friday', 'tfuse'), __('Saturday', 'tfuse')),
            'dayNamesMin'       => array(__('Sun', 'tfuse'), __('Mon', 'tfuse'), __('Tue', 'tfuse'), __('Wed', 'tfuse'), __('Thu', 'tfuse'), __('Fri', 'tfuse'), __('Sat', 'tfuse')),
            'dayNamesShort'     => array(__('Su', 'tfuse'), __('Mo', 'tfuse'), __('Tu', 'tfuse'), __('We', 'tfuse'), __('Th', 'tfuse'), __('Fr', 'tfuse'),__('Sa', 'tfuse')),
            'weekHeader'        => __('Wk', 'tfuse'),
        );

        $opts = apply_filters('tf_events_general_eventsjs', $general_opts);

        wp_localize_script('general', 'tf_calendar', apply_filters('tf_events_generaljs', $opts));
        wp_localize_script('events', 'tf_calendar', apply_filters('tf_events_eventsjs', $opts));
    }
}
add_action('tf_scripts_added', 'tf_events_calendar_options');

if( !function_exists('tfuse_theme_styles') )
{
    function tfuse_theme_styles($values = array(),$options = array())
    {
        if (empty($options))
            return;
        
        $output = '';
        
        $body_font = $options[TF_THEME_PREFIX . '_body_font'];
        $h_font = $options[TF_THEME_PREFIX . '_h_font'];
        
        if(!empty($body_font))
        {
            switch ($body_font) {
                case 'roboto': 
                    $font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700'; 
                    $b_family ='"Roboto Slab", serif';
                    break;
                case 'cabin': 
                    $font = 'http://fonts.googleapis.com/css?family=Cabin';
                    $b_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $font = 'http://fonts.googleapis.com/css?family=Droid+Sans'; 
                    $b_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata': 
                    $font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $b_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $font = 'http://fonts.googleapis.com/css?family=Oxygen'; 
                    $b_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher': 
                    $font = 'http://fonts.googleapis.com/css?family=Philosopher';
                    $b_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial': 
                    $font = 'http://fonts.googleapis.com/css?family=Questrial'; 
                    $b_family ="'Questrial', sans-serif";
                    break;
                case 'raleway': 
                    $font = 'http://fonts.googleapis.com/css?family=Raleway';
                    $b_family ="'Raleway', sans-serif";
                    break;
                case 'signika': 
                    $font = 'http://fonts.googleapis.com/css?family=Signika';
                    $b_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $font = 'http://fonts.googleapis.com/css?family=Ubuntu'; 
                    $b_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia': 
                    $font = ''; 
                    $b_family ="'Georgia', serif";
                    break;
                case 'arial': 
                    $font = ''; 
                    $b_family ="'Arial', sans-serif";
                    break;
                case 'arbutus': 
                    $font = 'http://fonts.googleapis.com/css?family=Arbutus+Slab'; 
                    $b_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter': 
                    $font = 'http://fonts.googleapis.com/css?family=Bitter'; 
                    $b_family ="'Bitter', serif";
                    break;
                case 'coustard': 
                    $font = 'http://fonts.googleapis.com/css?family=Coustard';
                    $b_family ="'Coustard', serif";
                    break;
                case 'droid_serif': 
                    $font = 'http://fonts.googleapis.com/css?family=Droid+Serif';
                    $b_family ="'Droid Serif', serif";
                    break;
                case 'eb': 
                    $font = 'http://fonts.googleapis.com/css?family=EB+Garamond';
                    $b_family ="'EB Garamond', serif";
                    break;
                case 'goudy': 
                    $font = 'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $b_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta': 
                    $font = 'http://fonts.googleapis.com/css?family=Kotta+One';
                    $b_family ="'Kotta One', serif";
                    break;
                case 'playfair': 
                    $font = 'http://fonts.googleapis.com/css?family=Playfair+Display';
                    $b_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka': 
                    $font = 'http://fonts.googleapis.com/css?family=Vidaloka';
                    $b_family ="'Vidaloka', serif";
                    break;

                default: 
                    $font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $b_family = '"Gafata", sans-serif';
                    break;
            }
        }
        else
        {
            $output .= '
                    // Load Custom Fonts
                    @import url(http://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Gafata|Lato:300,700);

                    @font-family-sans-serif:  "Gafata", sans-serif;
                    @font-family-serif:       "Roboto Slab", serif;
                    
                    ';
        }
        
        if(!empty($h_font))
        {
            switch ($h_font) {
                case 'roboto': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700'; 
                    $h_family ='"Roboto Slab", serif';
                    break;
                case 'cabin': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Cabin';
                    $h_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $head_font = 'http://fonts.googleapis.com/css?family=Droid+Sans'; 
                    $h_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $h_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $head_font = 'http://fonts.googleapis.com/css?family=Oxygen'; 
                    $h_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Philosopher';
                    $h_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Questrial'; 
                    $h_family ="'Questrial', sans-serif";
                    break;
                case 'raleway': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Raleway';
                    $h_family ="'Raleway', sans-serif";
                    break;
                case 'signika': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Signika';
                    $h_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $head_font = 'http://fonts.googleapis.com/css?family=Ubuntu'; 
                    $h_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia': 
                    $head_font = ''; 
                    $h_family ="Georgia, serif";
                    break;
                case 'arial': 
                    $head_font = ''; 
                    $h_family ="Arial, sans-serif";
                    break;
                case 'arbutus': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Arbutus+Slab'; 
                    $h_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Bitter'; 
                    $h_family ="'Bitter', serif";
                    break;
                case 'coustard': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Coustard';
                    $h_family ="'Coustard', serif";
                    break;
                case 'droid_serif': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Droid+Serif';
                    $h_family ="'Droid Serif', serif";
                    break;
                case 'eb': 
                    $head_font = 'http://fonts.googleapis.com/css?family=EB+Garamond';
                    $h_family ="'EB Garamond', serif";
                    break;
                case 'goudy': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $h_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Kotta+One';
                    $h_family ="'Kotta One', serif";
                    break;
                case 'playfair': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Playfair+Display';
                    $h_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka': 
                    $head_font = 'http://fonts.googleapis.com/css?family=Vidaloka';
                    $h_family ="'Vidaloka', serif";
                    break;

                default: 
                    $head_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700'; 
                    $h_family ='"Roboto Slab", serif';
                    break;
            }
        }
                
        
        if(!empty($font))
            $output .= '
                    @import url('.$font.');

                    @font-family-sans-serif:  '.$b_family.';';
        else
            $output .= '
                    @font-family-sans-serif:  '.$b_family.';';
        
        if(!empty($head_font))
            $output .= '
                    @import url('.$head_font.');

                    @font-family-serif:  '.$h_family.';';
        else
            $output .= '
                    @font-family-serif:  '.$h_family.';';
        
        $primary_color = $options[TF_THEME_PREFIX . '_primary_color'];
        $bg_color = $options[TF_THEME_PREFIX . '_bg_color'];
        $text_color = $options[TF_THEME_PREFIX . '_text_color'];
        $link_color = $options[TF_THEME_PREFIX . '_link_color'];
        $menu_color = $options[TF_THEME_PREFIX . '_menu_color'];
        $menu_color_bot = $options[TF_THEME_PREFIX . '_menu_color_bot'];
        $footer_color = $options[TF_THEME_PREFIX . '_footer_color'];
        $footer_color_bot = $options[TF_THEME_PREFIX . '_footer_color_bot'];
        $header_color = $options[TF_THEME_PREFIX . '_top_section'];

        
        if(!empty($bg_color))
            $output .= '//** Background color for `<body>`.
                    @body-bg: '.$bg_color.';';
        
        if(!empty($text_color))
            $output .= '
                    @gray: '.$text_color.';
                    @text-color2: '.$text_color.';';
        
        if(!empty($link_color))
            $output .= '
                    @brand-secondery: '.$link_color.';
                     @logo-text-color:   '.$link_color.';';
        
            $output .= '
                     @logo-text-color:  #000;';
            
        if(!empty($primary_color))
            $output .= '
                    @brand-primary: '.$primary_color.';';
        
        if(!empty($menu_color))
            $output .= '
                    @header-bg-second: '.$menu_color.';';

        if(!empty($header_color))
            $output .= '
                    @header-main-top: '.$header_color.';';
        
        if(!empty($menu_color_bot))
            $output .= '
                    @header-bg-second_bot: '.$menu_color_bot.';';
        
        if(!empty($footer_color))
            $output .= '
                    @main-row-bg-2: '.$footer_color.';';
        
        if(!empty($footer_color_bot))
            $output .= '
                     @footer-bg-info: '.$footer_color_bot.';';
        
            //writtte new values in colors.less file
            file_put_contents(get_template_directory().'/less/colors.less', $output);
            
            if(file_exists(get_template_directory().'/less-compiler.php'))
            {
                include get_template_directory().'/less-compiler.php';
                
                $less = new lessc;
                                
                $new_css = $less->compileFile(get_template_directory().'/style.less');
                
              //  tf_print($new_css);
                                
                //if(!empty($new_css))
                file_put_contents(get_template_directory().'/style.css', $new_css);
            }
        

    }
    add_action('tfuse_admin_save_options', 'tfuse_theme_styles',10,2);
}
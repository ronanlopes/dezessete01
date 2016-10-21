<?php
function get_comments_popup_link($id, $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;

    if ( false === $zero ) $zero = __( 'No Comments','indieground');
    if ( false === $one ) $one = __( '1 Comment','indieground');
    if ( false === $more ) $more = __( '% Comments','indieground');
    if ( false === $none ) $none = __( 'Comments Off','indieground');

    $number = get_comments_number( $id );

    $str = '';

    if ( 0 == $number && !comments_open($id) && !pings_open($id) ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }

    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','indieground');
        return $str;
    }

    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }

    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );

    $str .= apply_filters( 'comments_popup_link_attributes', '' );

    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','indieground'), $title ) ) . '">';
    $str .= get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';

	$return = get_comments_number_str($id, $zero, $one, $more );

    return $return;
}

function get_comments_number_str($id, $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );

    $number = get_comments_number($id);

    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments','indieground') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __('No Comments','indieground') : $zero;
    else // must be one
        $output = ( false === $one ) ? __('1 Comment','indieground') : $one;

    return apply_filters('comments_number', $output, $number);
}


function the_category_portfolio($postid) {
	$terms = get_the_terms($postid, "categories");
	if (is_array($terms)) {
		$strcate="";
		foreach ($terms as $term ) {
			if ($strcate!="") {
				$strcate.=", ";
			}
			$strcate.=$term->name;
		}
		echo $strcate;
	}
}


?>
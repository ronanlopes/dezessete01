<?php
if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = 'Select a page';
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;


if (!function_exists('tfuse_list_posts')) :
    function tfuse_list_posts() {
        $posts = get_posts(array('post_type' => 'video','posts_per_page' => -1,'orderby' => 'post_date'));
		$result = array();
        foreach ( $posts as $post ) {
            $result[$post->ID] = get_the_title($post->ID);
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_posts_gallery')) :
    function tfuse_list_posts_gallery() {
        $posts = get_posts(array('post_type' => 'gallery','posts_per_page' => -1,'orderby' => 'post_date'));
		$result = array();
        foreach ( $posts as $post ) {
            $result[$post->ID] = get_the_title($post->ID);
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_posts_members')) :
    function tfuse_list_posts_members() {
        $posts = get_posts(array('post_type' => 'members','posts_per_page' => -1,'orderby' => 'post_date'));
		$result = array();
        foreach ( $posts as $post ) {
            $result[$post->ID] = get_the_title($post->ID);
        }
        return $result;
    }
endif;

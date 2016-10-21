<?php
	/************************************************************************
	* Main Front Page
	*************************************************************************/

	get_header();

	$page_sort_sections = sort_sections();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'page-sections',
		//'post__in'  => (array) $page_sort_sections,
		'orderby' => 'post__in',
		'orderby' => 'date',
		'order' => 'DESC'
		);

	$home_query = new WP_Query($args);

	if($home_query->have_posts()):
		while($home_query->have_posts()) : $home_query->the_post();
			get_template_part('page-sections');
		endwhile;
	else:
		get_template_part('no-results', 'home');
	endif;


	if($indieground_options['indieground-backtotop-yesno']==1) {
		echo "<!-- Back To Top -->\n";
		echo "	<a id='back-to-top' href='#' style='display: block;'>\n";
		echo "		<i class='fa fa-sort-desc'></i>\n";
		echo "	</a>\n";
		echo "<!-- Back To Top -->\n";
	}

	get_footer();
?>
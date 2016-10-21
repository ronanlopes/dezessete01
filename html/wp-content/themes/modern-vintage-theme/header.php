<!DOCTYPE html>
<!--
================================================================================
 Modern Vintage WordPress Theme by indieground-themes http://www.indieground.it/
================================================================================
-->

<html <?php language_attributes(); ?>>
	<?php global $indieground_options; ?>

<head>

	<!-- Basic Page Needs  ================================================== -->
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' -'; } ?> <?php bloginfo('name'); ?></title>

  	<meta charset="<?php bloginfo( 'charset' ); ?>"/>


	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<!-- Mobile Specific Metas ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!-- Favicons  ================================================== -->
	<?php if(!empty($indieground_options['indieground-icon-favicon'])) { ?>
     <link rel="shortcut icon" href="<?php echo $indieground_options['indieground-icon-favicon']['url']?>" />
	<?php } ?>

	<!-- RSS & Pingbacks  ================================================== -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	<?php wp_head(); ?>
</head>
<!-- ===================================== END HEAD ===================================== -->

<body <?php body_class(); ?> id="vid_container">

	<?php if (!empty($indieground_options['indieground-preloader'])) : ?>
		<div id="prequeryLoader2"></div>
	<?php endif; ?>

		<section id="home" class="head_bg">

		<?php if($indieground_options['indieground-home-logoyesno']==1): ?>

			<?php

			$indieground_value=1;
			if (isset($indieground_options['indieground-switch-custom']['on'])) {
				$indieground_value = $indieground_options['indieground-switch-custom']['on'];
			} else {
				$indieground_value = $indieground_options['indieground-switch-custom'];
			}
			if ($indieground_value==1) { ?>

				<header>
					<div id="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
							<img style="margin-top:<?php echo $indieground_options['indieground-logo-head-margin-top']?>px;" width="<?php echo $indieground_options['indieground-logo-head-size-width']?>" height="<?php echo $indieground_options['indieground-logo-head-size-height']?>" alt="<?php bloginfo('name'); ?>"  rel="<?php bloginfo('name'); ?>" src="<?php echo $indieground_options['indieground-logo-head-retina']['url']; ?>"/>
						</a>
					</div>
				</header>

			<?php } else { ?>
				<div class="center blogname">
					 <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>" rel="<?php bloginfo('name'); ?>">
						 <b><span class="foot_tit"><?php bloginfo('name'); ?></span></b>
					 </a>
				</div>
			<?php }   ?>

		<?php endif; ?>

		<?php if($indieground_options['indieground-sticky-yesno']==1): ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#navigation").sticky({topSpacing:0});
				});
			</script>
		<?php endif; ?>

		<div id="navigation">
			<div class="container">
				 <div class="row">

					<?php

					$indieground_value=1;
					if (isset($indieground_options['indieground-head-social']['on'])) {
						$indieground_value = $indieground_options['indieground-head-social']['on'];
					} else {
						$indieground_value = $indieground_options['indieground-head-social'];
					}
					if ($indieground_value==1) : ?>
						<div id="social_head">
								<?php echo indiegroundshortcode_social() ?>
						</div><!-- end social -->
					<?php endif; ?>

					<nav id="scrollsections-navigation">
						<?php
							wp_nav_menu(array('container' => '',
											'menu_id'=> 'main-menu',
											'theme_location' => 'primary',
											'fallback_cb'=> ''
											));?>
					</nav>

					<a id="mobile-nav" class="menu-button menu-nav sbutton_menu_responsive" href="#menu-nav">
						<i class="fa fa-bars"></i>
					</a>



<?php if($indieground_options['indieground-search-header']==1): ?>
					<div class="menu-nav sbutton">
						<i class="fa fa-search"></i>
					</div>
					<div class="widget_navigation">
						<div class="widget_search">
							<form role="search" method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', '' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( '', 'label', '' ); ?>">
							</form>
						</div>
					</div><!-- end .widget_navigation -->
<?php endif; ?>








					<div class="container shadow shadow_navigation">
						<img alt="shadow"  src="<?php echo esc_url( get_template_directory_uri() . '/include/images/retina/shadow/shadow.png' ); ?>" /> 					</div><!-- end container shadow -->



	<?php
				wp_nav_menu( array(
				'container' => '',
				'menu_id'=> '',
				'menu_class' => '',
				'theme_location' => 'primary',
				'menu_class' => 'flexnav', //Adding the class for FlexNav
				'items_wrap' => '<ul data-breakpoint="990" id="%1$s" class="%2$s">%3$s   </ul>' // Adding data-breakpoint for FlexNav
				));

			?>

				</div><!-- end row  -->
			</div><!-- end container  -->
		</div><!-- end #navigation -->

		

				</section>
	<!--  End Normal Header -->


<script type=text/javascript>
	jQuery(window).ready(function() {

		jQuery("#menu-nav-mobile,li.menu-item-object-page a").addClass("external");
		jQuery("#menu-nav-mobile,li.menu-item-object-category a").addClass("external");

		<?php  if (is_home()!=1): ?>
			jQuery("#main-menu li a").addClass("external");
			jQuery("#menu-nav-mobile li a").addClass("external");
		<?php endif;  ?>


		jQuery('#navigation').onePageNav({
			filter: ':not(.external)',
			scrollOffset: 25,
			scrollSpeed: 750,
			easing: 'swing'
		});
	});


</script>
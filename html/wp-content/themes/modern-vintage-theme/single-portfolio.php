<?php get_header(); ?>

<?php
	global $indieground_options;

	$layout = "2";
	$client = "";

	if (!empty($indieground_options['indieground-portfolio-page-layout'])) {
		$layout=$indieground_options['indieground-portfolio-page-layout'];
	}


	if (have_posts()):
		while(have_posts()) : the_post();

			$parallax_image = get_post_meta(get_the_ID(), 'indieground_parallax_image', TRUE);
			$client = get_post_meta(get_the_ID(), 'indieground_client', TRUE);
			if (!empty($parallax_image)): ?>

				<script>
					jQuery(window).load(function () {
						jQuery("#parallax-sections-<?php echo get_the_ID()?>").parallax("50%", "0.3");
					});
				</script>

				<section class="parallax_blog parallax-sections" id="parallax-section-<?php echo get_the_ID()?>" style="background-position:50% 24px;">
				</section>
			<?php endif; ?>



			<?php if ($layout=="1"): ?>
				<!-- LAYOUT 1 FULL -->
				<section class="pad_menu page_theme">
					<div class="container">
						<div class="row">

							<div class="col-md-12">
								<?php indieground_slider(get_the_ID()); ?>
							</div>

							<div class="col-md-12 ">
								<div class="cont-post">
									<h2 class="text_intertit center"><?php echo get_post_meta(get_the_ID(), 'indieground_subtitle', TRUE); ?></h2>
									<h1 class="text_tit center"><?php the_title(); ?></h1>
									<div class="divider"></div><!-- end divider -->

									    <div class="entry-footer-meta center">
								                 <ul class="cat-meta-list">
								                     <li title="calendar" alt="date post">
								                     <i class="fa fa-calendar"></i> DATE&nbsp;<?php echo the_time('j M , Y'); ?>
								                     </li>
								                     										                           <?php if (!empty($client)): ?>
								                     <li title="comments" alt="">
								                        <i class="fa fa-bookmark"></i> CLIENT&nbsp; <?php echo $client; ?>
								                     </li>
								       									                                                <?php endif;   ?>



								                     <li title="category" alt=""> &nbsp; <i class="fa fa-tags"></i>&nbsp;  POSTED IN &nbsp;<?php the_category_portfolio(get_the_ID()); ?>

								                     </li>
								                 </ul>
				                               </div><!-- .entry-footer-meta -->












									<!-- BEGIN .article -->
									<div class="article">
										<?php the_content('Read more...'); ?>
									</div><!-- END .article -->

									<!-- Botton social -->
                              <?php if($indieground_options['indieground-portfolio-socialsharing']==1): ?>
										<?php include(TEMPLATEPATH."/social-share/social-share-full.php");?>
									<?php endif;   ?>
									<!-- End Botton social -->

							</div><!-- End cont-post -->
						</div><!-- end col-xs-12 col-sm-5 col-md-5 -->
					</div>  <!-- End container  -->
			        </div>  <!-- End row  -->
				</section>
				<!-- END LAYOUT 1 -->
			<?php endif; ?>


			<?php if ($layout=="2"): ?>
				<!-- LAYOUT 2 LEFT-->
				<section class="pad_menu page_theme">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-5 col-md-5">
								<div class="cont-post">
									<h2 class="text_intertit_portfolio"><?php echo get_post_meta(get_the_ID(), 'indieground_subtitle', TRUE); ?></h2>
									<h2 class="headline_portfolio "><?php the_title(); ?></h2>

									<div class="divider-post"></div><!-- end divider -->



								   <div class="entry-footer-meta fleft">
								                 <ul class="cat-meta-list">
								                     <li title="calendar" alt="date post">
								                     <i class="fa fa-calendar"></i> DATE&nbsp;<?php echo the_time('j M , Y'); ?>
								                     </li>
								                     										                           <?php if (!empty($client)): ?>
								                     <li title="comments" alt="client">
								                        <i class="fa fa-bookmark"></i> CLIENT&nbsp; <?php echo $client; ?>
								                     </li>
								       									                                                <?php endif;   ?>



								                     <li title="category" alt="posted in"><i class="fa fa-tags"></i>&nbsp;  POSTED IN &nbsp;<?php the_category_portfolio(get_the_ID()); ?>

								                     </li>
								                 </ul>
				                               </div><!-- .entry-footer-meta -->
						<div class="clear"></div><!-- .clear -->




									<!-- BEGIN .article -->
									<div class="article">
										<?php the_content('Read more...'); ?>
									</div><!-- END .article -->
									<div class="divider-post"></div><!-- end divider -->

									<!-- Botton social -->
                              <?php if($indieground_options['indieground-portfolio-socialsharing']==1): ?>
										<?php include(TEMPLATEPATH."/social-share/social-share-sidebar.php");?>
									<?php endif;   ?>
									<!-- End Botton social -->
								</div><!-- End cont-post -->
							</div><!-- end col-xs-12 col-sm-5 col-md-5 -->

							<div class="col-xs-12 col-sm-7 col-md-7 slide_portfolio">
								<!-- slider -->
								<?php indieground_slider(get_the_ID()); ?>
								<!-- end slider -->
							</div><!-- end col-xs-12 col-sm-7 col-md-7 slide_portfolio -->

						</div>  <!-- End container  -->
					</div>  <!-- End row  -->

				</section>
				<!-- LAYOUT 2 LEFT-->
			<?php endif; ?>


			<?php if ($layout=="3"): ?>
				<!-- LAYOUT 3 RIGHT-->
				<section class="pad_menu page_theme">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-7 col-md-7 slide_portfolio">
								<?php indieground_slider(get_the_ID()); ?>
							</div><!-- end col-xs-12 col-sm-7 col-md-7 slide_portfolio -->

							<div class="col-xs-12 col-sm-5 col-md-5">
								<div class="cont-post">
									 <h2 class="text_intertit_portfolio"><?php echo get_post_meta(get_the_ID(), 'indieground_subtitle', TRUE); ?></h2>
									 <h2 class="headline_portfolio "><?php the_title(); ?></h2>

									<div class="divider-post"></div><!-- end divider -->
									   <div class="entry-footer-meta fleft">
								                 <ul class="cat-meta-list">
								                     <li title="calendar" alt="date post">
								                     <i class="fa fa-calendar"></i> DATE&nbsp;<?php echo the_time('j M , Y'); ?>
								                     </li>
								                     										                           <?php if (!empty($client)): ?>
								                     <li title="comments" alt="client">
								                        <i class="fa fa-bookmark"></i> CLIENT&nbsp; <?php echo $client; ?>
								                     </li>
								       									                                                <?php endif;   ?>



								                     <li title="category" alt="posted in"><i class="fa fa-tags"></i>&nbsp;  POSTED IN &nbsp;<?php the_category_portfolio(get_the_ID()); ?>

								                     </li>
								                 </ul>
				                               </div><!-- .entry-footer-meta -->
						<div class="clear"></div><!-- .clear -->

									<!-- BEGIN .article -->
									<div class="article">
										<?php the_content('Read more...'); ?>
									</div><!-- END .article -->
									<div class="divider-post"></div><!-- end divider -->

									<!-- Botton social -->							
                              <?php if($indieground_options['indieground-portfolio-socialsharing']==1): ?>
							 <?php include(TEMPLATEPATH."/social-share/social-share-sidebar.php");?>
						<?php endif;   ?>
									<!-- End Botton social -->

								</div><!-- End cont-post -->
							</div><!-- end col-xs-12 col-sm-5 col-md-5 -->
						</div>  <!-- End container  -->
					</div>  <!-- End row  -->

				</section>
				<!-- END LAYOUT 3 -->
			<?php endif; ?>

	<?php endwhile; ?>
<?php endif; ?>



<?php get_footer(); ?>
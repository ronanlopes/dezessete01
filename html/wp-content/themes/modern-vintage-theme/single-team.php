<?php get_header(); ?>

<section class="pad_menu page_theme">
	<div class="container">
		<div class="row">

			<?php if (have_posts()) :?>
				<?php while(have_posts()) : the_post(); ?>

                         <div class="col-xs-12 col-sm-7 col-md-7 slide_portfolio">
                              <?php if ( has_post_thumbnail() ) { ?>
                              <?php the_post_thumbnail('index-thumb', array('class' => 'frame feature-img')); ?>
                              <?php } ?>
                         </div><!-- end col-xs-12 col-sm-7 col-md-7 slide_portfolio -->



                         <div class="col-xs-12 col-sm-5 col-md-5">
                              <div class="cont-post">
							<h2 class="text_intertit_portfolio"><?php echo get_post_meta(get_the_ID(), 'indieground_subtitle', TRUE); ?></h2>
							<h2 class="headline_portfolio "><?php the_title(); ?></h2>
							<div class="divider-post"></div><!-- end divider -->

					          <!-- BEGIN .article -->
							<div class="article">
							    <?php the_content('Read more...'); ?>
							</div>
							<!-- END .article -->

							<div class="divider-post"></div><!-- end divider -->



		                         <!-- Botton social -->
							<?php  if (!empty($indieground_options['indieground-team-socialsharing']['on'])) : ?>
								<?php include(TEMPLATEPATH."/social-share/social-share-sidebar.php");?>
							<?php endif;   ?>
							<!-- End Botton social -->

                              </div><!-- End cont-post -->
                         </div><!-- end col-xs-12 col-sm-5 col-md-5 -->

				<?php endwhile; ?>
			<?php endif; ?>



		</div>  <!-- End row  -->
	</div>  <!-- End container  -->
</section>

<?php get_footer(); ?>
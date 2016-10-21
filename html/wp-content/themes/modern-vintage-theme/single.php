<?php get_header(); ?>

<!-- blog page -->


<?php
	global $indieground_options;

	$layout = "3";

	if (!empty($indieground_options['indieground-page-blog-layout'])) {
		$layout=$indieground_options['indieground-page-blog-layout'];
	}


	if (have_posts()):
		while(have_posts()) : the_post();

			$parallax_image = get_post_meta(get_the_ID(), 'indieground_parallax_image', TRUE);
			if (!empty($parallax_image)): ?>

				<script>
					jQuery(window).load(function () {
						jQuery("#parallax-sections-<?php echo get_the_ID()?>").parallax("50%", "0.3");
					});
				</script>
				<section class="parallax_blog parallax-sections" id="parallax-section-<?php echo get_the_ID()?>" style="background-position:50% 24px;">
				</section>
			<?php endif; ?>





	<!-- LAYOUT 1 FULL -->
	<?php if ($layout=="3"): ?>
	      <section class="pad_menu page_theme">
	           <div class="container">
	                     <div class="row">
                               <div class="col-xs-12">
	                               <div class="cont-post" <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	                                   <?php if ( has_post_thumbnail() ) { ?>
	                                       <?php the_post_thumbnail('indie', array('class' => 'frame feature-img')); ?>
	                                      <?php } ?>
					                  <h1 class="text_tit center"><?php the_title(); ?></h1>
				                           <div class="divider"></div><!-- end divider -->

				                               <div class="entry-footer-meta center">
								                 <ul class="cat-meta-list">
								                     <li title="calendar" alt="date post">
								                        <i class="fa fa-calendar"></i> DATE&nbsp;<?php echo the_time('j M , Y'); ?>
								                     </li>
								                     <li title="comments" alt="">
								                        <i class="fa fa-comment"></i> COMMENTS&nbsp; <?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?>
								                     </li>
								                     <li title="category" alt="">
								                         <i class="fa fa-tags"></i> POSTED IN&nbsp; <?php the_category(', '); ?>
								                     </li>
								                 </ul>
				                               </div><!-- .entry-footer-meta -->

				                                <!-- BEGIN .article -->
				                                <div class="article">
				                                     <?php the_content('Read more...'); ?>
				                                </div><!-- END .article -->

	                               </div><!-- END .cont-post -->

							    <!-- Botton social -->
							    
                              <?php if($indieground_options['indieground-social-blog-sharingx']==1): ?>
						     <?php include(TEMPLATEPATH."/social-share/social-share-full.php");?>
						 <?php endif;   ?>
						         
						         
						         
						         
						         <!-- End Botton social -->

					<div class="clear"></div><!-- end clear -->

	                 <div class="entry-footer-meta left">
				       <ul class="cat-meta-list">
	                           <li title="Tagged" alt="">
	                                <i class="fa fa-tags"></i> Tagged:&nbsp; <?php the_tags(','); ?>
	                           </li><br>
	                           <li title="author" alt="">
	                                <i class="fa fa-user"></i> Author:&nbsp; <?php the_author(); ?>
	                           </li>
				       </ul>
	                 </div><!-- .entry-footer-meta left-->


               <?php edit_post_link(__('Edit This', 'indieground')); ?>
			<div class="divider-post"></div><!-- end divider -->
			<?php comments_template('', true); ?>

                               </div><!-- end col-xs-12 col-sm-8 col-md-8 -->
	                     </div><!-- end row -->
	           </div><!-- end  container -->
	      </section>

        <?php endif; ?>
	   <!-- END LAYOUT 1 -->



		<!-- LAYOUT 2 LEFT-->
		<?php if ($layout=="4"): ?>
			 <section class="pad_menu page_theme">
                     <div class="container">
                         <div class="row">
                             <div class="col-xs-12 col-sm-8 col-md-8">

                                   <div class="cont-post" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                       <?php if ( has_post_thumbnail() ) { ?>
                                           <?php the_post_thumbnail('index-thumb', array('class' => 'frame feature-img')); ?>
                                       <?php } ?>
                                       <h2 class="headline"><?php the_title(); ?></h2>
                                         <div class="entry-footer-meta">
								                 <ul class="cat-meta-list">
								                     <li title="calendar" alt="date post">
								                        <i class="fa fa-calendar"></i> DATE&nbsp;<?php echo the_time('j M , Y'); ?>
								                     </li>

								                     <li title="author" alt="">
								                        <i class="fa fa-user"></i> Author:&nbsp; <?php the_author(); ?>
								                     </li>

								                     <li title="comments" alt="">
								                        <i class="fa fa-comment"></i> COMMENTS&nbsp; <?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?>
								                     </li>
								                 </ul>
				                               </div><!-- .entry-footer-meta -->

                                       <!-- BEGIN .article -->
                                       <div class="article">
                                           <?php the_content('Read more...'); ?>
                                       </div><!-- END .article -->
                                   </div><!-- END .cont-post -->


							<!-- Botton social -->
						   <?php if($indieground_options['indieground-social-blog-sharingx']==1): ?>
						     <?php include(TEMPLATEPATH."/social-share/social-share-full.php");?>
						 <?php endif;   ?>
							<!-- End Botton social -->

					<div class="clear"></div><!-- end clear -->


	                 <div class="entry-footer-meta left">
				       <ul class="cat-meta-list">
	                           <li title="Tagged" alt="">
	                                <i class="fa fa-tags"></i> Tagged:&nbsp; <?php the_tags(', '); ?>
	                           </li><br>

	                             <li title="category" alt="">
								                         <i class="fa fa-tags"></i> POSTED IN&nbsp; <?php the_category(', '); ?>
								                     </li>
	                      				       </ul>
	                 </div><!-- .entry-footer-meta left-->



							<div class="clear"></div><!-- end divider -->
							<?php edit_post_link(__('Edit This', 'indieground')); ?>
							<div class="divider-post"></div><!-- end divider -->

							<?php comments_template('', true); ?>

                             </div><!-- end col-xs-12 col-sm-8 col-md-8 -->



                             <div class="col-xs-12 col-sm-4 col-md-4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Post Sidebar') ) : ?>
						        <div class="tit_widget">
						            Widget Area
						            </div>
						                  <div class="box_widget" style="padding: 20px;">            
						            <p>This section is widgetized. To add widgets here, go to the <a href="<?php echo admin_url(); ?>widgets.php">Widgets</a> panel in your WordPress admin, and add the widgets you would like to <strong>Right Sidebar</strong>.</p>
						            <p><small>*This message will be overwritten after widgets have been added</small></p>
						                   </div><div class="tit_widget_bottom"></div>
						    <?php endif; ?>
                             </div><!-- end col-xs-12 col-sm-4 col-md-4 -->

                         </div><!-- end row -->
                     </div><!-- end  container -->
			 </section>

		<?php endif; ?>
	     <!-- END LAYOUT 4 -->






			<!-- LAYOUT 3 RIGHT-->
			<?php if ($layout=="5"): ?>
				 <section class="pad_menu page_theme">
                     <div class="container">
                         <div class="row">

                           <div class="col-xs-12 col-sm-4 col-md-4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Post Sidebar') ) : ?>
						        <div class="tit_widget">
						            Widget Area
						            </div>
						                  <div class="box_widget" style="padding: 20px;">            
						            <p>This section is widgetized. To add widgets here, go to the <a href="<?php echo admin_url(); ?>widgets.php">Widgets</a> panel in your WordPress admin, and add the widgets you would like to <strong>Right Sidebar</strong>.</p>
						            <p><small>*This message will be overwritten after widgets have been added</small></p>
						                   </div><div class="tit_widget_bottom"></div>
						    <?php endif; ?>
                             </div><!-- end col-xs-12 col-sm-4 col-md-4 -->

                             <div class="col-xs-12 col-sm-8 col-md-8">

                                   <div class="cont-post" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                       <?php if ( has_post_thumbnail() ) { ?>
                                           <?php the_post_thumbnail('index-thumb', array('class' => 'frame feature-img')); ?>
                                       <?php } ?>
                                       <h2 class="headline"><?php the_title(); ?></h2>
                                       <div class="entry-footer-meta">
								                 <ul class="cat-meta-list">
								                     <li title="calendar" alt="date post">
								                        <i class="fa fa-calendar"></i> DATE&nbsp;<?php echo the_time('j M , Y'); ?>
								                     </li>

								                     <li title="author" alt="">
								                        <i class="fa fa-user"></i> Author:&nbsp; <?php the_author(); ?>
								                     </li>

								                     <li title="comments" alt="">
								                        <i class="fa fa-comment"></i> COMMENTS&nbsp; <?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?>
								                     </li>
								                 </ul>
				                               </div><!-- .entry-footer-meta -->
                                       <!-- BEGIN .article -->
                                       <div class="article">
                                           <?php the_content('Read more...'); ?>
                                       </div><!-- END .article -->
                                   </div><!-- END .cont-post -->


							<!-- Botton social -->
							   <?php if($indieground_options['indieground-social-blog-sharingx']==1): ?>
						     <?php include(TEMPLATEPATH."/social-share/social-share-full.php");?>
						 <?php endif;   ?>
							<!-- End Botton social -->
					<div class="clear"></div><!-- end clear -->

							    <div class="entry-footer-meta left">
								       <ul class="cat-meta-list">
					                           <li title="Tagged" alt="">
					                                <i class="fa fa-tags"></i> Tagged:&nbsp; <?php the_tags(', '); ?>
					                           </li><br>

					                             <li title="category" alt="">
												                         <i class="fa fa-tags"></i> POSTED IN&nbsp; <?php the_category(', '); ?>
					                           </li>
								       </ul>
							    </div><!-- .entry-footer-meta left-->



							<div class="clear"></div><!-- end divider -->
							<?php edit_post_link(__('Edit This', 'indieground')); ?>
							<div class="divider-post"></div><!-- end divider -->

							<?php comments_template('', true); ?>

                             </div><!-- end col-xs-12 col-sm-8 col-md-8 -->




                         </div><!-- end row -->
                     </div><!-- end  container -->
			 </section>
			<?php endif; ?>
			<!-- END LAYOUT 5 -->

	<?php endwhile; ?>
<?php endif; ?>



<?php get_footer(); ?>
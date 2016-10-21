<?php
/*
Template Name: Blog Template left sidebar
*/
?>

<?php get_header(); ?>
   <section class="page_theme pagetop">
          <div class="container">
                         <div class="row">
                            <h1 class="text_tit center">BLOG</h1>
					   <div class="divider"></div><!-- end divider -->
					   
					   
                            <div class="col-xs-12 col-sm-4 col-md-4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Post Sidebar') ) : ?>
						        <div class="tit_widget">
						            Widget Area
						            </div>
						                  <div class="box_widget" style="padding: 20px;">            
						            <p>This section is widgetized. To add widgets here, go to the <a href="<?php echo admin_url(); ?>widgets.php">Widgets</a> panel in your WordPress admin, and add the widgets you would like to <strong>Sidebar</strong>.</p>
						            <p><small>*This message will be overwritten after widgets have been added</small></p>
						                   </div><div class="tit_widget_bottom"></div>
						    <?php endif; ?>
                            </div><!-- end col-xs-12 col-sm-4 col-md-4 -->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="col-xs-12 col-sm-8 col-md-8">
                            
                            
                            

<?php query_posts('post_type=post&post_status=publish&posts_per_page=5&paged='. get_query_var('page')); ?>




     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                            
                            
                            
              <div class='cont_grid_blog wow fadeInDown'> 
			 	<div class='post_thumbnail col-blog-5'> 
			 		<div class='grid cs-style-3 pol_blog frame'> 
			 			<a class='transition' href="<?php the_permalink() ?>"> 
			 				<figure> 
			 					
			 			<?php the_post_thumbnail( 'thumb-blog-side' ); ?>
		
			 								 					
			 					<figcaption class='postblog_thumbnail'> 
			 						<span>OPEN ARTICLE</span> 
			 					</figcaption> 
			 				</figure> 
			 			</a> 
			 		</div><!-- endgrid .cs-style-3 .frame --> 



			 		<img alt='' class='img_shadow' src="<?php echo esc_url( get_template_directory_uri() . '/include/images/retina/shadow/shadow.png' ); ?>" /> 
			 	</div><!-- end cont .post_thumbnail --> 



			 	<div class='col-blog-7'> 
			 		<h2 class='headline'><a href="<?php the_permalink() ?>" rel='bookmark'><?php the_title();?></a></h2> 
			 		<div class='post_details'> 
			 			<div class='w_blogpost w_blogpost_date'> 
						 <i class='fa fa-calendar'></i> <?php the_date(); ?>
					</div> 

				<div class='w_blogpost w_blogpost_author'> 
					<i class='fa fa-user'></i> Created by <?php the_author(); ?> 
						</div> 

			 			<div class='w_blogpost w_blogpost_comments'> 
			 			
			 			
			 				<a href='".get_permalink($post->ID)."#respond'> <i class='fa fa-comments-o'></i>  <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </a> 
			 				
			 				
			 				
			 				
			 			</div> 
			 		</div><!-- post_details --> 

			 		<div class='article'><!-- BEGIN .article --> 
		      <p> <?php the_excerpt();?></p> 

			 		</div><!-- END .article --> 

			 		<p class='align-right read_more'> <a href="<?php the_permalink() ?>"><i class='fa fa-book'></i>Read the article</a></p> 
			 	</div><!-- col-blog-7 --> 

			 	<div class='clear'></div><!-- end clear --> 
			 	<div class='divider-post'></div><!-- end divider --> 
			 </div><!-- cont_grid_blog --> 

                                                



		<?php endwhile; ?>
		
             

          <?php endif; ?>
          
                   
               <div class="indie_pagination">
				<?php indie_pagination(); ?>
			</div><!-- gelo_pagination -->

                  
                            </div><!-- end col-xs-12 col-sm-8 col-md-8 -->


                            
                         </div><!-- End Row  -->   
          
                      
          </div><!-- End Container  -->  
   </section>              
<?php get_footer(); ?>
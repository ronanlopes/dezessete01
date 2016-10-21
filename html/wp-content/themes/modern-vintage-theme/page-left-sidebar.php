<?php
/*
Template Name: Page Left Sidebar 
*/
?>

<?php get_header(); ?>
   <section class="page_theme pagetop">
          <div class="container">
     	     <?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>
                         <div class="row">
                            <h1 class="text_tit center"><?php the_title(); ?></h1>
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
                               <?php the_content();?>
                            </div><!-- end col-xs-12 col-sm-8 col-md-8 -->


                            
                         </div><!-- End Row  -->                



		<?php endwhile; ?>
                      <?php endif; ?>
                      
          </div><!-- End Container  -->  
   </section>              
<?php get_footer(); ?>
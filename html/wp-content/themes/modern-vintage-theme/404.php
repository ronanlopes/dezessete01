<?php get_header(); ?>
   <section class="page_theme pad_menu">
            <div class="container">
                         <h1 class="text_title_section center"><?php _e('ERROR 404', 'framework'); ?></h1>
                         <h2 class="introduction center"><?php _e('The page you are looking for might have been removed, had its name changed or is temporarily unavailable', 'framework'); ?></h2>
                         <div class="section_divider"></div><!-- end section_divider -->
                         <div class="cont_bottom_errorpage">

                             <a href="<?php echo home_url(); ?>" class="indie_botton">
                                 <div class="special"> <?php _e('Go to Home Page', 'framework'); ?> </div>
                             </a>
                         </div>
            </div>
   </section>
<?php get_footer(); ?>
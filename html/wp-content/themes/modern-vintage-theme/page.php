<?php get_header(); ?>
   <section class="page_theme pagetop">
         <div class="container">
              <?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>
                  <h1 class="text_tit center"><?php the_title(); ?></h1>
                  <div class="divider"></div><!-- end divider -->
                  <?php the_content();?>
                  <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'indieground').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
              <?php endwhile; ?>
              <?php endif; ?>
         </div><!-- End Container  -->
   </section>
<?php get_footer(); ?>
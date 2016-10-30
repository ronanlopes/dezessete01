<?php get_header(); ?>
<?php  tfuse_shortcode_content('before'); ?>

<!-- main row 1: calendar header -->
<div class="main-row main-row-bg main-row-thin">
    <div class="container">
    </div>
</div>
<!-- main row 1: calendar header -->
<div class="main-row content-row">
    <div class="container">
        <?php if (have_posts()) 
         { $count = 0;
            while (have_posts()) : the_post(); $count++;?>
                <div id="calendar"></div> 
      <?php endwhile;
         } 
         else 
         { ?>
             <div id="calendar"></div> 
   <?php } ?>
    </div>
</div>
<?php 
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $ID = $term->term_id;
?>
<input type="hidden" value="<?php echo $ID; ?>" name="current_event"  />
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>
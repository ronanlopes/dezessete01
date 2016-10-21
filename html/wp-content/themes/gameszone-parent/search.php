<?php get_header(); global $TFUSE;  ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>

<div class="main-row content-row">
    <div class="container">
        <?php if ($sidebar_position == 'left') : ?>
           <div class="middle-main sidebar-left">
        <?php endif;?>
        <?php if ($sidebar_position == 'right') : ?>
            <div class="middle-main content-cols2">
        <?php endif;?>
        <?php if ($sidebar_position == 'full') : ?>
            <div class="middle-main content-full">
        <?php endif; ?> 
                    <div id="primary" class="content-area">
                        <div class="inner">

<?php if($TFUSE->request->isset_GET('tax_reviews')):?>

    <section class="postlist postlist-cols-1">
        <h1><?php _e('All Reviews','tfuse');?></h1>
        <?php $ids = tfuse_get_search_tems();?>
        <?php if(!empty($ids)):?>
            <div class="top-filter">
                <span class="top-filter-title"><?php _e('Filters','tfuse');?>:</span>
                <ul>
                    <?php if(!empty($ids['platforms'])): ?>
                        <?php foreach ($ids['platforms'] as $term_id):?>
                            <?php $term = get_term( $term_id, 'platforms' );?>
                            <li><a href="#" class="btn btn-simple btn-sm"><?php echo $term->name;?> <i class="remove" id="platforms_<?php echo $term_id;?><?php echo '='.$term_id;?>">x</i></a></li>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <?php if(!empty($ids['genres'])): ?>
                        <?php foreach ($ids['genres'] as $term_id):?>
                            <?php $term = get_term( $term_id, 'genres' );?>
                            <li><a href="#" class="btn btn-simple btn-sm"><?php echo $term->name;?> <i class="remove" id="genres_<?php echo $term_id;?><?php echo '='.$term_id;?>">x</i></a></li>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <li><a href="#" class="btn btn-simple btn-sm"><?php _e('Rating from','tfuse');?> <?php echo implode(__(' to ','tfuse'),$ids['price-range']);?> <i class="remove" id="rating" data-rating="price-range=<?php echo implode('%3B',$ids['price-range']);?>">x</i></a></li>
                </ul>
            </div>
        <?php endif;?>
            <?php 
			$all_posts = tfuse_get_search_posts();
			
			if ($all_posts->have_posts()) 
             { $count = 0;
                while ($all_posts->have_posts()) : $all_posts->the_post(); $count++;
                    get_template_part('listing','reviews');
                endwhile;
             } 
             else 
             { ?>
                 <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
       <?php } ?>
        <?php 
			global $wp_query;
			$wp_query = $all_posts;
			tfuse_pagination();
			
			wp_reset_query();
		?>
    </section>
                            
<?php elseif($TFUSE->request->isset_GET('tax_games')):?>
                            
    <section class="postlist postlist-grid">
        <h1><?php _e('Games','tfuse');?></h1>
        <?php $ids = tfuse_get_search_tems();?>
        
        <?php if(!empty($ids['platforms'])|| !empty($ids['producers']) || !empty($ids['genres']) || !empty($ids['age'])):?>
            <div class="top-filter">
                <span class="top-filter-title"><?php _e('Filters','tfuse');?>:</span>
                <ul>
                    <?php if(!empty($ids['platforms'])): ?>
                        <?php foreach ($ids['platforms'] as $term_id):?>
                            <?php $term = get_term( $term_id, 'platforms_game' );?>
                            <li><a href="#" class="btn btn-simple btn-sm"><?php echo $term->name;?> <i class="remove" id="platforms_<?php echo $term_id;?><?php echo '='.$term_id;?>">x</i></a></li>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <?php if(!empty($ids['producers'])): ?>
                        <?php foreach ($ids['producers'] as $term_id):?>
                            <?php $term = get_term( $term_id, 'producers_game' );?>
                            <li><a href="#" class="btn btn-simple btn-sm"><?php echo $term->name;?> <i class="remove" id="producers_<?php echo $term_id;?><?php echo '='.$term_id;?>">x</i></a></li>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <?php if(!empty($ids['genres'])): ?>
                        <?php foreach ($ids['genres'] as $term_id):?>
                            <?php $term = get_term( $term_id, 'genres_game' );?>
                            <li><a href="#" class="btn btn-simple btn-sm"><?php echo $term->name;?> <i class="remove" id="genres_<?php echo $term_id;?><?php echo '='.$term_id;?>">x</i></a></li>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <?php if(!empty($ids['age'])): ?>
                        <?php foreach ($ids['age'] as $term_id):?>
                            <?php $term = get_term( $term_id, 'age_ratings' );?>
                            <li><a href="#" class="btn btn-simple btn-sm"><?php echo $term->name;?> <i class="remove" id="age_<?php echo $term_id;?><?php echo '='.$term_id;?>">x</i></a></li>
                        <?php endforeach;?>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif;?>
        <ul class="posts-grid">
            <?php 
				$all_posts = tfuse_get_search_posts();
				
				if ($all_posts->have_posts()) 
				 { $count = 0;
					while ($all_posts->have_posts()) : $all_posts->the_post(); $count++; 
						get_template_part('listing','games');
					endwhile;
				 } 
				 else 
				 { ?>
					 <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
		   <?php } ?>
        </ul>
        <?php 
			global $wp_query;
			$wp_query = $all_posts;
			tfuse_pagination();
			
			wp_reset_query();
		?>
    </section>  
                            
<?php else:?>
                            
    <section class="postlist postlist-blog">
        <h1><?php _e('Search Page','tfuse');?></h1>
        <?php if (have_posts()) 
         { $count = 0;
             while (have_posts()) : the_post(); $count++;
                 get_template_part('listing', 'blog');
             endwhile;
         } 
         else 
         { ?>
             <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
    <?php } ?>
        <?php  tfuse_pagination();?>
    </section>
                            
<?php endif;?>
                            
                    </div>
                </div>
                <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                    <div id="secondary" class="sidebar widget-area">
                        <div class="inner">

                            <?php get_sidebar();?>
                        </div>
                    </div>
                <?php endif; ?>
            </div> 
    </div>
</div>
<?php  tfuse_shortcode_content('after'); ?> 

<?php get_footer();?>
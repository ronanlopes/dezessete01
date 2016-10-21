<?php get_header(); ?>

<section class="page_theme">
   <div class="container pad_menu ">
		<h1 class="text_title_section center">
			
			
			<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
						
							the_post();
							printf( __( 'Author: %s', 'ilgelo' ), '<span class="vcard">' . get_the_author() . '</span>' );
							rewind_posts();


						elseif ( is_day() ) :
							printf( __( 'day: %s', 'ilgelo' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( '%s', 'ilgelo' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'ilgelo' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
							
							


						else :
							_e( 'archive', 'ilgelo' );

						endif;
					?>
			
		</h1>
			<div class="section_divider"></div><!-- end section_divider -->
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">

					<!-- START The Loop -->
					<?php

						global $query_string;
						global $wp_query;

						$paged = (get_query_var('page')) ? get_query_var('page') : 1;

						$query_args = explode("&", $query_string);
						$search_query = array();

						foreach($query_args as $key => $string) {
							$query_split = explode("=", $string);
							$search_query[$query_split[0]] = urldecode($query_split[1]);
						}
						$search_query["posts_per_page"] = 5;
						$search_query["paged"] = $paged;

						$wp_query = new WP_Query($search_query);

						if ($wp_query->have_posts()) :
							while ($wp_query->have_posts()) : $wp_query->the_post();	 ?>

								<div class="cont_grid_blog">
									<div class="post_thumbnail col-blog-5">
										 <div class="grid cs-style-3 pol_blog frame">
											<a class="transition" href="<?php the_permalink() ?>">
												<figure>
													<?php if ( has_post_thumbnail() ) { ?>
														<?php the_post_thumbnail('thumb-blog-full', array('class' => '')); ?>
													<?php } ?>
													<figcaption class="postblog_thumbnail">
														<span>VIEW PROJECT</span>
													</figcaption>
												</figure>
											</a>
										</div><!-- end grid cs-style-3 frame -->
										<img class="img_shadow" src="<?php echo esc_url( get_template_directory_uri() . '/include/images/retina/shadow/shadow.png' ); ?>" /> 									</div><!-- cont post_thumbnail -->

									<div class="col-blog-7">
										<h2 class="headline"><a href="<?php the_permalink() ?> " rel="bookmark"><?php the_title(); ?></a></h2>
										<div class="post_details">
											<div class="w_blogpost w_blogpost_date">
												<i class="fa fa-calendar"></i> <?php the_time('j M , Y'); ?>
											</div>
											<div class="w_blogpost w_blogpost_author">
												<i class="fa fa-user"></i> Created by <?php the_author(); ?>
											</div>
											<div class="w_blogpost w_blogpost_comments">
												<a href="<?php comments_link(); ?>"> <i class="fa fa-comments-o"></i> <?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></a>
											</div>
										</div><!-- post_details -->

										<div class="article"><!-- BEGIN .article -->
											<?php the_excerpt() ?>
										</div><!-- END .article -->

										<p class="align-right read_more"> <a href="<?php the_permalink() ?>"><i class="fa fa-book"></i>Read the article</a></p>
									</div><!-- col-blog-7 -->

									<div class="clear"></div><!-- end clear -->
									<div class="divider-post"></div><!-- end divider -->
								</div><!-- cont_grid_blog -->
							<?php endwhile; ?>

							<div class="indie_pagination">
								<?php indie_pagination(); ?>
							</div><!-- gelo_pagination -->

						<?php else : ?>
							<article class="post center">
								Your search did not match any entries!
								Sorry, but you are looking for something that isn't here.
							</article>
						<?php endif; ?>
					</div><!-- end .col-xs-12 col-sm-8 col-md-8 -->
			</div><!-- end row -->
		</div>
</section>

<?php get_footer(); ?>
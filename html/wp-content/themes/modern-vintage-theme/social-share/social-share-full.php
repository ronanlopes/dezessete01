<?php if ( !function_exists('social-share') || !dynamic_sidebar('indie_social') ) : ?>

<!-- Botton social -->
									<div id="buttons">
										<div class="facebook button">
											<i class="icon">
												<i class="fa fa-facebook"></i>
											</i>
											<div class="slide">
												<p>facebook</p>
											</div>
											<div id="fb-root" style="margin-left:60px;">

											<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
											<fb:like href="<?php the_permalink() ?>" send="false"  layout="button_count" width="120" height="20" show_faces="true" action="like" colorscheme="light" font=""></fb:like>
										</div>
									</div>

									<div class="twitter button">
										<i class="icon">
											<i class="fa fa-twitter"></i>
										</i>
										<div class="slide">
											<p>twitter</p>
										</div>

										<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
										<a href="http://twitter.com/share?url=<?php echo urlencode(get_permalink($post->ID)); ?>&via=wpbeginner&count=horizontal" class="twitter-share-button">Tweet</a>
									</div>

									<div class="google button">
										<i class="icon">
											<i class="fa fa-google-plus"></i>
										</i>
										<div class="slide">
											<p>google+</p>
										</div>
										<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
										<g:plusone></g:plusone>
									</div>

									<div class="linkedin button">
									<i class="icon">
										<i class="fa fa-linkedin"></i>
									</i>
									<div class="slide">
										<p>linkedin</p>
									</div>

									<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-url="<?php the_permalink(); ?>" data-counter="right"></script>									</div>
								</div>
								
<!-- End Botton social -->
								
<?php endif; ?>
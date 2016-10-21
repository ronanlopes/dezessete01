<?php global $indieground_options; ?>


	<div class="clear"></div>

	<!-- ===================================== FOOTER ===================================== -->
	<footer>
<?php if ($indieground_options['indieground-footer-stitched']==1) : ?>
			<div class="bg_navigation_up"></div>
		<?php endif;   ?>






		<div class="container footer_cont center">

			<?php  if (!empty($indieground_options['indieground-footer-site-name']['on'])) : ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>" rel="<?php bloginfo('name'); ?>">
					<b><span class="foot_tit"><?php bloginfo('name'); ?></span></b>
				</a>
		<?php endif;   ?>


<?php if ($indieground_options['logo-footer-switch-custom']==1) : ?>


				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>" rel="home">
					<div class="hidden-phone ">
						<img width="<?php echo $indieground_options['indieground-logo-footer-size-width']?>" height="<?php echo $indieground_options['indieground-logo-footer-size-height']?>"  rel="<?php bloginfo('name'); ?>" src="<?php echo $indieground_options['indieground-logofooter-retina']['url']; ?>"  />
					</div>
				</a>

			<?php endif;   ?>


			<?php  if (!empty($indieground_options['indieground-footer-custom-copy'])) : ?>
				<b>  <span class="scrollsections-navigation">
				<?php  echo $indieground_options['indieground-footer-custom-copy'];  ?>
				</span></b>
			<?php endif;   ?>

			<br>

<?php if ($indieground_options['indieground-footer-social']==1) : ?>				<div id="social_footer">
						<?php echo indiegroundshortcode_social() ?>
				</div><!-- end social -->
			<?php endif;   ?>
		</div><!-- end  container -->

<?php if ($indieground_options['indieground-footer-stitched']==1) : ?>

			<div class="bg_navigation_down"></div>

		<?php endif; ?>

	</footer>

	<?php if (isset($indieground_options['indieground-header-style'])) : ?> ?>
		<?php if ($indieground_options['indieground-header-style']=="2" && is_home()==1): ?> ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>


	<?php if (!empty($indieground_options['indieground-preloader'])) : ?>
		<!-- Loading  ================================================== -->

	  <script type="text/javascript">
			jQuery(document).ready(function () {
			    jQuery("body").queryLoader2({
			        barColor: '<?php echo $indieground_options['indieground-bar-color'] ?>',
					<?php if ($indieground_options['indieground-backgroundColor-color']!="") : ?>
						backgroundColor:'<?php echo $indieground_options['indieground-backgroundColor-color'] ?>',
					<?php else:   ?>
						backgroundColor: '#211310',
					<?php endif;   ?>
			        percentage: true,
			        barHeight: 3,
			        onLoadComplete: function() {
			        	console.log("okok");
			        	jQuery("#prequeryLoader2").hide();
			        },
			        completeAnimation: "grow" /* Options: "grow" or "fade" */

			    });
			});
	  </script>
	<?php endif;   ?>



	<!-- Analytics  ================================================== -->
	<?php if(!empty($indieground_options['indieground-custom-analytics'])) echo $indieground_options['indieground-custom-analytics']; ?>
	<!-- Style  ================================================== -->





	<?php wp_footer();?>
</body>
</html>
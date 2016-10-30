<?php
/**
 * @var array $view_variables
 */
$tabs_right = tf_akg( 'general/pos', $view_variables ) == 'true' ? ' tabs-right' : '';
?>
<div class="video-slider clearfix <?php echo $tabs_right; ?>">
	<div class="video-slider-tabs scrollbar">
		<ul>
			<?php $count = 0;
			foreach ( $view_variables['slides'] as $slide ): $count ++; ?>
				<li <?php echo ( $count == 1 ) ? 'class="active"' : ''; ?>>
					<a href="#video-slide-<?php echo $count; ?>" data-toggle="tab">
						<?php echo $slide['slide_src']; ?>
						<?php if ( ! empty( $slide['slide_rating'] ) ): ?>
							<span class="rating"><?php echo $slide['slide_rating']; ?></span>
						<?php endif; ?>
						<span class="video-title"><?php echo $slide['slide_title']; ?></span>
						<small class="video-tags"><?php echo $slide['slide_cats']; ?></small>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="video-slider-content tab-content">
		<?php $c = 0;
		foreach ( $view_variables['slides'] as $slide ): $c ++; ?>
			<div class="tab-pane <?php echo ( $c == 1 ) ? 'active' : ''; ?>" id="video-slide-<?php echo $c; ?>">
				<?php
				if ( ! empty( $slide['slide_video'] ) ) : ?>
					<?php
					preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#",
						$slide['slide_video'],
						$video_id );
					?>
					<?php if ( ! empty( $video_id ) ) : ?>
						<iframe src="//www.youtube.com/embed/<?php echo $video_id[0] ?>?wmode=transparent"
						        width="782" height="440" allowFullScreen></iframe>
					<?php else : ?>
						<iframe src="<?php echo $slide['slide_video']; ?>" width="782" height="440"
						        allowFullScreen></iframe>
					<?php endif ?>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
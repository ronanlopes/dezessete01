<?php header("Content-type: text/css; charset=utf-8");

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );


?>




<?php if (!empty($indieground_options['indieground-preloader'])) : ?>

#qLoverlay {
	<?php if ($indieground_options['indieground-backgroundColor-color']!="") : ?>
				background-color:<?php echo $indieground_options['indieground-backgroundColor-color'] ?> !important;
				<?php else:   ?>
				background-color: #211310 !important;
				<?php endif;   ?>
           }


#qLbar { /*PRELOADER BAR COLOR*/

<?php if ($indieground_options['indieground-bar-color']!="") : ?>
      background-color:<?php echo $indieground_options['indieground-bar-color'] ?> !important;
<?php else:   ?>
      background-color: #e37f65;
<?php endif;   ?>

}


#qLpercentage { /*PERCENTAGE COLOR*/

<?php if ($indieground_options['indieground-percentage-color']!="") : ?>
				color:<?php echo $indieground_options['indieground-percentage-color'] ?> !important;
				<?php else:   ?>
	          	color: #ffd8be;

				<?php endif;   ?>
	         }


#prequeryLoader2 { /*PRELOADER BACKGROUND COLOR*/
				position:absolute;
				top:0;
				left:0;
				right:0;
				bottom:0;
				width:100%;
				height:100%;
				z-index:99999;
				<?php if ($indieground_options['indieground-backgroundColor-color']!="") : ?>
				background:<?php echo $indieground_options['indieground-backgroundColor-color'] ?> !important;
				<?php else:   ?>
				background: #211310 !important;
				<?php endif;   ?>
	         }
<?php endif;?>


<?php if (!empty($indieground_options['indieground-custom-css'])) : ?>
		 <?php  echo $indieground_options['indieground-custom-css'];  ?>
<?php endif;   ?>


<?php echo indieground_custom_css() ?>

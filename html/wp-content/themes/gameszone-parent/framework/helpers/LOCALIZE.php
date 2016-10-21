<?php if ( ! defined( 'TFUSE' ) ) {
	exit( 'Direct access forbidden.' );
}

function _action_tfuse_translate_jquery_datepicker() {
	?>
	<script>
		jQuery(function ($) {
			$.datepicker.regional['<?php echo substr( get_locale(), 0, 2 ) ?>'] = {
				closeText: "<?php  _ex( 'Done', 'date-picker-calendar', 'tfuse' ) ?>",
				prevText: "<?php  _ex( 'Prev', 'date-picker-calendar', 'tfuse' ) ?>",
				nextText: "<?php  _ex( 'Next', 'date-picker-calendar', 'tfuse' ) ?>",
				currentText: "<?php  _ex( 'Today', 'date-picker-calendar', 'tfuse' ) ?>",
				monthNames: [
					"<?php  _ex( 'January', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'February', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'March', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'April', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'May', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'June', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'July', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'August', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'September', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'October', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'November', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'December', 'date-picker-calendar', 'tfuse' ) ?>"
				],
				monthNamesShort: [
					"<?php  _ex( 'Jan', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Feb', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Mar', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Apr', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'May', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Jun', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Jul', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Aug', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Sep', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Oct', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Nov', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Dec', 'date-picker-calendar', 'tfuse' ) ?>",
				],
				dayNames: [
					"<?php  _ex( 'Sunday', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Monday', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Tuesday', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Wednesday', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Thursday', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Friday', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Saturday', 'date-picker-calendar', 'tfuse' ) ?>",
				],
				dayNamesShort: [
					"<?php  _ex( 'Sun', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Mon', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Tue', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Wed', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Thu', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Fri', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Sat', 'date-picker-calendar', 'tfuse' ) ?>",
				],
				dayNamesMin: [
					"<?php  _ex( 'Su', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Mo', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Tu', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'We', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Th', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Fr', 'date-picker-calendar', 'tfuse' ) ?>",
					"<?php  _ex( 'Sa', 'date-picker-calendar', 'tfuse' ) ?>",
				],
				weekHeader: "<?php  _ex( 'Wk', 'date-picker-calendar', 'tfuse' ) ?>",
				dateFormat: "<?php echo apply_filters( 'datepicker-calendar-date-format', 'mm/dd/yy' ) ?>",
				firstDay: 0,
				isRTL: <?php echo is_rtl() ? 'true' : 'false' ?>,
				showMonthAfterYear: false,
				yearSuffix: ""
			};

			$.datepicker.setDefaults($.datepicker.regional['<?php echo substr( get_locale(), 0, 2 ) ?>']);
		});
	</script>
	<?php
}

function _action_sdfsadfsadfsdf() {
	global $wp_scripts;

	if ( in_array( 'jquery-ui-datepicker', $wp_scripts->queue ) ) {
		_action_tfuse_translate_jquery_datepicker();
	}
}

add_action( 'wp_print_footer_scripts', '_action_sdfsadfsadfsdf' );
<?php
/************************************************************************
* Meta Boxes Gallery
*************************************************************************/


/*
 * create boxes
 * */
add_action('admin_menu', 'indieground_add_gallery_meta_boxes');
add_action('wp_ajax_wpindieground_get_thumbnail', 'indieground_ajax_getThumbnail');
add_action('wp_ajax_wpindieground_get_all_thumbnail', 'indieground_ajax_getAttachments');
add_action('save_post', 'saveMetaGallery', 9, 1);


function indieground_add_gallery_meta_boxes() {
	$post_types = array('portfolio');

	foreach ($post_types as $i => $type) {
		add_meta_box('indieground', __('Gallery', 'indieground'), 'indieground_metabox_gallery', $type);
	}
}


function indieground_metabox_gallery($post) {
	$gallery = get_post_meta($post->ID, 'wpindieground_gallery', true);
	wp_nonce_field(basename(__FILE__), 'wpindieground_gallery_nonce');

	$upload_size_unit = $max_upload_size = wp_max_upload_size();
	$sizes = array('KB', 'MB', 'GB');

	for ($u = -1; $upload_size_unit > 1024 && $u < count($sizes) - 1; $u++) {
		$upload_size_unit /= 1024;
	}

	if ($u < 0) {
		$upload_size_unit = 0;
		$u = 0;
	} else {
		$upload_size_unit = (int) $upload_size_unit;
	}

	$upload_action_url = admin_url('async-upload.php');
	$post_params = array(
		"post_id" => $post->ID,
		"_wpnonce" => wp_create_nonce('media-form'),
		"short" => "1",
	);

	$post_params = apply_filters('upload_post_params', $post_params);
	$plupload_init = array(
		'runtimes' => 'html5,silverlight,flash,html4',
		'browse_button' => 'wpsg-plupload-browse-button',
		'file_data_name' => 'async-upload',
		'multiple_queues' => true,
		'max_file_size' => $max_upload_size . 'b',
		'url' => $upload_action_url,
		'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
		'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
		'filters' => array(array('title' => __('Allowed Files', 'indieground'), 'extensions' => '*')),
		'multipart' => true,
		'urlstream_upload' => true,
		'multipart_params' => $post_params
	);
	?>
	<script type="text/javascript">
		var POST_ID = <?php echo $post->ID; ?>;
		var WPSGwpUploaderInit = <?php echo json_encode($plupload_init) ?>;
	</script>

	<input id="wpsg-plupload-browse-button" class="button" type="button" value="<?php echo __('Quick Upload', 'indieground'); ?>" rel="" />
	<input id="wpindieground_upload_button" data-uploader_title="Select Image" data-uploader_button_text="Select" class="upload_button button" type="button" value="<?php echo __('Select Image', 'indieground'); ?>" rel="" />
	<input id="wpindieground_delete_all_button" class="button" type="button" value="<?php echo __('Delete All', 'indieground'); ?>" rel="" />
	<span class="spinner" id="wpsimplegallyer_spinner"></span>
	<div id="wpindieground_container">
		<ul id="wpindieground_thumbs" class="clearfix"><?php
			$gallery = (is_string($gallery)) ? @unserialize($gallery) : $gallery;
			if (is_array($gallery) && count($gallery) > 0) {
				foreach ($gallery as $id) {
					echo indieground_admin_thumb($id);
				}
			}
			?>
		</ul>
	</div>
	<?php
}

function indieground_admin_thumb($id) {
	$image = wp_get_attachment_image_src($id, 'wpindieground_admin_thumb', true);
	?>
	<li><img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" /><a href="#" class="wpindieground_remove"><?php echo __('Remove', 'indieground'); ?></a><input type="hidden" name="wpindieground_thumb[]" value="<?php echo $id; ?>" /></li>
	<?php
}

function indieground_ajax_getThumbnail() {
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	echo indieground_admin_thumb($_POST['imageid']);
	die;
}

function indieground_ajax_getAttachments() {
	$post_id = $_POST['post_id'];
	$included = (isset($_POST['included'])) ? $_POST['included'] : array();

	$attachments = get_children(array(
		'post_parent' => $post_id,
		'post_type' => 'attachment',
		'numberposts' => -1,
		'order' => 'ASC',
		'post_mime_type' => 'image',
			)
	);
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	if (count($attachments) > 0) {
		foreach ($attachments as $a) {
			if (!in_array($a->ID, $included)) {
				echo indieground_admin_thumb($a->ID);
			}
		}
	}
	die;
}

function thumb($id, $post_id) {
	$info = get_posts(array('p' => $id, 'post_type' => 'attachment'));
	$url = wp_get_attachment_url($id);
	if (wpsg_of_get_option('wpindieground_use_timthumb', '0') === '1') {
		$width = 150;
		$height = 150;
		$image = array(
			wpindieground_URL . 'timthumb.php?src=' . $url . '&q=85&w=' . $width . '&h=' . $height,
			$width,
			$height
		);
	} else {
		$image = wp_get_attachment_image_src($id);
	}
	$title_string = wpsg_of_get_option('wpindieground_caption', '%title%');
	$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
	$data = array(
		'%title%' => $info[0]->post_title,
		'%alt%' => $alt,
		'%filename%' => basename($url),
		'%caption%' => $info[0]->post_excerpt,
		"\n" => ' - '
	);
	$title = str_replace(array_keys($data), $data, $title_string);
	return '<li><a href="' . $url . '" title="' . $title . '" rel="wpindieground_group_' . $post_id . '"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $info[0]->post_title . '" /></a></li>';
}

function saveMetaGallery($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return '';
	}
	if (!isset($_POST['wpindieground_gallery_nonce']) || !wp_verify_nonce($_POST['wpindieground_gallery_nonce'], basename(__FILE__)))
		return (isset($post_id)) ? $post_id : 0;

	$images = (isset($_POST['wpindieground_thumb'])) ? $_POST['wpindieground_thumb'] : array();
	$gallery = array();
	if (count($images) > 0) {
		foreach ($images as $i => $img) {
			if (is_numeric($img))
				$gallery[] = $img;
		}
	}
	update_post_meta($post_id, 'wpindieground_gallery', $gallery);
	return $post_id;
}


?>
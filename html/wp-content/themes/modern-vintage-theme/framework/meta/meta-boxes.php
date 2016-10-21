<?php
/************************************************************************
* Meta Boxes
*************************************************************************/
global $wpdb;

$prefix = 'indieground_';
$table_name = $wpdb->prefix."revslider_sliders";
$revsliders = array();

if($wpdb->get_var("SHOW TABLES LIKE '$table_name'")==$table_name) {
	$rs = $wpdb->get_results("SELECT id, title, alias FROM ".$table_name." ORDER BY id ASC LIMIT 100");
	if ($rs) {
		foreach ($rs as $slider) {
			$revsliders[$slider->alias] = $slider->alias;
		}
	} else {
		$revsliders["No sliders found"] = 0;
	}
} else {
	$revsliders["No sliders found"] = 0;
}


$idg_post_meta = array(
    'id' => 'meta-posts',
    'title' => __('Section Customize Options','indieground'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Internal Parallax Image', 'indieground'),
            'desc' => __('Choose a parallax image for this section.', 'indieground'),
            'id' => $prefix.'parallax_image',
            "type" => "image",
            'std' => ''
        )
    )
);

$idg_section_meta = array(
    'id' => 'page-section-meta',
    'title' => __('Section Customize Options','indieground'),
    'page' => 'page-sections',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Revolution Slider', 'indieground'),
            'desc' => __('Select your Revolution Slider Alias for the slider that you want to show.', 'indieground'),
            'id' => $prefix.'revslider',
            "type" => "combo_slider",
            'options' => $revsliders,
            'std' => ''
        ),
        array(
            'name' => __('Enable google maps', 'indieground'),
            'desc' => __('Enable google maps', 'indieground'),
            'id' => $prefix.'googlemaps_visibility',
            "type" => "onoff",
            'std' => ''
        ),
        array(
            'name' => __('Enable title', 'indieground'),
            'desc' => __('Set title visible or invisible', 'indieground'),
            'id' => $prefix.'title_visibility',
            "type" => "onoff",
            'std' => '',
            'default' => 'ON'
        ),
        array(
            'name' => __('Enable line', 'indieground'),
            'desc' => __('Set line visible or invisible', 'indieground'),
            'id' => $prefix.'line_visibility',
            "type" => "onoff",
            'std' => '',
            'default' => 'ON'
        ),
        array(
            'name' => __('Subtitle', 'indieground'),
            'desc' => __('Add a subtitle at your page section', 'indieground'),
            'id' => $prefix.'subtitle',
            "type" => "testo",
            'std' => ''
        ),
        array(
            'name' => __('Background Image', 'indieground'),
            'desc' => __('Choose a background image for this section.', 'indieground'),
            'id' => $prefix.'bg_image',
            "type" => "image",
            'std' => ''
        ),
        array(
            'name' => __('Background color', 'indieground'),
            'desc' => __('You can set a custom background color using the color picker, or enter a hex value (i.e #ff0000).', 'indieground'),
            'id' => $prefix.'bg_color',
            'type' => 'pickcolor',
            'std' => ''
        ),
        array(
            'name' => __('Parallax Image', 'indieground'),
            'desc' => __('Choose a parallax image for this section.', 'indieground'),
            'id' => $prefix.'parallax_image',
            "type" => "image",
            'std' => ''
        )
    )
);

$idg_portfolio_meta = array(
    'id' => 'portfolio-meta',
    'title' => __('Section Customize Options','indieground'),
    'page' => 'portfolio',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
     array(
            'name' => __('LABEL', 'indieground'),
            'desc' => __('Text you want to display on the polaroid frame', 'indieground'),
            'id' => $prefix.'pretitle',
            "type" => "testo",
            'std' => 'VIEW PROJECT'
        ),
       array(
            'name' => __('INTRODUCTION', 'indieground'),
            'desc' => __('Text you want to display over the project title.', 'indieground'),
            'id' => $prefix.'subtitle',
            "type" => "testo",
            'std' => ''
        ),
            array(
            'name' => __('CLIENT', 'indieground'),
            'desc' => __('Enter the client name.', 'indieground'),
            'id' => $prefix.'client',
            "type" => "testo",
            'std' => ''
        ),
           array(
            'name' => __('TOP PARALLAX IAMGE', 'indieground'),
            'desc' => __('Set a parallax image to be displayed on top of the page.', 'indieground'),
            'id' => $prefix.'parallax_image',
            "type" => "image",
            'std' => ''
                  ),
            array(
            'name' => __('EXTERNAL LINK', 'indieground'),
            'desc' => __('Place URL if you want to display your project from another page.', 'indieground'),
            'id' => $prefix.'link',
            "type" => "testo",
            'std' => ''
        )

    )
);


$idg_team_meta = array(
    'id' => 'team-meta',
    'title' => __('Section Customize Options','indieground'),
    'page' => 'team',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Subtitle', 'indieground'),
            'desc' => __('Subtitle', 'indieground'),
            'id' => $prefix.'subtitle',
            "type" => "testo",
            'std' => ''
        ),
        array(
            'name' => __('Facebook', 'indieground'),
            'desc' => __('Facebook', 'indieground'),
            'id' => $prefix.'tlink_facebook',
            "type" => "testo",
            'std' => ''
        ),
        array(
            'name' => __('Twitter', 'indieground'),
            'desc' => __('Twitter', 'indieground'),
            'id' => $prefix.'tlink_twitter',
            "type" => "testo",
            'std' => ''
        ),
        array(
            'name' => __('Pinterest', 'indieground'),
            'desc' => __('Pinterest', 'indieground'),
            'id' => $prefix.'tlink_pinterest',
            "type" => "testo",
            'std' => ''
        ),
        array(
            'name' => __('Behance', 'indieground'),
            'desc' => __('Behance', 'indieground'),
            'id' => $prefix.'tlink_behance',
            "type" => "testo",
            'std' => ''
        ),
        array(
            'name' => __('Linkedin', 'indieground'),
            'desc' => __('Linkedin', 'indieground'),
            'id' => $prefix.'tlink_linkedin',
            "type" => "testo",
            'std' => ''
        )
    )
);

function indieground_create_meta_box($metabox_data)
{
    global $post;

    // Use nonce for verification
    echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($metabox_data['fields'] as $field) {
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>';
        echo '<th style="width:25%">';
        echo '<label for="', $field['id'], '">';
        echo '<strong>', $field['name'], '</strong>';
        echo '<span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span>';
        echo '</label>';
        echo '</th>';
        echo '<td>';

        switch ($field['type']) {
            case 'image':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
                    : stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
                //echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '_browse" id="', $field['id'], '_browse" value="Browse" />';

				echo '<input id="'.$field['id'].'_browse" data-uploader_title="Upload Image" data-uploader_button_text="Select" class="upload_button button" type="button" value="'.__('Upload Image', 'wpsimplegallery').'" rel="" />';

				?>

				<script type="text/javascript" language="javascript">
					jQuery(document).ready(function() {
						jQuery("#<?php echo $field['id']; ?>_browse").on('click', function(e) {
							var file_frame;

							e.preventDefault();
							if (file_frame) {
								file_frame.open();
								return;
							}

							file_frame = wp.media.frames.file_frame = wp.media({
								title: jQuery(this).data('uploader_title'),
								button: {
									text: jQuery(this).data('uploader_button_text'),
								},
								multiple: false
							});

							file_frame.on('select', function() {
								attachment = file_frame.state().get('selection').first().toJSON();
								jQuery("#<?php echo $field['id']; ?>").val(attachment.url);
							});
							file_frame.open();
						});

						/*jQuery("#<?php echo $field['id']; ?>_browse").click(function () {
							window.send_to_editor = function (html) {
								imgurl = jQuery('img', html).attr('src');
								jQuery("#<?php echo $field['id']; ?>").val(imgurl);
								tb_remove();
							}
							tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
							return false;
						});*/
					});
				</script>

				<?php

                break;

            case 'testo':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
                    : stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
                break;

            case 'pulsante':
                echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '" value="Browse" />';
                break;

            case 'combo':
                echo'<select name="' . $field['id'] . '">';

                foreach ($field['options'] as $option) {
                    echo'<option';
                    if ($meta == $option) {
                        echo ' selected="selected"';
                    }
                    echo'>' . $option . '</option>';
                }
                echo'</select>';

                break;

			case 'combo_slider':
				echo '<select name="'. $field['id'] .'" id="'. $field['id'] .'">';
				echo '<option value="">' . __('None','') . '</option>';
				foreach( $field['options'] as $key => $option ){
					if ( is_numeric($key) && is_string($option) || is_numeric($key) && is_numeric($option) ) {
                        $key = $option;
                    }

					$selected = '';
					if ($meta == $key) $selected = ' selected="selected"';
					echo '<option class="'.$option.'" value="'.$option.'"'.$selected.'>'.$key.'</option>';
				}
				echo'</select>';
				break;

            case 'onoff':
            	if ($meta=='') {
            		if (isset($field['default'])) {
            			$meta=$field['default'];
            		}
            	}

				$selected_on = '';
				$selected_off = '';
				if ($meta=='ON') {
					$selected_on=' selected="selected" ';
				} else {
					$selected_off=' selected="selected" ';
				}

				/*echo '<div class="indie_control">';
				echo '<div class="btn-group" data-toggle="buttons">';
				echo '<label class="btn btn-primary">';
				echo '<input type="radio" name="'.$field['id'].'" value="ON" '.$selected_on.'> ON';
				echo '</label>';
				echo '<label class="btn btn-primary">';
				echo '<input type="radio" name="'.$field['id'].'" value="OFF" '.$selected_off.'> OFF';
				echo '</label>';
				echo '</div>';
				echo '</div>';
				break;*/

				echo '<select name="'.$field['id'].'" id="'.$field['id'].'" data-role="slider" data-mini="true">';
				echo '	<option value="OFF" '.$selected_off.'>Off</option>';
				echo '	<option value="ON" '.$selected_on.'>On</option>';
				echo '</select>';

				?>

				<script type="text/javascript" language="javascript">
					jQuery(document).ready(function() {
						jQuery("#<?php echo $field['id']; ?>").slider();
						/*  fine  */
					});
				</script>

				<?php

				break;


            case 'pickcolor':
                echo '<div id="' . $field['id'] . '_picker" class="colorSelector"><div></div></div>';
                echo '<input name="' . $field['id'] . '" id="' . $field['id'] . '" type="text">';
                ?>

				<script type="text/javascript" language="javascript">
					jQuery(document).ready(function () {
						jQuery('#<?php echo $field['id']; ?>').minicolors({
							control: jQuery(this).attr("data-control") || "hue",
							defaultValue: "<?php echo $meta; ?>",
							inline: jQuery(this).hasClass("inline"),
							letterCase: jQuery(this).hasClass("uppercase") ? "uppercase" : "lowercase",
							opacity: jQuery(this).hasClass("opacity"),
							position: jQuery(this).attr("data-position") || "default",
							styles: jQuery(this).attr("data-style") || "",
							swatchPosition: jQuery(this).attr("data-swatch-position") || "left",
							theme: jQuery(this).attr("data-theme") || "default",
							change: function(hex, opacity) {
							}
						});
					});
				</script>
            <?php break;

			echo '</td>';
			echo '</tr>';
        }

    }

    echo '</table>';
}

/*
 * save metadata
 * */
function indieground_save_metadata_box($post_id,$metabox_data){
    global $idg_section_meta,$post;
    $new = '';
    // verify nonce
    if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
    // check permissions
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($metabox_data['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);

        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }

}


/*
 * create boxes
 * */
add_action('admin_menu', 'indieground_add_section_meta_boxes');



function indieground_add_section_meta_boxes() {
    global $idg_section_meta;
    global $idg_portfolio_meta;
    global $idg_team_meta;
    global $idg_post_meta;

    add_meta_box($idg_section_meta['id'], $idg_section_meta['title'], 'indieground_show_metasection_box', $idg_section_meta['page'], $idg_section_meta['context'], $idg_section_meta['priority']);
    add_meta_box($idg_portfolio_meta['id'], $idg_portfolio_meta['title'], 'show_metaportfolio_box', $idg_portfolio_meta['page'], $idg_portfolio_meta['context'], $idg_portfolio_meta['priority']);
    add_meta_box($idg_team_meta['id'], $idg_team_meta['title'], 'show_metateam_box', $idg_team_meta['page'], $idg_team_meta['context'], $idg_team_meta['priority']);
    add_meta_box($idg_post_meta['id'], $idg_post_meta['title'], 'indieground_show_metapost_box', $idg_post_meta['page'], $idg_post_meta['context'], $idg_post_meta['priority']);
}

function indieground_show_metasection_box() {
	global $idg_section_meta;
	indieground_create_meta_box($idg_section_meta);
}

function show_metaportfolio_box() {
	global $idg_portfolio_meta;
	indieground_create_meta_box($idg_portfolio_meta);
}

function show_metateam_box() {
	global $idg_team_meta;
	indieground_create_meta_box($idg_team_meta);
}

function indieground_show_metapost_box() {
	global $idg_post_meta;
	indieground_create_meta_box($idg_post_meta);
}

/**** save data ****/
function indieground_save_metasection_box($post_id){
	global $idg_section_meta;
	indieground_save_metadata_box($post_id,$idg_section_meta);
}

function indieground_save_metaportfolio_box($post_id){
	global $idg_portfolio_meta;
	indieground_save_metadata_box($post_id,$idg_portfolio_meta);
}

function indieground_save_metateam_box($post_id){
	global $idg_team_meta;
	indieground_save_metadata_box($post_id,$idg_team_meta);
}

function indieground_save_metapost_box($post_id){
	global $idg_post_meta;
	indieground_save_metapost_box($post_id,$idg_post_meta);
}

add_action('save_post', 'indieground_save_metasection_box');
add_action('save_post', 'indieground_save_metaportfolio_box');
add_action('post_meta', 'indieground_save_metapost_box');
add_action('save_post', 'indieground_save_metateam_box');

?>
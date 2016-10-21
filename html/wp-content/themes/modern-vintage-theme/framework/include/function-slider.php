<?php /*** Include ***/

    function indieground_slider($post_id = false) {
        global $post;
        $post_id = (!$post_id) ? $post->ID : $post_id;
        $gallery = get_post_meta($post_id, 'wpindieground_gallery', true);
        $gallery = (is_string($gallery)) ? @unserialize($gallery) : $gallery;

        if (is_array($gallery) && count($gallery) > 0) {
            echo "<div class='flexslider flexAppp'>\n";
            echo "<ul class='slides sliderWrapper'>\n";
            $k=0;
            foreach ($gallery as $thumbid) {
                $image = wp_get_attachment_image_src($thumbid,'full');
                echo "<li class='slideN".$k."'><img class='frame ' src='".$image[0]."'/></li>\n";
				$k+=1;
            }
            echo "</ul></div>\n";
        }
    }

?>
<?php
	function indiegroundshortcode_social() {
		global $indieground_options;
		$output = "";

		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-facebook'],"icon-facebookicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-twitter'],"icon-twittericon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-google'],"icon-googleplusicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-behance'],"icon-behanceicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-dribbble'],"icon-dribbbleicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-linkedin'],"icon-linkedinicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-flickr'],"icon-flickricon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-vimeo'],"icon-vimeoicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-soundcloud'],"icon-soundcloudicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-ustream'],"icon-ustreamicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-deviantart'],"icon-deviantarticon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-instagram'],"icon-instagramicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-pinterest'],"icon-pinteresticon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-youtube'],"icon-youtubeicon");
		$output.=indiegroundshortcode_getecho($indieground_options['indieground-social-tumblr'],"icon-tumblricon");

		return $output;
	}

	function indiegroundshortcode_getecho($url_social, $icon_social) {
		$output = "";

		if ($url_social!="") {
			$output.="		<a class='social_icon external' href='".$url_social."' target='_blank'>\n";
			$output.="			<i class='".$icon_social."'></i>\n";
			$output.="		</a>\n";

		}

		return $output;
	}

?>
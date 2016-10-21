<?php

class Indieground_wTwitter extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'indieground_widget_twitter clearfix', 'description' => __( 'Use this widget to display your latest tweets.', 'indieground') );
		parent::__construct('lw_twitter', __('Indieground Twitter Widget', 'indieground'), $widget_ops);
		$this->alt_option_name = 'indieground_widget_twitter';
	}

	function widget($args, $instance) {
		global $indieground_options;

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;
		echo $before_title . $title . $after_title;

		$replies = true;

		if(function_exists('getTweets')) {

			echo '<div class="widget">';
			echo '<div class="indie_widget_twitter">';

			//$tweets = getTweets(false, null, $opts);

			$config['key'] = $indieground_options["indieground-twitter"][1];
			$config['secret'] = $indieground_options["indieground-twitter"][2];
			$config['token'] = $indieground_options["indieground-twitter"][3];
			$config['token_secret'] = $indieground_options["indieground-twitter"][4];
			$config['screenname'] = $indieground_options["indieground-twitter"][5];
			$config['cache_expire'] = 3600;
			$config['directory'] = plugin_dir_path(__FILE__);

			if ($config['key']!="" && $config['secret']!="" && $config['token']!="" && $config['token_secret']!="" && $config['screenname']!="") {
				echo '<ul class="list_tweets' . '-' . $this->number . '">';

				$count = $indieground_options["indieground-twitter"][6];
				$username = $indieground_options["indieground-twitter"][5];

				$obj = new StormTwitter($config);
				$tweets = $obj->getTweets($username, $count, false);

				if(is_array($tweets)) {
					foreach($tweets as $tweet){
						if($tweet['text']){
							$the_tweet = $tweet['text'];
							if (is_array($tweet['entities'])) {
								if(is_array($tweet['entities']['user_mentions'])){
									foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
										$the_tweet = preg_replace('/@'.$user_mention['screen_name'].'/i', '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>', $the_tweet);
									}
								}
							}
							if(is_array($tweet['entities'])) {
								if(is_array($tweet['entities']['hashtags'])){
									foreach($tweet['entities']['hashtags'] as $key => $hashtag){
										$the_tweet = preg_replace('/#'.$hashtag['text'].'/i', '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>', $the_tweet);
									}
								}
							}
							if(is_array($tweet['entities'])) {
								if(is_array($tweet['entities']['urls'])){
									foreach($tweet['entities']['urls'] as $key => $link){
										$the_tweet = preg_replace('`'.$link['url'].'`', '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>', $the_tweet);
									}
								}
							}

							echo "<li>\n";
							echo "<span class='tweet_text'>\n";
							echo $the_tweet;
							echo "</span>\n";
							echo "<p class='fancy_one_tw_sider'>\n";
							echo "<span>   <i class='fa fa-twitter'></i> ".date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours'))."</span>\n";
							echo "</p>\n";
							echo "</li>\n";
						}
					}
				}
				echo '</ul>';
			} else {
				echo "First complete the twitter's fields in the panel option (Social Key Tab)";
			}
			echo '</div>';
			echo '</div>';

		} else {
			echo '<span>Please install <a href="http://wordpress.org/plugins/oauth-twitter-feed-for-developers/">oAuth Twitter Feed for Developers</a> plugin</span>';
		}

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance)	{

		$defaults = array(
			'title' => 'Twitter Widget',
			'username' => '',
			'limit' => 5,
			'replies' => 'true'
		);

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'indieground') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

	<?php }
}
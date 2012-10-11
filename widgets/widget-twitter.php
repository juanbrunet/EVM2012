<?php
class UDS_Twitter extends WP_Widget {
	function UDS_Twitter() {
		//Constructor
		parent::__construct(false, 'uDS Twitter');
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$twitter_user = apply_filters('widget_twitter_user', $instance['twitter_user']);
		$twitter_count = apply_filters('widget_twitter_count', $instance['twitter_count']);
		
		if(empty($twitter_user)) return;
		if(!is_numeric($twitter_count) || (int)$twitter_count < 1) $twitter_count = 5;
		
		if(!function_exists('curl_init')){
			echo __("cURL is not installed");
			return;
		}
		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$twitter_user.'&count='.$twitter_count);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($c, CURLOPT_TIMEOUT, 5);
		$response = curl_exec($c);
		$responseInfo = curl_getinfo($c);
		curl_close($c);
		if (intval($responseInfo['http_code']) != 200) {
			echo __("Failed to retrieve tweets");
			return;
		}
		
		$statuses = json_decode($response);
		
		if(empty($statuses)) return;
		
		echo $before_widget;
		if ( $title )
        	echo $before_title . $title . $after_title;
        
        //var_dump($statuses);
		?>
			<div class="uds-twitter-widget">
				<ul>
					<?php foreach($statuses as $status): 
					$description = $status->text;
    				$description = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $description);
					$description = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $description);
					$description = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $description)
					?>
					<li class="tweet">
						<?php echo "<div class='text'>$description</div>" ?>
						<p class="source">posted from <?php echo $status->source?>, at <?php echo $status->created_at?></p>
						
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$twitter_user = esc_attr($instance['twitter_user']);
		$twitter_count = esc_attr($instance['twitter_count']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('twitter_user'); ?>"><?php _e('Twitter Screen Name:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_user'); ?>" name="<?php echo $this->get_field_name('twitter_user'); ?>" type="text" value="<?php echo $twitter_user; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('twitter_count'); ?>"><?php _e('Tweet count:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_count'); ?>" name="<?php echo $this->get_field_name('twitter_count'); ?>" type="text" value="<?php echo $twitter_count; ?>" /></label></p>
		<?php
	}
}
?>
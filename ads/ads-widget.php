<?php
class UDS_Ads extends WP_Widget {
	function UDS_Ads() {
		//Constructor
		parent::__construct('uds-ads', 'uDS Ads Widget');
	}

	function widget($args, $instance) {
		global $wpdb;
		extract($args, EXTR_SKIP);
		$title = apply_filters('widget_title', $instance['title']);
 
		$res = (int)$instance['resolution'];
		$pos = (int)$instance['position'];
		
		$table = $wpdb->prefix . UDS_ADS_TABLE_NAME;
		$ads = $wpdb->get_results("
			SELECT * FROM $table 
			WHERE position = $pos
				AND format = '$res'
				AND showing = 1
				AND (
					ignore_date = 1
					OR (
						display_from > NOW()
						AND display_to < NOW()
					)
				)
				AND (
					click_limit = 0
					OR click_limit < times_clicked
				)
			ORDER BY priority ASC
		");
		
		if(empty($ads)) return;
 
		echo $before_widget;
		if ( $title )
        	echo $before_title . $title . $after_title;
		echo '<div id="'.$this->id.'" class="uds-ads  uds-ads-position-'.$pos.'">';
		foreach($ads as $key => $ad){
			echo '<div class="uds-ads-'.$res.' uds-ad '.($key%2 == 0 ? 'even' : 'odd').'">';
			$target = '';
			if($ad->new_window == 1){
				$target = 'target="_blank"';
			}
			echo '<a href="'.get_bloginfo('url').'/index.php?uds_ads_id='.$ad->id.'" '.$target.'>';
			echo '<img src="'.$ad->image_url.'" alt="'.$ad->name.'"/>';
			echo '</a>';
			echo '</div>';
		}
		echo '<div class="clear"></div>';
		echo '</div>';
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['position'] = strip_tags($new_instance['position']);
		$instance['resolution'] = strip_tags($new_instance['resolution']);
		return $new_instance;
	}

	function form($instance) {
		global $uds_ads_resolutions;
		$instance = wp_parse_args( 
			(array) $instance, 
			array( 
				'position' => '0', 
				'resolution' => '125'
			)
		);
		$position = (int)$instance['position'];
		$resolution = (int)$instance['resolution'];
		$title = esc_attr($instance['title']);
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php _e('Title:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('position'); ?>">
					Position: 
					<select class="widefat" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
					<? for($i = 0; $i < 10; $i++): ?>
						<option value="<?php echo $i ?>" <?php echo $position == $i ? "selected='selected'" : "" ?>><?php echo $i+1 ?></option>
					<? endfor; ?>
					</select>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('resolution'); ?>">
					Resolution: 
					<select class="widefat" id="<?php echo $this->get_field_id('resolution'); ?>" name="<?php echo $this->get_field_name('resolution'); ?>">
					<? foreach($uds_ads_resolutions as $key => $value): ?>
						<option value="<?php echo $key ?>" <?php echo $resolution == $key ? "selected='selected'" : "" ?>><?php echo $value ?></option>
					<? endforeach; ?>
					</select>
				</label>
			</p>
		<?php
	}
}
?>
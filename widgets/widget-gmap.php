<?php
class UDS_Gmap extends WP_Widget {
	function UDS_Gmap() {
		//Constructor
		parent::__construct(false, 'uDS Google Map');
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$lat = empty($instance['lat']) ? '' : $instance['lat'];
		$lng = empty($instance['lng']) ? '' : $instance['lng'];
		$zoom = empty($instance['zoom']) ? '' : $instance['zoom'];
 
		//$key = $instance['api_key']; 

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<div id="uds-google-map">';
		echo '<span id="uds-google-map-lat">'.$lat.'</span>';
		echo '<span id="uds-google-map-lng">'.$lng.'</span>';
		echo '<span id="uds-google-map-zoom">'.$zoom.'</span>';
		echo '</div>';
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['lat'] = strip_tags($new_instance['lat']);
		$instance['lng'] = strip_tags($new_instance['lng']);
		$instance['zoom'] = strip_tags($new_instance['zoom']);
		return $new_instance;
	}

	function form($instance) {
		$instance = wp_parse_args( 
			(array) $instance, 
			array( 
				'title' => '', 
				'api_key' => '',
				'lat' => '', 
				'lng' => '' ,
				'zoom' => ''
			)
		);
		$title = strip_tags($instance['title']);
		$lat = strip_tags($instance['lat']);
		$lng = strip_tags($instance['lng']);
		$zoom = strip_tags($instance['zoom']);

		?>
			<p>Make sure you have the Google API Key set in the Theme's Options</p>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('lat'); ?>">Lat: <input class="widefat" id="<?php echo $this->get_field_id('lat'); ?>" name="<?php echo $this->get_field_name('lat'); ?>" type="text" value="<?php echo attribute_escape($lat); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('lng'); ?>">Lng: <input class="widefat" id="<?php echo $this->get_field_id('lng'); ?>" name="<?php echo $this->get_field_name('lng'); ?>" type="text" value="<?php echo attribute_escape($lng); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('zoom'); ?>">Zoom: <input class="widefat" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo attribute_escape($zoom); ?>" /></label></p>
		<?php
	}
}
?>
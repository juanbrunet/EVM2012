<?php
class UDS_Slideshow extends WP_Widget {
	function UDS_Slideshow() {
		//Constructor
		parent::__construct(false, 'uDS Slideshow');
		add_option($this->id);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$images = unserialize(get_option($this->id));
		echo $before_widget;
		if ( $title )
        	echo $before_title . $title . $after_title;
		?>
			<div class="uds-slideshow-widget">
				<div class="images">
					<?php foreach($images as $image): ?>
						<img src="<?php echo $image?>" alt="" />
					<?php endforeach; ?>
				</div>
				<div class="control"></div>
			</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$images = array();
		$n = 0;
		while(isset($new_instance['image_'.$n])){
			if(!empty($new_instance['image_'.$n])){
				$images[] = $new_instance['image_'.$n];
			}
			$n++;
		}
		
		if(!empty($new_instance['image_new'])){
			$images[] = $new_instance['image_new'];
		}
		
		update_option($this->id, serialize($images));
		
		return $new_instance;
	}

	function form($instance) {
		$images = maybe_unserialize(get_option($this->id));
		$title = esc_attr($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p>Images:</p>
		<?php
		if(!empty($images)){
			foreach($images as $key => $image){
				?>
					<p><input class="widefat" id="image-<?php echo $key?>" name="<?php echo $this->get_field_name('image_'.$key)?>" type="text" value="<?php echo $image?>" /></p>
				<?php
			}
		}
		?>
		<p><input class="widefat" id="image-new" name="<?php echo $this->get_field_name('image_new')?>" type="text" value="" /></p>
		<?php
	}
}
?>
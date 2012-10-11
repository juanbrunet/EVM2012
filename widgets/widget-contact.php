<?php
class UDS_Contact extends WP_Widget {
	function UDS_Contact() {
		//Constructor
		parent::__construct(false, 'uDS Contact');
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
		
		$message = '';
		$email = 'Your e-mail';
		$subject = 'Subject';
		$text = 'Your message';
		
		if(!empty($_POST)){
			$can_go = true;
			$email = htmlentities2(stripslashes(trim($_POST['uds-email'])));
			$subject = htmlentities2(stripslashes(trim($_POST['uds-subject'])));
			$text = htmlentities2(stripslashes(trim($_POST['uds-text'])));
			
			if(isset($_POST['uds-email']) && $email == ''){
				$message .= '<p class="error">The email field is empty</p>';
				$can_go = false;
			}
			if(isset($_POST['uds-subject']) && $subject == ''){
				$message .= '<p class="error">The subject field is empty</p>';
				$can_go = false;
			}
			if(isset($_POST['uds-text']) && $text == ''){
				$message .= '<p class="error">The message field is empty</p>';
				$can_go = false;
			}
			
			if($can_go && !is_email($email, true)){
				$message .= '<p class="error">The email address is invalid</p>';
				$can_go = false;
			}
			
			if($can_go){
				$to = get_option('uds-cf-recipient');
				
				$subj = get_option('uds-cf-subject-prefix') . ' ' . $subject;
			
    	        $msg = "$email wrote:\n";
    	        $msg .= wordwrap($text, 80, "\n") . "\n\n";
    	        $msg .= "From website: " . get_bloginfo('name') . ' at ' . get_bloginfo('url') . "\n";
    	        $msg .= "IP: " . $_SERVER["REMOTE_ADDR"];
    	        
				$headers = "MIME-Version: 1.0\n";
				$headers .= "From: $name <$email>\n";
				$headers .= "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
				
				wp_mail($to, $subj, $msg, $headers);
				
				$message .= '<p class="success">'.get_option('uds-cf-success-message').'</p>';
			}
		}

		echo $before_widget;
		if ( $title )
        	echo $before_title . $title . $after_title;
        	
		$form = "
			<form action='".get_permalink()."#contact_widget' method='post'>
				<fieldset>
			   		<input type='text' name='uds-email' value='$email' />
			   		<input type='text' name='uds-subject' value='$subject' />
			    	<textarea name='uds-text' rows='' cols=''>$text</textarea>
			    	<button type='submit'>Submit</button>
			    </fieldset>
			</form>
		";
		
		$out = "
			<div id='contact_widget'>
				<div id='message-container'>$message</div>
				$form
			</div>
		";
		
		echo $out;
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<?php
	}
}
?>
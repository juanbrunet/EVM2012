<?php

///////////////////////////////////////////////////////////////
//
//	Custom layout shortcodes
//
///////////////////////////////////////////////////////////////

include 'tinymce/tinymce.php';

$thirds = 0;

// Thirds
add_shortcode('third', 'third');
function third($atts, $content = null)
{
	global $thirds, $fourths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fourths != 0){
		$thirds = 0;
		$fourths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$thirds++;

	if($content == null) return '';
	
	$class = 'layout-third';

	if($thirds == 3) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($thirds == 3){
		$out .= '<div class="clear"></div>';
		$thirds = 0;
	}
	
	return $out;
}

// Two Thirds
add_shortcode('two-thirds', 'two_thirds');
function two_thirds($atts, $content = null)
{
	global $thirds, $fourths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fourths != 0 || $thirds > 2){
		$thirds = 0;
		$fourths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$thirds += 2;

	if($content == null) return '';
	
	$class = 'layout-two-thirds';
	
	if($thirds == 3) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($thirds == 3){
		$out .= '<div class="clear"></div>';
		$thirds = 0;
	}
	
	return $out;
}

///////////////////////////////////////////////////////////////

$fourths = 0;
// Halves
add_shortcode('half', 'half');
function half($atts, $content = null)
{
	global $thirds, $fourths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($thirds != 0 || $fourths > 2){
		$thirds = 0;
		$fourths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fourths += 2;

	if($content == null) return '';
	
	$class = 'layout-half';
	
	if($fourths == 4) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fourths == 4){
		$out .= '<div class="clear"></div>';
		$fourths = 0;
	}
	
	return $out;
}

// Fourths
add_shortcode('fourth', 'fourth');
function fourth($atts, $content = null)
{
	global $thirds, $fourths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($thirds != 0){
		$thirds = 0;
		$fourths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fourths++;

	if($content == null) return '';
	
	$class = 'layout-fourth';
	
	if($fourths == 4) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fourths == 4){
		$out .= '<div class="clear"></div>';
		$fourths = 0;
	}
	
	return $out;
}

// Three Fourths
add_shortcode('three-fourths', 'three_fourths');
function three_fourths($atts, $content = null)
{
	global $thirds, $fourths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($thirds != 0 || $fourths > 1){
		$thirds = 0;
		$fourths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fourths += 3;

	if($content == null) return '';
	
	$class = 'layout-three-fourths';
	
	if($fourths == 4) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fourths == 4){
		$out .= '<div class="clear"></div>';
		$fourths = 0;
	}
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Buttons
//
///////////////////////////////////////////////////////////////
add_shortcode('button', 'button');
function button($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'link' => '#',
		'type' => ''
	), $atts));
	
	$out = '<a href="'.$link.'" class="button '.$type.'">';
	$out .= do_shortcode($content);
	$out .= '</a>';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	List styles
//
///////////////////////////////////////////////////////////////
add_shortcode('list', 'uds_list');
function uds_list($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
	
	$out = '<div class="list '.$type.'">';
	$out .= $content;
	$out .= '</div>';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Boxes
//
///////////////////////////////////////////////////////////////
add_shortcode('box', 'uds_box');
function uds_box($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
	
	$out = '<div class="box '.$type.'">';
	$out .= $content;
	$out .= '</div>';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Pullquotes
//
///////////////////////////////////////////////////////////////
add_shortcode('pullquote', 'pullquote');
function pullquote($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'align' => 'left'
	), $atts));
	
	$out = '<blockquote class="testimonial">';
	$out .= $content;
	$out .= '</blockquote>';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Dividers
//
///////////////////////////////////////////////////////////////
add_shortcode('divider', 'divider');
function divider($atts)
{
	$out = '<hr class="divider" />';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Portfolio
//
///////////////////////////////////////////////////////////////
add_shortcode('portfolio', 'portfolio_shortcode');
function portfolio_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'category' => 'Portfolio'
	), $atts));
	
	if(is_numeric($cat)){
		$params = 'cat='.$cat;
	} else {
		$params = 'category_name='.$category;
	}
	
	$posts = query_posts($params);
	
	if(!have_posts()) return;
	
	$out = '<div id="portfolio">';
	$n = 1;
	while(have_posts()){
		the_post();
		$custom = get_post_custom();
		$anim = $custom['animation'][0];
		$anims = array('curve', 'up', 'down', 'left', 'top');
		
		if($anim == 'random') $anim = $anims[array_rand($anims)];
		
		$out .= '<div class="portfolio-item '. ($n%3 == 0 ? 'last' : '') .'">';
		$out .= '<img src="'.get_first_image().'" alt="" />';
		$out .= '<span class="anim">'. ((!empty($anim) && in_array($anim, $anims)) ? $anim : 'down' ).'</span>';
		$out .= '<div class="portfolio-post">';
		$out .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
		$out .= get_the_excerpt();
		$out .= '<br /><a href="'.get_permalink().'" class="read-more">Read More &raquo;</a>';
		$out .= '</div>';
		$out .= '</div>';
		$n++;
	}
	
	$out .= '</div>';
	$out .= '<div class="clear"></div>';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Inner slider
//
///////////////////////////////////////////////////////////////
add_shortcode('slider', 'slider_shortcode');
function slider_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'delay' => 1000,
		'height' => '200px'
	), $atts));
	
	$matches = array();
	$pattern = '@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\-\.]*(\?\S+)?)?)?)@';
	if(!preg_match_all($pattern, $content, $matches)){
		return '';
	}
	$images = $matches[0];
	
	if(empty($images)) return '';
	
	$out = '<div class="inner-slider">';
	$out .= '<span class="inner-slider-delay">'.$delay.'</span>';
	$out .= '<span class="inner-slider-height">'.$height.'</span>';
	
	foreach($images as $image){
		$out .= "<img src='".trim($image)."' alt='' />";
	}
	
	$out .= '</div>';
	$out .= '<div class="clear"></div>';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Contact form
//
///////////////////////////////////////////////////////////////

add_shortcode('uds-contact-form', 'contact_form_shortcode');
function contact_form_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'category' => 'Portfolio'
	), $atts));
	
	$message = '';
	$email = '';
	$subject = '';
	$text = '';
	
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
	
	$form = "
		<form action='".get_permalink()."' method='post'>
			<fieldset>
		    	<div class='required'>
		    		<label for='email'>E-mail:</label>
		    		<input type='text' name='uds-email' id='email' value='$email' />
		    	</div>
		    	<div class='required'>
		    		<label for='subject'>Subject:</label>
		    		<input type='text' name='uds-subject' id='subject' value='$subject' />
		    	</div>
		    	<div class='required'>
		    		<label for='text'>Message:</label>
		    		<textarea name='uds-text' id='text'>$text</textarea>
		    	</div>
		    	<div class='clear'></div>
		    	<div>
		    		<button type='submit'>Submit question</button>
		    	</div>
		    </fieldset>
		</form>
	";
	
	if(get_option("uds-cf-show-on-success") != 'on'){
		$form = '';
	}
	
	$out = "
		<div id='contact-form'>
			<div id='message-container'>$message</div>
			$form
		</div>
	";
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	Youtube
//
///////////////////////////////////////////////////////////////

add_shortcode('youtube', 'youtube_shortcode');
function youtube_shortcode($atts, $content = null)
{
	$link = substr($atts[0], 1);
	echo '
	<object width="425" height="355">
	  <param name="movie" value="'.$link.'"></param>
	  <param name="allowFullScreen" value="true"></param>
	  <embed src="'.$link.'"
	    type="application/x-shockwave-flash"
	    width="425" height="355" 
	    allowfullscreen="true"></embed>
	</object>
	';
}

///////////////////////////////////////////////////////////////
// 
//	Google video
//
///////////////////////////////////////////////////////////////

add_shortcode('googlevideo', 'googlevideo_shortcode');
function googlevideo_shortcode($atts, $content = null)
{
	$link = substr($atts[0], 1);
	echo '
	<object width="425" height="355">
	  <param name="movie" value="'.$link.'"></param>
	  <param name="allowFullScreen" value="true"></param>
	  <embed src="'.$link.'"
	    type="application/x-shockwave-flash"
	    width="425" height="355" 
	    allowfullscreen="true"></embed>
	</object>
	';
}


///////////////////////////////////////////////////////////////
// 
//	Table from Table Creator
//
///////////////////////////////////////////////////////////////

add_shortcode('uds-table', 'table_shortcode');
function table_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array(
		'name' => ''
	), $atts));
	
	if(empty($name)){
		echo "Table name must be set [uds-table name=\"Table\"]";
		return;
	}
	
	$tables = maybe_unserialize(get_option('uds-tables', array()));
	
	$table = $tables[$name];
	
	if(empty($table)){
		echo "Table named $name is empty.";
		return;
	}
	
	echo "<table class='uds-table'>";
	for($i = 0; $i < count($table['headerx']); $i++){
		echo "<tr class='".$table['headery'][$i]."'>";
		for($j = 0; $j < count($table['headery']); $j++){
			echo "<td class='".$table['headerx'][$i] .' '. $table['headery'][$j] ."'>";
			echo stripslashes($table['cell'][$i][$j]);
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>
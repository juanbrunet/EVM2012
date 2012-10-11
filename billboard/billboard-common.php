<?php

define('UDS_BILLBOARD_OPTION', 'uds-billboard');

add_option(UDS_BILLBOARD_OPTION, array());

// define data structure for billboard
$uds_billboard_attributes = array(
	'image'=> array(
		'type' => 'image',
		'label' => 'Image'
	),
	'title' => array(
		'type' => 'text',
		'label' => 'Título'
	),
	'link' => array(
		'type' => 'text',
		'label' => 'Link URL'
	),
	'text' => array(
		'type' => 'textarea',
		'label' => 'Texto'
	),
	'delay' => array(
		'type' => 'select',
		'label' => 'Duración',
		'options' => array(
			'1000' => '1s',
			'2000' => '2s',
			'3000' => '3s',
			'4000' => '4s',
			'5000' => '5s',
			'10000' => '10s',
		),
		'default' => '5000'
	),
	'layout' => array(
		'type' => 'select',
		'label' => 'Aparición',
		'options' => array(
			'none' => 'No Description',
			'stripe-left' => 'Stripe Left',
			'stripe-right' => 'Stripe Right',
			'stripe-bottom' => 'Stripe Bottom',
			'stripe-left alt' => 'Alternate Stripe Left',
			'stripe-right alt' => 'Alternate Stripe Right',
			'stripe-bottom alt' => 'Alternate Stripe Bottom',
		),
		'default' => 'none'
	),
	'transition' => array(
		'type' => 'select',
		'label' => 'Transición',
		'options' => array(
			'random' => 'Random',
			'fade' => 'Fade',
			'scaleTop' => 'Scale from Top',
			'scaleCenter' => 'Scale from Center',
			'scaleBottom' => 'Scale from Bottom',
			'scaleRight' => 'Scale from Right',
			'scaleLeft' => 'Scale from Left',
			'squaresRandom' => 'Squares Random',
			'squaresRows' => 'Squares by Rows',
			'squaresCols' => 'Squares by Columns',
			'squaresMoveIn' => 'Squares Fly in',
			'squaresMoveOut' => 'Squares Fly out',
			'columnWave' => 'Column Wave',
			'curtainRight' => 'Curtain Right',
			'curtainLeft' => 'Curtain Left',
			'curtainRotateRight' => 'Curtain Rotate Right',
			'curtainRotateLeft' => 'Curtain Rotate Left',
			'interweaveLeft' => 'Interweave Left',
			'interweaveRight' => 'Interweave Right'
		),
		'default' => 'fade'
	)
);

// initialize billboard
add_action('init', 'uds_billboard_init');
function uds_billboard_init()
{
	$dir = get_template_directory_uri()."/billboard/";
	if(is_admin()){
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-draggable");
		wp_enqueue_script('uds-billboard', $dir."js/billboard-admin.js");
		wp_enqueue_style('uds-billboard', $dir.'css/billboard-admin.css', false, false, 'screen');
	} else {
		wp_enqueue_style('uds-billboard', $dir.'css/billboard.css', false, false, 'screen');
		wp_enqueue_script("uds-billboard", $dir."js/billboard.min.js", array('jquery', 'easing'));	
	}
}

// check for POST data and update billboard accordingly
function uds_billboard_proces_updates()
{
	global $uds_billboard_attributes;

	$post = $_POST['uds_billboard'];
	//d($post);
	if(empty($post)) return;
	
	if(!is_admin()) return;
	
	// update billboard array
	$billboards = array();
	foreach($uds_billboard_attributes as $attrib => $options){
		foreach($post[$attrib] as $key => $item){
			if($billboards[$key] == null){
				$billboard = uds_billboard_default_billboard();
			} else {
				$billboard = $billboards[$key];
			}
			
			$billboard->$attrib = $item;
			$billboards[$key] = $billboard;
		}
	}
	
	// delete empty billboards
	$bb_default = uds_billboard_default_billboard();
	foreach($billboards as $key => $bb){
		$delete = true;
		foreach($uds_billboard_attributes as $attrib => $options){
			if($bb->$attrib != $bb_default->$attrib){
				$delete = false;
			}
		}
		
		if($delete){
			unset($billboards[$key]);
		}
	}
	
	update_option(UDS_BILLBOARD_OPTION, serialize($billboards));
	//delete_option(UDS_BILLBOARD_OPTION);
}

// Initialize empty billboard instance
function uds_billboard_default_billboard()
{
	global $uds_billboard_attributes;

	$bb = new StdClass();
	foreach($uds_billboard_attributes as $att => $options){
		if(isset($options['default'])){
			$bb->$att = $options['default'];
		} else {
			$bb->$att = '';
		}
	}
	return $bb;
}

// frontend proxy function
function get_billboard()
{
	include 'billboard.php';
}

////////////////////////////////////////////////////////////////////////////////
//
//	Functions to render billboard admin form based on the data structure
//
////////////////////////////////////////////////////////////////////////////////

// Render a single input field
function uds_billboard_render_field($item, $attrib, $unique_key){
	global $uds_billboard_attributes;

	$attrib_full = $uds_billboard_attributes[$attrib];
	switch($attrib_full['type']){
		case 'input':
		case 'text':
			uds_billboard_render_text($item, $attrib, $unique_key);
			break;
		case 'textarea':
			uds_billboard_render_textarea($item, $attrib, $unique_key);
			break;
		case 'select':
			uds_billboard_render_select($item, $attrib, $unique_key);
			break;
		case 'image':
			uds_billboard_render_image($item, $attrib, $unique_key);
			break;
		default:
	}
}

// Render text field
function uds_billboard_render_text($item, $attrib, $unique_id)
{
	global $uds_billboard_attributes;
	$attrib_full = $uds_billboard_attributes[$attrib];
	echo '<div class="'. $attrib .'-wrapper">';
	echo '<label for="billboard-'. $attrib .'-'. $unique_id .'">'. $attrib_full['label'] .'</label>';
	echo '<input type="text" name="uds_billboard['. $attrib .'][]" value="' . htmlspecialchars(stripslashes($item->$attrib)) . '" id="billboard-'. $attrib .'-'. $unique_id .'" class="billboard-'. $attrib .'" />';
	echo '</div>';
}

// Render textarea
function uds_billboard_render_textarea($item, $attrib, $unique_id)
{
	global $uds_billboard_attributes;
	$attrib_full = $uds_billboard_attributes[$attrib];
	echo '<div class="'. $attrib .'-wrapper">';
	echo '<label for="billboard-'. $attrib .'-'. $unique_id .'">'. $attrib_full['label'] .'</label>';
	echo '<textarea name="uds_billboard['. $attrib .'][]" class="billboard-'. $attrib .'">'. htmlspecialchars(stripslashes($item->$attrib)) .'</textarea>';
	echo '</div>';
}

// Render Select field
function uds_billboard_render_select($item, $attrib, $unique_id)
{
	global $uds_billboard_attributes;
	$attrib_full = $uds_billboard_attributes[$attrib];
	
	if($attrib_full['type'] != 'select') return;

	echo '<div class="'. $attrib .'-wrapper">';
	echo '<label for="billboard-'. $attrib .'-'. $unique_id .'">'. $attrib_full['label'] .'</label>';
	echo '<select name="uds_billboard['. $attrib .'][]" class="billboard-'. $attrib .'">';
	if(is_array($attrib_full['options'])){
		foreach($attrib_full['options'] as $key => $option){
			$selected = '';
			if($item->$attrib == $key){
				$selected = 'selected="selected"';
			}
			echo '<option value="'. $key .'" '. $selected .'>'. $option .'</option>';
		}
	}
	echo '</select>';
	echo '</div>';
}

// Render Image input
function uds_billboard_render_image($item, $attrib, $unique_id)
{
	echo '<div class="'. $attrib .'-wrapper">';
	echo '<a class="thickbox" title="Add an Image" href="media-upload.php?type=image&TB_iframe=true&width=640&height=345">';
	if(!empty($item->image)){
		echo '<img alt="Add an Image" src="'. $item->$attrib .'" id="billboard-'. $attrib .'-'. $unique_id .'" class="billboard-'. $attrib  .'" />';
	} else {
		echo '<img alt="Add an Image" src="'. get_template_directory_uri() .'/billboard/images/noimg385x180.jpg" id="billboard-'. $attrib .'-'. $unique_id .'" class="billboard-'. $attrib .'" />';
	}
	echo '</a>';
	echo '<input type="hidden" name="uds_billboard['. $attrib .'][]" value="'. $item->$attrib .'" id="billboard-'. $attrib .'-'. $unique_id .'-hidden" />';
	echo '</div>';
}

// render JS support for image input
function uds_billboard_render_js_support()
{
	global $uds_billboard_attributes;
	$selector = '';
	foreach($uds_billboard_attributes as $attrib => $options){
		if($options['type'] == 'image'){
			$selector .= '.billboard-'.$attrib;
		}
	}
	?>
	<script language='JavaScript' type='text/javascript'>
	var set_receiver = function(rec){
		//console.log(rec);
		window.receiver = jQuery(rec).attr('id');
		window.receiver_hidden = jQuery(rec).attr('id')+'-hidden';
	}
	var send_to_editor = function(img){
		tb_remove();
		if(jQuery(jQuery(img)).is('a')){ // work around Link URL supplied
		   var src = jQuery(jQuery(img)).find('img').attr('src');
		} else {
		   var src = jQuery(jQuery(img)).attr('src');
		}
	 
		//console.log(window.receiver);
		//console.log(src);
		jQuery('#'+window.receiver).attr('src', src);
		jQuery("#"+window.receiver_hidden).val(src);
	}
	jQuery('<?php echo $selector; ?>').click(function(){
		set_receiver(this);
	});
	</script>
	<?php
}

?>
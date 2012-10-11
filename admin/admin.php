<?php

// setup Admin menu entry
add_action('admin_menu', 'uds_menu');
function uds_menu()
{	
	$icon = get_template_directory_uri() . '/admin/images/menu-icon.png';
	add_menu_page(UDS_TEMPLATE_NAME, "Opciones Tema", 'manage_options', 'uds_theme_menu', 'uds_theme_admin', $icon, 61);
	add_submenu_page('uds_theme_menu', UDS_TEMPLATE_NAME, 'Slideshow', 'manage_options', 'uds_theme_admin_billboard', 'uds_theme_admin_billboard');
	add_submenu_page('uds_theme_menu', UDS_TEMPLATE_NAME, 'Social Networks', 'manage_options', 'uds_theme_admin_social', 'uds_theme_admin_social');
	add_submenu_page('uds_theme_menu', UDS_TEMPLATE_NAME, 'Colores', 'manage_options', 'uds_theme_admin_colors', 'uds_theme_admin_colors');
	//add_submenu_page('uds_theme_menu', UDS_TEMPLATE_NAME, 'Table Creator', 'manage_options', 'uds_theme_admin_table', 'uds_theme_admin_table');
	//add_submenu_page('uds_theme_menu', UDS_TEMPLATE_NAME, 'Portfolio Options', 'manage_options', 'uds_theme_admin_portfolio', 'uds_theme_admin_portfolio');
	add_submenu_page('uds_theme_menu', UDS_TEMPLATE_NAME, 'Formulario de Contacto', 'manage_options', 'uds_theme_admin_contact', 'uds_theme_admin_contact');
}

// Admin menu entry handling
function uds_theme_admin()
{
	global $uds_themes, $uds_backgrounds, $wp_version;
	include 'admin-general.php';
}

function uds_theme_admin_table()
{
	global $uds_themes, $uds_backgrounds, $wp_version;
	include 'admin-table.php';
}

function uds_theme_admin_contact()
{
	global $uds_themes, $uds_backgrounds, $wp_version;
	include 'admin-contact.php';
}

function uds_theme_admin_portfolio()
{
	global $uds_themes, $uds_backgrounds, $wp_version;
	include 'admin-portfolio.php';
}

function uds_theme_admin_social()
{
	global $uds_themes, $uds_backgrounds, $wp_version;
	include 'admin-social.php';
}

function uds_theme_admin_colors()
{
	global $uds_themes, $uds_backgrounds, $wp_version;
	include 'admin-colors.php';
}

function uds_theme_admin_billboard()
{
	global $uds_themes, $uds_backgrounds, $wp_version;
	include 'admin-billboard.php';
}

add_action('wp_print_scripts', 'admin_enqueue_scripts');
function admin_enqueue_scripts()
{
	$jsdir = get_template_directory_uri()."/admin/";
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script("jquery-cookie", $jsdir."js/jquery_cookie.js");
	wp_enqueue_script("uds-colorpicker", $jsdir."colorpicker/jscolor.js");
	wp_enqueue_script("admin", $jsdir."js/admin.js");	
}

add_action('init', 'uds_admin_init');
function uds_admin_init()
{	
	add_thickbox();
	$dir = get_template_directory_uri()."/admin/";
	wp_enqueue_style('uds-admin', $dir.'css/admin.css', false, false, 'screen');
}
/*
	
	add_option('uds-google-key', '');
	add_option('uds-ga-tracking-code');
	add_option('uds-ga-tracking-domain');
*/

// Render options form
function uds_render_options_form($options){
	?>
	<form action="options.php" method="post" class="uds-general-form">
		<?php wp_nonce_field('update-options') ?>
		<input type="submit" value="Actualizar" class="submit button-primary" />
		<table id="uds-general-table">
			<?php $n = 0;?>
			<?php foreach($options as $key => $item): ?>
			<tr class="<?php echo $n%2 == 0 ? 'even' : 'odd' ?>">
				<td>
					<?php uds_render_field($options[$key], $key) ?>
				</td>
			</tr>
			<?php $n++; ?>
			<?php endforeach; ?>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php echo implode(',', uds_config_keys($options)) ?>" />
		<input type="submit" value="Actualizar" class="submit button-primary" />
	</form>
	<?php
}

// Output all keys in a config array
function uds_config_keys($options) {
	$keys = array_keys($options);
	foreach($options as $option) {
		if(!empty($option['optionals'])){
			$keys = array_merge($keys, array_keys($option['optionals']));
		}
		if(!empty($option['alternates'])){
			foreach($option['alternates'] as $alternate){
				$keys = array_merge($keys, array_keys($alternate));
			}
		}
	}
	return $keys;
}

// Render a single input field
function uds_render_field($options, $key){
	static $id = 0;

	switch($options['type']){
		case 'input':
		case 'text':
		case 'string':
			uds_render_text($key, $options, $id);
			break;
		case 'color':
			uds_render_colorpicker($key, $options, $id);
			break;
		case 'textarea':
			uds_render_textarea($key, $options, $id);
			break;
		case 'select':
			uds_render_select($key, $options, $id);
			break;
		case 'checkbox':
		case 'switch':
			uds_render_switch($key, $options, $id);
			break;
		case 'image':
			uds_render_image($key, $options, $id);
			break;
		case 'alternate':
			uds_render_alternate($key, $options, $id);
			break;
		case 'optional':
			uds_render_optional($key, $options, $id);
			break;
		default:
	}
	
	$id++;
}

// Render text field
function uds_render_text($key, $options, $unique_id, $value = '')
{
	global $uds_general_options;
	
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<input type="text" name="'. $key .'" value="' . htmlspecialchars(stripslashes(get_option($key, $options['default']))) . '" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .'" />';
	echo '</div>';
}

// Render color picker
function uds_render_colorpicker($key, $options, $unique_id, $value = '')
{
	global $uds_general_options;

	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '#<input type="text" name="'. $key .'" value="' . htmlspecialchars(stripslashes(get_option($key, $options['default']))) . '" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .' color" />';
	echo '</div>';
}


// Render textarea
function uds_render_textarea($key, $options, $unique_id, $value = '')
{
	global $uds_general_options;
	
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<textarea name="'. $key .'" class="general-'. $key .'">'. htmlspecialchars(stripslashes(get_option($key, $options['default']))) .'</textarea>';
	echo '</div>';
}

// Render Select field
function uds_render_select($key, $options, $unique_id, $value = '')
{
	global $uds_general_options;
	
	if($options['type'] != 'select') return;

	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<select name="'. $key .'" class="general-'. $key .'">';
	if(is_array($options['options'])){
		foreach($options['options'] as $option => $value){
			$selected = '';
			if(get_option($key) == $option){
				$selected = 'selected="selected"';
			}
			echo '<option value="'. $option .'" '. $selected .'>'. $value .'</option>';
		}
	}
	echo '</select>';
	echo '</div>';
}

// Render Alternate field
function uds_render_alternate($key, $options, $unique_id, $value = '')
{
	global $uds_general_options;
	
	if($options['type'] != 'alternate') return;

	echo '<div class="'. $key .'-wrapper alternate-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<select name="'. $key .'" class="general-'. $key .'">';
	if(is_array($options['options'])){
		foreach($options['options'] as $option => $value){
			$selected = '';
			if(get_option($key) == $option){
				$selected = 'selected="selected"';
			}
			echo '<option value="'. $option .'" '. $selected .'>'. $value .'</option>';
		}
	}
	echo '</select>';
	if(is_array($options['alternates'])){
		echo '<div class="alternates">';
		foreach($options['alternates'] as $key => $alternate){
			echo '<div class="'.$key.'-container">';
			foreach($alternate as $key => $alt_options){
				uds_render_field($alt_options, $key);
			}
			echo '</div>';
		}
		echo "</div>";
	}
	echo '</div>';
}

// Render Switch field
function uds_render_switch($key, $options, $unique_id, $value = '')
{
	global $uds_general_options;
	
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<input type="checkbox" name="'. $key .'" ' . (get_option($key) == 'on' ? 'checked="checked"' : '') . '" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .'" />';
	echo '</div>';
}

// Render Optional field
function uds_render_optional($key, $options, $unique_id, $value = '')
{
	global $uds_general_options;

	echo '<div class="'. $key .'-wrapper optional-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<input type="checkbox" name="'. $key .'" ' . (get_option($key) == 'on' ? 'checked="checked"' : '') . '" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .'" />';
	
	if(is_array($options['optionals'])){
		echo '<div class="optionals">';
		foreach($options['optionals'] as $key => $optional){
			uds_render_field($optional, $key);
		}
		echo "</div>";
	}
	echo '</div>';
}

// Render Image input
function uds_render_image($key, $options, $unique_id, $value = '')
{
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<a class="thickbox" title="Add an Image" href="media-upload.php?type=image&TB_iframe=true&width=640&height=345">';
	$image = get_option($key);
	if(!empty($image)){
		echo '<img alt="Add an Image" src="'. $image .'" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key  .'" />';
	} else {
		echo '<img alt="Add an Image" src="'. $options['default'] .'" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .'" />';
	}
	echo '</a>';
	echo '<input type="hidden" name="'. $key .'" value="'. $image .'" id="general-'. $key .'-'. $unique_id .'-hidden" />';
	echo '</div>';
}

// render JS support for image input
function uds_render_js_support()
{
	global $uds_general_options;
	$selectors = array();
	foreach($uds_general_options as $attrib => $options){
		if($options['type'] == 'image'){
			$selectors[] = '.general-'.$attrib;
		}
		if(is_array($options['alternates'])){
			foreach($options['alternates'] as $alternates){
				foreach($alternates as $key => $alternate){
					if($alternate['type'] == 'image'){
						$selectors[] = '.general-'.$key;
					}
				}
			}
		}
		if(is_array($options['optionals'])){
			foreach($options['optionals'] as $key => $optional){
				if($optional['type'] == 'image'){
					$selectors[] = '.general-'.$key;
				}
			}
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
	jQuery('<?php echo implode(',', $selectors); ?>').click(function(){
		set_receiver(this);
	});
	</script>
	<?php
}	

?>
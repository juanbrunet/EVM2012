<?php

$portfolio_options = array(
	'uds-portfolio-slug'
);

function is_portfolio() {
	return 
		is_page_template('portfolio-gallery.php') || 
		is_page_template('portfolio-1.php') || 
		is_page_template('portfolio-2.php') || 
		is_page_template('portfolio-3.php');
}

add_action('init', 'portfolio_init');
function portfolio_init() {
	// register Portfolio
	$args = array(
		'label' => __('Proyectos'),
		'singular_label' => __('Item Proyectos'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt')
	);

	register_post_type( 'uds-portfolio' , $args );
	
	register_taxonomy('portfolio_category', 'uds-portfolio', array('label'=>__('Tags'), 'hierarchical' => false));
}

add_action("wp_print_scripts", "uds_portfolio_scripts");
function uds_portfolio_scripts(){
	if(is_portfolio()){
		$theme = get_template_directory_uri();
		wp_register_script("mousewheel", $theme."/fancybox/jquery.mousewheel-3.0.2.pack.js", array('jquery'));
		wp_register_script("fancybox", $theme."/fancybox/jquery.fancybox-1.3.1.pack.js", array('jquery', 'easing', 'mousewheel'));
		wp_register_script("quicksand", $theme."/portfolio/js/jquery.quicksand.min.js", array('jquery', 'easing'));
		wp_enqueue_script("portfolio", $theme."/portfolio/js/portfolio.js", array('jquery', 'easing', 'fancybox', 'quicksand'));
	}
}

add_action("wp_print_styles", "uds_portfolio_styles");
function uds_portfolio_styles(){
	if(is_portfolio()){ 
		 $theme = get_template_directory_uri();
		wp_enqueue_style('portfolio', $theme.'/portfolio/css/portfolio.css', false, false, 'screen');
		wp_enqueue_style('portfolio-css3', $theme.'/portfolio/css/css3.css', false, false, 'screen');
		wp_enqueue_style('fancybox', $theme.'/fancybox/jquery.fancybox-1.3.1.css', false, false, 'screen');
	}
}

// Portfolio page metaboxes
$page_meta_box = array(
	'id' => 'portfolio-page-meta-box',
	'title' => 'Portfolio Options (Applies only to pages used for Portfolio)',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Show only posts with this tag: ',
			'desc' => 'Will not display tag selection',
			'id' => 'uds-portfolio-show-tags',
			'type' => 'text'
		)
	)
);

add_action('admin_menu', 'uds_portfolio_page_box');

// Add meta box
function uds_portfolio_page_box() {
	global $page_meta_box;
	add_meta_box($page_meta_box['id'], $page_meta_box['title'], 'uds_meta_box_show', $page_meta_box['page'], $page_meta_box['context'], $page_meta_box['priority'], 'page');
}

// portfolio meta boxes
$meta_box = array(
	'id' => 'portfolio-meta-box',
	'title' => 'Options',
	'page' => 'uds-portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Content Type',
			'id' => 'uds-portfolio-content-type',
			'type' => 'radio',
			'options' => array(
				array('name' => 'Image or other', 'value' => 'image'),
				array('name' => 'Video', 'value' => 'video')
			)
		),
		array(
			'name' => 'Do not open in lightbox',
			'id' => 'uds-portfolio-no-lightbox',
			'type' => 'checkbox'
		)
	)
);

add_action('admin_menu', 'uds_portfolio_box');

// Add meta box
function uds_portfolio_box() {
	global $meta_box;

	add_meta_box($meta_box['id'], $meta_box['title'], 'uds_meta_box_show', $meta_box['page'], $meta_box['context'], $meta_box['priority'], 'portfolio');
}

// Callback function to show fields in meta box
function uds_meta_box_show($a, $show) {
	global $meta_box, $post, $page_meta_box;
	
	if($show['args'] == 'page'){
		$box = $page_meta_box;
	} else {
		$box = $meta_box;
	}
	
	$image_selectors = array();
	// Use nonce for verification
	echo '<input type="hidden" name="uds_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:200px" />', '
', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '
', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<p><input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' /> '.$option['name'].'</p>';
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo	 '<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'uds_save_data');

// Save data from meta box
function uds_save_data($post_id) {
	global $meta_box, $page_meta_box;
	
	$box = array_merge($meta_box['fields'], $page_meta_box['fields']);
	
	// verify nonce
	if (!wp_verify_nonce($_POST['uds_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($box as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

// register portfolio query vars
add_filter('query_vars', 'parameter_queryvars' );
function parameter_queryvars( $qvars )
{
	$qvars[] = 'portfolio_category';
	return $qvars;
}

?>

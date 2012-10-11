<?php
// inital defines
define("UDS_TEMPLATE_NAME", "EVM CONSULTING 2012");

// include common headers
include 'admin/admin-common.php';
include 'billboard/billboard-common.php';
include 'portfolio/portfolio-common.php';
include 'ads/ads-common.php';
function d($d)
{
	echo "<pre>";
	var_dump($d);
	echo "</pre>";
}
// define additions to WP
function get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];
	if(empty($first_img)){ //Defines a default image
		$first_img = get_template_directory_uri()."/images/portfolio-default.jpg";
	}
	return $first_img;
}
function uds_the_post_thumbnail($id, $width, $height, $zc = 0, $q = 80) {
	$dir = get_template_directory_uri();
	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
	$thumb = urlencode($thumb[0]);
	echo "<img src=\"$dir/images/timthumb.php?src=$thumb&amp;w=$width&amp;h=$height&amp;zc=$zc&amp;q=$q\" class=\"attachment-post-thumbnail\" alt=\"\" />";
}
function is_ajax()
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function the_breadcrumbs()
{
	global $post;
	
	if(is_front_page()) return;
	
	$sep = htmlspecialchars(get_option('uds-breadcrumb-separator', '/'));
	
	echo "<div class='breadcrumbs'>";
	
	if(is_page()){
		$ancestors = get_post_ancestors($post->ID);
		echo "<a href='".get_bloginfo('url')."'>Home</a>";
		if(!empty($ancestors)){
			$ancestors = array_reverse($ancestors);
			foreach($ancestors as $ancestor){
				if(get_permalink($ancestor) == get_bloginfo('url')) continue;
				echo " $sep <a href='".get_permalink($ancestor)."'>".get_the_title($ancestor).'</a>';
			}
		}
		if( ! is_front_page()) echo " $sep <a href='".get_permalink()."'>".get_the_title().'</a>';
	} elseif(get_post_type() == 'portfolio') {
		echo "<a href='".get_bloginfo('url')."'>Home</a> $sep ";
		echo "Portfolio";
		echo " $sep <a href='".get_permalink()."'>".get_the_title().'</a>';
	} elseif(is_home()) {
		echo "<a href='".get_bloginfo('url')."'>Home</a> $sep ";
		echo "<a href='".get_permalink(get_option('page_for_posts'))."'>Blog</a>";
	} elseif(is_search()) {
		echo "<a href='".get_bloginfo('url')."'>Home</a> $sep ";
		echo "<a href='#'>Search</a>";
	} elseif(is_404()) {
		echo "<a href='".get_bloginfo('url')."'>Home</a> $sep ";
		echo "<a href='#'>404 Not Found</a>";
	} else {
		echo "<a href='".get_bloginfo('url')."'>Home</a> $sep ";
		echo "<a href='".get_permalink(get_option('page_for_posts'))."'>Blog</a>";
		//the_category(', ');
		echo " $sep <a href='".get_permalink()."'>".get_the_title().'</a>';
	}
	
	echo "</div>";
}

// enable sidebar
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Home',
		'id' => 'home',
		'description' => 'Displayed on the home page provided that you are displaying posts',
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	register_sidebar(array(
		'name' => 'Common',
		'id' => 'common',
		'description' => 'Displayed alongside the blog AND the pages',
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	register_sidebar(array(
		'name' => 'Blog',
		'id' => 'blog',
		'description' => 'Displayed alongside the blog',
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	register_sidebar(array(
		'name' => 'Page',
		'id' => 'page',
		'description' => 'Displayed alongside the pages',
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	$config = get_option('uds-footer-config', 3);
	for($i = 1; $i <= $config; $i++){
		register_sidebar(array(
			'name' => 'Footer '.$i,
			'id' => 'footer'.$i,
			'description' => 'Footer Column No. '.$i,
		    'before_widget' => ' <div class="footer-column '.($i == $config ? 'last' : '').' %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h3>',
		    'after_title' => '</h3>'
		));
	}
}

// set support for post thumbnails and menus
if (function_exists( 'add_theme_support' )){
	add_theme_support( 'nav-menus' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 610, 9999, false );
}

// init options and admin
add_action('init', 'uds_init');
function uds_init()
{
	global $uds_general_options;
	foreach($uds_general_options as $name => $option){
		add_option($name, $option['default']);
	}
    register_nav_menu( 'main-menu', __( 'Main Menu' ) );
    
    remove_filter('the_content', 'wpautop');
    remove_filter('the_content', 'do_shortcode');
    add_filter('the_content', 'uds_content_filter');
}

function uds_content_filter($content) {
	$content = do_shortcode($content);
	//echo htmlspecialchars(wpautop($content));
	return wpautop($content);
}

// init stlyes
add_action("wp_print_styles", "uds_styles");
function uds_styles()
{
	global $uds_themes, $uds_backgrounds;
	$turbine = get_template_directory_uri()."/turbine/css.php";
	$cssdir = get_template_directory_uri()."/css/";
	$fancybox = get_template_directory_uri()."/fancybox/";
	
	if(!is_admin()){
		wp_enqueue_style('style', $cssdir.'style.css', false, false, 'screen');
		wp_enqueue_style('style-css3', $cssdir.'css3.css', false, false, 'screen');
		// load custom CSS
		wp_enqueue_style('custom', $cssdir.'custom.css', false, false, 'screen');
	}
}

// init scripts
add_action("wp_print_scripts", "uds_scripts");
function uds_scripts()
{
	$jsdir = get_template_directory_uri()."/js/";
	if(!is_admin()) {
		wp_deregister_script('jquery');
    	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
    	wp_register_script('easing',  $jsdir."jquery.easing.js", array('jquery'));
    	wp_register_script('cycle',  $jsdir."jquery.cycle.js", array('jquery'));
		
		$key = get_option("uds-google-key");
		if(!empty($key)){		
			wp_enqueue_script("google.ajax", "http://www.google.com/jsapi?key=".$key, false, false);
		}

		wp_enqueue_script("scripts", $jsdir."scripts.min.js", array('jquery', 'cycle'));
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	}
}



// custom comments template load
function uds_comment($comment, $args, $depth) 
{
	$GLOBALS['comment'] = $comment;
	include "comment.php";
}

// delay feed publication
function publish_later_on_feed($where) {
	global $wpdb;

	if ( is_feed() ) {
		// timestamp in WP-format
		$now = gmdate('d/m/Y');

		// value for wait; + device
		$wait = '30'; // integer

		// http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_timestampdiff
		$device = 'MINUTE'; //MINUTE, HOUR, DAY, WEEK, MONTH, YEAR

		// add SQL-sytax to default $where
		$where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
	}
	return $where;
}

add_filter('posts_where', 'publish_later_on_feed');

// page tagline

add_action( 'do_meta_boxes', 'uds_add_page_tagline_meta_box', 10, 2 );
function uds_add_page_tagline_meta_box( $page, $context ) {
	if ( ( 'page' === $page || 'post' === $page || 'uds-portfolio' == $page ) && 'advanced' === $context )
		add_meta_box( 'uds-page-tagline', 'Page Tagline', 'uds_page_tagline_meta_box', $page, 'normal', 'low' );
}
function uds_page_tagline_meta_box() {
	global $post;
	echo '<p>';
	wp_nonce_field( 'uds_tagline_nonce', 'uds_tagline_nonce', false, true );
	echo '</p>';
	$tagline = get_post_meta( $post->ID, 'uds-page-tagline', true);
	$type = get_post_meta( $post->ID, 'uds-page-tagline-type', true);
	if($type == '') $type = 'default';
?>
	<p>
		Tagline Type: 
		<select name="uds-page-tagline-type">
			<option value="off" <?php echo $type == 'off' ? "selected='selected'" : '' ?>>No tagline</option>
			<option value="default" <?php echo $type == 'default' ? "selected='selected'" : '' ?>>Default tagline</option>
			<option value="custom" <?php echo $type == 'custom' ? "selected='selected'" : '' ?>>Custom tagline</option>
		</select>
	</p>
	<p>Custom Tagline: <input name="uds-page-tagline" type="text" style="width:200px" id="uds-page-tagline" value="<?php echo attribute_escape( $tagline ); ?>" /></p>
<?php
}
add_action( 'save_post', 'uds_page_tagline_save_meta_box');
function uds_page_tagline_save_meta_box( $post_ID ) {
	if ( wp_verify_nonce( $_REQUEST['uds_tagline_nonce'], 'uds_tagline_nonce' ) ) {
		if ( isset( $_POST['uds-page-tagline-type'] ) ) {
			update_post_meta( $post_ID, 'uds-page-tagline-type', $_REQUEST['uds-page-tagline-type'] );
			update_post_meta( $post_ID, 'uds-page-tagline', $_REQUEST['uds-page-tagline'] );
		} else {
			delete_post_meta( $post_ID, 'uds-page-tagline-type' );
			delete_post_meta( $post_ID, 'uds-page-tagline');
		}
	}
	return $post_ID;
}
// admin
if(is_admin()){
	include 'admin/admin.php';
}
include 'shortcodes.php';
include 'widgets/widgets.php';
?>
<?php

class uds_tinymce_extensions {
	
	var $plugin_name = "udsExtensions";
	
	function uds_tinymce_extensions()  {
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );
		
		// init process for button control
		add_action('init', array (&$this, 'add_button') );
	}

	function add_button() {
	
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		 
			// add the button for wp2.5 in a new way
			add_filter("mce_external_plugins", array (&$this, "add_tinymce_plugin" ), 5);
			add_filter('mce_buttons_3', array (&$this, 'register_button' ), 5);
		}
	}
	
	// used to insert button in wordpress 2.5x editor
	function register_button($buttons) {
	
		array_push(
			$buttons,
			'udsThirds',
			'udsTwoThirds',
			'udsHalves',
			'udsFourths',
			'udsThreeFourths',
			'|',
			'udsBox',
			'udsBoxInfo',
			'udsBoxSuccess',
			'udsBoxWarn',
			'udsBoxError',
			'udsListStyle',
			'udsListStyleCheck',
			'udsButton',
			'udsButtonDownload',
			'udsPullLeft',
			'udsPullRight',
			'udsDivider',
			'udsContact',
			'udsPortfolio',
			'udsSlider'
		);
	
		return $buttons;
	}
	
	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_tinymce_plugin($plugin_array) {    
	
		$plugin_array[$this->plugin_name] =  get_template_directory_uri().'/tinymce/editor_plugin.js';

		return $plugin_array;
	}
	
	function change_tinymce_version($version) {
		return ++$version;
	}
	
}

// Call it now
$uds_extensions = new uds_tinymce_extensions();

?>
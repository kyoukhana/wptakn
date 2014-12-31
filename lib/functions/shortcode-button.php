<?php

$jshortcode = array (
	'headinghr', 'grid', 'icon', 'highlight', 'dropcaps', 'linebreak', 'quote', '|',
	'listchevron', 'listcheck', 'listcert','liststar', '|' , 
	'listlowerroman', 'listupperroman', 'listlowerlatin', 'listupperlatin', '|',
	'button', 'alert', '|', 'accordion', 'tab' , '|', 
	'youtube', 'vimeo', 'html5video', 'html5audio', '|', 'testimonial', 'newimage', 'portfolio'
);

add_action('current_screen'	, 'jeg_shortcode_button');

function jeg_shortcode_button () {
	$screen = get_current_screen();
	if($screen->post_type != JEG_PORTFOLIO_POST_TYPE && $screen->post_type != JEG_FRONT_POST_TYPE && $screen->post_type != '') {
		if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') &&  get_user_option('rich_editing') == 'true')
		{
			 add_filter('mce_external_plugins'	, 'jeg_add_tinymce_plugin');  
			 add_filter('mce_buttons_3'			, 'jeg_register_button');  
		}
	}
}

function jeg_register_button ($buttons) {
	global $jshortcode, $post;	
	array_push($buttons, implode(',',$jshortcode));	
	return $buttons;
}

function jeg_add_tinymce_plugin ($plugin_array) {
	global $jshortcode;
	foreach ($jshortcode as $plugin) {
		if($plugin != '|') {
			$plugin_array[$plugin] = JEG_LIB_TINYMCE_PATH . $plugin . '.js';
		}
	}
	return $plugin_array;	
}


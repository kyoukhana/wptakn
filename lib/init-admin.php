<?php
/**
 * @author Jegbagus
 */

/** get shortcode data **/ 
require_once JEG_LIB_FUNCTION_PATH . 'metabox.php';

// load css & js
add_action('admin_enqueue_scripts', 'jeg_load_script');
add_action('admin_head', 'jeg_admin_head');
add_action('admin_menu','jeg_admin_menu');
add_filter('upload_mimes', 'addUploadMimes');


function jeg_load_script() {
	wp_enqueue_style ('jeg-ui-theme'	, 	JEG_ADMIN_CSS_URL . 'jquery-ui-1.8.21.custom.css');
	wp_enqueue_style ('jeg-css-admin'	, 	JEG_ADMIN_CSS_URL . 'admin.css' , null , '20121002');
	wp_enqueue_style('thickbox');
	add_editor_style('css/admin/editor-style.css');
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jeg-colorpicker'		, 	JEG_ADMIN_JS_URL . 	'colorpicker.js'		, null , '20121002');
	wp_enqueue_script('jeg-js-admin'		, 	JEG_ADMIN_JS_URL . 	'admin.js'				, null , '20121002');
	wp_enqueue_script('jeg-jquery-cookie'	, 	JEG_ADMIN_JS_URL . 	'jquery.cookie.js'		, null , '20121002');
	wp_enqueue_script('jeg-json'			, 	JEG_ADMIN_JS_URL . 	'json2.js'				, null , '20121002');
	wp_enqueue_script('jeg-ibutton'			, 	JEG_ADMIN_JS_URL .  'jquery.ibutton.min.js'	, null , '20121002');
	wp_enqueue_script('webfont'				, 'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('media-upload');	
	wp_enqueue_script('editor');	
}

function jeg_admin_head() {
	echo "<script type='text/javascript'>\n\t var admincookiename = '" . JEG_ADMIN_COOKIE . "';\n</script>\n";
}

function jeg_admin_menu() {
	add_menu_page( JEG_THEMENAME, JEG_THEMENAME, 'administrator', JEG_OPTION_PAGE, 'jeg_theme_admin', JEG_ADMIN_CSS_URL . 'images/jlioadmin.png');
	add_submenu_page( JEG_OPTION_PAGE , JEG_THEMENAME . " Settings", JEG_THEMENAME . " Settings" , 'administrator', JEG_OPTION_PAGE, 'jeg_theme_admin');
	/* add_submenu_page( JEG_OPTION_PAGE , JEG_THEMENAME . "Tracker", "Hit Tracker", 'administrator', JEG_TRACKER_PAGE, 'jeg_theme_tracker'); */	
}

function jeg_theme_tracker() {
}



function addUploadMimes($mimes) {
	$mimes = array_merge($mimes, array(        
		'ico' 	=> 'image/vnd.microsoft.icon',
		'ttf'	=> 'application/octet-stream',
		'otf'	=> 'application/octet-stream',
		'woff'	=> 'application/x-font-woff',
		'svg'	=> 'image/svg+xml',
		'eot'	=> 'application/vnd.ms-fontobject'
	));
	
	return $mimes;
}


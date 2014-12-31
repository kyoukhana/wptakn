<?php

/** 
 * @author jegbagus
 */

define("JEG_THEMENAME", 'JPhotolio');
define("JEG_SHORTNAME", 'jlio');
define("JEG_THEME", 'jegtheme');

// global variable, cuman dipake buat front end
$jdata 			= new stdClass();
$jshortcode  	= array();

/** get theme version **/
$themeData			= wp_get_theme();
$themeVersion 		= trim($themeData['Version']);
if (!$themeVersion)   $themeVersion = "1.0.0";
define("JEG_VERSION"	, $themeVersion);

/** define path & url **/
define('JEG_LIB_PATH'			, get_template_directory() . '/lib/');
define('JEG_ADMIN_TEMPLATE_PATH', get_template_directory() . '/lib/template/');
define('JEG_LIB_FUNCTION_PATH'	, get_template_directory() . '/lib/functions/');
define('JEG_INCLUDE'			, get_template_directory() . '/includes/');
define('JEG_FUNCTION'			, get_template_directory() . '/functions/');
define('JEG_UTIL'				, get_template_directory() . '/util/');
define('JEG_LIB_URL'			, get_template_directory_uri().'/lib/');
define('JEG_LIB_TINYMCE_PATH'	, JEG_LIB_URL . 'tinymce-button/');
define('JEG_UTIL_URL'			, get_template_directory_uri().'/util/');
define('JEG_JS_URL'				, get_template_directory_uri().'/js/');
define('JEG_CSS_URL'			, get_template_directory_uri().'/css/');
define('JEG_ADMIN_JS_URL'		, get_template_directory_uri().'/js/admin/');
define('JEG_ADMIN_CSS_URL'		, get_template_directory_uri().'/css/admin/');

// setting template path
define('JEG_SETTING_TEMPLATE', JEG_ADMIN_TEMPLATE_PATH 	. 'setting/');
define('JEG_SETTING_OPTION'	 , JEG_LIB_FUNCTION_PATH 	. 'setting/option/');

/** post type **/
define('JEG_PORTFOLIO_POST_TYPE', 'portfolio');
define('JEG_PORTFOLIO_CATEGORY'	, 'portfolio_category');
define('JEG_FRONT_POST_TYPE', 'frontslider');

/** option page **/
define('JEG_OPTION_PAGE'	, 'jeg_setting');
define('JEG_TRACKER_PAGE'	, 'jeg_tracker');

/** load common function **/
require_once JEG_FUNCTION . 'common-function.php';
require_once JEG_FUNCTION . 'default-setting.php';
require_once JEG_FUNCTION . 'init-register.php';
require_once JEG_FUNCTION . 'custom-image.php';
require_once JEG_FUNCTION . 'comments-function.php';
require_once JEG_FUNCTION . 'like-function.php';
/* require_once JEG_FUNCTION . 'tracker.php'; */
require_once JEG_FUNCTION . 'style.php';
require_once JEG_FUNCTION . 'additionalrequest.php';
require_once JEG_FUNCTION . 'widget.php';

require_once JEG_LIB_FUNCTION_PATH . 'jtemplate.php';
require_once JEG_LIB_FUNCTION_PATH . 'install-theme.php';
require_once JEG_LIB_FUNCTION_PATH . 'update-notification.php';

//the init functionality for the admin
if(is_admin()){
	require_once (JEG_LIB_PATH . 'init-admin.php');
	require_once (JEG_LIB_FUNCTION_PATH . 'jeg-setting.php');
} else {
	require_once (JEG_LIB_PATH . 'init-default.php');
}

require_once JEG_LIB_FUNCTION_PATH . 'ajax.php';
require_once JEG_LIB_FUNCTION_PATH . 'shortcode.php';
require_once JEG_LIB_FUNCTION_PATH . 'shortcode-button.php';
require_once JEG_LIB_FUNCTION_PATH . 'frontslider.php';
require_once JEG_LIB_FUNCTION_PATH . 'portfolio.php';

/*
$basetheme = new stdClass();
$basetheme->title = 'default';
$basetheme->schema = 'light';
j_update_option('thememanager', array($basetheme));
	
j_update_option('heading_font', 		array('name' => 'PT Sans Narrow','variant' => '700', 'face' => '', 'facefont' => array('','','','')));
j_update_option('heading_alt_font', 	array('name' => 'Overlock','variant' => 'italic', 'face' => '', 'facefont' => array('','','','')));
j_update_option('body_font', 			array('name' => 'PT Sans Narrow','variant' => 'regular', 'face' => '', 'facefont' => array('','','','')));
j_update_option('front_slider_font', 	array('name' => 'PT Sans Narrow','variant' => '700', 'face' => '', 'facefont' => array('','','','')));
*/ 
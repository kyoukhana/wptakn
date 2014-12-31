<?php

add_action('init', 'jeg_set_admin_cookie');

define('JEG_SETTING_NONCE_ACTION', 'setting_nonce');
define('JEG_ADMIN_COOKIE'	, 'wp-jeg-admin');

function jeg_set_admin_cookie() {
	jeg_admin_panel::getInstance()->set_admin_cookie();
}

function jeg_theme_admin() {
	jeg_admin_panel::getInstance()->display();
}

function j_create_setting_nonce() {
	return  wp_nonce_field(JEG_SETTING_NONCE_ACTION, 'admin_setting_nonce');
}

/*** admin panel class **/
class jeg_admin_panel {
	
	/** static variable to hold class instance **/
	private static $_instance;
	
	/** class variable **/
	private $jtemplate;
	private $data;
	private $navistate;
	private $setting;
	
	public function __construct()
	{
		$this->jtemplate = new JTemplate(JEG_SETTING_TEMPLATE);		
	}
	
	// singletop jeg admin panel instance
	public static function getInstance() 
	{
		if(!self::$_instance) {
			self::$_instance = new jeg_admin_panel();			
		}
		
		return self::$_instance;
	}
	
	private function build_option_list ($options) {
		$html = ""; $data = array();			
						
		foreach($options as $option) {
			if($option['type'] == 'heading'){
				$html .= $this->jtemplate->render('option-heading', $option);
			}
			if($option['type'] == 'text'){
				$html .= $this->jtemplate->render('option-text', $option);
			}
			if($option['type'] == 'tinymce'){
				$html .= $this->jtemplate->render('option-tinymce', $option);
			}
			if($option['type'] == 'textarea'){
				$html .= $this->jtemplate->render('option-textarea', $option);
			}
			if($option['type'] == 'upload'){
				$html .= $this->jtemplate->render('option-upload', $option);
			}
			if($option['type'] == 'switchtoogle') {
				$html .= $this->jtemplate->render('option-switchtoogle', $option);
			}
			if($option['type'] == 'iconsetting') {
				$html .= $this->jtemplate->render('option-iconsetting', $option);
			}
			if($option['type'] == 'select') {
				$html .= $this->jtemplate->render('option-select', $option);
			}
			if($option['type'] == 'sidebar') {
				$html .= $this->jtemplate->render('option-sidebar', $option);
			}
			if($option['type'] == 'frontslider') {
				$html .= $this->jtemplate->render('option-frontslider', $option);
			}			
			if($option['type'] == 'multicheckbox'){
				$html .= $this->jtemplate->render('option-multicheckbox', $option);
			}
			if($option['type'] == 'mapdata'){
				$html .= $this->jtemplate->render('option-mapdata', $option);
			}
			if($option['type'] == 'password'){
				$html .= $this->jtemplate->render('option-password', $option);
			}
			if($option['type'] == 'colorpicker'){
				$html .= $this->jtemplate->render('option-colorpicker', $option);
			}
			if($option['type'] == 'font'){
				$html .= $this->jtemplate->render('option-font', $option);
			}
			if($option['type'] == 'try_email') {
				$html .= $this->jtemplate->render('option-try-email', $option);
			}
			if($option['type'] == 'thememanager') {
				$html .= $this->jtemplate->render('option-thememanager', $option);
			}
			if($option['type'] == 'musicplaylist') {
				$html .= $this->jtemplate->render('option-musicplaylist', $option);
			}
		}
		
		return $html;
	}
		
	private function build_breadcrumb ($parent, $child) 
	{
		$html = $this->data['setting'][$parent]['title'];
		
		$key = array_keys($this->data['setting'][$parent]['item']);
		$html .= " &raquo; " . $key[$child];
		
		return array(
			'text'	=> $html,
			'icon'	=> $this->data['setting'][$parent]['class']
		);
	}
	
	/** level two **/
	private function build_jad_content($index, $content)
	{
		$html = ""; $data = array();
		
		// populate key nya, kita ga foreach jadi nanti dapetin key nya dari sini...
		$contentkey = array_keys($content);
		
		for($i = 0 ; $i < count($content); $i++) {
			$data['content_active'] = ($this->data['navistate']->state[$index] == $i) ? "content-active" : "";
			$data['option_list']	= $this->build_option_list($content[$contentkey[$i]]);
			$data['breadcrumb']		= $this->build_breadcrumb($index, $i);
			$html .=  $this->jtemplate->render('jad_content', $data);
		}

		return $html;
	}
	
	/** build first level **/
	private function build_body_content($index, $content) 
	{
		$this->data['body_active'] 	= ( $this->data['navistate']->active == $index ) ? "body-active" : "" ;
		$this->data['jtab']			= $this->jtemplate->render('jtab', array(
			'content'	=> $content,
			'state'		=> $this->data['navistate']->state[$index]
		));
		
		$this->data['jad_content']	= $this->build_jad_content($index, $content);
		return $this->jtemplate->render('bodycontent', $this->data);	
	}
	
	private function get_body_content() 
	{
		$html = '';
		for($i = 0; $i < count($this->data['setting']); $i++)
		{
			$html .= $this->build_body_content($i, $this->data['setting'][$i]['item']);			
		}
		return $html;
	}
	
	/** level zero **/
	private function get_navi ()
	{
		return $this->jtemplate->render('navi', $this->data);
	}
	
	public function save_data() {
		if(isset($_POST['submit']) && $_POST['submit'] == 'true'){
			
			if ( !wp_verify_nonce($_POST['admin_setting_nonce'], JEG_SETTING_NONCE_ACTION) ) {
				wp_die('Invalid Nonce');
			}
			
			$allsetting = $this->get_all_setting();
			
			// we need to disable magic quote, so we can read json entries from input 
			jeg_disable_magic_quote();
			
			foreach($allsetting as $setting) 
			{
				foreach($setting['item'] as $items) 
				{
					foreach($items as $item) 
					{
						if($item['type'] != 'heading' && $item['type'] != 'try_email') {					
							
							$value = isset($_POST[$item['id']]) ? $_POST[$item['id']] : NULL ; 
							
							if($item['type'] == 'iconsetting' 
							|| $item['type'] == 'sidebar' 
							|| $item['type'] == 'frontslider' 
							|| $item['type'] == 'mapdata' 
							|| $item['type'] == 'thememanager'
							|| $item['type'] == 'musicplaylist') {
								$value = json_decode($value);
							}
							
							if($item['id'] != 'posts_per_page') {
								if(empty($value)) {
									if($item['type'] == 'switchtoogle'){
										$value = 0;
										j_update_option($item['id'], $value);
									} else {
										j_delete_option($item['id']);
									}
								} else {
									j_update_option($item['id'], $value);
								}
							} else {
								update_option($item['id'], $value); // this will change default posts_per_page wordpress setting 
							}
						}
					}
				}
			}
			$this->setupfontmanager();
			$this->data['savemsg']	 = TRUE;
		}
	}
	
	public function fontempty ($fontid) 
	{
		$fontname 		= j_get_option(j_get_setup_font_name($fontid));
		$facename 		= j_get_option(j_get_setup_font_name($fontid . '_face'));
		
		if(empty($fontname) && empty($facename) ) {
			return true;
		}
		
	}
	
	public function setupfontmanager () 
	{
		$fontidarr = array("heading_font", "heading_alt_font", "body_font", "front_slider_font");
		
		foreach($fontidarr as $fontid) {
			if($this->fontempty($fontid)) {
				$this->set_default_font($fontid);
			} else {
				// nothing to do here
			}
		}
	}
	
	public function set_default_font($fontid) 
	{
		$variantname 	= j_get_setup_font_name($fontid . '_variant');
		$fontname 		= j_theme_name($fontid);
		
		if(j_get_schema() == "dark") {
			// @todo cari font yang sesuai
			if($fontid == 'heading_font') {
				j_update_option($fontname, array('name' => 'Abel','variant' => 'regular', 'face' => '', 'facefont' => array('','','','')));
			} else if($fontid == 'heading_alt_font') {
				j_update_option($fontname, array('name' => 'Overlock','variant' => 'italic', 'face' => '', 'facefont' => array('','','','')));
			} else if($fontid == 'body_font') {
				j_update_option($fontname, array('name' => 'Abel','variant' => 'regular', 'face' => '', 'facefont' => array('','','','')));
			} else if($fontid == 'front_slider_font') {
				j_update_option($fontname, array('name' => 'Abel','variant' => 'regular', 'face' => '', 'facefont' => array('','','','')));
			}
			
		} else {
			
			if($fontid == 'heading_font') {
				j_update_option($fontname, array('name' => 'PT Sans Narrow','variant' => '700', 'face' => '', 'facefont' => array('','','','')));
			} else if($fontid == 'heading_alt_font') {
				j_update_option($fontname, array('name' => 'Overlock','variant' => 'italic', 'face' => '', 'facefont' => array('','','','')));
			} else if($fontid == 'body_font') {
				j_update_option($fontname, array('name' => 'PT Sans Narrow','variant' => 'regular', 'face' => '', 'facefont' => array('','','','')));
			} else if($fontid == 'front_slider_font') {
				j_update_option($fontname, array('name' => 'PT Sans Narrow','variant' => '700', 'face' => '', 'facefont' => array('','','','')));	
			}			
		}
	}
	
	/**
	 * baru ambil data admin tab & setting waktu mau display
	 * biar ga bnyk resource yang kebuang kalau bukan di page setting	 
	 */
	public function display() 
	{
		$this->save_data();
		
		$this->data['themename']	= JEG_THEMENAME;
		$this->data['version']		= JEG_VERSION;		
		$this->data['navistate']	= $this->get_admin_tab();
		$this->data['setting']		= $this->get_all_setting();
		
		// fragment
		$this->data['navi']	 		= $this->get_navi();
		$this->data['bodycontent']	= $this->get_body_content();
		
		$this->jtemplate->render('skeleton', $this->data, true);
	}
	
	/** 
	 * need to disable magic qoute first
	 */
	private function get_admin_tab() 
	{
		if(!isset($_COOKIE[JEG_ADMIN_COOKIE])) 
		{		
			return $this->get_setting_count();
		} else {
			// we need to access cookie, so disable magic quote
			jeg_disable_magic_quote();
			return json_decode( $_COOKIE[JEG_ADMIN_COOKIE] );
		}
	}
	
	public function set_admin_cookie() 
	{
		if(!isset($_COOKIE[JEG_ADMIN_COOKIE])) 
		{
			$cookieTimeout = time() + 24 * 60 * 60 * 30;
			setcookie( JEG_ADMIN_COOKIE , json_encode( $this->get_setting_count() ) , $cookieTimeout, '/' );			
		}
	}
	
	private function get_setting_count() 
	{
		$active = count($this->get_all_setting());
				
		$state = array();
		for($i = 0; $i < $active; $i++) {
			$state[$i] = 0;
		}
		
		return array (
			'active'	=> 0,
			'state'		=> $state
		);
	}
		
	/** 
	 * setting guidance : 
	 * - switchtoogle type : harus selalu punya default value
	 * - text : 
	 * 		- nilai ga mungkin bakal null / empty jika default value nya terisi, 
	 * 		- nilai bisa terhapus jika default value nya tidak terisi. ini akan
	 * 		- option pada general setting harus sesuai dengan yang di interface. 
	 */
	
	public function get_all_setting() 
	{
		$options = array('general-setting', 'page-setting', 'style-option', 'translation', 'music-setting' , 'documentation');
		
		foreach($options as $option) {
			include_once JEG_SETTING_OPTION . $option . '.php';
		}		
		
		return array(
			array(
				'title'				=> 'General Setting',
				'class'				=> 'settingicon',
				'item'				=> jeg_admin_general_setting()
			),			
			array(
				'title'				=> 'Page Setting',
				'class'				=> 'pagesettingicon',
				'item'				=> jeg_admin_page_setting()			
			),			
			array(
				'title'				=> 'Contact - Email Detail',
				'class'				=> 'mappinicon',
				'item'				=> jeg_admin_contact_setting()
			),			
			array(
				'title'				=> 'Music Playlist',
				'class'				=> 'musicadminicon',
				'item'				=> jeg_admin_music_playlist()
			),			
			array(
				'title'				=> 'Style Manager',
				'class'				=> 'gridicon',
				'item'				=> jeg_themes_manager()
			),			
			array(
				'title'				=> 'Style / Color Option',
				'class'				=> 'styleicon',
				'item'				=> jeg_admin_style_option()
			),			
			array(
				'title'				=> 'Translation',
				'class'				=> 'translationicon',
				'item'				=> jeg_admin_translation()
			),
			array(
				'title'				=> 'Ads Setting',
				'class'				=> 'settingicon',
				'item'				=> jeg_admin_ads_setting()
			),	
			/*
			array(
				'title'				=> 'Documentation',
				'class'				=> 'docicon',
				'item'				=> jeg_admin_documentation()
			)*/
		);
	}
	
}

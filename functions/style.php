<?php

function jeg_build_font_style($font) 
{
	if(!empty($font['name'])) 
	{
		$v = " font-family : \"{$font['name']}\"; ";
		if($font['variant'] == 'regular' || $font['variant'] == '100' || $font['variant'] == '200' || $font['variant'] == '300' || $font['variant'] == '500' || $font['variant'] == '600' ) {
			$v .= "font-style : normal; font-weight : normal;";
		} else if($font['variant'] == '700' || $font['variant'] == '800' || $font['variant'] == '900' ) {
			$v .= "font-style : normal; font-weight : bold;";
		} else if($font['variant'] == 'italic' || $font['variant'] == '100italic' || $font['variant'] == '200italic' || $font['variant'] == '300italic' || $font['variant'] == '500italic' || $font['variant'] == '600italic' ) {
			$v .= "font-style : italic; font-weight : normal;";
		} else if($font['variant'] == '700italic' || $font['variant'] == '800italic' || $font['variant'] == '900italic' ) {
			$v .= "font-style : italic; font-weight : bold;";	
		}
	} else if(!empty( $font['face'])) {
		$v = " font-family : \"{$font['face']}\"; ";
	} else {
		return false;
	}
	return $v;
}

function jeg_style_template($schema) 
{
	$jtemplate = new JTemplate(JEG_ADMIN_TEMPLATE_PATH, '.css');
	$data = array();
	
	if($schema == 'light') {
		
		/**** Style RIGHT HERE :)) **/
		/** head **/
		$data['web_head_line_color'] 				= j_get_themes_manager('web_head_line_color', '4B4B4B');
		$data['menu_background'] 					= j_get_themes_manager('menu_background', '181818');		
		$data['menu_text_color'] 					= j_get_themes_manager('menu_text_color', '575757');
		$data['menu_hover_text_color'] 				= j_get_themes_manager('menu_hover_text_color', 'FFFFFF');
		
		/** submenu normal state **/
		$data['submenu_background'] 				= j_get_themes_manager('submenu_background', '181818');
		$data['submenu_text_color'] 				= j_get_themes_manager('submenu_text_color', 'FFFFFF');
		$data['submenu_arrow_light'] 				= j_get_themes_manager('submenu_arrow_light', 0);
	
		/** submenu hovered **/
		$data['submenu_hover_background'] 			= j_get_themes_manager('submenu_hover_background', 'FFFFFF');
		$data['submenu_hover_text_color'] 			= j_get_themes_manager('submenu_hover_text_color', '000000');
		$data['submenu_arrow_dark'] 				= j_get_themes_manager('submenu_arrow_dark', 0);
		
		$data['submenu_border_color'] 				= j_get_themes_manager('submenu_border_color', 'BBBBBB');
		$data['header_background']					= j_get_themes_manager('header_background');
		$data['nav_background']						= j_get_themes_manager('nav_background');
		$data['footer_background']					= j_get_themes_manager('footer_background');
		
		$data['footer_line1']						= j_get_themes_manager('footer_line1', 'EBEBEB');
		$data['footer_line2']						= j_get_themes_manager('footer_line2', 'FFFFFF');
		
		$data['footer_text_color']					= j_get_themes_manager('footer_text_color', '000000');
		$data['footer_dark_icon']					= j_get_themes_manager('footer_dark_icon', 0);
		
		/** web background **/
		$data['background_color']					= j_get_themes_manager('background_color', 'FAFAFA');
		$data['body_background']					= j_get_themes_manager('body_background');
		$data['body_bg_fullscreen']					= j_get_themes_manager('body_bg_fullscreen');
		
		
		/** loader **/
		$data['big_page_loader']					= j_get_themes_manager('big_page_loader');
		$data['big_page_loader_bg']					= j_get_themes_manager('big_page_loader_bg');
		$data['porto_item_loader']					= j_get_themes_manager('porto_item_loader');
		
		/** curtain **/
		$data['curtain_background_color']			= j_get_themes_manager('curtain_background_color', 'EFEEEF');
		$data['curtain_background']					= j_get_themes_manager('curtain_background');
		$data['curtain_head_image']					= j_get_themes_manager('curtain_head_image');
					
		/** Front Slider **/
		$data['home_pita_flag_outer']				= j_hex2RGB(j_get_themes_manager('home_pita_flag_outer', '7D7D7D'), true);
		$data['home_pita_flag_background']			= j_get_themes_manager('home_pita_flag_background', 'FFFFFF');
		$data['home_pita_flag_dark_icon']			= j_get_themes_manager('home_pita_flag_dark_icon', '0');
		
		$data['home_pita_title_bg_color']			= j_get_themes_manager('home_pita_title_bg_color', '181818');
		$data['home_pita_title_color']				= j_get_themes_manager('home_pita_title_color', 'FFFFFF');
		$data['home_pita_box_color']				= j_get_themes_manager('home_pita_box_color', 'FFFFFF');
		$data['home_pita_text_color']				= j_get_themes_manager('home_pita_text_color', '222222');
		$data['home_pita_dark_icon']				= j_get_themes_manager('home_pita_dark_icon');			
		
		/** Portfolio Filter **/
		$data['porto_filter_background']			= j_get_themes_manager('porto_filter_background', 'F8F8F8');
		$data['porto_filter_color']					= j_get_themes_manager('porto_filter_color', '222222');
		$data['porto_filter_background_hover']		= j_get_themes_manager('porto_filter_background_hover', '181818');
		$data['porto_filter_color_hover']			= j_get_themes_manager('porto_filter_color_hover', 'FFFFFF');
		$data['porto_filter_border']				= j_get_themes_manager('porto_filter_border', 'DDDDDD');
				
		/** portfolio item **/
		$data['porto_item_background']				= j_get_themes_manager('porto_item_background', 'FFFFFF');
		$data['porto_dark_icon']					= j_get_themes_manager('porto_dark_icon');
		$data['porto_item_description_title']		= j_get_themes_manager('porto_item_description_title', '464646');
		$data['porto_item_description_category']	= j_get_themes_manager('porto_item_description_category', '969595');
		$data['porto_item_description_color']		= j_get_themes_manager('porto_item_description_color', '969595');		
		
		/** portfolio navigation **/
		$data['porto_nav_background_color']			= j_get_themes_manager('porto_nav_background_color', 'FAFAFA');
		$data['porto_nav_hover_background_color']	= j_get_themes_manager('porto_nav_hover_background_color', '181818');
		$data['porto_nav_border_color']				= j_get_themes_manager('porto_nav_border_color', 'DEDEDE');
		$data['porto_nav_dark_nav']					= j_get_themes_manager('porto_nav_dark_nav');
		$data['porto_nav_dark_hover_nav']			= j_get_themes_manager('porto_nav_dark_hover_nav');
		
		/** blog inner container **/
		$data['blog_inner_background']				= j_get_themes_manager('blog_inner_background', 'FFFFFF');
		$data['blog_inner_border']					= j_hex2RGB(j_get_themes_manager('blog_inner_border', '7d7d7d'), true);
		$data['blog_icon_dark']						= j_get_themes_manager('blog_icon_dark');
		
		/** blog outer container **/
		$data['blog_outer_background']				= j_hex2RGB(j_get_themes_manager('blog_outer_background', '7d7d7d'), true);
		$data['blog_outer_border']					= j_hex2RGB(j_get_themes_manager('blog_outer_border', '7d7d7d'), true);
		
		/** blog header **/
		$data['blog_header_noimage_background']		= j_get_themes_manager('blog_header_noimage_background');
		$data['blog_header_noimage_color']			= j_get_themes_manager('blog_header_noimage_color', '7A7A7A');
		$data['blog_header_image_background']		= j_hex2RGB(j_get_themes_manager('blog_header_image_background', '000000'), true);
		$data['blog_header_image_color']			= j_get_themes_manager('blog_header_image_color', 'FFFFFF');
		$data['blog_header_border_color']			= j_hex2RGB(j_get_themes_manager('blog_header_border_color', 'C3C3C3'), true);
		
		/** blog meta **/
		$data['blog_meta_background']				= j_get_themes_manager('blog_meta_background', 'FFFFFF');
		$data['blog_meta_text_color']				= j_get_themes_manager('blog_meta_text_color', '222222');
		$data['blog_meta_hovered_text_color']		= j_get_themes_manager('blog_meta_hovered_text_color', 'DE3917');
		$data['blog_meta_border_color']				= j_get_themes_manager('blog_meta_border_color', 'DDDDDD');
		
		/** blog content **/
		$data['blog_inner_text_color']				= j_get_themes_manager('blog_inner_text_color', '484848');
		$data['blog_inner_link_color']				= j_get_themes_manager('blog_inner_link_color', 'DE3917');
		
		/** blog bottom bar **/
		$data['blog_bottom_background']				= j_get_themes_manager('blog_bottom_background', 'FCFCFC');
		$data['blog_bottom_border']					= j_get_themes_manager('blog_bottom_border', 'DDDDDD');
		
		/** blog comment **/
		$data['blog_comment_background']			= j_get_themes_manager('blog_comment_background', 'FCFCFC');
		$data['blog_comment_text_color']			= j_get_themes_manager('blog_comment_text_color', '484848');			
		
		/** Sidebar **/
		$data['blog_sidebar_hover_color']			= j_get_themes_manager('blog_sidebar_hover_color', 'F5F5F5');
		$data['blog_sidebar_link_color']			= j_get_themes_manager('blog_sidebar_link_color', '484848');
		$data['blog_sidebar_dark_icon']				= j_get_themes_manager('blog_sidebar_dark_icon', '0');
		
		/** tag **/
		$data['blog_tag_background']				= j_get_themes_manager('blog_tag_background', '999999');
		$data['blog_tag_color']						= j_get_themes_manager('blog_tag_color', 'FFFFFF');
		
		/** contact us flag **/
		$data['contact_flag_background']			= j_get_themes_manager('contact_flag_background', 'FFFFFF');
		$data['contact_flag_outer']					= j_hex2RGB(j_get_themes_manager('contact_flag_outer', '7D7D7D'), true);
		$data['contact_flag_dark_icon']				= j_get_themes_manager('contact_flag_dark_icon', '0');
		
		/** contact us head **/
		$data['contact_head_background']			= j_get_themes_manager('contact_head_background', '181818');
		$data['contact_head_text']					= j_get_themes_manager('contact_head_text', 'FFFFFF');
		$data['contact_head_arrow']					= j_get_themes_manager('contact_head_arrow', '0');
		
		/** contact us body **/
		$data['contact_body_color']					= j_get_themes_manager('contact_body_color', 'FFFFFF');
		$data['contact_body_text']					= j_get_themes_manager('contact_body_text', '222222');
		$data['contact_body_border']				= j_get_themes_manager('contact_body_border', 'C9C9C9');
		$data['contact_dark_icon']					= j_get_themes_manager('contact_dark_icon', '0');
		
		$data['contact_location_hover_background']	= j_get_themes_manager('contact_location_hover_background', '181818');
		$data['contact_location_hover_text']		= j_get_themes_manager('contact_location_hover_text', 'FFFFFF');
		$data['contact_location_icon_hover']		= j_get_themes_manager('contact_location_icon_light', '0');
	} else {
		/**** Style RIGHT HERE :)) **/
						
		/** web background **/
		$data['background_color']					= j_get_themes_manager('background_color', 'FFFFFF');
		$data['body_background']					= j_get_themes_manager('body_background');
		$data['body_bg_fullscreen']					= j_get_themes_manager('body_bg_fullscreen');
		
		/** head **/
		$data['web_head_line_color'] 				= j_get_themes_manager('web_head_line_color', '333333');
		$data['menu_background'] 					= j_get_themes_manager('menu_background', 'FFFFFF');		
		$data['menu_text_color'] 					= j_get_themes_manager('menu_text_color', 'FFFFFF');
		$data['menu_hover_text_color'] 				= j_get_themes_manager('menu_hover_text_color', '000000');
		
		/** submenu normal state **/
		$data['submenu_background'] 				= j_get_themes_manager('submenu_background', '000000');
		$data['submenu_text_color'] 				= j_get_themes_manager('submenu_text_color', 'FFFFFF');
		$data['submenu_arrow_light'] 				= j_get_themes_manager('submenu_arrow_light', 0);
		
		/** submenu hovered **/
		$data['submenu_hover_background'] 			= j_get_themes_manager('submenu_hover_background', 'FFFFFF');
		$data['submenu_hover_text_color'] 			= j_get_themes_manager('submenu_hover_text_color', '000000');
		$data['submenu_arrow_dark'] 				= j_get_themes_manager('submenu_arrow_dark', 0);
		
		$data['submenu_border_color'] 				= j_get_themes_manager('submenu_border_color', '363636');
		$data['header_background']					= j_get_themes_manager('header_background');
		$data['nav_background']						= j_get_themes_manager('nav_background');
		$data['footer_background']					= j_get_themes_manager('footer_background');
		
		$data['footer_line1']						= j_get_themes_manager('footer_line1', '000000');
		$data['footer_line2']						= j_get_themes_manager('footer_line2', '111111');
		
		$data['footer_text_color']					= j_get_themes_manager('footer_text_color', 'FFFFFF');
		$data['footer_dark_icon']					= j_get_themes_manager('footer_dark_icon', 0);
		
		
		/** loader **/
		$data['big_page_loader']					= j_get_themes_manager('big_page_loader');
		$data['big_page_loader_bg']					= j_get_themes_manager('big_page_loader_bg', '000000');
		$data['porto_item_loader']					= j_get_themes_manager('porto_item_loader');
		
		/** curtain **/
		$data['curtain_background_color']			= j_get_themes_manager('curtain_background_color', '000000');
		$data['curtain_background']					= j_get_themes_manager('curtain_background');
		$data['curtain_head_image']					= j_get_themes_manager('curtain_head_image');
		
		/** Front Slider **/
		$data['home_pita_flag_outer']				= j_hex2RGB(j_get_themes_manager('home_pita_flag_outer', '7D7D7D'), true);
		$data['home_pita_flag_background']			= j_get_themes_manager('home_pita_flag_background', '000000');
		$data['home_pita_flag_dark_icon']			= j_get_themes_manager('home_pita_flag_dark_icon', '0');
		
		$data['home_pita_title_bg_color']			= j_get_themes_manager('home_pita_title_bg_color', '000000');
		$data['home_pita_title_color']				= j_get_themes_manager('home_pita_title_color', 'FFFFFF');
		$data['home_pita_box_color']				= j_get_themes_manager('home_pita_box_color', 'FFFFFF');
		$data['home_pita_text_color']				= j_get_themes_manager('home_pita_text_color', '000000');
		$data['home_pita_dark_icon']				= j_get_themes_manager('home_pita_dark_icon');			
		
		/** Portfolio Filter **/
		$data['porto_filter_background']			= j_get_themes_manager('porto_filter_background', 'FFFFFF');
		$data['porto_filter_color']					= j_get_themes_manager('porto_filter_color', '222222');
		$data['porto_filter_background_hover']		= j_get_themes_manager('porto_filter_background_hover', '181818');
		$data['porto_filter_color_hover']			= j_get_themes_manager('porto_filter_color_hover', 'FFFFFF');
		$data['porto_filter_border']				= j_get_themes_manager('porto_filter_border', '888888');
		
		/** portfolio item **/
		$data['porto_item_background']				= j_get_themes_manager('porto_item_background', 'FFFFFF');
		$data['porto_dark_icon']					= j_get_themes_manager('porto_dark_icon');
		$data['porto_item_description_title']		= j_get_themes_manager('porto_item_description_title', '0A0A0A');
		$data['porto_item_description_category']	= j_get_themes_manager('porto_item_description_category', '969595');
		$data['porto_item_description_color']		= j_get_themes_manager('porto_item_description_color', '7A7A7A');		
		
		/** portfolio navigation **/
		$data['porto_nav_background_color']			= j_get_themes_manager('porto_nav_background_color', 'FAFAFA');
		$data['porto_nav_hover_background_color']	= j_get_themes_manager('porto_nav_hover_background_color', 'FFFFFF');
		$data['porto_nav_border_color']				= j_get_themes_manager('porto_nav_border_color', 'DEDEDE');
		$data['porto_nav_dark_nav']					= j_get_themes_manager('porto_nav_dark_nav');
		$data['porto_nav_dark_hover_nav']			= j_get_themes_manager('porto_nav_dark_hover_nav');
		
		/** blog inner container **/
		$data['blog_inner_background']				= j_get_themes_manager('blog_inner_background', 'FFFFFF');
		$data['blog_inner_border']					= j_hex2RGB(j_get_themes_manager('blog_inner_border', '000000'), true);
		$data['blog_icon_dark']						= j_get_themes_manager('blog_icon_dark');
		
		/** blog outer container **/
		$data['blog_outer_background']				= j_hex2RGB(j_get_themes_manager('blog_outer_background', '7d7d7d'), true);
		$data['blog_outer_border']					= j_hex2RGB(j_get_themes_manager('blog_outer_border', '7d7d7d'), true);
		
		/** blog header **/
		$data['blog_header_noimage_background']		= j_get_themes_manager('blog_header_noimage_background', '000000');
		$data['blog_header_noimage_color']			= j_get_themes_manager('blog_header_noimage_color', 'FFFFFF');
		$data['blog_header_image_background']		= j_hex2RGB(j_get_themes_manager('blog_header_image_background', '000000'), true);
		$data['blog_header_image_color']			= j_get_themes_manager('blog_header_image_color', 'FFFFFF');
		$data['blog_header_border_color']			= j_hex2RGB(j_get_themes_manager('blog_header_border_color', 'C3C3C3'), true);
		
		/** blog meta **/
		$data['blog_meta_background']				= j_get_themes_manager('blog_meta_background', 'FFFFFF');
		$data['blog_meta_text_color']				= j_get_themes_manager('blog_meta_text_color', '222222');
		$data['blog_meta_hovered_text_color']		= j_get_themes_manager('blog_meta_hovered_text_color', 'DE3917');
		$data['blog_meta_border_color']				= j_get_themes_manager('blog_meta_border_color', 'DDDDDD');
		
		/** blog content **/
		$data['blog_inner_text_color']				= j_get_themes_manager('blog_inner_text_color', '484848');
		$data['blog_inner_link_color']				= j_get_themes_manager('blog_inner_link_color', 'DE3917');
		
		/** blog bottom bar **/
		$data['blog_bottom_background']				= j_get_themes_manager('blog_bottom_background', 'FCFCFC');
		$data['blog_bottom_border']					= j_get_themes_manager('blog_bottom_border', 'DDDDDD');
		
		/** blog comment **/
		$data['blog_comment_background']			= j_get_themes_manager('blog_comment_background', 'FCFCFC');
		$data['blog_comment_text_color']			= j_get_themes_manager('blog_comment_text_color', '484848');			
		
		/** Sidebar **/
		$data['blog_sidebar_hover_color']			= j_get_themes_manager('blog_sidebar_hover_color', 'F5F5F5');
		$data['blog_sidebar_link_color']			= j_get_themes_manager('blog_sidebar_link_color', '484848');
		$data['blog_sidebar_dark_icon']				= j_get_themes_manager('blog_sidebar_dark_icon', '0');
		
		/** tag **/
		$data['blog_tag_background']				= j_get_themes_manager('blog_tag_background', '999999');
		$data['blog_tag_color']						= j_get_themes_manager('blog_tag_color', 'FFFFFF');
		
		/** contact us flag **/
		$data['contact_flag_background']			= j_get_themes_manager('contact_flag_background', 'FFFFFF');
		$data['contact_flag_outer']					= j_hex2RGB(j_get_themes_manager('contact_flag_outer', '7D7D7D'), true);
		$data['contact_flag_dark_icon']				= j_get_themes_manager('contact_flag_dark_icon', '0');
		
		/** contact us head **/
		$data['contact_head_background']			= j_get_themes_manager('contact_head_background', '000000');
		$data['contact_head_text']					= j_get_themes_manager('contact_head_text', 'FFFFFF');
		$data['contact_head_arrow']					= j_get_themes_manager('contact_head_arrow', '0');
		
		/** contact us body **/
		$data['contact_body_color']					= j_get_themes_manager('contact_body_color', 'FFFFFF');
		$data['contact_body_text']					= j_get_themes_manager('contact_body_text', '222222');
		$data['contact_body_border']				= j_get_themes_manager('contact_body_border', 'C9C9C9');
		$data['contact_dark_icon']					= j_get_themes_manager('contact_dark_icon', '0');
		
		$data['contact_location_hover_background']	= j_get_themes_manager('contact_location_hover_background', '000000');
		$data['contact_location_hover_text']		= j_get_themes_manager('contact_location_hover_text', 'FFFFFF');
		$data['contact_location_icon_hover']		= j_get_themes_manager('contact_location_icon_light', '0');
	}
	
	/*** common setting **/
	$data['schema']						= $schema;
	
	/** logo & nav **/
	$data['logo_top_margin']			= j_get_option('logo_top_margin', 0);
	$data['logo_margin_left']			= floor(j_get_option('logo_width') / 2);
	$data['nav_logo_gap']				= j_get_option('nav_logo_gap', 0);
	$data['logo_animation']				= j_get_option('logo_animation', 0);	
	
	/** Font **/
	$data['heading_font']						= jeg_build_font_style(j_get_themes_manager('heading_font'));
	$data['heading_alt_font']					= jeg_build_font_style(j_get_themes_manager('heading_alt_font'));
	$data['body_font']							= jeg_build_font_style(j_get_themes_manager('body_font'));
	$data['front_slider_font']					= jeg_build_font_style(j_get_themes_manager('front_slider_font'));
	
	$data['centered_menu']						= j_get_option('centered_menu', 1);
	$data['long_menu']							= j_get_option('long_menu', 1);		
	$data['long_menu_width']					= j_get_option('long_menu_width', 979);	
	
	
	$data['small_menu']							= j_get_option('small_menu', 0);	
	
	/** additional css **/
	$data['additional_css']						= j_get_themes_manager('additional_css');
	/**** Style Until RIGHT HERE :)) **/
	
			
	header("Content-type: text/css; charset: UTF-8"); 		
	$jtemplate->render('jeg-theme', $data, true);
	die();
}

function jeg_email_template() {
	$data = array(
		'header_logo' 	=> j_get_option('email_logo'),
		'head_color' 	=> j_get_option('email_head_color'),
		'body_color' 	=> j_get_option('email_body_color'),
		'body_text' 	=> j_get_option('email_body_text_color'),
		'footer_text'	=> j_get_option('email_footer_text'),
		'body_text'		=> j_get_option('email_body_text')
	);
	
	$jtemplate 	= new JTemplate(JEG_ADMIN_TEMPLATE_PATH);
	$jtemplate->render('email-template', $data, true);
	exit;
}
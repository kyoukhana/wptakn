<?php

function light_themes () {
	
	
	$general = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Web Background'
		),
		array (
			'id' 			=> j_theme_name('background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Website background color',
			'description'	=> 'Set website background color. this setting will apply to all website page.',
			'value'			=> j_get_themes_manager('background_color', 'FAFAFA')
		),
		array (
			'id' 			=> j_theme_name('body_background'),
			'type'			=> 'upload',
			'title'			=> 'Body Background',
			'description'	=> 'Set website body background. This background will be used for every page on the site',
			'value'			=> j_get_themes_manager('body_background')
		),
		array (
			'id' 			=> j_theme_name('body_bg_fullscreen'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable fullscreen background',
			'description'	=> 'If this option turned off, Body Background option will fill entire screen with repeated background. suit for pattern background. '.
								'<br> But if this option is turned on, image will scratched to fill background with only one image. suit for big image background.',
			'value'			=> j_get_themes_manager('body_bg_fullscreen' , 0)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Curtain Style Option'
		),
		array (
			'id' 			=> j_theme_name('curtain_background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Curtain background color',
			'description'	=> 'Set curtain background color.<br> You can ignore this option if you turn off curtain effect on General Setting.',
			'value'			=> j_get_themes_manager('curtain_background_color', 'EFEEEF')
		),
		array (
			'id' 			=> j_theme_name('curtain_background'),
			'type'			=> 'upload',
			'title'			=> 'Curtain Background',
			'description'	=> 'Set curtain background image, image will repeat to fill all curtain region.<br> You can ignore this option if you turn off curtain effect on General Setting.',
			'value'			=> j_get_themes_manager('curtain_background')
		),
		array (
			'id' 			=> j_theme_name('curtain_head_image'),
			'type'			=> 'upload',
			'title'			=> 'Curtain head image',
			'description'	=> 'When curtain slide up, this image will show before it reach the top of the page. you can change default image with 7 Pixel image height. Image will repeat on horizontally. <br> You can ignore this option if you turn off curtain effect on General Setting or use fade curtain effect.',
			'value'			=> j_get_themes_manager('curtain_head_image')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Header Navigation Menu'
		),	
		array (
			'id' 			=> j_theme_name('header_background'),
			'type'			=> 'upload',
			'title'			=> 'Header Background',
			'description'	=> 'change header background image with 160 pixel height (also used for responsive header background)',
			'value'			=> j_get_themes_manager('header_background')
		),
		array (
			'id' 			=> j_theme_name('nav_background'),
			'type'			=> 'upload',
			'title'			=> 'Header Separator of Navigation',
			'description'	=> 'change header separator of navigation image with your own image. height is 92 pixel.',
			'value'			=> j_get_themes_manager('nav_background')
		),
		array (
			'id' 			=> j_theme_name('web_head_line_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header line color',
			'description'	=> 'Change 5 pixel line above header logo & navigation',
			'value'			=> j_get_themes_manager('web_head_line_color', '4B4B4B')
		),
		array (
			'id' 			=> j_theme_name('menu_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header menu hovered background',
			'description'	=> 'Change header menu background color when menu hovered ',
			'value'			=> j_get_themes_manager('menu_background', '181818')
		),
		array (
			'id' 			=> j_theme_name('menu_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header menu text color',
			'description'	=> 'Change header header menu text color',
			'value'			=> j_get_themes_manager('menu_text_color', '575757')
		),
		array (
			'id' 			=> j_theme_name('menu_hover_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Menu hovered text color',
			'description'	=> 'Change menu text color when those menu hovered',
			'value'			=> j_get_themes_manager('menu_hover_text_color', 'FFFFFF')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Submenu normal state (not hovered)'
		),
		array (
			'id' 			=> j_theme_name('submenu_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header submenu background',
			'description'	=> 'submenu (menu child) header color when menu hovered',
			'value'			=> j_get_themes_manager('submenu_background', '181818')
		),
		array (
			'id' 			=> j_theme_name('submenu_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header submenu text color',
			'description'	=> 'submenu header text color',
			'value'			=> j_get_themes_manager('submenu_text_color', 'FFFFFF')
		),
		
		array (
			'id' 			=> j_theme_name('submenu_border_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Submenu border color',
			'description'	=> 'menu child border color',
			'value'			=> j_get_themes_manager('submenu_border_color', 'BBBBBB')
		),
		array (
			'id' 			=> j_theme_name('submenu_arrow_light'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Icon arrow on submenu to fit light background color when hovered',
			'description'	=> 'icon arrow on submenu to fit light background color when hovered',
			'value'			=> j_get_themes_manager('submenu_arrow_light', '0')
		),		
		array(
			'type'			=> 'heading',
			'title'			=> 'Submenu hovered'
		),
		array (
			'id' 			=> j_theme_name('submenu_hover_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Submenu background color when hovered',
			'description'	=> 'submenu (menu child) header background color when submenu hovered',
			'value'			=> j_get_themes_manager('submenu_hover_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('submenu_hover_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header submenu hovered text color',
			'description'	=> 'header submenu text color when submenu hovered',
			'value'			=> j_get_themes_manager('submenu_hover_text_color', '000000')
		),		
		array (
			'id' 			=> j_theme_name('submenu_arrow_dark'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Icon arrow on submenu to fit light background color when hovered',
			'description'	=> 'icon arrow on submenu to fit light background color when hovered',
			'value'			=> j_get_themes_manager('submenu_arrow_dark', '0')
		),		
		array(
			'type'			=> 'heading',
			'title'			=> 'Footer Background'
		),
		array (
			'id' 			=> j_theme_name('footer_background'),
			'type'			=> 'upload',
			'title'			=> 'Footer Background',
			'description'	=> 'change footer navigation image with your own image. height is 10 pixel',
			'value'			=> j_get_themes_manager('footer_background')
		),
		array (
			'id' 			=> j_theme_name('footer_line1'),
			'type'			=> 'colorpicker',
			'title'			=> 'Footer Separator Color Line 1',
			'description'	=> 'change footer separator color line',
			'value'			=> j_get_themes_manager('footer_line1', 'EBEBEB')
		),
		array (
			'id' 			=> j_theme_name('footer_line2'),
			'type'			=> 'colorpicker',
			'title'			=> 'Footer Background',
			'description'	=> 'change footer navigation image with your own image. height is 10 pixel',
			'value'			=> j_get_themes_manager('footer_line2', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('footer_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Footer text color',
			'description'	=> 'Footer hovered icon text color',
			'value'			=> j_get_themes_manager('footer_text_color', '000000')
		),
		array (
			'id' 			=> j_theme_name('footer_dark_icon'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Set icon to fit darker background on footer',
			'description'	=> 'set icon to fit darker background on footer, including social set & other navigation icon set',
			'value'			=> j_get_themes_manager('footer_dark_icon' , 0)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Loader GIF'
		),
		array (
			'id' 			=> j_theme_name('big_page_loader'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio, Front slider, Curtain loader image',
			'description'	=> 'Change portfolio, front slider, curtain loader image item loader with 40 x 40 pixel gif image to match your style',
			'value'			=> j_get_themes_manager('big_page_loader')
		),
		array (
			'id' 			=> j_theme_name('big_page_loader_bg'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio, Front slider, curtain loader background color',
			'description'	=> 'loader background color for portfolio page, front slider, and curtain.',
			'value'			=> j_get_themes_manager('big_page_loader_bg', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('porto_item_loader'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio item  & contact loader',
			'description'	=> 'Change portfolio item loader with 32 x 32 pixel gif image to match your style',
			'value'			=> j_get_themes_manager('porto_item_loader')
		),
		array (
			'id' 			=> j_theme_name('fullscreen_loader'),
			'type'			=> 'upload',
			'title'			=> 'Fullscreen loader image',
			'description'	=> 'loader gif image when fullscreen image show',
			'value'			=> j_get_themes_manager('fullscreen_loader')
		),
	);
	
	$font = array(
		array (
			'id' 			=> j_theme_name('heading_font'),
			'type'			=> 'font',
			'title'			=> 'Heading font',
			'description'	=> 'Heading font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('heading_font')
		),
		array (
			'id' 			=> j_theme_name('heading_alt_font'),
			'type'			=> 'font',
			'title'			=> 'Heading alt font',
			'description'	=> 'Heading alt font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('heading_alt_font')
		),
		array (
			'id' 			=> j_theme_name('body_font'),
			'type'			=> 'font',
			'title'			=> 'Body font',
			'description'	=> 'Body font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('body_font')
		),
		array (
			'id' 			=> j_theme_name('front_slider_font'),
			'type'			=> 'font',
			'title'			=> 'Front slider font',
			'description'	=> 'front slider font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('front_slider_font')
		),
	);
	
	$front_slider = array(		
		array (
			'id' 			=> j_theme_name('home_pita_flag_outer'),
			'type'			=> 'colorpicker',
			'title'			=> 'Home info flag outer color',
			'description'	=> 'Set home outer color for info flag & boxes, this option will faded into 0.3 of opacity',
			'value'			=> j_get_themes_manager('home_pita_flag_outer', '7D7D7D')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Front slider info flag'
		),
		array (
			'id' 			=> j_theme_name('home_pita_flag_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Home info flag background',
			'description'	=> 'Set home info flag background color',
			'value'			=> j_get_themes_manager('home_pita_flag_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('home_pita_flag_dark_icon'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Set home info flag icon to fit darker background',
			'description'	=> 'Set home info flag icon to fit darker background',
			'value'			=> j_get_themes_manager('home_pita_flag_dark_icon', '0')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Front slider info box header'
		),
		array (
			'id' 			=> j_theme_name('home_pita_title_bg_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Front slider info title & link background',
			'description'	=> 'front slider info title and link background color',
			'value'			=> j_get_themes_manager('home_pita_title_bg_color', '181818')
		),
		array (
			'id' 			=> j_theme_name('home_pita_title_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Front slider info title text color',
			'description'	=> 'Front slider info title text color',
			'value'			=> j_get_themes_manager('home_pita_title_color', 'FFFFFF')
		),		
		array (
			'id' 			=> j_theme_name('home_pita_dark_icon'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Turn close icon to fit darker background',
			'description'	=> 'Switch icon to fit darker darker background, this option wil change close icon on info box.',
			'value'			=> j_get_themes_manager('home_pita_dark_icon' , 0)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Front slider info box body'
		),
		array (
			'id' 			=> j_theme_name('home_pita_box_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Home info box color',
			'description'	=> 'Change home info box color. <br> Clear input to revert default value.',
			'value'			=> j_get_themes_manager('home_pita_box_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('home_pita_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Home info box text color',
			'description'	=> 'Change home info box text color. <br> Clear input to revert default value.',
			'value'			=> j_get_themes_manager('home_pita_text_color', '222222')
		),
	);
	
	$portfolio = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Portfolio Filter'
		),
		array (
			'id' 			=> j_theme_name('porto_filter_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter background',
			'description'	=> 'Change filter background on portfolio page',
			'value'			=> j_get_themes_manager('porto_filter_background', 'F8F8F8')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter text color',
			'description'	=> 'Change filter text color on portfolio page',
			'value'			=> j_get_themes_manager('porto_filter_color', '222222')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_background_hover'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter hovered background color',
			'description'	=> 'Change background color of portfolio filter when filter hovered',
			'value'			=> j_get_themes_manager('porto_filter_background_hover', '181818')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_color_hover'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter hovered text color',
			'description'	=> 'Change text color of portfolio filter when filter hovered',
			'value'			=> j_get_themes_manager('porto_filter_color_hover', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter border',
			'description'	=> 'Change default portfolio filter border',
			'value'			=> j_get_themes_manager('porto_filter_border', 'DDDDDD')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Portfolio Item'
		),
		array (
			'id' 			=> j_theme_name('porto_item_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item background color',
			'description'	=> 'Change default portfolio background color',
			'value'			=> j_get_themes_manager('porto_item_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('porto_dark_icon'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Turn portfolio to fit darker background',
			'description'	=> 'Switch icon to fit darker background on portfolio item & expanded item.',
			'value'			=> j_get_themes_manager('porto_dark_icon' , 0)
		),
		array (
			'id' 			=> j_theme_name('porto_item_description_title'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item description title text color',
			'description'	=> 'Change portfolio item description title color with your own color',
			'value'			=> j_get_themes_manager('porto_item_description_title', '464646')
		),
		array (
			'id' 			=> j_theme_name('porto_item_description_category'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item description category color',
			'description'	=> 'Change default portfolio background color',
			'value'			=> j_get_themes_manager('porto_item_description_category', '969595')
		),
		array (
			'id' 			=> j_theme_name('porto_item_description_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item description content text color',
			'description'	=> 'Change default portfolio content text color',
			'value'			=> j_get_themes_manager('porto_item_description_color', '7A7A7A')
		),				
		array(
			'type'			=> 'heading',
			'title'			=> 'Portfolio Navigator'
		),
		array (
			'id' 			=> j_theme_name('porto_nav_background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio navigator background color',
			'description'	=> 'Background color of portfolio navigator',
			'value'			=> j_get_themes_manager('porto_nav_background_color', 'FAFAFA')
		),
		array (
			'id' 			=> j_theme_name('porto_nav_hover_background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio navigator hovered background color',
			'description'	=> 'Background color when portfolio navigation hovered',
			'value'			=> j_get_themes_manager('porto_nav_hover_background_color', '181818')
		),
		array (
			'id' 			=> j_theme_name('porto_nav_border_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio navigator border color',
			'description'	=> 'Portfolio navigator border color',
			'value'			=> j_get_themes_manager('porto_nav_border_color', 'DEDEDE')
		),
		array (
			'id' 			=> j_theme_name('porto_nav_dark_nav'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Turn portfolio navigator icon color to fit darker background',
			'description'	=> 'Switch icon to fit darker background on portfolio navigator',
			'value'			=> j_get_themes_manager('porto_nav_dark_nav' , 0)
		),
		array (
			'id' 			=> j_theme_name('porto_nav_dark_hover_nav'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Turn portfolio navigator icon color to fit light background when navigator hovered',
			'description'	=> 'Switch icon to fit darker background on portfolio navigator when navigator hovereds',
			'value'			=> j_get_themes_manager('porto_nav_dark_hover_nav' , 0)
		),
		
	);
	
	$blog = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Inner Container'
		),
		array (
			'id' 			=> j_theme_name('blog_inner_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog background color',
			'description'	=> 'Change blog background color',
			'value'			=> j_get_themes_manager('blog_inner_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('blog_inner_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog border color',
			'description'	=> 'Change blog border color',
			'value'			=> j_get_themes_manager('blog_inner_border', '7d7d7d')
		),
					
		array (
			'id' 			=> j_theme_name('blog_icon_dark'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Turn blog icon to fit darker background',
			'description'	=> 'Switch icon to fit darker background on blog page',
			'value'			=> j_get_themes_manager('blog_icon_dark' , 0)
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Content'
		),		
		array (
			'id' 			=> j_theme_name('blog_inner_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog text color',
			'description'	=> 'Change blog content text color',
			'value'			=> j_get_themes_manager('blog_inner_text_color', '484848')
		),
		array (
			'id' 			=> j_theme_name('blog_inner_link_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog href text color',
			'description'	=> 'Change blog content href text color',
			'value'			=> j_get_themes_manager('blog_inner_link_color', 'DE3917')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Outer Container'
		),
		array (
			'id' 			=> j_theme_name('blog_outer_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog outer container background color',
			'description'	=> 'Change blog outer container background color, will be faded to 0.1 of opacity',
			'value'			=> j_get_themes_manager('blog_outer_background', '7d7d7d')
		),
		array (
			'id' 			=> j_theme_name('blog_outer_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog outer container border',
			'description'	=> 'Change blog outer container border color, will be faded to 0.3 of opacity',
			'value'			=> j_get_themes_manager('blog_outer_border', '7d7d7d')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog & Sidebar Header'
		),
		array (
			'id' 			=> j_theme_name('blog_header_noimage_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header background color (no image)',
			'description'	=> 'Blog & Sidebar header background color when no image preview available',
			'value'			=> j_get_themes_manager('blog_header_noimage_background')
		),
		array (
			'id' 			=> j_theme_name('blog_header_noimage_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header text color (no image)',
			'description'	=> 'Blog & Sidebar header text color when no image preview available',
			'value'			=> j_get_themes_manager('blog_header_noimage_color', '7A7A7A')
		),
		array (
			'id' 			=> j_theme_name('blog_header_image_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header background color (with image)',
			'description'	=> 'Blog & Sidebar header background color when image preview available',
			'value'			=> j_get_themes_manager('blog_header_image_background', '000000')
		),
		array (
			'id' 			=> j_theme_name('blog_header_image_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header text color (with image)',
			'description'	=> 'Blog & Sidebar header text color when image preview available',
			'value'			=> j_get_themes_manager('blog_header_image_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('blog_header_border_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header border color',
			'description'	=> 'Blog & Sidebar bottom border color',
			'value'			=> j_get_themes_manager('blog_header_border_color', 'C3C3C3')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Meta'
		),
		array (
			'id' 			=> j_theme_name('blog_meta_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header meta background color',
			'description'	=> 'Blog meta background color',
			'value'			=> j_get_themes_manager('blog_meta_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('blog_meta_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header meta text color',
			'description'	=> 'Blog & Sidebar header text color when image preview available',
			'value'			=> j_get_themes_manager('blog_meta_text_color', '222222')
		),
		array (
			'id' 			=> j_theme_name('blog_meta_hovered_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header meta hovered text color',
			'description'	=> 'Blog & Sidebar header text color when image preview available',
			'value'			=> j_get_themes_manager('blog_meta_hovered_text_color', 'DE3917')
		),
		array (
			'id' 			=> j_theme_name('blog_meta_border_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog meta border color',
			'description'	=> 'Blog meta border color',
			'value'			=> j_get_themes_manager('blog_meta_border_color', 'DDDDDD')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog bottom bar'
		),
		array (
			'id' 			=> j_theme_name('blog_bottom_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog bottom bar background',
			'description'	=> 'blog bottom bar background',
			'value'			=> j_get_themes_manager('blog_bottom_background', 'FCFCFC')
		),
		array (
			'id' 			=> j_theme_name('blog_bottom_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog bottom bar top border',
			'description'	=> 'blog bottom bar top border',
			'value'			=> j_get_themes_manager('blog_bottom_border', 'DDDDDD')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Comment'
		),
		array (
			'id' 			=> j_theme_name('blog_comment_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog comment background',
			'description'	=> 'blog comment background',
			'value'			=> j_get_themes_manager('blog_comment_background', 'FCFCFC')
		),
		array (
			'id' 			=> j_theme_name('blog_comment_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog comment text color',
			'description'	=> 'blog comment text color',
			'value'			=> j_get_themes_manager('blog_comment_text_color', '484848')
		),
		array (
			'id' 			=> j_theme_name('blog_comment_btn'),
			'type'			=> 'select',
			'title'			=> 'Blog comment button',
			'description'	=> 'blog comment button',
			'option'		=> array(
				'btn' 				=> 'Light', 
				'btn-primary' 		=> 'Deep blue',
				'btn-info' 			=> 'Sky blue',
				'btn-success' 		=> 'Green',
				'btn-warning' 		=> 'Warning',
				'btn-danger' 		=> 'Orange',
				'btn-inverse' 		=> 'Black',
			),
			'value'		=> j_get_themes_manager('blog_comment_btn' , 'btn-inverse')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Sidebar'
		),
		array (
			'id' 			=> j_theme_name('blog_sidebar_hover_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Sidebar hovered background color on list',
			'description'	=> 'sidebar hovered background color on list',
			'value'			=> j_get_themes_manager('blog_sidebar_hover_color', 'F5F5F5')
		),
		array (
			'id' 			=> j_theme_name('blog_sidebar_link_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Sidebar link color',
			'description'	=> 'sidebar link href color',
			'value'			=> j_get_themes_manager('blog_sidebar_link_color', '484848')
		),
		array (
			'id' 			=> j_theme_name('blog_sidebar_dark_icon'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable icon that fit darker background',
			'description'	=> 'Use icon that fit with darker background for sidebar',
			'value'			=> j_get_themes_manager('blog_sidebar_dark_icon', '0')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Tag'
		),
		array (
			'id' 			=> j_theme_name('blog_tag_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Tag background color',
			'description'	=> 'tag background color',
			'value'			=> j_get_themes_manager('blog_tag_background', '999999')
		),
		array (
			'id' 			=> j_theme_name('blog_tag_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Tag text color',
			'description'	=> 'tag text color',
			'value'			=> j_get_themes_manager('blog_tag_color', 'FFFFFF')
		),
		
	);
	
	$contact = array(
		array (
			'id' 			=> j_theme_name('contact_flag_outer'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact flag outer color',
			'description'	=> 'Set contact flag outer color, this option will faded into 0.3 of opacity',
			'value'			=> j_get_themes_manager('contact_flag_outer', '7D7D7D')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact Flag'
		),
		array (
			'id' 			=> j_theme_name('contact_flag_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact flag background',
			'description'	=> 'Set contact flag background color',
			'value'			=> j_get_themes_manager('contact_flag_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('contact_flag_dark_icon'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Set icon to fit darker background',
			'description'	=> 'set icon to fit darker background on contact us flag page',
			'value'			=> j_get_themes_manager('contact_flag_dark_icon', '0')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact Head'
		),
		array (
			'id' 			=> j_theme_name('contact_head_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact head background color',
			'description'	=> 'Set contact head background color',
			'value'			=> j_get_themes_manager('contact_head_background', '181818')
		),
		array (
			'id' 			=> j_theme_name('contact_head_text'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact header text color',
			'description'	=> 'Set contact header text color ',
			'value'			=> j_get_themes_manager('contact_head_text', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('contact_head_arrow'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Set icon to fit ligher background',
			'description'	=> 'set icon to fit ligher background on contact head',
			'value'			=> j_get_themes_manager('contact_head_arrow', '0')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact Body'
		),
		array (
			'id' 			=> j_theme_name('contact_body_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact body background',
			'description'	=> 'Set contact body background color',
			'value'			=> j_get_themes_manager('contact_body_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('contact_body_text'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact body text color',
			'description'	=> 'Set contact body text color',
			'value'			=> j_get_themes_manager('contact_body_text', '222222')
		),
		array (
			'id' 			=> j_theme_name('contact_body_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact body border color',
			'description'	=> 'Set contact body border color',
			'value'			=> j_get_themes_manager('contact_body_border', 'C9C9C9')
		),
		array (
			'id' 			=> j_theme_name('contact_dark_icon'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Set icon to fit dark background',
			'description'	=> 'set icon to fit dark background on contact body',
			'value'			=> j_get_themes_manager('contact_dark_icon', '0')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact location hovered'
		),
		array (
			'id' 			=> j_theme_name('contact_location_hover_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact location list hovered background color',
			'description'	=> 'Set contact location list hovered background color',
			'value'			=> j_get_themes_manager('contact_location_hover_background', '181818')
		),
		array (
			'id' 			=> j_theme_name('contact_location_hover_text'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact location list hovered text color',
			'description'	=> 'Set contact location list hovered text color',
			'value'			=> j_get_themes_manager('contact_location_hover_text', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('contact_location_icon_light'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Icon location to fit light background color when hovered',
			'description'	=> 'set icon location to fit light background when hovered',
			'value'			=> j_get_themes_manager('contact_location_icon_light', '0')
		)
	);
	
	$additional = array(
		array (
			'id' 			=> j_theme_name('additional_css'),
			'type'			=> 'textarea',
			'title'			=> 'Additional CSS style',
			'description'	=> 'Insert additional CSS code. If you need more style modification, its better to add modification code using this feature rather than modify the original css file.',
			'value'			=> j_get_themes_manager('additional_css', '')
		)
	);
	
	return array (
		'Font'			=> $font,
		'General'		=> $general,
		'Front Slider'	=> $front_slider,
		'Portfolio'		=> $portfolio,
		'Contact'		=> $contact,
		'Blog'			=> $blog,
		'Additional'	=> $additional	
	);
}

function dark_theme() {
	$general = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Web Background'
		),
		array (
			'id' 			=> j_theme_name('background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Website background color',
			'description'	=> 'Set website background color. this setting will apply to all website page.',
			'value'			=> j_get_themes_manager('background_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('body_background'),
			'type'			=> 'upload',
			'title'			=> 'Body Background',
			'description'	=> 'Set website body background. This background will be used for every page on the site',
			'value'			=> j_get_themes_manager('body_background')
		),
		array (
			'id' 			=> j_theme_name('body_bg_fullscreen'),
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable fullscreen background',
			'description'	=> 'If this option turned off, Body Background option will fill entire screen with repeated background. suit for pattern background. '.
								'<br> But if this option is turned on, image will scratched to fill background with only one image. suit for big image background.',
			'value'			=> j_get_themes_manager('body_bg_fullscreen' , 0)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Curtain Style Option'
		),
		array (
			'id' 			=> j_theme_name('curtain_background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Curtain background color',
			'description'	=> 'Set curtain background color.<br> You can ignore this option if you turn off curtain effect on General Setting.',
			'value'			=> j_get_themes_manager('curtain_background_color', '000000')
		),
		array (
			'id' 			=> j_theme_name('curtain_background'),
			'type'			=> 'upload',
			'title'			=> 'Curtain Background',
			'description'	=> 'Set curtain background image, image will repeat to fill all curtain region.<br> You can ignore this option if you turn off curtain effect on General Setting.',
			'value'			=> j_get_themes_manager('curtain_background')
		),
		array (
			'id' 			=> j_theme_name('curtain_head_image'),
			'type'			=> 'upload',
			'title'			=> 'Curtain head image',
			'description'	=> 'When curtain slide up, this image will show before it reach the top of the page. you can change default image with 7 Pixel image height. Image will repeat on horizontally. <br> You can ignore this option if you turn off curtain effect on General Setting or use fade curtain effect.',
			'value'			=> j_get_themes_manager('curtain_head_image')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Header Navigation Menu'
		),	
		array (
			'id' 			=> j_theme_name('header_background'),
			'type'			=> 'upload',
			'title'			=> 'Header Background',
			'description'	=> 'change header background image with 160 pixel height (also used for responsive header background)',
			'value'			=> j_get_themes_manager('header_background')
		),
		array (
			'id' 			=> j_theme_name('nav_background'),
			'type'			=> 'upload',
			'title'			=> 'Header Separator of Navigation',
			'description'	=> 'change header separator of navigation image with your own image. height is 92 pixel.',
			'value'			=> j_get_themes_manager('nav_background')
		),
		array (
			'id' 			=> j_theme_name('web_head_line_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header line color',
			'description'	=> 'Change 5 pixel line above header logo & navigation',
			'value'			=> j_get_themes_manager('web_head_line_color', '333333')
		),
		array (
			'id' 			=> j_theme_name('menu_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header menu hovered background',
			'description'	=> 'Change header menu background color when menu hovered ',
			'value'			=> j_get_themes_manager('menu_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('menu_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header menu text color',
			'description'	=> 'Change header header menu text color',
			'value'			=> j_get_themes_manager('menu_text_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('menu_hover_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Menu hovered text color',
			'description'	=> 'Change menu text color when those menu hovered',
			'value'			=> j_get_themes_manager('menu_hover_text_color', '000000')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Submenu normal state (not hovered)'
		),
		array (
			'id' 			=> j_theme_name('submenu_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header submenu background',
			'description'	=> 'submenu (menu child) header color when menu hovered',
			'value'			=> j_get_themes_manager('submenu_background', '000000')
		),
		array (
			'id' 			=> j_theme_name('submenu_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header submenu text color',
			'description'	=> 'submenu header text color',
			'value'			=> j_get_themes_manager('submenu_text_color', 'FFFFFF')
		),
		
		array (
			'id' 			=> j_theme_name('submenu_border_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Submenu border color',
			'description'	=> 'menu child border color',
			'value'			=> j_get_themes_manager('submenu_border_color', '363636')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Submenu hovered'
		),
		array (
			'id' 			=> j_theme_name('submenu_hover_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Submenu background color when hovered',
			'description'	=> 'submenu (menu child) header background color when submenu hovered',
			'value'			=> j_get_themes_manager('submenu_hover_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('submenu_hover_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header submenu hovered text color',
			'description'	=> 'header submenu text color when submenu hovered',
			'value'			=> j_get_themes_manager('submenu_hover_text_color', '000000')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Footer Background'
		),
		array (
			'id' 			=> j_theme_name('footer_background'),
			'type'			=> 'upload',
			'title'			=> 'Footer Background',
			'description'	=> 'change footer navigation image with your own image. height is 10 pixel',
			'value'			=> j_get_themes_manager('footer_background')
		),
		array (
			'id' 			=> j_theme_name('footer_line1'),
			'type'			=> 'colorpicker',
			'title'			=> 'Footer Separator Color Line 1',
			'description'	=> 'change footer separator color line',
			'value'			=> j_get_themes_manager('footer_line1', '000000')
		),
		array (
			'id' 			=> j_theme_name('footer_line2'),
			'type'			=> 'colorpicker',
			'title'			=> 'Footer Separator Color line 2',
			'description'	=> 'change footer separator color line',
			'value'			=> j_get_themes_manager('footer_line2', '111111')
		),
		array (
			'id' 			=> j_theme_name('footer_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Footer text color',
			'description'	=> 'Footer hovered icon text color',
			'value'			=> j_get_themes_manager('footer_text_color', 'FFFFFF')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Loader GIF'
		),
		array (
			'id' 			=> j_theme_name('big_page_loader'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio, Front slider, Curtain loader image',
			'description'	=> 'Change portfolio, front slider, curtain loader image item loader with 40 x 40 pixel gif image to match your style',
			'value'			=> j_get_themes_manager('big_page_loader')
		),
		array (
			'id' 			=> j_theme_name('big_page_loader_bg'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio, Front slider, curtain loader background color',
			'description'	=> 'loader background color for portfolio page, front slider, and curtain.',
			'value'			=> j_get_themes_manager('big_page_loader_bg', '000000')
		),
		array (
			'id' 			=> j_theme_name('porto_item_loader'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio item  & contact loader',
			'description'	=> 'Change portfolio item loader with 32 x 32 pixel gif image to match your style',
			'value'			=> j_get_themes_manager('porto_item_loader')
		),
		array (
			'id' 			=> j_theme_name('fullscreen_loader'),
			'type'			=> 'upload',
			'title'			=> 'Fullscreen loader image',
			'description'	=> 'loader gif image when fullscreen image show',
			'value'			=> j_get_themes_manager('fullscreen_loader')
		),
	);
	
	$font = array(
		array (
			'id' 			=> j_theme_name('heading_font'),
			'type'			=> 'font',
			'title'			=> 'Heading font',
			'description'	=> 'Heading font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('heading_font')
		),
		array (
			'id' 			=> j_theme_name('heading_alt_font'),
			'type'			=> 'font',
			'title'			=> 'Heading alt font',
			'description'	=> 'Heading alt font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('heading_alt_font')
		),
		array (
			'id' 			=> j_theme_name('body_font'),
			'type'			=> 'font',
			'title'			=> 'Body font',
			'description'	=> 'Body font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('body_font')
		),
		array (
			'id' 			=> j_theme_name('front_slider_font'),
			'type'			=> 'font',
			'title'			=> 'Front slider font',
			'description'	=> 'front slider font',
			'option'		=> j_get_all_font(),
			'value'			=> j_get_themes_manager('front_slider_font')
		),
	);
	
	$front_slider = array(				
		array(
			'type'			=> 'heading',
			'title'			=> 'Front slider info flag'
		),
		array (
			'id' 			=> j_theme_name('home_pita_flag_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Home info flag background',
			'description'	=> 'Set home info flag background color',
			'value'			=> j_get_themes_manager('home_pita_flag_background', '000000')
		),		
		array(
			'type'			=> 'heading',
			'title'			=> 'Front slider info box header'
		),
		array (
			'id' 			=> j_theme_name('home_pita_title_bg_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Front slider info title & link background',
			'description'	=> 'front slider info title and link background color',
			'value'			=> j_get_themes_manager('home_pita_title_bg_color', '000000')
		),
		array (
			'id' 			=> j_theme_name('home_pita_title_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Front slider info title text color',
			'description'	=> 'Front slider info title text color',
			'value'			=> j_get_themes_manager('home_pita_title_color', 'FFFFFF')
		),				
		array(
			'type'			=> 'heading',
			'title'			=> 'Front slider info box body'
		),
		array (
			'id' 			=> j_theme_name('home_pita_box_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Home info box color',
			'description'	=> 'Change home info box color. <br> Clear input to revert default value.',
			'value'			=> j_get_themes_manager('home_pita_box_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('home_pita_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Home info box text color',
			'description'	=> 'Change home info box text color. <br> Clear input to revert default value.',
			'value'			=> j_get_themes_manager('home_pita_text_color', '000000')
		),
	);
	
	$portfolio = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Portfolio Filter'
		),
		array (
			'id' 			=> j_theme_name('porto_filter_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter background',
			'description'	=> 'Change filter background on portfolio page',
			'value'			=> j_get_themes_manager('porto_filter_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter text color',
			'description'	=> 'Change filter text color on portfolio page',
			'value'			=> j_get_themes_manager('porto_filter_color', '222222')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_background_hover'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter hovered background color',
			'description'	=> 'Change background color of portfolio filter when filter hovered',
			'value'			=> j_get_themes_manager('porto_filter_background_hover', '181818')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_color_hover'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter hovered text color',
			'description'	=> 'Change text color of portfolio filter when filter hovered',
			'value'			=> j_get_themes_manager('porto_filter_color_hover', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('porto_filter_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio filter border',
			'description'	=> 'Change default portfolio filter border',
			'value'			=> j_get_themes_manager('porto_filter_border', '888888')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Portfolio Item'
		),
		array (
			'id' 			=> j_theme_name('porto_item_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item background color',
			'description'	=> 'Change default portfolio background color',
			'value'			=> j_get_themes_manager('porto_item_background', 'FFFFFF')
		),		
		array (
			'id' 			=> j_theme_name('porto_item_description_title'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item description title text color',
			'description'	=> 'Change portfolio item description title color with your own color',
			'value'			=> j_get_themes_manager('porto_item_description_title', '0A0A0A')
		),
		array (
			'id' 			=> j_theme_name('porto_item_description_category'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item description category color',
			'description'	=> 'Change default portfolio background color',
			'value'			=> j_get_themes_manager('porto_item_description_category', '969595')
		),
		array (
			'id' 			=> j_theme_name('porto_item_description_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio item description content text color',
			'description'	=> 'Change default portfolio content text color',
			'value'			=> j_get_themes_manager('porto_item_description_color', '7A7A7A')
		),				
		array(
			'type'			=> 'heading',
			'title'			=> 'Portfolio Navigator'
		),
		array (
			'id' 			=> j_theme_name('porto_nav_background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio navigator background color',
			'description'	=> 'Background color of portfolio navigator',
			'value'			=> j_get_themes_manager('porto_nav_background_color', 'FAFAFA')
		),
		array (
			'id' 			=> j_theme_name('porto_nav_hover_background_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio navigator hovered background color',
			'description'	=> 'Background color when portfolio navigation hovered',
			'value'			=> j_get_themes_manager('porto_nav_hover_background_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('porto_nav_border_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Portfolio navigator border color',
			'description'	=> 'Portfolio navigator border color',
			'value'			=> j_get_themes_manager('porto_nav_border_color', 'DEDEDE')
		)
		
	);
	
	$blog = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Inner Container'
		),
		array (
			'id' 			=> j_theme_name('blog_inner_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog background color',
			'description'	=> 'Change blog background color',
			'value'			=> j_get_themes_manager('blog_inner_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('blog_inner_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog border color',
			'description'	=> 'Change blog border color',
			'value'			=> j_get_themes_manager('blog_inner_border', '000000')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Content'
		),		
		array (
			'id' 			=> j_theme_name('blog_inner_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog text color',
			'description'	=> 'Change blog content text color',
			'value'			=> j_get_themes_manager('blog_inner_text_color', '484848')
		),
		array (
			'id' 			=> j_theme_name('blog_inner_link_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog href text color',
			'description'	=> 'Change blog content href text color',
			'value'			=> j_get_themes_manager('blog_inner_link_color', 'DE3917')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Outer Container'
		),
		array (
			'id' 			=> j_theme_name('blog_outer_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog outer container background color',
			'description'	=> 'Change blog outer container background color, will be faded to 0.1 of opacity',
			'value'			=> j_get_themes_manager('blog_outer_background', '7d7d7d')
		),
		array (
			'id' 			=> j_theme_name('blog_outer_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog outer container border',
			'description'	=> 'Change blog outer container border color, will be faded to 0.3 of opacity',
			'value'			=> j_get_themes_manager('blog_outer_border', '7d7d7d')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog & Sidebar Header'
		),
		array (
			'id' 			=> j_theme_name('blog_header_noimage_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header background color (no image)',
			'description'	=> 'Blog & Sidebar header background color when no image preview available',
			'value'			=> j_get_themes_manager('blog_header_noimage_background', '000000')
		),
		array (
			'id' 			=> j_theme_name('blog_header_noimage_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header text color (no image)',
			'description'	=> 'Blog & Sidebar header text color when no image preview available',
			'value'			=> j_get_themes_manager('blog_header_noimage_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('blog_header_image_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header background color (with image)',
			'description'	=> 'Blog & Sidebar header background color when image preview available',
			'value'			=> j_get_themes_manager('blog_header_image_background', '000000')
		),
		array (
			'id' 			=> j_theme_name('blog_header_image_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header text color (with image)',
			'description'	=> 'Blog & Sidebar header text color when image preview available',
			'value'			=> j_get_themes_manager('blog_header_image_color', 'FFFFFF')
		),		
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Meta'
		),
		array (
			'id' 			=> j_theme_name('blog_meta_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header meta background color',
			'description'	=> 'Blog meta background color',
			'value'			=> j_get_themes_manager('blog_meta_background', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('blog_meta_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header meta text color',
			'description'	=> 'Blog & Sidebar header text color when image preview available',
			'value'			=> j_get_themes_manager('blog_meta_text_color', '222222')
		),
		array (
			'id' 			=> j_theme_name('blog_meta_hovered_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Header meta hovered text color',
			'description'	=> 'Blog & Sidebar header text color when image preview available',
			'value'			=> j_get_themes_manager('blog_meta_hovered_text_color', 'DE3917')
		),
		array (
			'id' 			=> j_theme_name('blog_meta_border_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog meta border color',
			'description'	=> 'Blog meta border color',
			'value'			=> j_get_themes_manager('blog_meta_border_color', 'DDDDDD')
		),
				
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Comment'
		),
		array (
			'id' 			=> j_theme_name('blog_comment_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog comment background',
			'description'	=> 'blog comment background',
			'value'			=> j_get_themes_manager('blog_comment_background', 'FCFCFC')
		),
		array (
			'id' 			=> j_theme_name('blog_comment_text_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Blog comment text color',
			'description'	=> 'blog comment text color',
			'value'			=> j_get_themes_manager('blog_comment_text_color', '484848')
		),
		array (
			'id' 			=> j_theme_name('blog_comment_btn'),
			'type'			=> 'select',
			'title'			=> 'Blog comment button',
			'description'	=> 'blog comment button',
			'option'		=> array(
				'btn' 				=> 'Light', 
				'btn-primary' 		=> 'Deep blue',
				'btn-info' 			=> 'Sky blue',
				'btn-success' 		=> 'Green',
				'btn-warning' 		=> 'Warning',
				'btn-danger' 		=> 'Orange',
				'btn-inverse' 		=> 'Black',
			),
			'value'		=> j_get_themes_manager('blog_comment_btn' , 'btn-inverse')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Sidebar'
		),
		array (
			'id' 			=> j_theme_name('blog_sidebar_hover_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Sidebar hovered background color on list',
			'description'	=> 'sidebar hovered background color on list',
			'value'			=> j_get_themes_manager('blog_sidebar_hover_color', 'F5F5F5')
		),
		array (
			'id' 			=> j_theme_name('blog_sidebar_link_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Sidebar link color',
			'description'	=> 'sidebar link href color',
			'value'			=> j_get_themes_manager('blog_sidebar_link_color', '484848')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Tag'
		),
		array (
			'id' 			=> j_theme_name('blog_tag_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Tag background color',
			'description'	=> 'tag background color',
			'value'			=> j_get_themes_manager('blog_tag_background', '999999')
		),
		array (
			'id' 			=> j_theme_name('blog_tag_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Tag text color',
			'description'	=> 'tag text color',
			'value'			=> j_get_themes_manager('blog_tag_color', 'FFFFFF')
		),
		
	);
	
	$contact = array(		
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact Flag'
		),
		array (
			'id' 			=> j_theme_name('contact_flag_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact flag background',
			'description'	=> 'Set contact flag background color',
			'value'			=> j_get_themes_manager('contact_flag_background', 'FFFFFF')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact Head'
		),
		array (
			'id' 			=> j_theme_name('contact_head_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact head background color',
			'description'	=> 'Set contact head background color',
			'value'			=> j_get_themes_manager('contact_head_background', '000000')
		),
		array (
			'id' 			=> j_theme_name('contact_head_text'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact header text color',
			'description'	=> 'Set contact header text color ',
			'value'			=> j_get_themes_manager('contact_head_text', 'FFFFFF')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact Body'
		),
		array (
			'id' 			=> j_theme_name('contact_body_color'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact body background',
			'description'	=> 'Set contact body background color',
			'value'			=> j_get_themes_manager('contact_body_color', 'FFFFFF')
		),
		array (
			'id' 			=> j_theme_name('contact_body_text'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact body text color',
			'description'	=> 'Set contact body text color',
			'value'			=> j_get_themes_manager('contact_body_text', '222222')
		),
		array (
			'id' 			=> j_theme_name('contact_body_border'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact body border color',
			'description'	=> 'Set contact body border color',
			'value'			=> j_get_themes_manager('contact_body_border', 'C9C9C9')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Contact location hovered'
		),
		array (
			'id' 			=> j_theme_name('contact_location_hover_background'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact location list hovered background color',
			'description'	=> 'Set contact location list hovered background color',
			'value'			=> j_get_themes_manager('contact_location_hover_background', '000000')
		),
		array (
			'id' 			=> j_theme_name('contact_location_hover_text'),
			'type'			=> 'colorpicker',
			'title'			=> 'Contact location list hovered text color',
			'description'	=> 'Set contact location list hovered text color',
			'value'			=> j_get_themes_manager('contact_location_hover_text', 'FFFFFF')
		)
	);
	
	$additional = array(
		array (
			'id' 			=> j_theme_name('additional_css'),
			'type'			=> 'textarea',
			'title'			=> 'Additional CSS style',
			'description'	=> 'Insert additional CSS code. If you need more style modification, its better to add modification code using this feature rather than modify the original css file.',
			'value'			=> j_get_themes_manager('additional_css', '')
		)
	);
	
	return array (
		'Font'			=> $font,
		'General'		=> $general,
		'Front Slider'	=> $front_slider,
		'Portfolio'		=> $portfolio,
		'Contact'		=> $contact,
		'Blog'			=> $blog,
		'Additional'	=> $additional	
	);
}

function jeg_admin_style_option () {	
	if(j_get_schema() == "dark") {
		return dark_theme();
	} else {
		return light_themes();
	}
}

function jeg_themes_manager () {
	
	$manager = array(
		array (
			'id' 			=> 'thememanager',
			'type'			=> 'thememanager',
			'title'			=> 'Create new style manager ( don\'t forget to click Save Setting after create / updating style manager sequence ) ' ,
			'description'	=> '
				With style manager feature, you can have as many style combination as you like.<br/>
				When you create new style manager, default style & color will loaded. <br/>
				Style Manager only save setting on Style / Color Option. 
				Other setting will not affected with Style Manager.<br/>
				Don\'t forget to save setting everytime you make change on Style manager. 
			',
			'value'			=> j_get_option('thememanager')
		)
	);
	
	return array (
		'Setup Style Manager'		=> $manager
	);
}
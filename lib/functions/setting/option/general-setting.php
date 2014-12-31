<?php
/**
 * @author Jegbagus
 */
function jeg_admin_general_setting () {	
	
	$general = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Curtain Effect'
		),
		array (
			'id' 			=> 'curtain',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable curtain effect',
			'description'	=> 'Curtain effect depend on availability of latest html 5 feature (HTML 5 History API), that supported with latest browser (such as latest version of mozilla, safari and google chrome).',
			'value'			=> j_get_option('curtain' , 0)
		),
		array (
			'id' 			=> 'curtain_effect',
			'type'			=> 'select',
			'title'			=> 'Curtain Effect',
			'description'	=> 'Select curtain effect. You can also change curtain style on Jphotolio Setting &raquo; Style Color Option &raquo; Curtain.',
			'option'		=> array(
					'fade' 		=> 'fade', 
					'slide' 	=> 'slide'
			),
			'value'		=> j_get_option('curtain_effect' , 'fade')
		),
				
		array(
			'type'			=> 'heading',
			'title'			=> 'Responsive Website'
		),
		array (
			'id' 			=> 'responsive',
			'type'			=> 'switchtoogle',
			'title'			=> 'Responsive feature',
			'description'	=> 'reponsive website will render perfectly on modern device like iDevice or modern Phone like Android base phone. But you have option to turn responsive website off.',
			'value'			=> j_get_option('responsive' , 1)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Tracker'
		),
		/*
		array (
			'id' 			=> 'track_hit',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable theme built - in tracker',
			'description'	=> 'This option will enable theme\'s built in tracker. Enable this option will not affect other tracking plugin. <br>Tracker will log every hit from user (excluded bot) in real time, so you can have a better insight about your visitor data (data including IP, country, browser use)',
			'value'			=> j_get_option('track_hit' , 0)
		),
		array (
			'id' 			=> 'track_bot',
			'type'			=> 'switchtoogle',
			'title'			=> 'Track bot',
			'description'	=> 'This feature only applicable if Built-in tracker is turned on. <br>If this feature enabled, tracker will also track bot hit to server. This option is useful if you want to know bot crawler rate.',
			'value'			=> j_get_option('track_bot' , 1)
		),
		*/
		array (
			'id' 			=> 'google_analytic',
			'type'			=> 'text',
			'title'			=> 'Google Analytic ID',
			'description'	=> 'If you already create google analytic code, please insert it here.',
			'value'			=> j_get_option('google_analytic')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'iOS Support'
		),
		array (
			'id' 			=> 'apps_capable',
			'type'			=> 'switchtoogle',
			'title'			=> 'iOS Web Apps Capable',
			'description'	=> 'Enable Web Apps capablility on iOS device. When turned on, website will act like apps with fullscreen display. But if this feature turned off site will show on safari like normal website. You can add touch screen icon on Jphotolio Setting &raquo; General Setting &raquo; Logo & Favico.',
			'value'			=> j_get_option('apps_capable' , 0)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Mouse click'
		),
		array (
			'id' 			=> 'rightclick',
			'type'			=> 'switchtoogle',
			'title'			=> 'Allow right mouse click',
			'description'	=> 'Allow right mouse click.',
			'value'			=> j_get_option('rightclick' , 1)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Footer Copyright'
		),
		array (
			'id' 			=> 'footer_copy',
			'type'			=> 'textarea',
			'title'			=> 'Footer Copyright',
			'description'	=> 'Footer copyright text',
			'value'			=> j_get_option('footer_copy' , '')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Additional Javascript'
		),
		array (
			'id' 			=> 'additional_js',
			'type'			=> 'textarea',
			'title'			=> 'Additional Javascript',
			'description'	=> 'Insert additional Javascript code. If you need more Javascript modification, its better to add modification code using this feature rather than modify the original javascript file.',
			'value'			=> j_get_option('additional_js', '')
		)
	);	
	
	$logoicon = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Website Logo'
		),
		array (
			'id' 			=> 'website_logo',
			'type'			=> 'upload',
			'title'			=> 'Website logo',
			'description'	=> 'Upload your website logo. If you have logo hosted on other site, you also able to insert url of your logo right here.<br><br>If you want to upload your own file, click <b>"Select File"</b> and upload any file that you want to use. After finishing upload, click <b>"Insert into Post"</b> to move url to textbox. But if you already upload file, you can choose it by clicking <b>"Media Library"</b>, choose your file, click <b>"Show"</b>  and dont forget to click <b>"Insert into Post"</b>. But if you already have url of the file, you can simply put it into the textbox.',
			'value'			=> j_get_option('website_logo')
		),
		array (
			'id' 			=> 'logo_width',
			'type'			=> 'text',
			'title'			=> 'Logo width',
			'description'	=> 'Please provide your logo width in pixel, we need it to calculate navigation left & right margin.',
			'value'			=> j_get_option('logo_width')
		),
		array (
			'id' 			=> 'logo_top_margin',
			'type'			=> 'text',
			'title'			=> 'Logo top margin',
			'description'	=> 'Top margin of to and header line in pixel. Value can be negative.',
			'value'			=> j_get_option('logo_top_margin', 0)
		),		
		array (
			'id' 			=> 'nav_logo_gap',
			'type'			=> 'text',
			'title'			=> 'Logo and navigation gap',
			'description'	=> 'Gap between logo and navigation in pixel.',
			'value'			=> j_get_option('nav_logo_gap', 0)
		),
		array (
			'id' 			=> 'logo_animation',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable logo rotation animation',
			'description'	=> 'If browser support css 3 and this option enabled, you can see logo will rotate when hovered.',
			'value'			=> j_get_option('logo_animation' , 0)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Favico'
		),
		array (
			'id' 			=> 'website_favico',
			'type'			=> 'upload',
			'title'			=> 'Website Favico',
			'description'	=> 'Upload your favico with .ico extension<br><br>If you want to upload your own file, click <b>"Select File"</b> and upload any file that you want to use. After finishing upload, click <b>"Insert into Post"</b> to move url to textbox. If you already upload file, you can choose it by clicking <b>"Media Library"</b>, choose your file, click <b>"Show"</b>  and dont forget to click <b>"Insert into Post"</b>. But if you already have url of the file, you can simply put it into the textbox.',
			'value'			=> j_get_option('website_favico')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Touch Icon'
		),
		array (
			'id' 			=> 'touch_icon',
			'type'			=> 'upload',
			'title'			=> 'Touch Icon',
			'description'	=> 'This themes is a responsive theme that will look pixel perfect on modern device like iPhone or iPad. So its a good idea to provide icon for touch device. Upload your website touch icon with size 144x144 pixel.<br><br>If you want to upload your own file, click <b>"Select File"</b> and upload any file that you want to use. After finishing upload, click <b>"Insert into Post"</b> to move url to textbox. If you already upload file, you can choose it by clicking <b>"Media Library"</b>, choose your file, click <b>"Show"</b>  and dont forget to click <b>"Insert into Post"</b>. But if you already have url of the file, you can simply put it into the textbox.',
			'value'			=> j_get_option('touch_icon')
		)
	);
	
	$socialicon = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Social Icon (Bottom right menu)'
		),
		array (
			'id' 			=> 'social_icon',
			'type'			=> 'iconsetting',
			'title'			=> 'Social Icon',
			'value'			=> j_get_option('social_icon'),
			'icons'			=> array('social-digg', 'social-digg2', 'social-gbuzz', 'social-delicious', 'social-twitter', 'social-twitter2', 'social-tumbler', 'social-plixi', 'social-dribbble', 'social-dribbble2', 'social-stubleupon', 
								'social-lastfm', 'social-moby', 'social-youtube', 'social-youtube2', 'social-vimeo', 'social-vimeo2', 'social-skype', 'social-facebook', 'social-fblike', 'social-fblike2', 'social-myspace',
								'social-dropbox', 'social-foursquare', 'social-gowalla', 'social-ichat', 'social-gplust', 'social-twitter3', 'social-linkedin','social-flickr', 'social-500px', 'social-rss', 'social-instagram', 'social-pinterest')								
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Misc Icon (Bottom Left menu)'
		),	
		array (
			'id' 			=> 'misc_icon',
			'type'			=> 'iconsetting',
			'title'			=> 'Misc Icon',
			'value'			=> j_get_option('misc_icon'),
			'icons'			=> array('misc-magnifying-glass','misc-trashcan','misc-trashcan2','misc-presentation','misc-download-to-computer','misc-download','misc-upload','misc-flag','misc-flag2','misc-finish-flag','misc-winner-podium','misc-cup',
								'misc-home','misc-home2','misc-link','misc-link2','misc-note-book','misc-book','misc-book-large','misc-books','misc-tree','misc-under-construction','misc-umbrella','misc-mail','misc-help','misc-rss','misc-strategy','misc-strategy2',
								'misc-apartment-building','misc-companies','misc-pacman-ghost','misc-pacman','misc-vault','misc-archive','misc-file-cabinet','misc-bandaid','misc-post-card','misc-alert','misc-alert2','misc-alarm-bell','misc-alarm-bell2','misc-robot',
								'misc-globe','misc-globe2','misc-chemical','misc-light-bulb','misc-cloud','misc-cloud-upload','misc-cloud-download','misc-lamp','misc-ppreview','misc-ice-cream','misc-ice-cream2','misc-paperclip','misc-footprints','misc-firefox',
								'misc-chrome','misc-safari','misc-loading-bar','misc-bulls-eye','misc-folder','misc-locked','misc-locked2','misc-unlocked','misc-tag','misc-tags2','misc-macos','misc-windows','misc-linux','misc-create-write','misc-expose','misc-key',
								'misc-key2','misc-table','misc-chair','misc-acces-denied-sign','misc-balloons','misc-cat','misc-airplane','misc-truck','misc-car','misc-info-about','misc-frames','misc-coverflow','misc-list','misc-list-images','misc-list-image',
								'misc-blocks-images','misc-wordpress','misc-wordpress2','misc-expression-engine','misc-joomla','misc-drupal','misc-headphone')
		),
	);
	
	$seo = array(
		array (
			'id' 			=> 'enable_seo',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable built-in SEO',
			'description'	=> 'Enable built in SEO functionality. This feature is basic SEO configuration. You may consider to use another SEO Plugin, and don\'t forget to turn off this feature if you install another SEO Plugin to prevent conflict and duplication.',
			'value'			=> j_get_option('enable_seo' , 1)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Title'
		),	
		array (
			'id' 			=> 'separator',
			'type'			=> 'text',
			'title'			=> 'Title Separator',
			'description'	=> 'Separator between title, you can use : ( - , &raquo; , | ) or define by your self',
			'value'			=> j_get_option('separator' , '-')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Meta header'
		),
		array (
			'id' 			=> 'seo_keyword',
			'type'			=> 'text',
			'title'			=> 'Site Keyword',
			'description'	=> 'Website keyword that describe your site, separated by comma.',
			'value'			=> j_get_option('seo_keyword')
		),		
		array (
			'id' 			=> 'seo_description',
			'type'			=> 'textarea',
			'title'			=> 'Site Description',
			'description'	=> 'Will show as website meta description',
			'value'			=> j_get_option('seo_description')
		)
	);
	
	$sidebar = array(
		array (
			'id' 			=> 'sidebar',
			'type'			=> 'sidebar',
			'title'			=> 'Sidebar Name',
			'description'	=> '<ul><li>You can use different sidebar (widget container) on different page or post. Register new sidebar here. </li><li>When you create / edit page with default template or blog page template, you able to choose sidebar that you\'ve been created here.</li><li>Add sidebar content at Appeareance &raquo; Widget. </li></ul>',
			'value'			=> j_get_option('sidebar')
		)
	);
	
	
	$menuoption = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Menu Option'
		),
		array (
			'id' 			=> 'centered_menu',
			'type'			=> 'switchtoogle',
			'title'			=> 'Switch to centered menu',
			'description'	=> 'if you want your menu & logo on center of the page, you will need to enable this option. if this option disabled, your logo will aligned to left, and your menu aligned to right. ',
			'value'			=> j_get_option('centered_menu' , 1)
		),
		array (
			'id' 			=> 'small_menu',
			'type'			=> 'switchtoogle',
			'title'			=> 'Set smaller menu',
			'description'	=> 'By enabling this option, top menu height will be reduced from 99px to 60px. ',
			'value'			=> j_get_option('small_menu' , 0)
		),		
		array (
			'id' 			=> 'long_menu',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable Long Menu Option',
			'description'	=> 'if you are using menu more than 2 each side, you will need to activate this option so menu will not break on smaller resolution device',
			'value'			=> j_get_option('long_menu' , 1)
		),
		array (
			'id' 			=> 'long_menu_width',
			'type'			=> 'text',
			'title'			=> 'Long menu width effect',
			'description'	=> 'if you have alot of menu, you can increase this value',
			'value'			=> j_get_option('long_menu_width' , 979)
		)
	);
	
	
	return array(		
		'General'				=> $general,
		'Logo & Favico'			=> $logoicon,
		'Social & Navi Icon'	=> $socialicon,
		'Sidebar'				=> $sidebar,
		'Basic SEO'				=> $seo,
		'Menu Option'			=> $menuoption
	);
}

function jeg_admin_ads_setting () {
	
	$general = array(
		array (
			'id' 			=> 'header_ads',
			'type'			=> 'switchtoogle',
			'title'			=> 'Show Ads on Header',
			'description'	=> 'Disable this option if you want to hide ads on header. We will recommend you not to turn off this option. We offer several information about product that may be usefull for you.',
			'value'			=> j_get_option('header_ads' , 1)
		),
	);
	
	return array(		
		'Header Ads'				=> $general
	);
}
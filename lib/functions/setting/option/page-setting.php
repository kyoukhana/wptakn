<?php

function jeg_admin_page_setting () {
	
	$fontslider = array(
		array (
			'id' 			=> 'front_slider_speed',
			'type'			=> 'text',
			'title'			=> 'Front slider delay',
			'description'	=> 'slide delay in mili second, default is 10000 (10 second)',		
			'value'			=> j_get_option('front_slider_speed', '10000')
		),
		array (
			'id' 			=> 'arrange_slider',
			'type'			=> 'frontslider',
			'title'			=> 'Arrange Front Slider (drag to change arrangement)',			
			'value'			=> j_get_front_slider() , 
		)		
	);
	
	$blog = array(
		array (
			'id' 			=> 'blog_layout',
			'type'			=> 'select',
			'title'			=> 'Blog Layout',
			'description'	=> 'This option will affect blog, single blog entry, archive, and search page',
			'option'		=> array(
				Jeg_Sidebar::$_RIGHT		=> 'Right sidebar layout',
				Jeg_Sidebar::$_LEFT 		=> 'Left sidebar layout',
				Jeg_Sidebar::$_FULLWIDTH 	=> 'Fullwidth no sidebar',
			),
			'value'		=> j_get_option('blog_layout', JEG_DEFAULT_LAYOUT)
		),
		array (
			'id' 			=> 'blog_sidebar',
			'type'			=> 'select',
			'title'			=> 'Blog Sidebar',
			'description'	=> 'Sidebar will show if you choose Right sidebar / Left sidebar blog page layout',
			'option'		=> j_get_sidebar_list(),
			'value'			=> j_get_option('blog_sidebar', JEG_DEFAULT_SIDEBAR)
		),
		array (
			'id' 			=> 'posts_per_page',
			'type'			=> 'text',
			'title'			=> 'Number of post',
			'description'	=> 'Number of post on a blog page, if you have more post, will be splited with paging',
			'value'			=> get_option('posts_per_page')
		),
		array (
			'id' 			=> 'blog_exclude',
			'type'			=> 'multicheckbox',
			'title'			=> 'Exclude category',
			'description'	=> 'Exclude this blog category from listed on blog',
			'option'		=> j_get_blog_category(),
			'value'			=> j_get_option('blog_exclude', array())
		),
		array (
			'id' 			=> 'blog_hidemeta',
			'type'			=> 'switchtoogle',
			'title'			=> 'Hide blog meta',
			'description'	=> 'Hide blog meta detail. Turn on this option if you don\'t want to show post detail including who write post and when post is published',
			'value'			=> j_get_option('blog_hidemeta' , 0)
		)
		,array (
			'id' 			=> 'blog_hide_comment',
			'type'			=> 'switchtoogle',
			'title'			=> 'Hide blog comment',
			'description'	=> 'Show blog comment box. Turn on this option if you don\'t want your visitor show comment boxes',
			'value'			=> j_get_option('blog_hide_comment' , 0)
		)
		,array (
			'id' 			=> 'show_full_blog',
			'type'			=> 'switchtoogle',
			'title'			=> 'Show full blog content on blog page',
			'description'	=> 'Show full blog content on blog page instead of blog summary',
			'value'			=> j_get_option('show_full_blog' , 0)
		)
	);
	
	$portfolio = array(			
		array (
			'id' 			=> 'portfolio_like',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable Like function',
			'description'	=> 'Enable Like function on portfolio',
			'value'			=> j_get_option('portfolio_like' , 1)
		),
		/* move this option to metabox
		array (
			'id' 			=> 'portfolio_filter',
			'type'			=> 'switchtoogle',
			'title'			=> 'Show portfolio filter',
			'description'	=> 'Show portfolio filter in top of portfolio item',
			'value'			=> j_get_option('portfolio_filter' , 1)
		),
		*/
		array (
			'id' 			=> 'social_sharer',
			'type'			=> 'switchtoogle',
			'title'			=> 'Show social sharer (fb like & twitter share)',
			'description'	=> 'Show social sharer (fb like & twitter share) when portfolio item expanded',
			'value'			=> j_get_option('social_sharer' , 1)
		),
		array (
			'id' 			=> 'flex_slide_speed',
			'type'			=> 'text',
			'title'			=> 'Expanded image gallery slide speed',
			'description'	=> 'slide speed when image gallery expanded in milisecond, default is 7000 (7 second)',
			'value'			=> j_get_option('flex_slide_speed', '7000')
		),
		array (
			'id' 			=> 'zoom_slide_speed',
			'type'			=> 'text',
			'title'			=> 'Zoomed image gallery slide speed',
			'description'	=> 'slide speed when image gallery zoomed in milisecond, default is 7000 (7 second)',
			'value'			=> j_get_option('zoom_slide_speed', '7000')
		),
		array (
			'id' 			=> 'direction_nav',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable image slider direction nav on portfolio',
			'description'	=> 'Turn this option if you want enabled direction navigation when portfolio expanded. Direction navigation will show arrow above sliding image. you can use this option as alternative image navigation',
			'value'			=> j_get_option('direction_nav' , 0)
		),
		array (
			'id' 			=> 'control_nav',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable image slider control navigation on portfolio',
			'description'	=> 'Disable this option if you want want to see dot bellow image slider.',
			'value'			=> j_get_option('control_nav' , 1)
		),
		array (
			'id' 			=> 'uncroped_bg_color',
			'type'			=> 'colorpicker',
			'title'			=> 'Background color for uncroped image',
			'description'	=> 'set background color for uncroped image (if you are using uncroped on portfolio)',
			'value'			=> j_get_option('uncroped_bg_color', '000000')
		),
	);
	
	$page = array(
		array (
			'id' 			=> 'page_gallery',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable JPhotolio shortcode override implementation for gallery',
			'description'	=> 'You can disable shortcode implementation for gallery shortcode and use native wordpress implementation. 
								You may want to use another image gallery plugin that will override 
								gallery behaviour instead using themes default image gallery implementation.',
			'value'			=> j_get_option('page_gallery' , 1)
		),
		
		array (
			'id' 			=> 'use_lighbox',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable to use lightbox instead of photoswipe for showing gallery on page or blog',
			'description'	=> 'Enable usage of lightbox, and disable photoswipe for zoomed image gallery on page or blog',
			'value'			=> j_get_option('use_lighbox' , 0)
		),
	);
	
	return array(
		'Front Slider'		=> $fontslider,
		'Blog'				=> $blog,
		'Portfolio'			=> $portfolio,
		'Page'				=> $page
	);
}


function jeg_admin_contact_setting()
{
	$contactusage = array(
		array(
			'id' 			=> 'use_contact_map',
			'type'			=> 'switchtoogle',
			'title'			=> 'Check if you are using map as background',
			'description'	=> 'Check if you are using map as background, you will need to fill location data',
			'value'			=> j_get_option('use_contact_map' , 1)
		),
		array (
			'id' 			=> 'contact_picture_background',
			'type'			=> 'upload',
			'title'			=> 'Contact picture background',
			'description'	=> 'You can define background for contact page. fill this option only if you are turn above option off.',
			'value'			=> j_get_option('contact_picture_background')
		),
	);
	
	$contactdata = array(
		array(
			'id'			=> 'zoomfactor',
			'type'			=> 'text',
			'title'			=> 'Zoom Factor',
			'description'	=> 'Zoom factor for the map, this option will only aplicable when only one location available',
			'value'			=> j_get_option('zoomfactor', 10)
		),
		array (
			'id' 			=> 'show_contact_map',
			'type'			=> 'switchtoogle',
			'title'			=> 'Show map first ',
			'description'	=> 'Show map first instead of contact form',
			'value'			=> j_get_option('show_contact_map' , 0)
		),
		array(
			'id'			=> 'mapdata',
			'type'			=> 'mapdata',
			'title'			=> 'Create location data',
			'value'			=> j_get_option('mapdata')
		)
	);
	
	$contactdetail = array(
		array (
			'id' 			=> 'email_from',
			'type'			=> 'text',
			'title'			=> 'Email Sender',
			'description'	=> 'Set the From e-mail for all outgoing message. <br>Ex : info@yourdomain.com',
			'value'			=> j_get_option('email_from', 'your@email.com')
		),
		array (
			'id' 			=> 'email_from_name',
			'type'			=> 'text',
			'title'			=> 'Sender Name',
			'description'	=> 'Sets the From name for all outgoing messages. <br> Example : Jegphotolio Contact Information',
			'value'			=> j_get_option('email_from_name', 'Your company contact information')
		),
		array (
			'id' 			=> 'email_subject',
			'type'			=> 'text',
			'title'			=> 'Email Subject to Requester',
			'description'	=> 'Ex : Contact notification from Jegphotolio <br> <b>Formating :</b> <br>{email} will become requester email <br> {name} will become requester name',
			'value'			=> j_get_option('email_subject', 'Contact from {name} to yourcompany.com')
		)
	);
	
	$smtp = array(
		array (
			'id' 			=> 'use_smtp',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable SMTP for sending email',
			'description'	=> 'You can use this setting for sending email through SMTP. Google email / apps use this setting for sending email',
			'value'			=> j_get_option('use_smtp' , 0)
		),
		array (
			'id' 			=> 'smtp_prefix',
			'type'			=> 'select',
			'title'			=> 'SMTP Connection Prefix',
			'description'	=> 'Sets connection prefix for secure connections',
			'option'		=> array(
				'ssl'		=> 'ssl',
				'tls' 		=> 'tls',
			),
			'value'		=> j_get_option('smtp_prefix', 'ssl')
		),
		array (
			'id' 			=> 'smtp_host',
			'type'			=> 'text',
			'title'			=> 'SMTP Host',
			'description'	=> 'SMTP host &amp; protocol, <br>default for google mail / apps : ssl://smtp.googlemail.com',
			'value'			=> j_get_option('smtp_host' , 'smtp.googlemail.com')
		),
		array (
			'id' 			=> 'smtp_port',
			'type'			=> 'text',
			'title'			=> 'SMTP Port',
			'description'	=> 'SMTP port, <br>default for google mail / apps : 465 or 25',
			'value'			=> j_get_option('smtp_port' , '465')
		),
		array (
			'id' 			=> 'smtp_user',
			'type'			=> 'text',
			'title'			=> 'SMTP Username',
			'description'	=> 'SMTP username, don\'t use same email address as Sender email<br> ex : noreply@yourdomain.com',
			'value'			=> j_get_option('smtp_user')
		),
		array (
			'id' 			=> 'smtp_pass',
			'type'			=> 'password',
			'title'			=> 'SMTP Password',
			'description'	=> 'Fill your smtp password',
			'value'			=> j_get_option('smtp_pass')
		),
		array (
			'id' 			=> 'enable_smtp_loging',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable smtp debuging',
			'description'	=> 'Enable this option only if you found problem when trying to send email. You can analize what problem with SMTP using this option from ajax request. <br/>or before requesting for support about email, you need to enable this option.',
			'value'			=> j_get_option('enable_smtp_loging' , 0)
		),
	);
	
	$emailstyle = array(
		array (
			'id' 			=> 'email_logo',
			'type'			=> 'upload',
			'title'			=> 'Email logo',
			'description'	=> 'Upload your email logo',
			'value'			=> j_get_option('email_logo')
		),
		array (
			'id' 			=> 'email_head_color',
			'type'			=> 'colorpicker',
			'title'			=> 'Email head background color',
			'description'	=> 'background color for email header',
			'value'			=> j_get_option('email_head_color', 'FFFFFF')
		),
		array (
			'id' 			=> 'email_body_color',
			'type'			=> 'colorpicker',
			'title'			=> 'Email body background color',
			'description'	=> 'background color for email body',
			'value'			=> j_get_option('email_body_color', 'F1FAD9')
		),
		array (
			'id' 			=> 'email_body_text_color',
			'type'			=> 'colorpicker',
			'title'			=> 'Email body text color',
			'description'	=> 'text color for email body',
			'value'			=> j_get_option('email_body_text_color', '000000')
		),
		array (
			'id' 			=> 'email_footer_text',
			'type'			=> 'text',
			'title'			=> 'Footer text',
			'description'	=> 'text on footer',
			'value'			=> j_get_option('email_footer_text', '&copy 2011 - 2012 By your comany name')
		),
		array (
			'id' 			=> 'email_body_text',
			'type'			=> 'tinymce',
			'title'			=> 'Body Text',
			'description'	=> '{email} for showing client email<br>{name} for showing client name<br>{message} for showing what message they sent<br>',
			'value'			=> j_get_option('email_body_text', '<p>Hello, {name}</p>,
								<p>Thanks for contacting us.</p>
								<p>We have receive your message.</p>
								<p>Your message detail : </p>
								<p>Your name : {name} </p>
								<p>Email  : {email} </p>								
								<p>Message : </p>
								<p>"{message}"</p>
								<p>We will reply your email as soon as possible</p>
								<p>Thank you, </p>
								<p>Your company name</p>')
		),
		array (			
			'type'			=> 'try_email',
			'title'			=> 'View your email template (Don\'t forget to save option before viewing email template) ',
			'description'	=> 'View your edited email. If you need more customization with email template, you can find email template on Jphotolio template folder &raquo; lib &raquo; template &raquo; email-template.phtml. It may require you to understand html, css and little about php'			
		),
		
	);
	
	return array(
		'Contact picture'			=> $contactusage, 
		'Location data'				=> $contactdata ,
		'Email detail'				=> $contactdetail ,
		'Email style &amp; Content'	=> $emailstyle ,
		'SMTP config'				=> $smtp
	);
}
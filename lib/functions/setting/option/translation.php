<?php
/**
 * @author Jegbagus
 */
function jeg_admin_translation () {
	
	$general = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'General Lang'
		),
		array (
			'id' 			=> 'parameter_not_complete_lang',
			'type'			=> 'text',
			'title'			=> 'Parameter Not Complete',
			'description'	=> '',
			'value'			=> j_get_option('parameter_not_complete_lang', 'Parameter Not Complete')
		),
		array (
			'id' 			=> 'db_error_lang',
			'type'			=> 'text',
			'title'			=> 'Internal DB Error',
			'description'	=> '',
			'value'			=> j_get_option('db_error_lang', 'Internal DB Error')
		),
		array (
			'id' 			=> 'db_error_lang',
			'type'			=> 'text',
			'title'			=> 'Internal DB Error',
			'description'	=> '',
			'value'			=> j_get_option('db_error_lang', 'Internal DB Error')
		),
		array (
			'id' 			=> '404_lang',
			'type'			=> 'text',
			'title'			=> '404 Error',
			'description'	=> '',
			'value'			=> j_get_option('404_lang', 'It look like the page you\'re looking for doesn\'t exist, sorry')
		),
		array (
			'id' 			=> 'more_detail',
			'type'			=> 'text',
			'title'			=> 'More detail text',
			'description'	=> '',
			'value'			=> j_get_option('more_detail', 'More Detail')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Page Title'
		),
		array (
			'id' 			=> 'tag_archive_title_lang',
			'type'			=> 'text',
			'title'			=> 'Tag archive title',
			'description'	=> '',
			'value'			=> j_get_option('tag_archive_title_lang', 'Tag archive for &quot;%s&quot; %s ')
		),
		array (
			'id' 			=> 'post_filled_title_lang',
			'type'			=> 'textarea',
			'title'			=> 'Category archive title',
			'description'	=> '',
			'value'			=> j_get_option('post_filled_title_lang', 'Post filed under &quot;%s&quot; %s ')
		),
		array (
			'id' 			=> 'post_written_title_lang',
			'type'			=> 'text',
			'title'			=> 'Author archive title',
			'description'	=> '',
			'value'			=> j_get_option('post_written_title_lang', 'Post written by &quot;%s&quot; %s ')
		),
		array (
			'id' 			=> 'archive_title_lang',
			'type'			=> 'text',
			'title'			=> 'Archive text',
			'description'	=> '',
			'value'			=> j_get_option('archive_title_lang', ' archive ')
		),
		array (
			'id' 			=> 'search_for_title_lang',
			'type'			=> 'textarea',
			'title'			=> 'Search archive title',
			'description'	=> '',
			'value'			=> j_get_option('search_for_title_lang', 'Search for &quot;%s&quot; %s ')
		),
		array (
			'id' 			=> 'not_found_lang',
			'type'			=> 'text',
			'title'			=> 'Not found title',
			'description'	=> '',
			'value'			=> j_get_option('not_found_lang', 'Not found')
		),
		array (
			'id' 			=> 'page_title_lang',
			'type'			=> 'text',
			'title'			=> 'Page title',
			'description'	=> '',
			'value'			=> j_get_option('page_title_lang', ' Page ')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Header'
		),
		array (
			'id' 			=> 'navigate_lang',
			'type'			=> 'text',
			'title'			=> 'Navigation responsive text',
			'description'	=> '',
			'value'			=> j_get_option('navigate_lang', 'Navigate ...')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Search'
		),
		array (
			'id' 			=> 'search',
			'type'			=> 'text',
			'title'			=> 'Search',
			'description'	=> '',
			'value'			=> j_get_option('search', 'Search')
		),
		array (
			'id' 			=> 'search_for_lang',
			'type'			=> 'text',
			'title'			=> 'Search title',
			'description'	=> '',
			'value'			=> j_get_option('search_for_lang', 'Search for : <b>%s</b>')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Share Text'
		),
		array (
			'id' 			=> 'share_on_twitter_lang',
			'type'			=> 'text',
			'title'			=> 'Share twitter',
			'description'	=> '',
			'value'			=> j_get_option('share_on_twitter_lang', 'Share on Twitter')
		),
		array (
			'id' 			=> 'share_on_facebook_lang',
			'type'			=> 'text',
			'title'			=> 'Share facebook',
			'description'	=> '',
			'value'			=> j_get_option('share_on_facebook_lang', 'Share on Facebook')
		),
		array (
			'id' 			=> 'share_on_google_lang',
			'type'			=> 'text',
			'title'			=> 'Share Google Plus',
			'description'	=> '',
			'value'			=> j_get_option('share_on_google_lang', 'Share on Google Plus')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Music Playlist'
		),
		array (
			'id' 			=> 'music_playlist_lang',
			'type'			=> 'text',
			'title'			=> 'Music playlist header',
			'description'	=> '',
			'value'			=> j_get_option('music_playlist_lang', 'Music Playlist')
		),
		array (
			'id' 			=> 'playlist_muted_lang',
			'type'			=> 'text',
			'title'			=> 'Music playlist muted',
			'description'	=> '',
			'value'			=> j_get_option('playlist_muted_lang', 'Music Playlist Muted')
		),
		array (
			'id' 			=> 'playlist_unmuted_lang',
			'type'			=> 'text',
			'title'			=> 'Music playlist unmuted',
			'description'	=> '',
			'value'			=> j_get_option('playlist_unmuted_lang', 'Music Playlist Unmuted')
		),
		array (
			'id' 			=> 'playlist_start_play',
			'type'			=> 'text',
			'title'			=> 'Music playlist starting play',
			'description'	=> '',
			'value'			=> j_get_option('playlist_start_play', 'Playlist started')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Image Gallery Page'
		),
		array (
			'id' 			=> 'image_gallery_loading',
			'type'			=> 'text',
			'title'			=> 'Loading More Image text',
			'description'	=> '',
			'value'			=> j_get_option('image_gallery_loading', 'Loading More Image')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Sitemap Page'
		),
		array (
			'id' 			=> 'sitemap_portfolio',
			'type'			=> 'text',
			'title'			=> 'Sitemap Portfolio text',
			'description'	=> '',
			'value'			=> j_get_option('sitemap_portfolio', 'Portfolio')
		),
		array (
			'id' 			=> 'sitemap_frontslider',
			'type'			=> 'text',
			'title'			=> 'Sitemap front slider text',
			'description'	=> '',
			'value'			=> j_get_option('sitemap_frontslider', 'Front Slider')
		),
		array (
			'id' 			=> 'sitemap_page',
			'type'			=> 'text',
			'title'			=> 'Sitemap page text',
			'description'	=> '',
			'value'			=> j_get_option('sitemap_page', 'Page')
		),
		array (
			'id' 			=> 'sitemap_blog',
			'type'			=> 'text',
			'title'			=> 'Sitemap blog text',
			'description'	=> '',
			'value'			=> j_get_option('sitemap_blog', 'Blog')
		),
		array (
			'id' 			=> 'sitemap_portfolio_category',
			'type'			=> 'text',
			'title'			=> 'Sitemap portfolio category text',
			'description'	=> '',
			'value'			=> j_get_option('sitemap_portfolio_category', 'Portfolio Category')
		),
		array (
			'id' 			=> 'sitemap_blog_category',
			'type'			=> 'text',
			'title'			=> 'Sitemap blog category text',
			'description'	=> '',
			'value'			=> j_get_option('sitemap_blog_category', 'Blog Category')
		),
		array (
			'id' 			=> 'sitemap_blog_tag',
			'type'			=> 'text',
			'title'			=> 'Sitemap blog tag text',
			'description'	=> '',
			'value'			=> j_get_option('sitemap_blog_tag', 'Blog Tag')
		),
	);
	
	$blog = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog'
		),
		array (
			'id' 			=> 'no_post_available_lang',
			'type'			=> 'text',
			'title'			=> 'No post available',
			'description'	=> '',
			'value'			=> j_get_option('no_post_available_lang', 'No Post Available')
		),		
		array (
			'id' 			=> 'read_more_lang',
			'type'			=> 'text',
			'title'			=> 'Read more',
			'description'	=> '',
			'value'			=> j_get_option('read_more_lang', ' Read more ..')
		),
		array (
			'id' 			=> 'page_of_lang',
			'type'			=> 'textarea',
			'title'			=> 'Paging text',
			'description'	=> '',
			'value'			=> j_get_option('page_of_lang', 'Page %d of %d')
		),
		
		array (
			'id' 			=> 'prev_pos',
			'type'			=> 'text',
			'title'			=> 'Previous Post',
			'description'	=> '',
			'value'			=> j_get_option('prev_pos', ' Previous Post')
		),
		array (
			'id' 			=> 'next_pos',
			'type'			=> 'text',
			'title'			=> 'Next Post',
			'description'	=> '',
			'value'			=> j_get_option('next_pos', 'Next Post')
		),
						
		array(
			'type'			=> 'heading',
			'title'			=> 'Archive Box Title'
		),
		array (
			'id' 			=> 'tag_archive_for_lang',
			'type'			=> 'textarea',
			'title'			=> 'Text archive blog title box',
			'description'	=> '',
			'value'			=> j_get_option('tag_archive_for_lang', 'Tag archive for : <b>%s</b>')
		),
		array (
			'id' 			=> 'post_filled_under_lang',
			'type'			=> 'textarea',
			'title'			=> 'Post filled title box',
			'description'	=> '',
			'value'			=> j_get_option('post_filled_under_lang', 'Post filled under : <b>%s</b>')
		),
		array (
			'id' 			=> 'post_written_by_lang',
			'type'			=> 'textarea',
			'title'			=> 'Post writen title box',
			'description'	=> '',
			'value'			=> j_get_option('post_written_by_lang', 'Post written by : <b>%s</b>')
		),
		array (
			'id' 			=> 'date_archive_lang',
			'type'			=> 'textarea',
			'title'			=> 'Date archive title box',
			'description'	=> '',
			'value'			=> j_get_option('date_archive_lang', '%s - Archive')
		),
		array (
			'id' 			=> 'filled_under_lang',
			'type'			=> 'textarea',
			'title'			=> 'Post filled under single post template',
			'description'	=> '',
			'value'			=> j_get_option('filled_under_lang', '<p>Filled Under :  %s </p>')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Comment'
		),
		array (
			'id' 			=> 'comment_email_lang',
			'type'			=> 'text',
			'title'			=> 'Comment Email',
			'description'	=> '',
			'value'			=> j_get_option('comment_email_lang', 'Email')
		),
		array (
			'id' 			=> 'comment_website_lang',
			'type'			=> 'text',
			'title'			=> 'Comment Website',
			'description'	=> '',
			'value'			=> j_get_option('comment_website_lang', 'Website')
		),		
		array (
			'id' 			=> 'login_to_comment_lang',
			'type'			=> 'textarea',
			'title'			=> 'Login to comment',
			'description'	=> '',
			'value'			=> j_get_option('login_to_comment_lang', 'You must be <a href="%s">logged in</a> to post a comment.')
		),
		array (
			'id' 			=> 'new_login_as_lang',
			'type'			=> 'textarea',
			'title'			=> 'Login As',
			'description'	=> '',
			'value'			=> j_get_option('new_login_as_lang', 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>')
		),
		array (
			'id' 			=> 'comment_email_not_publish_lang',
			'type'			=> 'text',
			'title'			=> 'Comment Email not published',
			'description'	=> '',
			'value'			=> j_get_option('comment_email_not_publish_lang', 'Your email address will not be published.')
		),
		array (
			'id' 			=> 'comment_markup_lang',
			'type'			=> 'textarea',
			'title'			=> 'Comment bottom markup',
			'description'	=> '',
			'value'			=> j_get_option('comment_markup_lang', 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s')
		),
		
		array (
			'id' 			=> 'comment_leave_reply_lang',
			'type'			=> 'text',
			'title'			=> 'Leave a reply',
			'description'	=> '',
			'value'			=> j_get_option('comment_leave_reply_lang', 'Leave a Reply')
		),
		array (
			'id' 			=> 'comment_leave_reply_to_lang',
			'type'			=> 'textarea',
			'title'			=> 'Leave a reply to',
			'description'	=> '',
			'value'			=> j_get_option('comment_leave_reply_to_lang', 'Leave a Reply to %s')
		),
		array (
			'id' 			=> 'comment_cancel_reply_lang',
			'type'			=> 'text',
			'title'			=> 'Cancel reply',
			'description'	=> '',
			'value'			=> j_get_option('comment_cancel_reply_lang', 'Cancel reply')
		),
		array (
			'id' 			=> 'comment_post_comment_lang',
			'type'			=> 'text',
			'title'			=> 'Post comment',
			'description'	=> '',
			'value'			=> j_get_option('comment_post_comment_lang', 'Post Comment')
		),
		array (
			'id' 			=> 'comment_required_field_lang',
			'type'			=> 'text',
			'title'			=> 'Required Filed are marked ',
			'description'	=> '',
			'value'			=> j_get_option('comment_required_field_lang', 'Required fields are marked %s')
		),
		array (
			'id' 			=> 'comment_textarea_lang',
			'type'			=> 'text',
			'title'			=> 'Comment ',
			'description'	=> '',
			'value'			=> j_get_option('comment_textarea_lang', 'Comment')
		),
		
		array(
			'type'			=> 'heading',
			'title'			=> 'Comment Numbers Count'
		),
		array (
			'id' 			=> 'zerocomment_lang',
			'type'			=> 'text',
			'title'			=> '0 Comment',
			'description'	=> '',
			'value'			=> j_get_option('zerocomment_lang', '0 Comment')
		),
		array (
			'id' 			=> 'onecomment_lang',
			'type'			=> 'text',
			'title'			=> '1 Comment',
			'description'	=> '',
			'value'			=> j_get_option('onecomment_lang', '1 Comment')
		),
		array (
			'id' 			=> 'morecomment_lang',
			'type'			=> 'text',
			'title'			=> '% Comments',
			'description'	=> '',
			'value'			=> j_get_option('morecomment_lang', '% Comments')
		),
		
	);
	
	$contact = array(
		array (
			'id' 			=> 'contact_us_lang',
			'type'			=> 'text',
			'title'			=> 'Contact Us text',
			'description'	=> '',
			'value'			=> j_get_option('contact_us_lang', 'Contact Us')
		),
		array (
			'id' 			=> 'contact_detail_lang',
			'type'			=> 'text',
			'title'			=> 'Contact detail text',
			'description'	=> '',
			'value'			=> j_get_option('contact_detail_lang', 'Contact Detail')
		),
		array (
			'id' 			=> 'contact_form_lang',
			'type'			=> 'text',
			'title'			=> 'Contact form text',
			'description'	=> '',
			'value'			=> j_get_option('contact_form_lang', 'Contact Form')
		),
		array (
			'id' 			=> 'contact_location_lang',
			'type'			=> 'text',
			'title'			=> 'Location text',
			'description'	=> '',
			'value'			=> j_get_option('contact_location_lang', 'Our Location')
		),
		array (
			'id' 			=> 'click_view_map',
			'type'			=> 'text',
			'title'			=> 'View map direction',
			'description'	=> '',
			'value'			=> j_get_option('click_view_map', 'click for view map detail')
		),		
		array (
			'id' 			=> 'contact_message',
			'type'			=> 'text',
			'title'			=> 'Contact message',
			'description'	=> '',
			'value'			=> j_get_option('contact_message', 'Message')
		),
		array (
			'id' 			=> 'contact_send',
			'type'			=> 'text',
			'title'			=> 'Contact send button',
			'description'	=> '',
			'value'			=> j_get_option('contact_send', 'Send Contact')
		),
		array (
			'id' 			=> 'cantgetdirection_lang',
			'type'			=> 'text',
			'title'			=> 'Cannot get direction notification',
			'description'	=> '',
			'value'			=> j_get_option('cantgetdirection_lang', 'Cannot get direction . . . ')
		),
		array (
			'id' 			=> 'dummyposition_lang',
			'type'			=> 'text',
			'title'			=> 'Use dummy direction',
			'description'	=> '',
			'value'			=> j_get_option('dummyposition_lang', 'Can\'t get direction, use dummy position . . . ')
		),
		array (
			'id' 			=> 'geonotsupport_lang',
			'type'			=> 'text',
			'title'			=> 'Browser not support geolocation notification',
			'description'	=> '',
			'value'			=> j_get_option('geonotsupport_lang', 'Your browser don\'t support Geolocation . . .')
		),
		array (
			'id' 			=> 'contact_lang',
			'type'			=> 'text',
			'title'			=> 'Name',
			'description'	=> '',
			'value'			=> j_get_option('contact_lang', 'Name')
		),
		array (
			'id' 			=> 'entername_lang',
			'type'			=> 'text',
			'title'			=> 'Enter your name',
			'description'	=> '',
			'value'			=> j_get_option('entername_lang', 'Please enter your name')
		),
		array (
			'id' 			=> 'nameminlength_lang',
			'type'			=> 'text',
			'title'			=> 'Name minimum character notification',
			'description'	=> '',
			'value'			=> j_get_option('nameminlength_lang', 'At least {0} characters required')
		),
		array (
			'id' 			=> 'enteremail_lang',
			'type'			=> 'text',
			'title'			=> 'Enter Email',
			'description'	=> '',
			'value'			=> j_get_option('enteremail_lang', 'Please enter your email')
		),
		array (
			'id' 			=> 'contact_email',
			'type'			=> 'text',
			'title'			=> 'Email',
			'description'	=> '',
			'value'			=> j_get_option('contact_email', 'Your email')
		),
		array (
			'id' 			=> 'validemail_lang',
			'type'			=> 'text',
			'title'			=> 'Enter valid email',
			'description'	=> '',
			'value'			=> j_get_option('validemail_lang', 'Please enter a valid email')
		),
		array (
			'id' 			=> 'entermessage_lang',
			'type'			=> 'text',
			'title'			=> 'Enter message',
			'description'	=> '',
			'value'			=> j_get_option('entermessage_lang', 'Please enter a message')
		),
		array (
			'id' 			=> 'messageminlength_lang',
			'type'			=> 'text',
			'title'			=> 'Message minimum character notification',
			'description'	=> '',
			'value'			=> j_get_option('messageminlength_lang', 'At least {0} characters required')
		),
		array (
			'id' 			=> 'sendmessage_lang',
			'type'			=> 'text',
			'title'			=> 'Send message text',
			'description'	=> '',
			'value'			=> j_get_option('sendmessage_lang', 'Sending message . . .')
		),
		array (
			'id' 			=> 'messagesent_lang',
			'type'			=> 'text',
			'title'			=> 'Message sent text',
			'description'	=> '',
			'value'			=> j_get_option('messagesent_lang', 'Message Sent . . . ')
		),
		array (
			'id' 			=> 'failsentmessage',
			'type'			=> 'text',
			'title'			=> 'Failed to send message notification',
			'description'	=> '',
			'value'			=> j_get_option('failsentmessage', 'Fail to send message . . .')
		),
		array (
			'id' 			=> 'getdirection_lang',
			'type'			=> 'text',
			'title'			=> 'Click to get direction',
			'description'	=> '',
			'value'			=> j_get_option('getdirection_lang', 'Click to get direction')
		),		
	);
	
	$portfolio = array(
		array (
			'id' 			=> 'portfolio_all_filter_lang',
			'type'			=> 'text',
			'title'			=> 'All text on portfolio filter',
			'description'	=> '',
			'value'			=> j_get_option('portfolio_all_filter_lang', 'All')
		),
		array (
			'id' 			=> 'click_to_zoom_lang',
			'type'			=> 'text',
			'title'			=> 'Click to zoom lang',
			'description'	=> '',
			'value'			=> j_get_option('click_to_zoom_lang', 'Click to zoom')
		),
		array (
			'id' 			=> 'disableclick',
			'type'			=> 'text',
			'title'			=> 'Disable Right Mouse Click',
			'description'	=> '',
			'value'			=> j_get_option('disableclick', 'Disable Right Mouse Click')
		),
		array (
			'id' 			=> 'no_playback_lang',
			'type'			=> 'text',
			'title'			=> 'No video playback capability',
			'description'	=> '',
			'value'			=> j_get_option('no_playback_lang', 'No video playback capabilities')
		),	
		array (
			'id' 			=> 'more_in_portfolio_lang',
			'type'			=> 'text',
			'title'			=> 'More portfolio',
			'description'	=> '',
			'value'			=> j_get_option('more_in_portfolio_lang', 'More in portofolio')
		),	
		array (
			'id' 			=> 'previous_lang',
			'type'			=> 'text',
			'title'			=> 'Previous text',
			'description'	=> '',
			'value'			=> j_get_option('previous_lang', 'Previous')
		),	
		array (
			'id' 			=> 'next_lang',
			'type'			=> 'text',
			'title'			=> 'Next text',
			'description'	=> '',
			'value'			=> j_get_option('next_lang', 'Next')
		),
		array (
			'id' 			=> 'have_voted_lang',
			'type'			=> 'text',
			'title'			=> 'Have liked portfolio',
			'description'	=> '',
			'value'			=> j_get_option('have_voted_lang', 'Have Voted')
		),
		array (
			'id' 			=> 'thanks_vote_lang',
			'type'			=> 'text',
			'title'			=> 'Thanks for vote text',
			'description'	=> '',
			'value'			=> j_get_option('thanks_vote_lang', 'Thanks for your vote!')
		),
		array (
			'id' 			=> 'likethis_lang',
			'type'			=> 'text',
			'title'			=> 'Like this lang',
			'description'	=> '',
			'value'			=> j_get_option('likethis_lang', 'Like this')
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Protected Portfolio'
		),
		array (
			'id' 			=> 'protected_portfolio_lang',
			'type'			=> 'text',
			'title'			=> 'Protected Portfolio',
			'description'	=> '',
			'value'			=> j_get_option('protected_portfolio_lang', 'Protected Portfolio')
		),
		array (
			'id' 			=> 'password_placeholder_lang',
			'type'			=> 'text',
			'title'			=> 'Password placeholder',
			'description'	=> '',
			'value'			=> j_get_option('password_placeholder_lang', 'Password')
		),
		array (
			'id' 			=> 'portfolio_submit_lang',
			'type'			=> 'text',
			'title'			=> 'Password Submit Button',
			'description'	=> '',
			'value'			=> j_get_option('portfolio_submit_lang', 'Submit')
		),
		array (
			'id' 			=> 'portfolio_prev',
			'type'			=> 'text',
			'title'			=> 'Previous Portfolio',
			'description'	=> '',
			'value'			=> j_get_option('portfolio_prev', 'Previous Portfolio')
		),
		array (
			'id' 			=> 'portfolio_next',
			'type'			=> 'text',
			'title'			=> 'Next Portfolio',
			'description'	=> '',
			'value'			=> j_get_option('portfolio_next', 'Next Portfolio')
		),
	);
	
	$comment = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Blog Comment'
		),
		array (
			'id' 			=> 'comment_password_protected_lang',
			'type'			=> 'text',
			'title'			=> 'Comment text for password protected post',
			'description'	=> '',
			'value'			=> j_get_option('comment_password_protected_lang', 'This post is password protected. Enter the password to view any comments.')
		),
		array (
			'id' 			=> 'no_comment_lang',
			'type'			=> 'text',
			'title'			=> 'No comment text',
			'description'	=> '',
			'value'			=> j_get_option('no_comment_lang', 'No Comments')
		),
		array (
			'id' 			=> 'one_comment_lang',
			'type'			=> 'text',
			'title'			=> 'One comment',
			'description'	=> '',
			'value'			=> j_get_option('one_comment_lang', '1 Comment')
		),
		array (
			'id' 			=> 'more_comment_lang',
			'type'			=> 'text',
			'title'			=> 'More comment',
			'description'	=> '',
			'value'			=> j_get_option('more_comment_lang', '% Comments')
		),
		array (
			'id' 			=> 'login_comment_lang',
			'type'			=> 'text',
			'title'			=> 'Comment need login',
			'description'	=> '',
			'value'			=> j_get_option('login_comment_lang', '<p>Please login to comment.</p>')
		),
		array (
			'id' 			=> 'leave_comment_lang',
			'type'			=> 'text',
			'title'			=> 'Leave comment text',
			'description'	=> '',
			'value'			=> j_get_option('leave_comment_lang', 'Leave Comment')
		),
		array (
			'id' 			=> 'name_lang',
			'type'			=> 'text',
			'title'			=> 'Comment user name',
			'description'	=> '',
			'value'			=> j_get_option('name_lang', 'Name')
		),
		array (
			'id' 			=> 'your_email_lang',
			'type'			=> 'text',
			'title'			=> 'Comment user email ',
			'description'	=> '',
			'value'			=> j_get_option('your_email_lang', 'Your Email')
		),
		array (
			'id' 			=> 'website_lang',
			'type'			=> 'text',
			'title'			=> 'Comment user website',
			'description'	=> '',
			'value'			=> j_get_option('website_lang', 'Website')
		),
		array (
			'id' 			=> 'login_as_lang',
			'type'			=> 'textarea',
			'title'			=> 'Login and Logout link',
			'description'	=> '',
			'value'			=> j_get_option('login_as_lang', 'Login as  <b>"%s"</b> , <a href=%s>Not you? Logout. </a>')
		),
		array (
			'id' 			=> 'comment_lang',
			'type'			=> 'text',
			'title'			=> 'Comment text',
			'description'	=> '',
			'value'			=> j_get_option('comment_lang', 'Comment')
		),
		array (
			'id' 			=> 'send_comment_lang',
			'type'			=> 'text',
			'title'			=> 'Send comment button',
			'description'	=> '',
			'value'			=> j_get_option('send_comment_lang', 'Send Comment')
		),
		array (
			'id' 			=> 'comment_moderation_lang',
			'type'			=> 'text',
			'title'			=> 'Comment awaiting moderation',
			'description'	=> '',
			'value'			=> j_get_option('comment_moderation_lang', '<em>Your comment is awaiting moderation</em>')
		),
		
		array (
			'id' 			=> 'reply_comment_lang',
			'type'			=> 'text',
			'title'			=> 'Reply comment',
			'description'	=> '',
			'value'			=> j_get_option('reply_comment_lang', 'Reply')
		),
		array (
			'id' 			=> 'cancel_reply_comment_lang',
			'type'			=> 'text',
			'title'			=> 'Cancel Reply comment',
			'description'	=> '',
			'value'			=> j_get_option('cancel_reply_comment_lang', 'Cancel Reply')
		),
		
	);
	
	$setting = array(
		array (
			'id' 			=> 'enable_translation',
			'type'			=> 'switchtoogle',
			'title'			=> 'Use build in translation',
			'description'	=> 'When this option enabled, than you will use theme build in translation. Other tab on this page will control your website translation. <br> But when it turned off, you need to configure .mo files to translate the website.',
			'value'			=> j_get_option('enable_translation' , 1)
		),
		/*
		array (
			'id' 			=> 'default_locale',
			'type'			=> 'text',
			'title'			=> 'Default locale',
			'description'	=> 'When you use',
			'value'			=> j_get_option('default_locale', 'en_US')
		),
		*/
	);
	
	return array(
		'Setting'		=> $setting,
		'General'		=> $general,
		'Blog'			=> $blog,
		'Contact'		=> $contact,
		'Portfolio'		=> $portfolio,
		'Comment'		=> $comment
	);
}
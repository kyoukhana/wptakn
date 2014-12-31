<?php

function jeg_admin_music_playlist () {
	
	$musicicon = array(
		array (
			'id' 			=> 'show_music_icon',
			'type'			=> 'switchtoogle',
			'title'			=> 'Show music icon on right bottom bar',
			'description'	=> 'check if you want to show music icon on bottom of bar. disable it if you don\'t want your website visitor control playlist behaviour.',
			'value'			=> j_get_option('show_music_icon', 0)
		),
		array (
			'id' 			=> 'misc_playlist_icon',
			'type'			=> 'iconsetting',
			'title'			=> 'Misc Icon',
			'value'			=> j_get_option('misc_playlist_icon'),
			'icons'			=> array('misc-magnifying-glass','misc-trashcan','misc-trashcan2','misc-presentation','misc-download-to-computer','misc-download','misc-upload','misc-flag','misc-flag2','misc-finish-flag','misc-winner-podium','misc-cup',
								'misc-home','misc-home2','misc-link','misc-link2','misc-note-book','misc-book','misc-book-large','misc-books','misc-tree','misc-under-construction','misc-umbrella','misc-mail','misc-help','misc-rss','misc-strategy','misc-strategy2',
								'misc-apartment-building','misc-companies','misc-pacman-ghost','misc-pacman','misc-vault','misc-archive','misc-file-cabinet','misc-bandaid','misc-post-card','misc-alert','misc-alert2','misc-alarm-bell','misc-alarm-bell2','misc-robot',
								'misc-globe','misc-globe2','misc-chemical','misc-light-bulb','misc-cloud','misc-cloud-upload','misc-cloud-download','misc-lamp','misc-ppreview','misc-ice-cream','misc-ice-cream2','misc-paperclip','misc-footprints','misc-firefox',
								'misc-chrome','misc-safari','misc-loading-bar','misc-bulls-eye','misc-folder','misc-locked','misc-locked2','misc-unlocked','misc-tag','misc-tags2','misc-macos','misc-windows','misc-linux','misc-create-write','misc-expose','misc-key',
								'misc-key2','misc-table','misc-chair','misc-acces-denied-sign','misc-balloons','misc-cat','misc-airplane','misc-truck','misc-car','misc-info-about','misc-frames','misc-coverflow','misc-list','misc-list-images','misc-list-image',
								'misc-blocks-images','misc-wordpress','misc-wordpress2','misc-expression-engine','misc-joomla','misc-drupal','misc-headphone')
		)
	);
	
	$musicsetting = array(
		array (
			'id' 			=> 'music_volume',
			'type'			=> 'text',
			'title'			=> 'Music volume',
			'description'	=> 'Music volume setting when first loaded (range between 1 - 10, default 2)',
			'value'			=> j_get_option('music_volume', '2')
		),
		array (
			'id' 			=> 'music_autoplay',
			'type'			=> 'switchtoogle',
			'title'			=> 'Autoplay when website loaded',
			'description'	=> 'automatically start player when website loaded',
			'value'			=> j_get_option('music_autoplay', 1)
		),
		array (
			'id' 			=> 'enable_ie_music',
			'type'			=> 'switchtoogle',
			'title'			=> 'Enable Music playlist on IE',
			'description'	=> 'HTML 5 (History) doesn\'t supported with IE. <br/>
				those feature needed to run this music playlist for entire website. <br/>
				so if you want to disable completely music playlist on IE, you will need to turn off this option. <br/>',
			'value'			=> j_get_option('enable_ie_music', 1)
		),
	);
	
	$musicplaylist = array(
		array (
			'id' 			=> 'musicplaylist',
			'type'			=> 'musicplaylist',
			'title'			=> 'Create Music List',			
			'value'			=> j_get_option('musicplaylist') , 
		),
	);
	
	return array(
		'Playlist icon'				=> $musicicon,
		'Playlist setting'			=> $musicsetting,
		'Add Music into playlist'	=> $musicplaylist
	);
}
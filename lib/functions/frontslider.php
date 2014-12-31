<?php

add_action('init', 'jeg_register_frontslider_type');
add_action('manage_posts_custom_column'	 , 'jeg_front_show_columns'); 
add_filter('manage_edit-' . JEG_FRONT_POST_TYPE . '_columns'	, 'jeg_front_columns');

function jeg_register_frontslider_type() {
	
	$label = array(
		'name' 				=> __('Front Slider', 'jegtheme'),
		'singular_name' 	=> __('Front Slider Item', 'jegtheme'),
		'add_new'			=> __('Add Front Slider', 'jegtheme'),
		'add_new_item' 		=> __('Add Front Slider', 'jegtheme'),
		'edit_item' 		=> __('Edit Front Slider', 'jegtheme'),
		'new_item' 			=> __('New Front Slider', 'jegtheme'),
		'view_item' 		=> __('View Item', 'jegtheme'),
		'search_items' 		=> __('Search Front Slider', 'jegtheme'),
		'not_found' 		=> __('No front slider items found', 'jegtheme'),
		'not_found_in_trash'=> __('No front slider items found in Trash', 'jegtheme'), 
		'parent_item_colon' => ''
    );
    
    $args = array( 	'labels' 	=> $label,
		'description'			=> 'Front Slider Post type',
        'public' 				=> true,  
        'show_ui' 				=> true,  
    	'menu_icon'				=> JEG_ADMIN_CSS_URL . 'images/home.png',
		'menu_position'			=> 5,
        'capability_type' 		=> 'post',
        'hierarchical' 			=> false,
		'supports' 				=> array('title' , 'editor'),   
	 	// 'rewrite' 				=> array('slug'	=>	'frontslider')         	
	);     
	register_post_type( JEG_FRONT_POST_TYPE, $args);
}

function jeg_front_columns($columns) {
	$columns['author']	= 'Author';
	$columns['date']	= 'Date';
	return $columns;
}

function jeg_front_show_columns($name) {
	global $post;	
	switch ($name) {		
		case 'author' : 
			break;
	}
}
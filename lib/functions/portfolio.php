<?php

add_action('init', 'j_register_portfolio_type');
add_action('manage_posts_custom_column'	 , 'j_portfolio_show_columns'); 
add_filter('manage_edit-' . JEG_PORTFOLIO_POST_TYPE . '_columns'	, 'j_portfolio_columns');

function j_register_portfolio_type() {
	// register portolio
	
	$label = array(
		'name' 				=> __('Portfolio', 'jegtheme'),
		'singular_name' 	=> __('Portfolio Item', 'jegtheme'),
		'add_new'			=> __('Add Portfolio', 'jegtheme'),
		'add_new_item' 		=> __('Add Portfolio', 'jegtheme'),
		'edit_item' 		=> __('Edit Portfolio', 'jegtheme'),
		'new_item' 			=> __('New Portfolio', 'jegtheme'),
		'view_item' 		=> __('View Item', 'jegtheme'),
		'search_items' 		=> __('Search Portfolio Items', 'jegtheme'),
		'not_found' 		=> __('No portfolio items found', 'jegtheme'),
		'not_found_in_trash'=> __('No portfolio items found in Trash', 'jegtheme'), 
		'parent_item_colon' => ''
    );
    
    $args = array( 	'labels' 	=> $label,
		'description'			=> 'Portfolio Post type',
        'public' 				=> true,  
        'show_ui' 				=> true,  
    	'menu_icon'				=> JEG_ADMIN_CSS_URL . 'images/portfolio.png',
		'menu_position'			=> 6,
        'capability_type' 		=> 'post',
        'hierarchical' 			=> false,
		'supports' 				=> array('title' , 'editor'),   
	 	'rewrite' 				=> array('slug'	=>	'portfolio'),
	 	'taxonomies' 			=> array(JEG_PORTFOLIO_CATEGORY)	         	
	); 
    
	register_post_type( JEG_PORTFOLIO_POST_TYPE, $args);
	
	register_taxonomy(JEG_PORTFOLIO_CATEGORY, array(JEG_PORTFOLIO_POST_TYPE),
		array(	
			'hierarchical' 		=> true,
			'label' 			=> __('Portfolio Categories', 'jegtheme'), 
			'singular_label' 	=> __('Portfolio Categories', 'jegtheme'), 
			'rewrite' 			=> true,
			'query_var' 		=> true
		));
	
}

function j_portfolio_columns($columns) {
	$columns['category'] = 'Portfolio Category';
	$columns['author']	= 'Author';	
	$columns['sort']	= 'Sort Portfolio (Date Desc)';
	unset($columns['date']);	
	return $columns;
}

function j_portfolio_show_columns($name) {
	global $post;	
	switch ($name) {
		case 'date'	:
			break;
		case 'author' : 
			break;
		case 'category':
			$cats = get_the_term_list( $post->ID, JEG_PORTFOLIO_CATEGORY, '', ', ', '' );
			echo $cats;
			break;
		case 'sort'	:
			$sortpos = j_get_portfolio_position($post->ID);
			
			if( !is_null($sortpos)) {
				$urlpattern = home_url() . "?portfolio-sequence=true&id=%s&dir=%s";
				if($sortpos == "first") {
					echo '<a href="' . sprintf($urlpattern, $post->ID, "down") . '" class="jeg-portfolio-sort down" data-id="' . $post->ID . '" data-direction="down">Down</a>';
				} else if($sortpos == "last"){
					echo '<a href="' . sprintf($urlpattern, $post->ID, "up") . '" class="jeg-portfolio-sort up" data-id="' . $post->ID . '" data-direction="up">Up</a>';					
				} else if($sortpos == "middle"){
					echo '<a href="' . sprintf($urlpattern, $post->ID, "up") . '" class="jeg-portfolio-sort up" data-id="' . $post->ID . '" data-direction="up">Up</a>';
					echo " | ";
					echo '<a href="' . sprintf($urlpattern, $post->ID, "down") . '" class="jeg-portfolio-sort down" data-id="' . $post->ID . '" data-direction="down">Down</a>';
				}
			}
			break;
	}	
}

$jportfolioseq = array();
function j_get_portfolio_result() {
	global $jportfolioseq ;
	if(empty($jportfolioseq)) {
		$jportfolioseq = new WP_Query(array(
			"post_type"				=> JEG_PORTFOLIO_POST_TYPE , 
			"nopaging"				=> true,
		    "orderby"				=> "date",
		    "order"					=> "DESC"
		));
	}
	return $jportfolioseq->posts;	
}

function j_get_portfolio_position($id) {
	$result = j_get_portfolio_result();
	if(!empty($result)) {
		$totalresult = sizeof($result);
		if($totalresult == 1) {
			return null;
		} else {
			for($i = 0; $i < $totalresult; $i++) {
				if($result[$i]->ID == $id) {
					break;
				}
			}
			
			if($i == 0) {
				return "first";				
			} else if($i == ( $totalresult - 1 )){
				return "last";
			} else {
				return "middle";
			}
		}
	}
	return null;
}

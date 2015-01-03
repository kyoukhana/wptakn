<?php
/*
Template Name: Portfolio Gallery
*/
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

$jdata->portoLayout			= j_get_meta('portfolio_layout', JEG_DEFAULT_PORTO_LAYOUT);
$jdata->portoItemWidth 		= j_get_meta('portfolio_item_width'		, 180);
$jdata->portoItemHeight		= j_get_meta('portfolio_item_height'	, 210);
$jdata->portoExclude		= j_get_meta('portfolio_exclude');
$jdata->galleryDim			= j_get_meta('portfolio_galdim', 3);
$jdata->postid				= get_the_ID();

if(j_get_meta('portfolio_description', 1)) {
	$jdata->descriptionDim		= j_get_meta('portfolio_descdim', 1);
} else {
	$jdata->descriptionDim		= 0;
}

$jdata->theatherMode		= j_get_meta('portfolio_theatherMode', 0);
$jdata->itemHeightExpanded	= j_get_meta('portfolio_wide_height', 550);
$jdata->itemTransition		= j_get_meta('portfolio_item_transition', 'sequpfade');
$jdata->showFilter			= j_get_meta('portfolio_filter', 1);
$jdata->usepaging			= j_get_meta('portfolio_paging', 0);
$jdata->caption				= j_get_meta('portfolio_image_caption', 0);
$jdata->schema				= j_get_schema();

if($jdata->usepaging) 
{
	$jdata->portfolioItem = query_posts(array(
		'post_type'				=> JEG_PORTFOLIO_POST_TYPE , 
		'posts_per_page'		=> j_get_meta('portfolio_per_page', 10),
		'paged'					=> 1,
		'tax_query'				=> array(
	        array(
	            'taxonomy' 	=>  JEG_PORTFOLIO_CATEGORY,
	            'terms' 	=>  $jdata->portoExclude,   
	            'field' 	=> 'id',
	            'operator' 	=> 'NOT IN' 
	        )
	    ),
	    "orderby"				=> "date",
	    "order"					=> "DESC"
	));
	global $wp_query;
	$jdata->totalpage = $wp_query->max_num_pages;
} else 
{
	$jdata->portfolioItem = query_posts(array(
		'post_type'				=> JEG_PORTFOLIO_POST_TYPE , 
		'nopaging'				=> true,
		'tax_query'				=> array(
	        array(
	            'taxonomy' 	=>  JEG_PORTFOLIO_CATEGORY,
	            'terms' 	=>  $jdata->portoExclude,   
	            'field' 	=> 'id',
	            'operator' 	=> 'NOT IN' 
	        )
	    ),
	    "orderby"				=> "date",
	    "order"					=> "DESC"
	));
}

get_template_part( "includes/portfolio-template" );

if(!jisAjax()) {
	get_footer();
}
<?php
/** 
 * @author Jegbagus
 */
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

$jdata->blogLayout 			= j_get_option('blog_layout'	, JEG_DEFAULT_LAYOUT);
$jdata->blogSidebar 		= j_get_option('blog_sidebar'	, jegGenId(JEG_DEFAULT_SIDEBAR));
$jdata->hideMeta			= j_get_option('blog_hidemeta'	, 0);
$jdata->excludeCategory		= j_get_option('blog_exclude'	);

$jdata->blogTitle 			= sprintf( j__('search_for_lang'),  get_search_query()) ;

/** query **/
query_posts(array(
	's'					=> get_query_var('s'),
	'category__not_in' 	=> $jdata->excludeCategory,
	'paged' 			=> (get_query_var('paged')) ? get_query_var('paged') : 1,
	'post_type' 		=> 'post'
));


get_template_part( "includes/page-template" );

if(!jisAjax()) {
	get_footer();
}
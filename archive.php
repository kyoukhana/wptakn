<?php
/** 
 * Archive
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

$jdata->blogTitle 			= "";

if (function_exists('is_tag') && is_tag()) {
	$jdata->blogTitle =  sprintf( j__('tag_archive_for_lang') , single_tag_title('', false) ); 
} elseif (is_category()){	
	$jdata->blogTitle =  sprintf( j__('post_filled_under_lang') , single_cat_title('', false) ); 
} elseif (is_author()){
	$jdata->blogTitle =  sprintf( j__('post_written_by_lang') , get_userdata(get_query_var('author'))->display_name );	
} elseif (is_archive()) {
	$jdata->blogTitle =  sprintf( j__('date_archive_lang'),  wp_title('', false)) ;
} 

get_template_part( "includes/page-template" );

if(!jisAjax()) {
	get_footer();
}
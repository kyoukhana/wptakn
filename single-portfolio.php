<?php
/** 
 * @author Jegbagus
 */
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

if( have_posts() ) {
	the_post();	
	get_template_part( "includes/portfolio-single-item" );
} else {
	echo j_e('no_post_available_lang');
}

if(!jisAjax()) {
	get_footer();
}
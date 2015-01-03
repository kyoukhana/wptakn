<?php
/**
 * This template will used by blog & page
 * 
 * @author jegbagus
 */

global $jdata;

$jdata->contentClass 		= "";
$jdata->postImageDim 		= "post-feature-image";

// show full blog of not
$jdata->fullblog = j_get_option('show_full_blog');

switch (Jeg_Sidebar::get_sidebar($jdata->blogLayout)) {
	case Jeg_Sidebar::$_LEFT :
		$jdata->contentClass 	= "span8 blog-side-width floatright";		
		break;
	case Jeg_Sidebar::$_FULLWIDTH :
		$jdata->postImageDim 	= "post-feature-image-wide";		
		$jdata->contentClass 	= "blog-full-width"; 
		break;
	case Jeg_Sidebar::$_RIGHT :
		$jdata->contentClass 	= "span8 blog-side-width";
		break;	
}
?>

<div class="container">
	<div class="<?php echo $jdata->contentClass; ?>">
		<?php if(isset($jdata->blogTitle)) : ?>
		<div class="blogentry containerborder">
			<div class="inner-container">
				<div class="blogheading"> 
					<h3><?php echo $jdata->blogTitle; ?></h3> 
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php 
		if( have_posts() ) {
			while(have_posts()){
				the_post();				
				get_template_part( "includes/post-template" );
			}
		} else {
			echo _e('No Post Available', 'jegtheme');
		}
		
		// @todo : include pagging
		?>
		<?php get_template_part( "includes/pagination" ); ?>
	</div>
	<?php get_template_part( "includes/sidebar" ); ?>	
</div>
<div class="page-bottom-spacer"></div>

<script type="text/javascript" src="<?php echo JEG_JS_URL . 'jeggallery.full.js';?>"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
	/** bind jeg default **/
	$(window).jegdefault({
		curtain : <?php echo j_get_option('curtain', 0);?>,
		rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
		clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>"
	});

	<?php if(is_single() || is_page() || $jdata->fullblog): ?> 
		/** jeg blog **/
		$("body").jegblog({ 
			minItem : 7,
			uselightbox	: <?php echo j_get_option('use_lighbox', 0); ?> 
		});	
	<?php endif; ?>

	<?php if(is_single() || is_page()) : ?>
		<?php if (j_get_meta('single_stop_music', 0)) : ?>
		muteplayer();
		<?php endif; ?>
	<?php endif; ?>
});
</script>
<?php 

global $jdata;

$categories = get_terms(JEG_PORTFOLIO_CATEGORY, array(
	'order'		=> 'ASC',
	'hide_empy'	=> 1,
	'exclude'	=> $jdata->portoExclude
));

?>

<style type="text/css">
	#jeglio .item {
		width : <?php echo $jdata->portoItemWidth . 'px'?>;
	}

	<?php if(!j_get_meta('portfolio_image_caption', 0 , $jdata->postid)) : ?>
    .fotorama__caption {
        display: none !important;
    }
    .item-gallery .fotorama__nav-wrap {
        bottom: 0;
    }
	<?php endif; ?>




    <?php if(j_get_option('direction_nav', 0) == 0) { ?>
    .fotorama__arr {
        display: none !important;
    }
    <?php } ?>

    <?php if(j_get_option('control_nav', 1) == 0) { ?>
    .fotorama__nav-wrap {
        display: none !important;
    }
    <?php } ?>

    <?php if(!j_get_meta('portfolio_image_caption', 0 , $jdata->postid)) : ?>
    .flex-control-nav {
        bottom: 7px;
    }

    .item-description-wrapper {
        display: none;
    }
    <?php endif; ?>
</style>

<?php if($jdata->showFilter) : ?>
<div id="liofilter">
	<span>
		<div class="misc-list"></div>
		<ul>
			<li class="apply-filter filter-select" data-filter="*"><?php j_e('portfolio_all_filter_lang', 'All'); ?></li>	
			<?php 
			foreach ($categories as $category) :				
				echo "<li class='apply-filter' data-filter='." . $category->term_id . "'> $category->name </li>\n";
			endforeach; 
			?>
		</ul>
	</span>
</div>
<?php endif; ?>
<div class="lioseparator"></div>

<div id="jeglio">
<?php 
if(have_posts()) {
	while(have_posts()) {
		the_post();		
		get_template_part( "includes/portfolio-item" );
	}
}
?>
</div>

<div class="lio-loader"></div>	

<?php
	$nofirstload = "";
	if($jdata->usepaging && isset($jdata->totalpage) && $jdata->totalpage > 1) :
		$nofirstload = "";	
	else : 
		$nofirstload = "nofirstload"; 
	endif;  
?>

<div class="lio-load-more">
	<span style="display: none;" class="load-more-button <?php echo $nofirstload; ?>" data-category="" data-page="2" data-more="<?php j_e('portfolio_load_more', ' More Portfolio Page'); ?>" data-loading="<?php j_e('portfolio_loading', 'Loading . . . . '); ?>"><?php echo ( $jdata->totalpage - 1 ) . ' '; ?> <?php j_e('portfolio_load_more', ' More Portfolio Page'); ?></span>
</div>

<div id="item-theater-overlay">		
	<div id="item-theater">		
		<div id="item-theater-detail">
			<a href="#!/">
				<div class="closeme">
					<div class="icon-remove"></div>
				</div>
			</a>
			<div class="love-this">					
				<span class="love-counter"></span>
				<b class="icon-heart"></b>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo JEG_JS_URL . 'jeglio.full.js';?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		/** bind jeg default **/
		$(window).jegdefault({
			curtain 	: <?php echo j_get_option('curtain', 0);?>,
			rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
			clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>" 
		});
		
		$("#jeglio").jeglio({
            expand_script       : <?php echo j_get_option('portfolio_expand_script', 1); ?>,
			postid				: <?php echo $jdata->postid; ?>,
			itemWidth 			: "<?php echo $jdata->portoItemWidth; ?>",
			itemHeight 			: "<?php echo $jdata->portoItemHeight + 60; ?>",
			itemMode			: "<?php echo $jdata->portoLayout; ?>",
			itemHeightWide 		: "<?php echo $jdata->itemHeightExpanded; ?>",	
			galleryDim			: "<?php echo $jdata->galleryDim; ?>",
			descDim				: "<?php echo $jdata->descriptionDim; ?>",
			loadAnimation		: "<?php echo $jdata->itemTransition; ?>",	
			theatherMode		:  <?php echo $jdata->theatherMode; ?>,
			fullimage           :  <?php  echo j_get_meta('porto_gallery_crop', 0 , $jdata->postid) ?>,
			flexDelay			:  <?php echo j_get_option('flex_slide_speed', '7000'); ?>,
			zoomDelay			:  <?php echo j_get_option('zoom_slide_speed', '7000'); ?>,
			direction_nav		:  <?php echo j_get_option('direction_nav', 0); ?>,
			control_nav			:  <?php echo j_get_option('control_nav', 1); ?>,
			use_pagging			:  <?php echo $jdata->usepaging; ?>,
			portfolio_caption 	:  <?php echo $jdata->caption; ?>,
			themes_schema		:  "<?php echo $jdata->schema;  ?>" ,
			lang				: {
				portfoliotitle						: "<?php j_e("protected_portfolio_lang") ?>",
				passwordplaceholder  				: "<?php j_e("password_placeholder_lang") ?>",
				submit 								: "<?php j_e("portfolio_submit_lang") ?>"
			}
		});
		
	});
</script>

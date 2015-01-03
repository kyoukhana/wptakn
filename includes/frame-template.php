<?php
	$framesource = j_get_meta('frame_url');
?>

<iframe width="100%" height="1000" frameborder=0 border=0 src="<?php echo $framesource; ?>" name="childframe" id="childframe">
</iframe>

<script type="text/javascript">

jQuery(document).ready(function($){
	/** bind jeg default **/
	$(window).jegdefault({
		curtain 	: <?php echo j_get_option('curtain', 0);?>,
		rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
		clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>"
	});	
	
	var frameresize = function() {
		var headerheight = $('header').height();
		var footerheight = $('footer').height();
		var wh = $(window).height();
		
		console.log(headerheight);
		console.log(footerheight);
		
		console.log(wh);
		
		var fh = wh - headerheight - footerheight; 
		$("#childframe").attr('height', fh);		
	};
	
	$(window).bind('resize load', frameresize);	
});
</script>
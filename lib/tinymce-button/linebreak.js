(function($){
	$('html').jshortcode({
		id							: 'linebreak',
		title 						: 'Line Break',			
		image						: 'enter.png',
		showWindow					: false 
	}, 
	function(ed, url, options){
		/** empty **/
	}, 
	function(ed, url, options) 
	{		
		ed.selection.setContent('<br class="clearboth"/>&nbsp;');
	});
})(jQuery);
(function($){
	$('html').jshortcode({
		id							: 'grid',
		title 						: 'Build Grid',			
		image						: 'grid.png',
		showWindow					: true,
		windowWidth					: 820,
		fields						: [{ type : 'grid' 	   	, name : 'Grid Layout'}] 
	}, 
	function(ed, url, options) 
	{	
		var html = '<div class="row">\n';
		$('.buildgrid > li').each (function(){
			var spanWidth = parseInt($(this).attr('data-length'), 10);
			html += '<div class="span'+ spanWidth +'"><p>Your Content Goes Here</p></div>\n';			
		});
		html += '<div class="clearboth"></div>\n' +
			'</div>\n';
		ed.execCommand('mceInsertContent', false, html);
	});
})(jQuery);
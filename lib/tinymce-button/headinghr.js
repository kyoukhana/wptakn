(function($){
	$('html').jshortcode({
		id							: 'headinghr',
		title 						: 'Underline Heading',			
		image						: 'heading.png',
		showWindow					: true,
		allowSelection				: true,
		fields						: [{ type : 'text' 	   	, name : 'Heading'		, id: 'heading'}] 
	}, 
	function(ed, url, options) 
	{
		var heading 	= $('#'+options.pluginprefix + 'heading').val();
		var insertHtml 	= '<h3>' + heading + '</h3><hr class="hr-margin" />';			
		ed.execCommand('mceInsertContent', false, insertHtml);
	}, 
	function(ed, url, options) 
	{		
		ed.selection.setContent('<h3>' + ed.selection.getContent() + '</h3><hr class="hr-margin" />');
	});
})(jQuery);
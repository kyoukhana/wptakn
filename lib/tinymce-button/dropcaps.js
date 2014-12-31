(function($){
	$('html').jshortcode({
		id							: 'dropcaps',
		title 						: 'Drop cap',			
		image						: 'text_dropcaps.png',
		showWindow					: true,
		allowSelection				: true,
		fields						: [{ type : 'text' , name : 'Drop caps' , id: 'dropcap'}] 
	}, 
	function(ed, url, options) 
	{
		var dropcap 	= $('#'+options.pluginprefix + 'dropcap').val();
		var insertHtml 	= '<span class="dropcaps">' + dropcap + '</span>';			
		ed.execCommand('mceInsertContent', false, insertHtml);
	}, 
	function(ed, url, options) 
	{		
		ed.selection.setContent('<span class="dropcaps">' + ed.selection.getContent() + '</span>');
	});
})(jQuery);
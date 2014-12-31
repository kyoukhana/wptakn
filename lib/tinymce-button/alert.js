(function($){
	$('html').jshortcode({
		id							: 'alert',
		title 						: 'Alert / Infobox',			
		image						: 'warning.png',
		showWindow					: true,	
		fields						: [ {type : 'select', name : 'Select alert style '	, id : 'select-color' , option : ['warning', 'error', 'success', 'info',]} ,
		      						    {type : 'text'  , name : 'Alert Title'     		, id: 'title'},
		      						    {type : 'text'  , name : 'Alert Content'    	, id: 'content'}] 
	}, 
	function(ed, url, options) 
	{
		var color 	= $('#'+options.pluginprefix + 'select-color').val();
		var title	= $('#'+options.pluginprefix + 'title').val();		
		var content	= $('#'+options.pluginprefix + 'content').val();
		
		var alertstyle = '';
		if(color == "warning") {
			alertstyle = 'alert-block';
		} else if(color == "error") {
			alertstyle = 'alert-error'; 
		} else if(color == "success") {
			alertstyle = 'alert-success';	
		} else if(color == "info") {
			alertstyle = 'alert-info';
		}
		
		var html = "<div class='alert " + alertstyle + "'><a class='close' data-dismiss='alert'>×</a><strong>" + title + "</strong> " + content + " </div>";
		
		ed.execCommand('mceInsertContent', false, html);
	});
})(jQuery);
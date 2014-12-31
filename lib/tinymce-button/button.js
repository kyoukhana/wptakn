(function($){
	$('html').jshortcode({
		id							: 'button',
		title 						: 'Insert Button',			
		image						: 'button.png',
		showWindow					: true,	
		fields						: [ {type : 'select', name : 'Select button style ', id : 'select-color' , option : ['default', 'primary', 'info', 'sucess', 'warning', 'danger', 'inverse']} ,
		      						    {type : 'text'  , name : 'Button Url'     , id: 'btnurl'},
		      						    {type : 'text'  , name : 'Button Text'    , id: 'btntxt'}] 
	}, 
	function(ed, url, options) 
	{
		var color 	= $('#'+options.pluginprefix + 'select-color').val();
		var txt 	= $('#'+options.pluginprefix + 'btntxt').val();		
		var url		= $('#'+options.pluginprefix + 'btnurl').val();
		var html = '[button url="'+url+'"  style="'+color+'"]' + txt + '[/button]';
		ed.execCommand('mceInsertContent', false, html);
	});
})(jQuery);
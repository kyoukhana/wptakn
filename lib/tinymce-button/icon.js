(function($){
	$('html').jshortcode({
		id							: 'icon',
		title 						: 'Insert Icon',			
		image						: 'infopotrait.png',
		showWindow					: true,		
		windowWidth					: 800,
		fields						: [ {type : 'select', name : 'Select icon color ', id : 'select-color' , option : ['black', 'white']} , 
		      						    {type : 'icon'  , name : 'Choose Icon'    , id: 'icon'}] 
	}, 
	function(ed, url, options) 
	{	
		var color 	= $('#'+options.pluginprefix + 'select-color').val();
		var icon 	= $('.select-icon .selected i').attr('class');		
		
		color = (color == 'white') ? ' color="icon-white" ' : '';		
		
		var html = '[icon '+color+' style="'+ icon +'"][/icon]';
		ed.execCommand('mceInsertContent', false, html);
	});
})(jQuery);
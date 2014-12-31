(function($){
	$('html').jshortcode({
		id							: 'highlight',
		title 						: 'Highlight text & tooltips',			
		image						: 'newspaper_pencil.png',
		showWindow					: true,
		fields						: [{ type : 'colorpicker' 	, name : 'Background Color'	, id : 'bgcolor',   color : '666666'}, 
		      						   { type : 'colorpicker' 	, name : 'Text Color' 		, id : 'txtcolor' , color : 'ffffff'},
		      						   { type : 'text' 		    , name : 'Highlighed text' 	, id : 'highlight'},
		      						   { type : 'textarea' 		, name : 'Insert Tooltips' 	, id : 'tooltips'}]
	}, 
	function(ed, url, options) 
	{
		var bgcolor 	= $('#'+options.pluginprefix + 'bgcolor div').css('background-color');
		var txtcolor 	= $('#'+options.pluginprefix + 'txtcolor div').css('background-color');
		var tooltips 	= $('#'+options.pluginprefix + 'tooltips').val();
		var highlight 	= $('#'+options.pluginprefix + 'highlight').val();	
		
		var style = "background-color : " + bgcolor + "; color : " + txtcolor;
				
		if(tooltips != '') {
			var tooltips = 'data-rel="tooltip" title="' + tooltips + '"';
		}
		
		var insertHtml = '<span class="highlight" ' + tooltips + ' style="' + style + '">' + highlight + '</span>&nbsp;';		
		ed.execCommand('mceInsertContent', false, insertHtml);
	});
})(jQuery);
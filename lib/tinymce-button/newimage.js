(function($){
	$('html').jshortcode({
		id							: 'newimage',
		title 						: 'Insert Image fullscreen option',			
		image						: 'picture.png',
		showWindow					: true,	
		fields						: [ {type : 'select', name : 'Select Image Size '	, id: 'size' , option : ['span12', 'span11', 'span10', 'span9', 'span8', 'span7', 'span6', 'span5', 'span4', 'span3', 'span2', 'span1']} ,
		      						    {type : 'select', name : 'Image Align'			, id: 'align' , option : ['alignleft', 'alignright', 'aligncenter']} ,
		      						    {type : 'text'  , name : 'Image Title'     		, id: 'title'}, 
		      						    {type : 'upload', name : 'Upload Image' 		, id: 'image'},
		      						    {type : 'check' , name : 'Zoomable'     		, id: 'zoomable'}]
	}, 
	function(ed, url, options) 
	{
		var size 		= $('#'+options.pluginprefix + 'size').val();
		var align 		= $('#'+options.pluginprefix + 'align').val();
		var title		= $('#'+options.pluginprefix + 'title').val();
		var image		= $('#'+options.pluginprefix + 'image').val();
		var zoomable	= $('#'+options.pluginprefix + 'zoomable').is(':checked');
		
		var photoswipe = "";
		if(zoomable) {
			photoswipe = "class='photoswipe'";
		}
		
		var html = 	'<div><a href="' + image + '" ' + photoswipe + ' data-title="' + title + '"  data-tourl="false"><img class="' + size + ' ' + align +  '" src="' + image + '"/></a></div>';	
		ed.execCommand('mceInsertContent', false, html);
	});
})(jQuery);
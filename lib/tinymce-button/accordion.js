(function($){
	$('html').jshortcode({
		id							: 'accordion',
		title 						: 'Accordion',			
		image						: 'ui_accordion.png',
		showWindow					: true,	
		fields						: [ {type : 'inputgrow', name : 'Add Accordion'} ] 
	}, 
	function(ed, url, options) 
	{
		var html = '[accordion-wrapper]<br class="removeme"/>&nbsp;';
		$(".textgrow").each(function(){
			html += '[accordion-title] ' + $(this).val() + ' [/accordion-title]<br class="removeme">&nbsp;';
			html += '[accordion-body] Put your content here [/accordion-body]<br class="removeme"/>&nbsp;';
		});
		html += '[/accordion-wrapper]<br class="removeme"/>&nbsp;';
		
		var html = '<div class="accordion" data-accordion="accordion">';
		$(".textgrow").each(function(){
			html += '<div class="accordion-group">' +
				      '<div class="accordion-heading">' +
			            '<a href="#" class="accordion-toggle active">' +
			              $(this).val() +
			            '</a>' +
			          '</div>' +
			          '<div class="accordion-body">' +
			            '<div class="accordion-inner">' +
			             'Content of ' + $(this).val() +
			            '</div>' +
			          '</div>' +
			        '</div>';
		});
		html += '</div>';
		
		ed.execCommand('mceInsertContent', false, html);
	});
})(jQuery);
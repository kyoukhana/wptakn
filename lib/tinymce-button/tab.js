(function($){
	$('html').jshortcode({
		id							: 'tab',
		title 						: 'Tabbed Content',			
		image						: 'tab_breakoff.png',
		showWindow					: true,	
		fields						: [ {type : 'inputgrow', name : 'Add Tab'} ] 
	}, 
	function(ed, url, options) 
	{		
		var html = '<div class="tab-wrapper" data-tab="tab">';
		
			html += '<ul class="nav nav-tabs">';
			var i = 0;
			$(".textgrow").each(function(){
				if(i == 0) {
					html += '<li class="active"><a href="#">' + $(this).val() + '</a></li>';
				} else {
					html += '<li><a href="#">' + $(this).val() + '</a></li>';
				}
				i++;
			});
			html += '</ul>';
		
			html += '<div class="tab-content">';
			
			var i = 0;
			$(".textgrow").each(function(){
				if(i == 0) {
					html += '<div class="tab-pane active"><p>' + 'Content of ' + $(this).val() + ' tab' + '<p></div>';
				} else {
					html += '<div class="tab-pane"><p>' + 'Content of ' + $(this).val() + ' tab' + '<p></div>';
				}
				i++;
			});
			
			html += '</div>';
		
		html += '</div>';
		
		ed.execCommand('mceInsertContent', false, html);
		ed.selection.collapse(0);
	});
})(jQuery);
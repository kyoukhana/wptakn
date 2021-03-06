(function($){
	$('html').jshortcode({
		id							: 'listupperroman',
		title 						: 'List Upper Roman',			
		image						: 'upperroman.png',
		showWindow					: false 
	}, 
	function(ed, url, options){
		/** empty **/
	}, 
	function(ed, url, options) 
	{
		 //this is a list
	    var list, dom = ed.dom, sel = ed.selection;
	    
   		// Check for existing list element
   		list = dom.getParent(sel.getNode(), 'ol');
   		
   		// Switch/add list type if needed
   		ed.execCommand('InsertOrderedList');
   		
   		// Append styles to new list element
   		list = dom.getParent(sel.getNode(), 'ol');
   		
   		if (list) {
   			$(list).attr('class','');
   			dom.addClass(list, 'upperroman');
   		}
	});
})(jQuery);
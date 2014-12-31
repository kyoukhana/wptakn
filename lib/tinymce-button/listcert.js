(function($){
	$('html').jshortcode({
		id							: 'listcert',
		title 						: 'List Certificate',			
		image						: 'certificate.png',
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
   		list = dom.getParent(sel.getNode(), 'ul');
   		
   		// Switch/add list type if needed
   		ed.execCommand('InsertUnorderedList');
   		
   		// Append styles to new list element
   		list = dom.getParent(sel.getNode(), 'ul');
   		
   		if (list) {
   			$(list).attr('class','');
   			dom.addClass(list, 'list-certificate');
   		}
	});
})(jQuery);
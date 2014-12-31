(function($){
	
	/** variable **/
	var mceTout  = 0;
	var data = new Array();
	
	var decode = function(tag)
	{
	    var r = /(\w+)="([^"]+)"/g,
	    h = {};
	    while ((m = r.exec(tag)) !== null) {
	        h[m[1]] = m[2];
	    }
	    return h;
	};
	
	/*** before send content **/
	var do_get_visual = function (co) {
		return co.replace(/\[portfolio([^\]]*)\]/g, function(a,b){
			var html = '<img src="'+tinymce.baseURL+'/plugins/wpgallery/img/t.gif" class="portfolio mceItem" title="'+tinymce.DOM.encode(a)+'" />';						
			return html;
		});
	};
	
	var beforeSendContentCb = function (ed, o) {
		data = decode(o.content);
		o.content = do_get_visual(o.content);
	};	
	
	/*** before post process **/	
	var do_get_html = function (co) {

		function getAttr(s, n) {
			n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
			return n ? tinymce.DOM.decode(n[1]) : '';
		};

		return co.replace(/(?:<p[^>]*>)*(<img[^>]+>)(?:<\/p>)*/g, function(a,im) {
			var cls = getAttr(im, 'class');

			if ( cls.indexOf('portfolio') != -1 )
				return '<p>'+tinymce.trim(getAttr(im, 'title'))+'</p>';

			return a;
		});
	};
		
	var postProcessCb = function (ed, o) {
		if (o.get)
			o.content = do_get_html(o.content);
	};
	
	/** create button **/ 
	var _createButtons = function (url) {
		var t = this, ed = tinyMCE.activeEditor, DOM = tinymce.DOM, editButton, dellButton;
		DOM.remove('portfolio_button');
		
		DOM.add(document.body, 'div', {
			id : 'portfolio_button',
			style : 'display:none;'
		});
		
		editButton = DOM.add('portfolio_button', 'img', {
			src : url+'/images/edit.png',
			id : 'portfolio_edit',
			width : '24',
			height : '24',
			title : 'Edit Portfolio Gallery'
		});

		tinymce.dom.Event.bind(editButton, 'mousedown', function(e) {
			var ed = tinyMCE.activeEditor, el = ed.selection.getNode();
			var d = decode(el.getAttribute('title'));
			
			console.log(d);
			
			if ( el.nodeName == 'IMG' && ed.dom.hasClass(el, 'portfolio') ) {
				shortcode.buildResponse(ed, url, d);
			}
		});
		
		dellButton = DOM.add('portfolio_button', 'img', {
			src : url+'/images/delete.png',
			id : 'portfolio_delete',
			width : '24',
			height : '24',
			title : 'Delete Portfolio Gallery'
		});

		tinymce.dom.Event.bind(dellButton, 'mousedown', function(e) {
			var ed = tinyMCE.activeEditor, el = ed.selection.getNode();

			if ( el.nodeName == 'IMG' && ed.dom.hasClass(el, 'portfolio') ) {
				ed.dom.remove(el);				
				ed.execCommand('mceRepaint');
				_hideButtons();
				return false;
			}
		});
	};
	
	/** show hide button **/
	var _showButtons = function(n, id) {
		console.log(id);
		var ed = tinyMCE.activeEditor, p1, p2, vp, DOM = tinymce.DOM, X, Y;		
		
		vp = ed.dom.getViewPort(ed.getWin());
		p1 = DOM.getPos(ed.getContentAreaContainer());
		p2 = ed.dom.getPos(n);

		X = Math.max(p2.x - vp.x, 0) + p1.x;
		Y = Math.max(p2.y - vp.y, 0) + p1.y;

		DOM.setStyles(id, {
			'top' : Y+5+'px',
			'left' : X+5+'px',
			'display' : 'block'
		});

		if ( this.mceTout )
			clearTimeout(this.mceTout);

		mceTout = setTimeout( function(){_hideButtons();}, 2000 );
	};
	
	var _hideButtons = function () {
		if ( !mceTout )
			return;

		if ( document.getElementById('portfolio_button') )
			tinymce.DOM.hide('portfolio_button');

		clearTimeout(mceTout);
		mceTout = 0;
	};
	
	// execute do init
	var doinit = function (ed, url, op) {
		ed.onBeforeSetContent.add(function(ed, o) {
			beforeSendContentCb(ed, o);
		});
		
		ed.onPostProcess.add(function(ed, o) {
			postProcessCb(ed, o);
		});
				
		_createButtons (url) ;
		
		ed.onMouseDown.add(function(ed, e) {
			if ( e.target.nodeName == 'IMG' && ed.dom.hasClass(e.target, 'portfolio') )
				_showButtons(e.target, 'portfolio_button');
		});
	};
	
	var shortcode = $('html').jshortcode({
			id							: 'portfolio',
			title 						: 'Insert Portfolio Gallery',	
			image						: 'portfolio_gallery.png',
			showWindow					: true,	
			hookInit					: doinit,
			fields						: [ {type : 'text',      name : 'Portfolio ID'				, id: 'id'}]
		}, 
		function(ed, url, options) 
		{
			var portfolio 			= $('#'+options.pluginprefix + 'id').val();				
			
			var html = '[portfolio id="' + portfolio + '"]';			
			ed.execCommand('mceInsertContent', false, html);
			ed.execCommand('mceCleanup');
		});
})(jQuery);

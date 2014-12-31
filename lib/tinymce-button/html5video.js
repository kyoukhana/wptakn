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
		return co.replace(/\[html5video([^\]]*)\]/g, function(a,b){
			var html = '<img src="'+tinymce.baseURL+'/plugins/wpgallery/img/t.gif" class="html5video mceItem" title="='+tinymce.DOM.encode(a)+'" />';						
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

			if ( cls.indexOf('html5video') != -1 )
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
		DOM.remove('html5video_button');
		
		DOM.add(document.body, 'div', {
			id : 'html5video_button',
			style : 'display:none;'
		});
		
		editButton = DOM.add('html5video_button', 'img', {
			src : url+'/images/edit.png',
			id : 'html5video_edit',
			width : '24',
			height : '24',
			title : 'Edit Quote'
		});

		tinymce.dom.Event.bind(editButton, 'mousedown', function(e) {
			var ed = tinyMCE.activeEditor, el = ed.selection.getNode();
			var d = decode(el.getAttribute('title'));
						
			if ( el.nodeName == 'IMG' && ed.dom.hasClass(el, 'html5video') ) {
				shortcode.buildResponse(ed, url, d);
			}
		});
		
		dellButton = DOM.add('html5video_button', 'img', {
			src : url+'/images/delete.png',
			id : 'html5video_delete',
			width : '24',
			height : '24',
			title : 'Delete Quote'
		});

		tinymce.dom.Event.bind(dellButton, 'mousedown', function(e) {
			var ed = tinyMCE.activeEditor, el = ed.selection.getNode();

			if ( el.nodeName == 'IMG' && ed.dom.hasClass(el, 'html5video') ) {
				ed.dom.remove(el);				
				ed.execCommand('mceRepaint');
				_hideButtons();
				return false;
			}
		});
	};
	
	/** show hide button **/
	var _showButtons = function(n, id) {
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

		if ( document.getElementById('html5video_button') )
			tinymce.DOM.hide('html5video_button');

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
			if ( e.target.nodeName == 'IMG' && ed.dom.hasClass(e.target, 'html5video') )
				_showButtons(e.target, 'html5video_button');
		});
	};
	
	
	/** jshortcode **/
	var shortcode = $('html').jshortcode({
		id							: 'html5video',
		title 						: 'Html 5 Video',			
		image						: 'html5video.png',
		showWindow					: true,	
		hookInit					: doinit,
		fields						: [ {type : 'select', name : 'Select Video Size '	, id: 'size' , option : ['span12', 'span11', 'span10', 'span9', 'span8', 'span7', 'span6', 'span5', 'span4', 'span3', 'span2', 'span1',]} ,		      						    
		      						    {type : 'upload'  , name : 'MP4 File'     		, id: 'mp4'} , 
		      						    {type : 'upload'  , name : 'WEBM File'     		, id: 'webm'} , 
		      						    {type : 'upload'  , name : 'OGG File'     		, id: 'ogg'}, 
		      						    {type : 'upload', name : 'Image Cover'     		, id: 'image'},
		      						    {type : 'check' , name : 'Clear Bottom'     	, id: 'clearbottom'}] 
	}, 
	function(ed, url, options) 
	{
		var videosize 	= $('#'+options.pluginprefix + 'size').val();
		var mp4			= $('#'+options.pluginprefix + 'mp4').val();
		var webm		= $('#'+options.pluginprefix + 'webm').val();
		var ogg			= $('#'+options.pluginprefix + 'ogg').val();
		var videoimage  = $('#'+options.pluginprefix + 'image').val();
		var clearbottom = $('#'+options.pluginprefix + 'clearbottom').is(':checked');
		
		if(mp4 != '') mp4 = ' mp4="' + mp4 + '" ';
		if(webm != '') webm = ' webm="' + webm + '" ';
		if(ogg != '') ogg = ' ogg="' + ogg + '" ';
		
		var html = '[html5video size="' + videosize + '" ' + mp4 + webm + ogg + 'image="' + videoimage + '" clearbottom="'+ clearbottom +'"]';
		ed.execCommand('mceInsertContent', false, html);
		ed.execCommand('mceCleanup');
	});
})(jQuery);

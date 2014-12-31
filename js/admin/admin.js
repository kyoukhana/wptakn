(function($) {
	$.fn.jshortcode = function( options  , cbwindow , cbselection) 
	{
		var settings = {
			id							: 'jeg-plugin-id',
			title 						: 'jeg-plugin-title',			
			image						: '',
			showWindow					: false,
			windowWidth					: 500,
			allowSelection				: false,
			pluginprefix				: 'jeg-shortcode-',	
			hookInit					: null,
			fields						: []
		};
		
		if (options) {
			var options = $.extend(settings, options);	
		} else {
			var options = $.extend(settings);					
		}
		
		options.hookInit = options.hookInit || $.noop;
		
		var buildResponse = function (ed, url, data) {
			if(!options.showWindow) {
				cbselection.call(this, ed, url, options);
				return ;
			} else {
				
				var selection = ed.selection.getContent();
				if(options.allowSelection && selection) {
					cbselection.call(this, ed, url, options);
					return ;
				}
				
				var htmlfield = '';
				
				var addIconOption = function (arr) {
					var html = '';
					for (var i = 0; i < arr.length ; i++) {
						html += '<li class=""><i class="' + arr[i] + '"></i>' + arr[i] + '\n';
					}
					return html;
				};
				
				var addOption = function (arr) {
					var html = '';
					for (var i = 0; i < arr.length ; i++) {
						html += '<option value="' + arr[i] + '">' + arr[i] + '</option>\n';
					}
					return html;
				};
				
				for ( var i = 0 ; i < options.fields.length; i++ ) {
					var field = options.fields[i]; //-> name, type, option
					if(field.type == 'text') {
						htmlfield += '<label>' + field.name + ' : </label><input type="text" id="'+ options.pluginprefix + field.id +'" name="'+ options.pluginprefix + field.id +'" />';
					} else if(field.type == 'textarea') {
						htmlfield += '<label>' + field.name + ' : </label><textarea id="'+ options.pluginprefix + field.id +'" name="'+ options.pluginprefix + field.id +'" /></textarea>';
					} else if(field.type == 'grid') {
						htmlfield += '<label>' + field.name + ' : <a href="#" title="Add Grid" class="addgrid">&nbsp;</a></label>' + 
							'<ul class="buildgrid">' + 	
								'<li class="gridlist span12" data-length="12">' + 
									'<div class="gridcounter">12/12</div>' + 
									'<div class="panelgrid">' +
										'<a href="#" class="plusgrid" title="Increase Grid Width">plus</a> ' +
										'<a href="#" class="reducegrid" title="Reduce Grid Width">reduce</a> ' +
										'<a href="#" class="removegrid" title="Remove Grid">remove</a>' +
									'</div>' + 
								'</li>' + 
							'</ul>';
					} else if(field.type == 'icon') {
						var iconArray = ["icon-glass","icon-music","icon-search","icon-envelope","icon-heart","icon-star","icon-star-empty","icon-user","icon-film",
						                 "icon-th-large","icon-th","icon-th-list","icon-ok","icon-remove","icon-zoom-in","icon-zoom-out","icon-off","icon-signal",
						                 "icon-cog","icon-trash","icon-home","icon-file","icon-time","icon-road","icon-download-alt","icon-download","icon-upload",
						                 "icon-inbox","icon-play-circle","icon-repeat","icon-refresh","icon-list-alt","icon-lock","icon-flag","icon-headphones",
						                 "icon-volume-off","icon-volume-down","icon-volume-up","icon-qrcode","icon-barcode","icon-tag","icon-tags","icon-book",
						                 "icon-bookmark","icon-print","icon-camera","icon-font","icon-bold","icon-italic","icon-text-height","icon-text-width",
						                 "icon-align-left","icon-align-center","icon-align-right","icon-align-justify","icon-list","icon-indent-left","icon-indent-right",
						                 "icon-facetime-video","icon-picture","icon-pencil","icon-map-marker","icon-adjust","icon-tint","icon-edit","icon-share","icon-check",
						                 "icon-move","icon-step-backward","icon-fast-backward","icon-backward","icon-play","icon-pause","icon-stop","icon-forward",
						                 "icon-fast-forward","icon-step-forward","icon-eject","icon-chevron-left","icon-chevron-right","icon-plus-sign","icon-minus-sign",
						                 "icon-remove-sign","icon-ok-sign","icon-question-sign","icon-info-sign","icon-screenshot","icon-remove-circle","icon-ok-circle",
						                 "icon-ban-circle","icon-arrow-left","icon-arrow-right","icon-arrow-up","icon-arrow-down","icon-share-alt","icon-resize-full",
						                 "icon-resize-small","icon-plus","icon-minus","icon-asterisk","icon-exclamation-sign","icon-gift","icon-leaf","icon-fire",
						                 "icon-eye-open","icon-eye-close","icon-warning-sign","icon-plane","icon-calendar","icon-random","icon-comment","icon-magnet","icon-chevron-up",
						                 "icon-chevron-down","icon-retweet","icon-shopping-cart","icon-folder-close","icon-folder-open","icon-resize-vertical",
						                 "icon-resize-horizontal","icon-hdd","icon-bullhorn","icon-bell","icon-certificate","icon-thumbs-up","icon-thumbs-down",
						                 "icon-hand-right","icon-hand-left","icon-hand-up","icon-hand-down","icon-circle-arrow-right","icon-circle-arrow-left",
						                 "icon-circle-arrow-up","icon-circle-arrow-down","icon-globe","icon-wrench","icon-tasks","icon-filter","icon-briefcase",
						                 "icon-fullscreen"];
						
						htmlfield +=
							'<label>' + field.name + ' : ' +
								'<div class="wrapper-icon">' + 
									'<ul class="select-icon" id="'+ options.pluginprefix + field.id +'">\n' +
										addIconOption(iconArray) +
									'</ul>' + 
								'</div>' +
							'</label>';						
					} else if(field.type == 'select') {
						htmlfield += 
							'<label>' + field.name + ' : ' + '</label>' + 
							'<select id="'+ options.pluginprefix + field.id +'" name="'+ options.pluginprefix + field.id +'">' +
								addOption(field.option) + 
							'</select>';
					} else if(field.type == 'colorpicker') {
						htmlfield += 
							'<label>' + field.name + ' : ' +
								'<div class="pickcolor" id="'+ options.pluginprefix + field.id +'"><div style="background-color: #'+ field.color +'"></div></div>' +
							'</label>';
					} else if(field.type == 'inputgrow') {
						htmlfield += '<label>' + field.name +  '<a href="#" title="'+ field.name+ '" class="addgrow">&nbsp;</a></label>';
						htmlfield += '<div class="growwrapper"></div>';
					} else if(field.type == 'upload') {
						htmlfield += '<label>' + field.name + '</label>' + 
							'<div id="'+ options.pluginprefix + field.id +'-upload" class="uploadwrapper">'+
								'<input type="text" class="uploadtext" id="'+ options.pluginprefix + field.id +'" name="'+ options.pluginprefix + field.id +'"/>'+
								'<input type="button" value="Upload" class="button-primary alignright uploadbutton"/>'+
							'</div>';
					} else if(field.type == 'check') {
						htmlfield += '<label><input type="checkbox" id="'+ options.pluginprefix + field.id +'" name="'+ options.pluginprefix + field.id +'" value="true" />' + field.name + ' </label>';
					}
				}
				
				var html = 
               	 '<div>'+
               	 	'<div class="jeg-dialog-form">' + 
               	 		htmlfield +
               	 	'</div>'+
               	 	'<div class="jeg-dialog-submit">' + 
               	 		'<input type="button" id="exeCmd" class="button-primary alignright" value="Insert" />'+
               	 	'</div>'+
               	 	'<div style="clear: both;"></div>' +
               	 '</div>';
				
				 var dialog = $(html).dialog({
					 title			: options.title, 
					 modal			: true,
					 dialogClass	: 'j-dialog',
					 resizable		: false,
					 width			: options.windowWidth,
					 close			: function(event, ui){
						jQuery(this).html('').remove();
					 },
					 create:function(){
						 // upload 
						 if($(".uploadwrapper").length) {
							 $(".uploadwrapper .uploadbutton").each (function (){
								 $(this).click(function(){
									 
									 $me = $(this);
									 var cacheEditor = window.send_to_editor;									 
									 var postid = $("#post_ID").val();
									 postid = 0;
									 
									 tb_show('', 'media-upload.php?post_id=' + postid + '&type=file&TB_iframe=true'); // type= can be image too, browse codex for another option
									 // tinymce.DOM.setStyle( ['TB_overlay','TB_window','TB_load'], 'z-index', '999999' );
									 tinymce.DOM.setStyle( ['TB_window'], 'z-index', '999999' );
									 
									 // when insert into post is clicked
									 window.send_to_editor = function(html) {
										 var a =jQuery(html);
										 fileurl = a.find("img").attr('src');	
										 if(fileurl == undefined) fileurl = a.attr('href');
										 $me.parent().find('.uploadtext').val(fileurl);
										 tb_remove();
									 };
									 
									 $("#TB_closeWindowButton").click(function(){
										 window.send_to_editor = cacheEditor;
									 });
									 
									 return false;
								 });								 
							 });
						 }
						 
						 // input grow
						 if($(".growwrapper").length) {							 
							 $(".addgrow").click(function() {
								 $(".growwrapper").append("<label>Title : <a href='#' title='Remove Title' class='removegrow'>&nbsp;</a><input type='text' class='textgrow'/></label>");
								 return false;
							 });
							 
							 $(document).on("click", ".removegrow" ,function(event) {
								 $(this).parent().remove();
								 event.preventDefault();				 
							 });
						 }
						 
						 // color picker
						 if($(".pickcolor").length) {
							 $(".pickcolor").each (function () {
								 var $this = $(this);
								 $this.ColorPicker( {
										color: '#000000',
										onShow: function (colpkr) {									 	
											$(colpkr).fadeIn(500);
											return false;
										},
										onHide: function (colpkr) {
											$(colpkr).fadeOut(500);
											return false;
										},
										onChange: function (hsb, hex, rgb) {
											$this .find('div').css('backgroundColor', '#' + hex);
										}
									});
							 });			 
						 }
						 
						 // icon selection
						 if($(".select-icon").length) {
							 $(".select-icon li").click(function() {
								 $(".select-icon li").removeClass('selected');
								 $(this).addClass('selected');
							 });
						 }
						 
						 /** jika grid **/
						 if($(".buildgrid").length) {
							 var maxlength = 12;
							 var getTotalGrid = function () {
								 return $(".buildgrid > li").size();
							 };
							 
							 var getTotalGridLength = function () {
								 var length = 0;
								 $(".buildgrid > li").each (function (){
									 length += parseInt($(this).attr('data-length'), 10);
								 });
								 return length;
							 };
							 
							 var gridtemplate = function (gridlength) {
								return '<li class="gridlist span'+ gridlength +'" data-length="'+ gridlength +'">' + 
									'<div class="gridcounter">'+ gridlength +'/12</div>' + 
									'<div class="panelgrid">' +
										'<a href="#" class="plusgrid" title="Increase Grid Width">plus</a> ' +
										'<a href="#" class="reducegrid" title="Reduce Grid Width">reduce</a> ' +
										'<a href="#" class="removegrid" title="Remove Grid">remove</a>' +
									'</div>' + 
								'</li>'; 
							 };
							 
							 var createGrid = function (i) {
								 var grid = '';
								 var gridlength = Math.floor( 12 / i );
								 for(var a = 0; a < i ; a++) {
									 grid += gridtemplate (gridlength);
								 }
								 return grid;
							 };
							 
							 $(".addgrid").on("click", function(event){
								 var totalgrid = getTotalGrid();
								 if(totalgrid < maxlength) {
									 var resgrid = createGrid( totalgrid + 1 ) ;
									 $('.buildgrid').html(resgrid);
								 }
								 return false;					 
							 });
							 
							 $(document).on("click", ".buildgrid .removegrid" ,function(event) {								 
								 $(this).parent().parent().remove();								 
								 return false;
							 });
							 
							 $(document).on("click", ".buildgrid .reducegrid" ,function(event) {
								 var selector = $(this).parent().parent();
								 var gridlength = parseInt($(selector).attr('data-length'));
								 if(gridlength == 1) {
									 $(selector).remove();
								 } else {
									 var grid = gridtemplate(gridlength - 1);
									 $(selector).replaceWith(grid);
								 }
								 return false;
							 });
							 
							 $(document).on("click", ".buildgrid .plusgrid" ,function(event) {
								 var selector = $(this).parent().parent();
								 var gridlength = parseInt($(selector).attr('data-length'));
								 if(getTotalGridLength() < maxlength ) {
									 var grid = gridtemplate(gridlength + 1);
									 $(selector).replaceWith(grid);
								 } else {									 
									 alert("Remove or reduce other grid before increasing this grid size");
								 }
								 return false;
							 });
						 }
						 
						 // windows on edit mode, then show the content
						 if(data) {
							 for (var key in data) {
								 var input = $('#'+options.pluginprefix + key);								 
								 if(input.prop("tagName") != undefined) {
									 var tagname = input.prop("tagName").toLowerCase();
									 var tagtype = input.attr("type");
									 
									 if(tagname == 'input' && tagtype == 'text') {
										 input.val(data[key]);										 
									 } else if(tagname == 'textarea') {
										 input.val(data[key]);
									 } else if (tagname == 'input' && tagtype == 'checkbox') {									 
										 if(data[key] == 'true') {
											 $(input).prop("checked", true);
										 } else {
											 $(input).prop("checked", false);								 
										 }
									 } else if (tagname == 'select') {
										 input.val(data[key]);
									 }
								 }
							 }
						 }						 
					 }
				 });
				 
				 dialog.find('#exeCmd').click(function(event){
          			event.preventDefault();
          			cbwindow.call(this, ed, url, options);
          			// langsung panggil callback untuk send content ke editor
          			dialog.remove();
				 });
			}
		};
				
		tinymce.create('tinymce.plugins.' + options.id , {
	        init : function(ed, url) {
				options.hookInit(ed, url, options);
	            ed.addButton(options.id, {
	                title : options.title,
	                image : url + '/button/' + options.image,
	                onclick : function() {
	            		buildResponse(ed, url);		            	
	                }
	            });
	        },
	        createControl : function(n, cm) {
	            return null;
	        }
	    });
	    tinymce.PluginManager.add(options.id, tinymce.plugins[options.id]);
	    
	    return {
	    	buildResponse : buildResponse
	    };	    
	};
	
	var metabox = {
		init : function (options) {
			if($(".jeg-meta-tab").length) {
				var settings = {
				};
				
				if (options) {
					var options = $.extend(settings, options);	
				} else {
					var options = $.extend(settings);					
				}
				
				metabox.setTabs();
				metabox.setSlider();
				metabox.attachUpload();
				metabox.attachGallery();
				metabox.setSwitchtoogle();
				
				// image paging
				metabox.setImagePaging();
				
				// PAGE META
				if($("#jegtheme_page_meta").length) {
					metabox.listenTemplateChange();	
				}
				
				// PORTFOLIO META
				if($("#jegtheme_portfolio_meta").length) {
					metabox.listenPortfolioTabChange();	
				}
				
				// FRONT SLIDER META
				if($("#jegtheme_frontslider_meta").length) {
					metabox.listenFrontSliderTabChange();	
				}
			}
		} ,
		setImagePaging : function() {
			if($("div [data-type='imagelist']").length) {				

				var updatejson = function(root) {
					var imagelist = {}; var i = 0;					
					$(root).find('.imageresult-inner .imageresult-list').each(function(){
						var imgresult = {};
						imgresult['id'] 		= $(this).find("[name='image-id']").val();
						imgresult['title'] 		= $(this).find("[name='image-title']").val();
						imgresult['desc'] 		= $(this).find("[name='image-desc']").val();
						imagelist['img' + i++] = imgresult;
					});	
					
					var jsoninput = $(root).find('.imagelistjson').val(JSON.stringify(imagelist));
				};
				
				// paging clicked
				$(document).on('click', '.imagepaginglist li', function(event){
					var pagenumber 		= $(this).attr('data-page');
					var imagecontent 	= $(this).parents('.imagecontent-inner');					
					var loader 			= $(imagecontent).find('.imagepagingloading').show();					
					
					$.ajax({
						url: ajaxurl,
						type : "post",
						dataType : "html", 
						data : {
							page		: pagenumber,
							action		: 'get_paged_image'
						},
						success: function(data) {
							$(imagecontent).html('').html(data);
							$(loader).hide();
						}
					});
				});
				
				// image toogle clicked
				$(document).on('click', '.imageresult-header-toogle', function(event) {
					var $this 		= $(this);
					var $parent 	= $(this).parents('.imageresult-list');					
					var resvisible 	= $(".imageresult-body", $parent).is(":visible");
					
					if(resvisible) {
						$(".imageresult-body", $parent).hide("fast");
						$(this).text('show');
						
						/** save **/
						var headertext = $parent.find('input[name="image-title"]').val();
						$(this).parents('.imageresult-header').find('.imageresult-header-title').text(headertext);						
						updatejson($(this).parents('.meta-option'));
					} else {
						$(".imageresult-body", $parent).show("fast");
						$(this).text('save');
					}
					
					return false;
				});
				
				// delete item
				$(document).on('click', '.imageresult-header-delete', function(event) {
					var metaoption = $(this).parents('.meta-option');
					
					$(this).parents('.imageresult-list').fadeOut(function(){
						$(this).remove();						
						updatejson(metaoption);
					});
					
					return false;
				});
				
				
				// enable sortable
				$(".imageresult-inner").sortable({
					forcePlaceholderSize: true,
					placeholder: 'imageresult-placeholder',
					stop : function(event, ui) {
						updatejson($(ui.item).parents('.meta-option'));
					}
				});
				
				// item on image list clicked 
				$(document).on('click', '.imagepagelist li', function(event){		
					var builderimglist 	= $(this).parents('.meta-imagelist');
					var resultgrid 		= $(builderimglist).find('.imageresult-inner');																	
					var cloned 			= $(".imggridclone", builderimglist).find('.imageresult-list').clone();
					
					// attribute 
					var imgid 		= $(this).attr('data-id');
					var imgsrc 		= $(this).find('img').attr('src');
					var imgtitle 	= $(this).find('img').attr('alt');
					var imgdesc 	= '';					
					
					imgtitle = imgtitle.replace(/_/g, ' ', -1);
					imgtitle = imgtitle.replace(/-/g, ' ', -1);
					
					$(".imageresult-header-thumb", cloned).attr('src', imgsrc);
					$(".imageresult-body-thumb", cloned).attr('src', imgsrc);
					$(".imageresult-header-title", cloned).text(imgtitle);
					$("[name='image-id']", cloned).val(imgid);
					$("[name='image-title']", cloned).val(imgtitle);
					$("[name='image-desc']", cloned).val(imgdesc);
											
					$(resultgrid).append(cloned);					
					updatejson($(this).parents('.meta-option'));
					
					return false;
				});
				
				
				// img button uploader
				$(document).on('click', '.imgbtnuploader', function(event){
					
					// show media upload
					tb_show('', 'media-upload.php?post_id=0&type=file&TB_iframe=true');
					
					var imagecontent 	= $(this).parents('.imagecontent').find('.imagecontent-inner');
					var loader 			= $(imagecontent).find('.imagepagingloading');
					
					$("#TB_closeWindowButton, #TB_overlay").click(function(){														
						$(loader).show();
						$.ajax({
							url: ajaxurl,
							type : "post",
							dataType : "html", 
							data : {
								page		: 1,
								action		: 'get_paged_image'
							},
							success: function(data) {
								$(imagecontent).html('').html(data);
								$(loader).hide();
							}
						});
					});

					return false;						
				});
			}
		},
		setSwitchtoogle : function () {
			if($(".switchtoogle").length) {
				$(".switchtoogle").iButton();
			}
		} ,
		setSlider : function () {
			if($(".sliderbar").length) {
				$(".sliderbar").each(function(){
					var slidebar = $(this);
					var minval		= parseInt(slidebar.attr('min')		, 10);
					var maxval		= parseInt(slidebar.attr('max')		, 10);
					var val 		= parseInt(slidebar.attr('value')	, 10);
					var stepval 	= parseInt(slidebar.attr('step')	, 10);
					slidebar.slider({
						range: "min",
						value: val,
						min: minval,
						max: maxval,
						step: stepval,
						slide: function( event, ui ) {
							var slidertext = $(this).parent().find('.slidertext');
							$(slidertext).val(ui.value);
						}
					});
				}); 
			}
		},
		attachGallery : function () {
			if($(".attachgallery").length) {
				$(".attachgallery").click(function(){
					var postid = $("#post_ID").val();										
					tb_show('', 'media-upload.php?post_id=' + postid + '&type=file&TB_iframe=true'); // type= can be image too, browse codex for another option						 
					// tinymce.DOM.setStyle( ['TB_overlay','TB_window','TB_load'], 'z-index', '999999' );
					tinymce.DOM.setStyle( ['TB_window'], 'z-index', '999999' );
					return false;
				});
			}
		},
		attachUpload : function() {
			 if($(".uploadfile").length) {
				 $(".uploadfile .selectfile").each (function (){
					 $(this).click(function() {
					 	console.log('hitting here...');	 
						 $me = $(this);
						 var cacheEditor = window.send_to_editor;
						 var postid = $("#post_ID").val();
						 postid = 0;
						 tb_show('', 'media-upload.php?post_id=' + postid + '&type=file&TB_iframe=true'); // type= can be image too, browse codex for another option						 
						 // tinymce.DOM.setStyle( ['TB_overlay','TB_window','TB_load'], 'z-index', '999999' );
						 tinymce.DOM.setStyle( ['TB_window'], 'z-index', '999999' );
						 
						 // when insert into post is clicked
						 window.send_to_editor = function(html) {
							 var a = jQuery(html);
							 fileurl = a.find("img").attr('src');
							 if(fileurl == undefined) fileurl = a.attr('href');						
							 $me.parent().find('.uploadtext').val(fileurl);
							 tb_remove();
						 };
						 
						 $("#TB_closeWindowButton").click(function(){
							 window.send_to_editor = cacheEditor;
						 });
						 
						 return false;
					 });
					 
				 });
			 }
		},
		setTabs : function (options) {
			if($('.jeg-meta-tab > .jeg-tab').length) {
				var taboption = {};
				metabox.metatab = $('.jeg-meta-tab > .jeg-tab').tabs(taboption);				
			}
		}, 
		/** front slider **/
		listenFrontSliderTabChange : function () {
			metabox.frontsliderSwitch();
			metabox.metatab.bind( "tabsactivate", function(event, ui) {
				var url = $(ui.newTab).find('a').attr('href').substring(1);
				$("#j_frontslider_media").val(url);
			});
		}, 
		frontsliderSwitch : function () {
			var portfoliomedia = $("#j_frontslider_media").val();
			$(".jeg-meta-tab .ui-state-default a").each(function(index, ele){
				if($(ele).attr('href').substring(1) == $("#j_frontslider_media").val()) {
					metabox.switchtab(index, []);
				}
			});	
		},
		/** portfolio **/
		listenPortfolioTabChange : function() {
			metabox.portfolioSwitch();
			metabox.metatab.bind( "tabsactivate", function(event, ui) {				
				var url = $(ui.newTab).find('a').attr('href').substring(1);				
				$("#jlio_portfolio_media").val(url);
			});
		},
		portfolioSwitch : function () {
			var portfoliomedia = $("#jlio_portfolio_media").val();
			$(".jeg-meta-tab .ui-state-default a").each(function(index, ele){
				if($(ele).attr('href').substring(1) == $("#jlio_portfolio_media").val()) {
					metabox.switchtab(index, []);
				}
			});			
		},
		/** page **/
		listenTemplateChange : function () {
			var pt = $("#page_template");
			if(pt.length) {
				$(document).on("change", pt ,function(event) {
					 $(this).parent().remove();
					 metabox.templateChanged(pt.val());
				});
				metabox.templateChanged(pt.val());
			}
		},
		templateChanged : function (ptname) {
			/** hardcoded !!! **/
			if(ptname == 'default') {
				metabox.switchtab(0, [1,2,3,4,5,6,7]);
			} else if(ptname == 'template-blog.php') {
				metabox.switchtab(1, [0,2,3,4,5,6,7]);
			} else if(ptname == 'template-contact.php') {
				metabox.switchtab(4, [0,1,2,3,5,6,7]);		
			} else if(ptname == 'template-front.php') {
				metabox.switchtab(2, [0,1,3,4,5,6,7]);
			} else if(ptname == 'template-portfolio.php') {
				metabox.switchtab(3, [0,1,2,4,5,6,7]);
			}  else if(ptname == 'template-frame.php') {
				metabox.switchtab(5, [0,1,2,3,4,6,7]);
			} else if(ptname == 'template-gallery.php') {
				metabox.switchtab(6, [0,1,2,3,4,5,7]);
			} else if(ptname == 'template-sitemap.php') {
				metabox.switchtab(7, [0,1,2,3,4,5,6]);
			}
		},
		switchtab : function (enable, disable) {
			metabox.metatab.tabs( "option", "disabled", [] );			
			metabox.metatab.tabs( "option", "active", enable );
			metabox.metatab.tabs( "option", "disabled", disable );	
		}
	};
	
	var custom_uploader;
	var jadmin = {		
		init : function () {
			if($('.jad').length){
				jadmin.savednotif();
				jadmin.navclick();
				jadmin.tabclick();
				jadmin.helpclick();
				jadmin.attachUpload();
				jadmin.setSwitchToogle();
				jadmin.iconSetup();
				jadmin.sidebarSetup();
				jadmin.frontslideSetup();
				jadmin.contactSetup();
				jadmin.colorSetup();
				jadmin.fontSetup();
				jadmin.childHeading();
				jadmin.themeManager();
				
				jadmin.playlistSetup();
			}
		},
		childHeading : function () {
			$(".jad-child-heading").click(function() {
				var parent 	= $(this).parent();
				var idx 	= $(parent).children('div').index(this);
				for(var i = idx + 1; i < $(parent).children('div').length ; i++) {
					var now = $(parent).children('div').get(i);
					if($(now).hasClass('jad-child-heading')) {
						break;						
					} else {						
						if($(now).is(':visible')) {
							$(now).hide();
						} else {
							$(now).show();
						}
					}					
				}
			});
		},
		/** font setup **/
		fontSetup : function() {
			if($('.font-option').length) {
				
				// load pertama kali
				$('.fontselect').each(function(){
					var fontname 	= $(this).val();
					var variant 	= $(this).parent().find('.fontvariant');
					var fontview 	= $(this).parent().find('.fontview');
					var $this		= $(this);
					var stylename 	= $(this).parent().attr('data-id') + "_css";						
					var fontblock 	= $(this).parent('.fontblock');
					
					$.ajax({							
						url: ajaxurl,
						type : "post",
						dataType : "json", 
						data : {
							font		: fontname ,
							action		: 'font_variant'
						},
						success: function(data) {
							if(data != 0) {									
								 $('.fontchooser', fontblock).remove();
								 var fontfamily = escape(fontname)  + ":" + data.join(',');
								 
								 $(fontblock).append("<link rel='stylesheet' class='fontchooser' href='http://fonts.googleapis.com/css?family=" + fontfamily + "' type='text/css' media='all' />");
								 $this.parent().find('.fontview').css('font-family', fontname).css('font-style', '').css('font-weight', '');
								 
								 var content = $(variant).val();
								
								 if(content == 'regular' || content == '100' || content == '200' || content == '300' || content == '500' || content == '600' ) {
									$(fontview).css('font-style', '').css('font-weight', '');
								 } else if(content == '700' || content == '800' || content == '900' ) {
									$(fontview).css('font-style', '').css('font-weight', 'bold');
								 } else if(content == 'italic' || content == '100italic' || content == '200italic' || content == '300italic' || content == '500italic' || content == '600italic' ) {
									$(fontview).css('font-style', 'italic').css('font-weight', '');
								 } else if(content == '700italic' || content == '800italic' || content == '900italic' ) {
									$(fontview).css('font-style', 'italic').css('font-weight', 'bold');
								 }
							}
						}
					});					
				});
				
				$(".fontselect").change(function(){
					var $this 		= $(this);
					var fontname 	= $(this).val();
					var idname		= $(this).parent().attr('data-id') ;
					var stylename 	= $(this).parent().attr('data-id') + "_css";
					var fontvariant = $(this).parent().find('.fontvariant');
					var fontblock 	= $(this).parent('.fontblock');
					
					$.ajax({
						url: ajaxurl,
						type : "post",
						dataType : "json", 
						data : {
							font		: fontname ,
							action		: 'font_variant'
						},
						success: function(data) {
							if(data != 0) {
								$('.fontchooser', fontblock).remove();
								 var fontfamily = escape(fontname)  + ":" + data.join(',');
								 
								 var variantstyle = "" ;
								 $(data).each(function(idx, val){	
									 if(val.substring) {
										 variantstyle += "<option value='" + val + "'>" + val + "</option>";
									 }
								 });								 
								 fontvariant.html('').append(variantstyle);
								 
								 $(fontblock).append("<link rel='stylesheet' class='fontchooser' href='http://fonts.googleapis.com/css?family=" + fontfamily + "' type='text/css' media='all' />");
								 $this.parent().find('.fontview').css('font-family', fontname).css('font-style', '').css('font-weight', '');												
							}
						}
					});	
				});
				
				$(".fontvariant").change(function(){
					var content = $(this).val();
					var style = '';
					var fontview = $(this).parent().find('.fontview');
					
					if(content == 'regular' || content == '100' || content == '200' || content == '300' || content == '500' || content == '600' ) {
						$(fontview).css('font-style', '').css('font-weight', '');
					} else if(content == '700' || content == '800' || content == '900' ) {
						$(fontview).css('font-style', '').css('font-weight', 'bold');
					} else if(content == 'italic' || content == '100italic' || content == '200italic' || content == '300italic' || content == '500italic' || content == '600italic' ) {
						$(fontview).css('font-style', 'italic').css('font-weight', '');
					} else if(content == '700italic' || content == '800italic' || content == '900italic' ) {
						$(fontview).css('font-style', 'italic').css('font-weight', 'bold');
					}
				});
			}
		},
		colorSetup : function() {
			if($('.setting-colorpicker').length) {
				$('.setting-colorpicker').each(function(idx, val){
					var $this = $(this).find('.pickcolor');
					var $text = $(this).find('.pickcolor-text');
					var $thiscolor = $text.val();
					$this.ColorPicker({
						color: '#' + $thiscolor ,
						onShow: function (colpkr) {						 	
							$(colpkr).fadeIn(500);
							return false;
						},
						onHide: function (colpkr) {
							$(colpkr).fadeOut(500);
							return false;
						},
						onChange: function (hsb, hex, rgb) {							
							$this.find('div').css('backgroundColor', '#' + hex);
							$text.val(hex);
						}
					});
				});
			}
		},
		scrollto : function (element) {
			$("html, body").animate({
				scrollTop: $(element).offset().top
			});
		},
		

		playlistUpdated : function(selector) {
			var playlistarray = new Array();
			
			$('.musicitem' , selector).each(function(i, v){
				var data = {
					title 		: $('.resulttitle', this).text(),
					mp3 		: $('.resultmp3', this).text(),
					oga 		: $('.resultogg', this).text()
				};
				playlistarray.push(data);
			});
			
			$(selector).parent().find('.musicresultval').val(JSON.stringify(playlistarray));
		},
		addPlaylist : function (selector, data) {
			var template = 
				'<li class="musicitem" style="background: #75cefa;">' +
					'<div class="musicicon"></div>' +
					'<div class="musictext">' +
						'<table>' +
							'<tr>' +
							'<td>Music Title </td><td> : </td><td class="resulttitle">' + data.title + '</td></tr>' +
							'<tr><td>MP3 File</td><td> : </td><td><span class="resultmp3">' + data.mp3 + '</span></td></tr>' +
							'<tr><td>OGG File</td><td>:</td><td><span class="resultogg">' + data.oga + '</span></td></tr>' +							
							'</tr>' +
						'</table>' +
					'</div>' +
					'<div class="musicedit">&nbsp;</div>' +
					'<div class="musicdel">&nbsp;</div>' + 
				'</li>';
		
			$(selector).find("ul").append(template);
			$(selector).find("ul > li:last-child").animate({ backgroundColor: "#FBFBFB" }, 2000);
			jadmin.playlistUpdated(selector);
		},
		playlistSetup : function() {
			if($('.playlistdata').length) {
				$('.musicsubmit input').click(function(){
					var playlistdata = $(this).parents('.playlistdata');
					
					var sel = new Array('mp_title','mp_mp3','mp_ogg');
					
					var data = {
						title 		: $('.' + sel[0], playlistdata).val(),
						mp3 		: $('.' + sel[1], playlistdata).val(),
						oga 		: $('.' + sel[2], playlistdata).val(),
					};
					
					$(sel).each(function(idx, value){
						$('.' + sel[idx], playlistdata).val('');
					});
					
					if(data.title == '' 
						|| data.mp3 == '' 
						|| data.ogg == ''){
						alert('Please fill all music data');
						return ;
					} else {
						var selector = $(playlistdata).find('.musicresult');
						jadmin.addPlaylist(selector, data);
						jadmin.scrollto("#musicresult");
					}
				});
				
				$(document).on("click", ".musicdel" ,function(event) {
					var thisparent = $(this).parents('.musicresult');
					$(this).parent().remove();
					jadmin.playlistUpdated(thisparent);
				});
				
				$(document).on("click", ".musicedit", function(event){
					var thisparent = $(this).parents('.musicresult');
					var par = $(this).parent();
					
					var data = {
						title 		: $('.resulttitle', par).text(),
						mp3 		: $('.resultmp3', par).text(),
						oga 		: $('.resultogg', par).text()
					};									
										
					var playlistdata = $(this).parents('.playlistdata');
					
					$('.mp_title', playlistdata).val(data.title);
					$('.mp_mp3', playlistdata).val(data.mp3);
					$('.mp_ogg', playlistdata).val(data.oga);
										
					$(par).remove();
					jadmin.scrollto("#musicinsert");
					jadmin.playlistUpdated(thisparent);
				});
				
				$(".musicresult ul").sortable({
					stop : function(event, ui) {
						jadmin.playlistUpdated($(ui.item).parents('.musicresult'));
					}
				}); 
			}
		},
		
		contactUpdated : function(selector) {
			var contactarray = new Array();
			
			$('.locationitem' , selector).each(function(i, v){
				var data = {
					title 		: $('.resulttitle', this).text(),
					x 			: $('.resultx', this).text(),
					y 			: $('.resulty', this).text(),
					firstlane 	: $('.resultfirstline', this).text(),
					secondlane 	: $('.resultsecondline', this).text(),
					phone 		: $('.resultphone', this).text()
				};
				contactarray.push(data);
			});
			
			$(selector).parent().find('.locationresultval').val(JSON.stringify(contactarray));
		},
		addContact : function (selector, data) {
			var template = 
				'<li class="locationitem" style="background: #75cefa;">' +
					'<div class="locationicon"></div>' +
					'<div class="locationtext">' +
						'<table>' +
							'<tr>' +
							'<td>Location Title </td><td> : </td><td class="resulttitle">' + data.locationtitle + '</td></tr>' +
							'<tr><td>Coordinate</td><td> : </td><td><span class="resultx">' + data.xcoordinate + '</span> - <span class="resulty">' + data.ycoordinate + '</span></td></tr>' +
							'<tr><td>Address</td><td>:</td><td><span class="resultfirstline">' + data.addressfirstlane + '</span> - <span class="resultsecondline">' + data.addresssecline + '</span></td></tr>' +
							'<tr><td>Phone Number</td><td>:</td><td><span class="resultphone">' + data.phone + '</span></td>' +
							'</tr>' +
						'</table>' +
					'</div>' +
					'<div class="locationedit">&nbsp;</div>' +
					'<div class="locationdel">&nbsp;</div>' + 
				'</li>';
		
			$(selector).find("ul").append(template);
			$(selector).find("ul > li:last-child").animate({ backgroundColor: "#FBFBFB" }, 2000);
			jadmin.contactUpdated(selector);
		},
		contactSetup : function () {
			if($('.mapdata').length) {
				$('.locsubmit input').click(function(){
					var mapdata = $(this).parents('.mapdata');
					
					var sel = new Array('locationtitle','xcoordinate','ycoordinate','addressfirstlane','addresssecline','phone');
					
					var data = {
						locationtitle 		: $('.' + sel[0], mapdata).val(),
						xcoordinate 		: $('.' + sel[1], mapdata).val(),
						ycoordinate 		: $('.' + sel[2], mapdata).val(),
						addressfirstlane 	: $('.' + sel[3], mapdata).val(),
						addresssecline 		: $('.' + sel[4], mapdata).val(),
						phone 				: $('.' + sel[5], mapdata).val()
					};
					
					$(sel).each(function(idx, value){
						$('.' + sel[idx], mapdata).val('');
					});
					
					if(data.locationtitle == '' 
						|| data.xcoordinate == '' 
						|| data.ycoordinate == '' 
						|| data.addressfirstlane == '' 
						|| data.addresssecline == ''){
						alert('Please fill all location data');
						return ;
					} else {
						var selector = $(mapdata).find('.locationresult');
						jadmin.addContact(selector, data);
						jadmin.scrollto("#locationresult");
					}
				});
				
				$(document).on("click", ".locationdel" ,function(event) {
					var thisparent = $(this).parents('.locationresult');
					$(this).parent().remove();
					jadmin.contactUpdated(thisparent);
				 });
				
				$(document).on("click", ".locationedit", function(event){
					var thisparent = $(this).parents('.locationresult');
					var par = $(this).parent();
					
					var data = {
						title 		: $('.resulttitle', par).text(),
						x 			: $('.resultx', par).text(),
						y 			: $('.resulty', par).text(),
						firstlane 	: $('.resultfirstline', par).text(),
						secondlane 	: $('.resultsecondline', par).text(),
						phone 		: $('.resultphone', par).text()
					};
					
					var mapdata = $(this).parents('.mapdata');					
					var sel = new Array('locationtitle','xcoordinate','ycoordinate','addressfirstlane','addresssecline','phone');
										
					$('.locationtitle', mapdata).val(data.title);
					$('.xcoordinate', mapdata).val(data.x);
					$('.ycoordinate', mapdata).val(data.y);
					$('.addressfirstlane', mapdata).val(data.firstlane);
					$('.addresssecline', mapdata).val(data.secondlane);
					$('.phone', mapdata).val(data.phone);		
					
					$(par).remove();
					jadmin.scrollto("#locationinsert");
					jadmin.contactUpdated(thisparent);
				});
				
				
				$(".locationresult ul").sortable({
					stop : function(event, ui) {
						jadmin.contactUpdated($(ui.item).parents('.locationresult'));
					}
				}); 
			}
		},
		savednotif : function () {
			if($('.savedinfo').length) {				
				setTimeout(function(){
					$('.savedinfo').slideUp();
				}, 2000);
			}
		}, 
		frontslideSetup : function () {
			if($('.frontslider').length) {
				$(".arrange_slider ul").sortable({
					stop : function(event, ui) {
						var selector = ui.item.parent();
						var input = $(selector).parents('.frontslider').find('.frontslideresult');
						var res = new Array();
						
						$('.frontslideritem', selector).each(function(index, val){							
							res.push($(val).attr('data-id'));
						});
						
						$(input).val(JSON.stringify(res));
					}
				}); 
			}
		} ,
		sidebarUpdated : function (selector) {
			var sidebararray = new Array();
			
			$('.sidebarresultitem' , selector).each(function(index, val){
				if(index > 0) {
					var title = $('.sidebartitleitem', val).text();				
					sidebararray.push(title);
				}
			});
			
			$(selector).parent().find('.sidebarresult').val(JSON.stringify(sidebararray));
		}, 
		sidebarSetup : function() {
			if($('.sidebar').length) {
				$('.sidebarsubmit input').click(function(){
					var thisparent = $(this).parents('.setting-option');
					var sideinput = $('.sidebartitle', thisparent).val();
					var selector = thisparent.parent().find('.sidebarres');
					
					var template = '<li class="sidebarresultitem">' +
										'<div class="sidebarresulttext"><span class="sidebartitleitem">' + sideinput + '</span></div>' +	
										'<div class="sidebarresultdel">&nbsp;</div>' + 
									'</li>';
					$(selector).find("ul").append(template);
					$('.sidebartitle', thisparent).val('');
					jadmin.sidebarUpdated(selector);
				});
				
				$(document).on("click", ".sidebarresultdel" ,function(event) {
					var thisparent = $(this).parents('.sidebarres');
					$(this).parent().remove();
					jadmin.sidebarUpdated(thisparent);
				 });
			}
		},
		thememanagerUpdated : function (selector) {
			var managerarray = new Array();
						
			$('.thememanager_item' , selector).each(function(index, val){
				managerarray.push({
					'title'	: $('.thememanager_titleitem', val).text(),
					'schema'	: $('.thememanager_schema', val).text()
				});
			});
			
			$(selector).parent().find('.thememanagerresult').val(JSON.stringify(managerarray));
		},
		themeManager : function () {
			if($('.thememanager').length) {
				
				$(".thememanagersubmit input").click(function(){
					var thisparent = $(this).parents('.setting-option');
					var thememanagerinput = jadmin.convertToSlug($('.managertitle', thisparent).val());
					var themeschema = $('.managerschema', thisparent).is(':checked');
					var thememanagerschema = '';
					
					if(thememanagerinput == '') {
						alert("Please fill your thememanager name");					
					} else {
						if(themeschema == true) {
							thememanagerschema = 'dark';
						} else {
							thememanagerschema = 'light';
						}
						
						var selector = thisparent.parent().find('.thememanager_result');
						
						var template = '<li class="thememanager_item">' +
											'<div class="thememanager_text">' + 
											'<span class="thememanager_titleitem">' + thememanagerinput + '</span>' + 
											' (<span class="thememanager_schema">' + thememanagerschema + '</span>)' +
											'</div>' +	
											'<div class="thememanager_del">&nbsp;</div>' + 
										'</li>';
						
						$(selector).find("ul").prepend(template);
						$('.managertitle', thisparent).val('');
						jadmin.thememanagerUpdated(selector);
						alert("Dont forget to click save setting after update / create new Style manager");		
					}
				});
				
				$(document).on("click", ".thememanager_del" ,function(event) {
					var thisparent = $(this).parents('.thememanager_result');
					$(this).parent().remove();
					jadmin.thememanagerUpdated(thisparent);
				 });
				
				$(".thememanager_result ul").sortable({
					stop : function(event, ui) {
						jadmin.thememanagerUpdated($(ui.item).parents('.thememanager_result'));
					}
				}); 
				
			}
		},
		convertToSlug : function (Text)
		{
		    return Text
		        .toLowerCase()
		        .replace(/ /g,'-')
		        .replace(/[^\w-]+/g,'');
		} ,
		/** icon sortable **/
		iconUpdated : function (selector) {
			var iconarray = new Array();
			
			$('.iconresultitem' , selector).each(function(index, val){
				var icon = $('.iconresulticon', val).find('span').attr('class');
				var title = $('.hovertitle', val).text();
				var url = $('.iconurl', val).text();
				iconarray.push({
							'icon'	: icon,
							'title'	: title,
							'url'	: url
				});
			});
			
			$(selector).parent().find('.iconresultval').val(JSON.stringify(iconarray));
		},
		addIcon : function(selector, icon, hover, url) {
			var template = '<li class="iconresultitem">' +
								'<div class="iconresulticon"><span class="' + $(icon).find('span').attr('class') + '"></span></div>' +
								'<div class="iconresulttext"><span class="hovertitle">' + hover + '</span> - <span class="iconurl">'+ url  +'</span></div>' +
								'<div class="iconresultdel">&nbsp;</div>' +
							'</li>';
			$(selector).find("ul").append(template);
			jadmin.iconUpdated(selector);
		},
		iconSetup : function() {
			if($(".iconset").length) {
				$(".iconset li").click(function(){
					$(this).parent().find('li').removeClass('iconitemselect');
					$(this).addClass('iconitemselect');
				});
				$(".iconsubmit input").click(function(){
					var thisparent = $(this).parents('.setting-option');
					var result = thisparent.parent().find('.iconresult');
					var iconset = thisparent.find('.iconset');

					// save selection
					var iconselect 	= $(iconset).find('.iconitemselect');
					var hovertitle 	= $(thisparent).find('.hovertitle').val();
					var iconurl 	= $(thisparent).find('.iconurl').val();
					
					if($(iconselect).length) {
						// bersihin
						$(iconset).find('li').removeClass('iconitemselect');
						$(thisparent).find('.hovertitle').val('');
						$(thisparent).find('.iconurl').val('');
						
						// add icon 
						jadmin.addIcon(result, iconselect, hovertitle, iconurl);
					} else {
						alert("please choose your icon");
					}
				});
				
				$(document).on("click", ".iconresultdel" ,function(event) {
					var thisparent = $(this).parents('.iconresult');
					$(this).parent().remove();
					jadmin.iconUpdated(thisparent);
				 });
				
				$(".iconresult ul").sortable({
					stop : function(event, ui) {
						jadmin.iconUpdated($(ui.item).parents('.iconresult'));
					}
				}); 
			}
		},	
		/** icon sortable end **/
		setSwitchToogle : function() {
			if($(".switchtoogle").length) {
				$(".switchtoogle").iButton();
			}
		},
		attachUpload : function() {
			 if($(".uploadfile").length) {
				 $(".uploadfile .selectfile").each (function (){
				 	console.log(this);
					 $(this).click(function(e) {
					 	var element = this;
							e.preventDefault();
						 	
						 	//If the uploader object has already been created, reopen the dialo
						 	if (custom_uploader) {
						 		custom_uploader.open();
						 		return;
							}
					 		
					        //Extend the wp.media object
					        custom_uploader = wp.media.frames.file_frame = wp.media({
					            title: "Select File",
					            button: {
					                text: "Select File"
					            },
					            multiple: false
					        });
					 
					        //When a file is selected, grab the URL and set it as the text field's value
					        custom_uploader.on('select', function() {
					            attachment = custom_uploader.state().get('selection').first().toJSON();
					            $(element).parent().find('.uploadtext').val(attachment.url);
					        });
					        
					        //Open the uploader dialog
					        custom_uploader.open();	
							return false;
					 });
					 
				 });
			 }
		},
		helpclick : function() {
			$(document).on("click", ".moreinfo" ,function(event) {
				$(this).addClass('lessinfo').removeClass('moreinfo');
				$(this).parent().find('.help').slideDown("fast");	 
			 });
			
			$(document).on("click", ".lessinfo" ,function(event) {
				$(this).addClass('moreinfo').removeClass('lessinfo');
				$(this).parent().find('.help').slideUp("fast");
			 });
		},
		setNavActive : function (idx) {
			var cookie = jadmin.getCookie();
			
			cookie.active = idx;			
			jadmin.setCookie(cookie);
		},
		setTabActive : function (idx) {
			var cookie = jadmin.getCookie();
			
			cookie.state[cookie.active] = idx;			
			jadmin.setCookie(cookie);
		},
		setCookie : function(cookie) {
			$.cookie(admincookiename, JSON.stringify(cookie), { expires: 30, path: '/' });
		},
		getCookie : function () {
			var navicookie = $.cookie(admincookiename);			
			return $.parseJSON(navicookie);
		},
		navclick: function (){
			$('.jad-body-navi li.navi').click(function(){
				if(!$(this).hasClass('active')) {
					// remove active state
					$('.jad-body-navi li').removeClass('active');
					$('.jad-body-content').removeClass('body-active');
					
					// add active state						
					var idx = $(this).index() - 1;
					$(this).addClass('active');
					$($('.jad-body-content').get(idx)).addClass('body-active');
					
					// set nav active
					jadmin.setNavActive(idx);
				}
			});
		}, 
		tabclick : function() {
			$('.jad-tab li').click(function(){
				if(!$(this).hasClass('active')) {
					var parent = $(this).parents('.jad-body-content');
					var tab = $(this).parent();
					
					// remove active state
					$('li', tab).removeClass('active');
					$('.jad-content', parent).removeClass('content-active');
					
					// add active state
					var idx = $(this).index() ;
					$(this).addClass('active');
					$($('.jad-content', parent).get(idx)).addClass('content-active');
					
					jadmin.setTabActive(idx);
				}				
			});
		}
	};
	
	
	$(document).ready(function(){
		metabox.init();
		jadmin.init();
	});
	
})(jQuery);
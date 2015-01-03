/*
 Author: Jegbagus
 */

// check if screenwidth is avaliable for animation
var scw = function(i){
    if(jQuery(window).width() >= i) {
        return true;
    } else {
        return false;
    }
};

var mediaquerywidth			= 767 + 1;
var iphonewidth				= 480 + 1;
var optioncurtain			= 0;
var defaultexecuted 		= 0;

/** music **/
var musicplayer				= null;
var mppaused				= false;
jQuery(document).ready(function($){
    var mplist = $("#mplist");

    if(mplist.length > 0){
        $(".openplaylist").click(function(){
            $(mplist).fadeIn();
            return false;
        });

        $(".mpcls").click(function(){
            $(mplist).fadeOut();
            return false;
        });
    }
});

var mpnotifbox = function(lang) {
    jQuery(".mpnotif").html(lang);
    jQuery(".mpnotif").fadeIn();

    setTimeout(function(){
        jQuery(".mpnotif").fadeOut();
    }, 3000);
};

var muteplayer = function() {
    if(typeof mplang != 'undefined') {
        mpnotifbox(mplang.playlistmuted);
        jQuery("#jquery_jplayer").jPlayer("mute");
    }
};

var unmuteplayer = function() {
    if(typeof mplang != 'undefined') {
        /* mpnotifbox(mplang.playlistunmuted); */
        jQuery("#jquery_jplayer").jPlayer("unmute");
    }
};
/** music end **/

(function($) {
    $.fn.outerHTML = function() {
        return $(this).clone().wrap('<div></div>').parent().html();
    };
})(jQuery);


var notifbox = function(content, timeout){
    var notiftimeout = undefined;
    var notif 	= jQuery(".notification");
    var top		= jQuery(notif).css('top');
    var topdest	= 80;

    if(jQuery(notif).attr('data-small-menu') == 1) {
        topdest = 40;
    }

    /** show notification **/
    jQuery(notif).show();
    jQuery(notif).addClass('unfolded');

    // position
    var setpos = function() {
        var leftpos = (jQuery(window).width() - jQuery(notif).width()) / 2;
        jQuery(notif).css({left : leftpos});
    };

    setpos();
    jQuery(window).resize(function(){ setpos(); });

    var closeNotif = function(callback){
        clearTimeout(notiftimeout);
        jQuery(notif).animate({top : 0}, 'fast', function(){
            jQuery(notif).hide().removeClass('unfolded');

            callback = callback || jQuery.noop;
            callback();
        });
    };

    var showNotif = function(){
        jQuery('.notification-content',notif).html(content);
        jQuery(notif).show().animate({top : topdest}, 'fast');
        jQuery(notif).addClass('unfolded');
        if(timeout > 0) {
            clearTimeout(notiftimeout);
            notiftimeout = setTimeout(function(){
                closeNotif();
            }, timeout);
        }
    };

    jQuery('.closeme', notif).click(function(){
        closeNotif();
    });

    jQuery(window).bind("jmainremove", function(){
        jQuery(notif).hide();
    });

    if(!jQuery(notif).hasClass('unfolded')) {
        showNotif();
    } else {
        closeNotif(showNotif);
    }
};

/** header navigation **/
jQuery(document).ready(function($)
{
    var pos;
    var slideHeight 	= 45;
    var increasedMargin = 40;
    var slideDownEle 	= undefined;
    var touch			= false;

    if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
        touch = true;
    }

    // add haschild
    $("nav li").each(function(){
        var i = $(this);
        $(i).find('li').each(function(){
            if(!$(this).hasClass('haschild')) {
                var ul = $(this).children('ul');
                if(ul.length > 0) {
                    $(this).addClass('haschild');
                    $(this).children('a').prepend('<div class="icon-white"></div>');
                }
            }
        });
    });

    var getPos = function(obj) {
        var submenu 	= $(obj);
        var pp 			= $(obj).parent().position().left;
        var pw			= $(obj).parent().width();
        pp = pp + ( pw / 2 ) ;
        var ww 			= $(window).width();
        var sw			= 0;

        $(obj).children('li').each(function(){
            sw += $(this).width();
        });

        pos = pp - (sw / 2);

        if(pos < 0) {
            pos = 1;
        } else if( ( pos + sw ) > ww ) {
            pos = ww - sw - 1;
        }

        return pos;
    };

    var menuSlideDown = function(i){
        var childLength = $(i).children("ul").length;
        if(childLength == 0) {
            if(touch) {
                var loc = $(i).find('a').attr('href');
                tourl(loc, true);
            }
        } else {
            // $(i).children("ul").height(slideHeight).css({'padding-left' : pos});

//			var c = $(i).children("ul");			
//			var ml = getPos(c);
//			$(c).css({
//				'padding-left' 	: ml,
//				'width'			: ($(window).width() - ml)
//			});

            $(i).children("ul").stop().slideDown("fast", function(){
                var ml = getPos(this);
                $(this).animate({'padding-left' : ml}, function(){
                    $(this).width($(window).width() - ml);
                });
            });
        }
    };

    var parentMenuSlideUp = function(i) {
        var slideparentmenu = function() {
            if(i.parent().hasClass('menu')) {
                $(i).find('.bgmenu').stop().animate({
                    height : 0
                }, 150, function(){
                    $(i).find('a').removeClass('whitecolor');

                    // ini HACK PARAH!
                    if(touch) {
                        setTimeout(function(){
                            var nekad = $(i).parent().outerHTML();
                            $(i).parent().parent().html("").append(nekad);
                            bindHoverIntent();
                        }, 1200);
                    }

                    $(this).remove();
                });
            }
        };

        if(touch) {
            var ul = $(i).children('ul');

            if(ul.length > 0) {
                slideparentmenu();
            } else {
                setTimeout(function(){
                    slideparentmenu();
                }, 500);
            }

        } else {
            slideparentmenu();
        }
    };

    var menuSlideUp = function(i){
        var child = $(i).children("ul");
        if(child.length > 0) {
            $(i).children("ul").stop().slideUp("fast", function(){
                parentMenuSlideUp(i);
                // fix overflow slideup bug on ipad
                $(this).css({ "overflow": "", "height" : "auto" });
            });

        } else {
            parentMenuSlideUp(i);
        }
    };

    var bindHoverIntent = function() {
        $("header nav li").hoverIntent({
            over: function(){
                if(scw(mediaquerywidth)) {
                    var i = $(this);

                    // save last slide down element
                    slideDownEle = i;

                    $(i).find('a').addClass('whitecolor');
                    if(i.parent().hasClass('menu')) {
                        var bgmenu = "<div class='bgmenu'></div>";
                        $(i).prepend(bgmenu);

                        menuSlideDown(i);

                        $(i).find('.bgmenu').css({
                            "width" : $(i).width()
                        }).stop().animate({
                            height : $(i).height()
                        }, 150, function(){});

                    } else {
                        menuSlideDown(i);
                    }
                }
            },
            out: function(){
                if(scw(mediaquerywidth)) {
                    var i = $(this);
                    menuSlideUp(i);
                }
            } ,
            timeout: 250
        });
    };
    bindHoverIntent();


    var findparent = function (i) {
        if($(i).parent().hasClass('menu')) {
            return $(i);
        } else {
            return findparent($(i).parent());
        }
    };

    var slideUpChild = function(i){
        var ul = $(i).children('ul');

        if(ul.length > 0) {
            $(ul).slideUp("fast");
            $(ul).children('li').each(function(){
                slideUpChild($(this));
            });
        }
    };

    var slideUpMe = function(i){
        var parent = findparent(i);
        parentMenuSlideUp(parent);
        slideUpChild(parent);
    };


    $(window).bind("menuslideup", function(){
        if(slideDownEle !== undefined) {
            slideUpMe(slideDownEle);
        }
    });
});


/** history **/
//return true kalo dia mau slide keatas
var checktourl = function(url){

    var base 	= base_url;
    var curloc 	= document.URL;
    var nextloc	= url;

    var index = nextloc.indexOf(base);

    if(index == 0 ){
        var tempcurloc = curloc.split("#");
        var tempnextloc = nextloc.split("#");

        if(tempcurloc[0] == tempnextloc[0]) {
            var hashindex = nextloc.indexOf("#");
            if(hashindex == -1) {
                return false;
            } else {
                return true;
            }
        } else {
            if(curloc == nextloc) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return true;
    }
};

String.prototype.unescapeHtml = function () {
    var temp = document.createElement("div");
    temp.innerHTML = this;
    var result = temp.childNodes[0].nodeValue;
    temp.removeChild(temp.firstChild);
    return result;
};

var ajax_request = undefined;
var tourl = function(i, push){

    var cururl = document.URL;

    if(!scw(iphonewidth)) {
        window.location = i;
    } else {
        if ( ( Modernizr.history && jcurtain ) != 0) {
            if(!checktourl(i)) {
                if(push) {
                    history.pushState({ href: i }, '', i);
                }

                jQuery("html, body").animate({
                    scrollTop: 0
                }, function(){});

                var wh = jQuery(window).height();

                jQuery(window).trigger("menuslideup");

                unmuteplayer();

                function exeAjax () {
                    /** remove before executing ajax main **/
                    jQuery("#main").remove();
                    jQuery(window).trigger("jmainremove");

                    var replace_body = function (data) {
                        // append data
                        jQuery("div[role=main]").empty().append(data);

                        // check jika page wrapper ga ada, maka ini dia bukan response kita, langsung aja lempar keluar
                        if(jQuery('.pagemetawrapper').length == 0) window.location = i;

                        // change title
                        document.title = jQuery('.pagemetawrapper .pagemetatitle').text().unescapeHtml();

                        // @todo : ganti language nya aja
                        jQuery(".langwrapper").html(jQuery(data).find('.langwrapper').html());

                        /** curtain loader **/
                        if(curtainstyle == "fade") {
                            jQuery('.curtain').fadeOut("slow");
                        } else {
                            jQuery(".curtain-loader").fadeOut();
                            jQuery('.curtain').animate({'height'	: 0}, 1500, function(){});
                        }
                    };


                    if(ajax_request !== undefined) {
                        ajax_request.abort();
                    }

                    ajax_request = jQuery.ajax({
                        url: i,
                        type : "POST",
                        dataType : "html",
                        success: function(data) {

                            if(i!='http://www.takenbymarc.com/')
                            {
                                jQuery('#musBars').attr('src','/wp-content/themes/jphotolio_v453/css/img/barsoff.gif');
                                jQuery('#jquery_jplayer').jPlayer("stop");
                                jQuery(this).attr('class','ply');
                            }
                            else
                            {
                                jQuery('#musBars').attr('src','/wp-content/themes/jphotolio_v453/css/img/bars.gif');
                                jQuery('#jquery_jplayer').jPlayer("play");
                                jQuery(this).attr('class','stp');
                            }

                            replace_body(data);
                        },
                        error : function(xhr, ajaxOptions, thrownError) {
                            if(xhr.status == '404') {
                                replace_body(xhr.responseText);
                            } else {
                                window.location = i;
                            }
                        }
                    });

                }

                if(curtainstyle == 'fade'){
                    jQuery('.curtain').fadeIn(500, function(){
                        exeAjax();
                    });
                } else {
                    jQuery('.curtain').animate({
                        'height'	: '100%'
                    }, 300, function(){
                        jQuery(".curtain-loader").fadeIn();
                        exeAjax();
                    });
                }

                return false;
            }
            return true;
        } else {
            window.location = i;
        }
    }
};

window.tourl = tourl;




jQuery(document).ready(function($)
{
    if (Modernizr.history) {
        /** popstate **/
        window.onpopstate = function(e){
            if(e.state !== null) {
                return tourl(e.state.href, false);
            }
        };
    }

    // define curtain position
    if(curtainstyle == 'fade'){
        $(".curtain").addClass('curtainfade');
    }

    $('.navselect select').change(function(){
        tourl($(this).val(), true);
    });

    /*Stop music added feature */
    $('#stopmusic').click(function(e){

        var clsName=jQuery(this).attr('class');

        if(clsName==='stp'){
            jQuery('#musBars').attr('src','/wp-content/themes/jphotolio_v453/css/img/barsoff.gif');
            jQuery('#jquery_jplayer').jPlayer("stop");
            jQuery(this).attr('class','ply');
        }
        else
        {
            jQuery('#musBars').attr('src','/wp-content/themes/jphotolio_v453/css/img/bars.gif');
            jQuery('#jquery_jplayer').jPlayer("play");
            jQuery(this).attr('class','stp');
        }

        e.preventDefault();

    })

});

(function($) {
    /** rebinding a href **/
    $.fn.jegdefault = function( options )
    {
        var settings = {
            curtain			: false,
            rightclick		: true,
            clickmsg		: ''
        };

        if (options) {
            var options = $.extend(settings, options);
        } else {
            var options = $.extend(settings);
        }

        if(!options.rightclick && defaultexecuted == 0) {
            $(document).bind('contextmenu', function (e) {
                if( e.button == 2 ) {
                    e.preventDefault();
                    alert(options.clickmsg);
                }
                return true;
            });
        }

        if (Modernizr.history) {
            $('a').not('[data-tourl="false"]').unbind('click');
            if(options.curtain) {
                $('a').not('[data-tourl="false"]').bind('click', function(){
                    if(!$(this).parents("#wpadminbar").length) {
                        return tourl(this.href, true);
                    } else {
                        return true;
                    }
                });
            }
        }

        /** alert **/
        $('[data-dismiss="alert"]').click(function(){
            $(this).parent().fadeOut();
        });

        /** tab **/
        $('[data-tab="tab"]').each(function(){
            var i 	= $(this),
                el 	= [$("> .nav-tabs > li", i), $("> .tab-content > .tab-pane", i)];

            $(el).each(function(){
                $(this).parent().children(":first").addClass("active");
            });

            $("> .nav-tabs li", i).click(function() {
                if(!$(this).hasClass("active")) {
                    var a = "active";
                    $(el).each(function(){$(this).removeClass(a);});
                    $(this).addClass(a);
                    $(el[1].get(el[0].index(this))).addClass(a);

                    $(window, document).trigger('resize');
                }
                return false;
            });
        });

        /** colapse **/
        $('[data-accordion="accordion"]').each(function(){
            var i = $(this);
            var acb = "> .accordion-body", acg = "> .accordion-group";

            var showAccordion = function (el) {
                if($(el).hasClass("active")) {
                    hideAccordion(el);
                } else {
                    $(acb, el).slideDown("fast");
                    $(el).addClass("active");
                }
            };

            var hideAccordion = function(el) {
                $(acb, el).slideUp("fast");
                $(el).removeClass("active");
            };

            showAccordion($(acg , i).get(0));
            hideAccordion( $(acg , i).not(":eq(0)") );

            $(acg , i).click(function(e){
                var idx = $(acg , i).index(this);
                showAccordion($(acg , i).get(idx));
                hideAccordion($(acg , i).not(":eq("+idx+")") );
                return false;
            });
        });

        /** tooltips **/
        $('[data-rel="tooltip"]').tipTip({maxWidth: "auto", edgeOffset: 10, defaultPosition: "top", delay : 100});

        /** remove me **/
        $('.removeme').remove();


        /** fix bug when image expanded **/
        $("html").css("overflow-y", "").css("overflow-x", "").css("overflow", "");

        // default has been executed
        defaultexecuted++;
    };
})(jQuery);
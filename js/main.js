jQuery(document).ready(function(e){function n(){if(t<758){e(".toggleMenu").css("display","inline-block");if(!e(".toggleMenu").hasClass("active")){e(".nav").hide()}else{e(".nav").show()}e(".nav li").unbind("mouseenter mouseleave");e(".nav li a.parent").unbind("click").bind("click",function(t){t.preventDefault();e(this).parent("li").toggleClass("hover")})}else{e(".toggleMenu").css("display","none");e(".nav").show();e(".nav li").removeClass("hover");e(".nav li a").unbind("click");e(".nav li").unbind("mouseenter mouseleave").bind("mouseenter mouseleave",function(){e(this).toggleClass("hover")})}}var t=document.body.clientWidth;jQuery(document).ready(function(e){e(".toggleMenu").click(function(t){t.preventDefault();e(this).toggleClass("active");e(".nav").toggle()});e(".nav li a").each(function(){if(e(this).next().length>0){e(this).addClass("parent")}});n()});jQuery(window).bind("resize orientationchange",function(e){t=document.body.clientWidth;n()});jQuery(function(e){function o(){return t.find(r)}function u(){return n.find(r)}var t=e(".slider");var n=e(".slider_buttons");var r="li";var i=1e3;var s=4e3;o().fadeOut();o().first().addClass("active");o().first().fadeIn(0);u().first().addClass("active");$interval=setInterval(function(){var e=t.find(r+".active").index();o().eq(e).removeClass("active");o().eq(e).fadeOut(i);var s=n.find(r+".active").index();u().eq(s).removeClass("active");if(u().length==s+1)s=-1;u().eq(s+1).addClass("active");if(o().length==e+1)e=-1;o().eq(e+1).fadeIn(i);o().eq(e+1).addClass("active")},i+s)});var r=e(".slider_buttons");r.children("li").click(function(){var t=e(this).index()+1})})
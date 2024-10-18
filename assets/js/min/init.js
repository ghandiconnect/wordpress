"use strict";!function(r,c,l){function d(e,t,i,a,s){t.classList.add(i),a.classList.add(s),e.setAttribute("aria-expanded","true"),"search_toggle"===e.id&&c.getElementById("search_dropdown").children[0].children[0].focus(),"message_top_toggle"!==e.id&&"message_bottom_toggle"!==e.id||(function(e){var t=new Date;t.setTime(t.getTime()+31536e6);var i="expires="+t.toUTCString();t.cookie=e+"=1;"+i+";path=/"}(e.getAttribute("data-id")),e.parentNode.remove())}function u(e,t,i,a,s){t.classList.remove(i),a.classList.remove(s),e.setAttribute("aria-expanded","false")}function p(e,t){return-1!==e.className.indexOf(t)}function g(t,i,a,s,n){var o=c.getElementById(i),l=c.getElementById(t);o&&l&&(o.addEventListener("click",function(e){(p(l,a)?u:d)(o,l,a,s,n)}),s.addEventListener("click",function(e){p(l,a)&&e.target!==o&&e.target.closest("#"+i)!==o&&!e.target.closest("#"+t)&&u(o,l,a,s,n)}),"message_top_toggle"!==i&&"message_bottom_toggle"!==i&&r.addEventListener("scroll",function(e){p(l,a)&&u(o,l,a,s,n)}))}function m(){var e;"undefined"!=typeof Masonry&&"undefined"!=typeof imagesLoaded&&(e=.481929*l(".format-gallery .post-thumbnail-wrap").width(),l(".masonry .format-gallery .post-thumbnail-wrap").css("min-height",e),l(".masonry .format-gallery .flexslider li img").css("min-height",e))}function v(){l(".toggle_submenu").remove(),l("body").innerWidth()<1199&&l("ul.menu-many-items").find("li").each(function(){var i=l(this);i.find("ul").length&&i.append('<span class="toggle_submenu"></span>').find(".toggle_submenu, > a").on("click",function(e){var t=l(this);"#"!==t.attr("href")&&t.parent().hasClass("active-submenu")||e.preventDefault(),(t.parent().hasClass("active-submenu")?t.parent():i.addClass("active-submenu").siblings()).removeClass("active-submenu")})})}function h(){var e=l('input[type="number"]');e.before('<input type="button" value="+" class="plus"><i class="fa fa-caret-up" aria-hidden="true"></i>'),e.after('<input type="button" value="-" class="minus"><i class="fa fa-caret-down" aria-hidden="true"></i>'),l(".plus").on("click",function(e){var t=l(this).parent().find('[type="number"]'),i=""===t.val()?0:t.val();t.val(parseFloat(i)+1).trigger("change")}),l(".minus").on("click",function(e){var t=l(this).parent().find('[type="number"]'),i=""===t.val()?0:t.val();t.val(parseFloat(i)-1).trigger("change"),i<1&&t.val(0)})}function f(){var e=l(".shop_table");e.find('.quantity input[type="number"]').on("change",function(){setTimeout(function(){e.find('button[name="update_cart"]').trigger("click")},300)})}var e,i,a;l("select").wrap('<div class="select-wrap"></div>'),l(".header .top-nav ul.sub-menu ul.sub-menu").wrap("<div class='menu-padding-wrap'>"),l("#toggle_shop_view").on("click",function(e){e.preventDefault(),l(this).toggleClass("grid-view"),l("#products, ul.products").toggleClass("grid-view list-view"),l.cookie&&(l("#products, ul.products").hasClass("list-view")?l.cookie("grid-view","list-view"):l.cookie("grid-view","grid-view"))}),l.cookie&&"list-view"==l.cookie("grid-view")&&l("#toggle_shop_view").trigger("click"),c.addEventListener("DOMContentLoaded",function(e){var t=c.body;g("nav_top","nav_toggle","active",t,"top-menu-active"),g("nav_side","nav_side_toggle","active",t,"side-menu-active"),g("search_dropdown","search_toggle","active",t,"search-dropdown-active"),g("search_dropdown_alt","search_toggle_alt","active",t,"search-dropdown-alt-active"),g("login_dropdown","login_toggle","active",t,"login-dropdown-active"),g("topline_dropdown","topline_dropdown_toggle","active",t,"topline-dropdown-active"),g("dropdown-cart","dropdown-cart-toggle","active",t,"cart-dropdown-active"),g("message_top","message_top_toggle","active",t,"messagee-top-active"),g("message_bottom","message_bottom_toggle","active",t,"messagee-bottom-active"),v();var i=c.getElementById("nav_close");i&&i.addEventListener("click",function(e){c.body.dispatchEvent(new Event("click"))}),l().superfish&&l("ul.sf-menu-side").superfish({popUpSelector:"ul:not(.mega-menu ul), .mega-menu ",delay:500,animation:{opacity:"show",height:"100%"},animationOut:{opacity:"hide",height:0},speed:400,speedOut:300,disableHI:!1,cssArrows:!0,autoArrows:!0}),function(e){for(var t=0;t<e.length;++t)e[t].addEventListener("click",function(e){e.preventDefault()})}(c.querySelectorAll('a[href="#"]'));var a,s,n=c.getElementById("header-affix-wrap");n&&(i=c.getElementById("header"),s=(a=i).offsetTop+200,r.onscroll=function(e){r.pageYOffset>=s?a.classList.add("affix"):a.classList.remove("affix"),0==r.pageYOffset&&a.classList.remove("affix"),this.oldScroll>this.scrollY?(a.classList.add("scrolling-up"),a.classList.remove("scrolling-down")):(a.classList.remove("scrolling-up"),a.classList.add("scrolling-down")),this.oldScroll=this.scrollY}),m(),function(){if("undefined"!=typeof Masonry&&"undefined"!=typeof imagesLoaded){var e=c.querySelectorAll(".masonry");if(e.length)for(var t=0;t<e.length;t++)imagesLoaded(e[t],function(e){new Masonry(e.elements[0],{itemSelector:".grid-item",columnWidth:".grid-sizer",percentPosition:!0})});var i=c.querySelectorAll(".masonry-grid");if(i.length)for(var a=0;a<i.length;a++)imagesLoaded(i[a],function(e){new Masonry(e.elements[0],{itemSelector:".wp-block-group__inner-container>*",columnWidth:".wp-block-group__inner-container>*",percentPosition:!0})})}}(),"undefined"!=typeof GLightbox&&(new GLightbox({selector:".blocks-gallery-item  figure a, .gallery figure a"}),new GLightbox({selector:'a[href*="youtube.com"]:not(.social-icon), a[href*="youtu.be"], a[href*="vimeo.com"]'})),l(".wp-block-getwid-recent-posts__entry-meta .heading-inner").each(function(){l(this).prepend(l(this).closest(".wp-block-getwid-recent-posts__content-wrapper").find(".wp-block-getwid-recent-posts__post-categories").html())});var o=c.getElementById("to-top");o&&(o.addEventListener("click",function(e){e.preventDefault(),r.scroll({top:0,left:0,behavior:"smooth"})}),r.addEventListener("scroll",function(e){60<r.pageYOffset?o.classList.add("visible"):o.classList.remove("visible")})),(o||n)&&r.dispatchEvent(new Event("scroll")),t.classList.add("dom-loaded"),h(),f(),document.getElementById("yith-quick-view-modal")&&(t=document.querySelectorAll(".product .yith-wcqv-button"),[].slice.call(t).forEach(function(e){e.addEventListener("click",function(){var e=document.getElementById("yith-quick-view-modal"),t=new MutationObserver(function(e){e.length&&h(),t.disconnect()});t.observe(e,{childList:!0,subtree:!0})})}))}),e=".modalLoginWrap .btn.btn-gradient",i=[".modalLoginWrap .modal-login",".modalLoginWrap .modal-registration"],(a=document.querySelector(".modalLoginWrap"))&&a.querySelectorAll(e).forEach(function(e){e.addEventListener("click",function(e){i.forEach(function(e){a.querySelector(e).classList.remove("active")});var t=this.dataset.toggle;a.querySelector("."+t).classList.add("active")})}),l("body").on("updated_cart_totals",function(e){h(),f()}),document.querySelector(".iq-rotate-text")&&l(".iq-rotate-text").each(function(){new CircleType(this)}),r.onload=function(){function i(){return window.innerWidth<768?1:window.innerWidth<1200?2:3}var e,t,a;l().flexslider&&(l(".page_slider .flexslider").each(function(e){var t=l(this),i=t.data(),a="undefined"===i.nav||i.nav,s="undefined"===i.dots||i.dots,n="undefined"===i.slideshow||i.slideshow,o="undefined"!==i.speed?i.speed:5e3,i="undefined"!==i.animation?i.animation:"slide";t.flexslider({animation:i,pauseOnHover:!0,useCSS:!0,controlNav:s,directionNav:a,prevText:"",nextText:"",smoothHeight:!1,slideshow:n,slideshowSpeed:o,animationSpeed:600}).find(".flex-control-nav").wrap('<div class="container nav-container"/>')}),l(".flexslider").each(function(e){var t=l(this);t.find(".flex-active-slide").length||t.flexslider({animation:"slide",useCSS:!0,controlNav:!0,directionNav:!0,prevText:"<",nextText:">",smoothHeight:!1,slideshow:!0,slideshowSpeed:5e3,animationSpeed:800})}),l(".flexslider-products").each(function(e){var t=l(this);t.find(".flex-active-slide").length||t.flexslider({animation:"slide",pauseOnHover:!0,useCSS:!0,controlNav:!0,directionNav:!1,prevText:"<",nextText:">",smoothHeight:!1,slideshow:!0,slideshowSpeed:5e3,animationSpeed:800,itemWidth:370,itemMargin:30,minItems:i(),maxItems:i()})})),l().owlCarousel&&(e=l(".related.products ul.products, .up-sells.products ul.products, .cross-sells ul.products"),l(".related.products ul.products").removeClass("columns-2 columns-3 columns-4"),l(".up-sells.products ul.products").removeClass("columns-2 columns-3 columns-4"),l(".cross-sells ul.products").removeClass("columns-2 columns-3 columns-4"),e.addClass("owl-carousel with_shadow_items").owlCarousel({loop:!1,margin:30,nav:!0,dots:!1,responsive:{0:{items:1},767:{items:2},992:{items:2},1200:{items:3}}}),e.hasClass("with_shadow_items")&&e.find(".owl-stage-outer").wrap('<div class="owl-stage-outer-wrap"></div>'),l(".widget_media_gallery.layout-carousel .gallery").removeClass("gallery-columns-2 gallery-columns-3 gallery-columns-4 gallery-columns-5 gallery-columns-6 gallery-columns-7 gallery-columns-8 gallery-columns-9").addClass("owl-carousel").owlCarousel({loop:!0,nav:!0,navText:['<span class="ico-uniF103"></span> prev','next <span class="ico-uniF103"></span>'],dots:!1,autoplay:!0,autoplayTimeout:5e3,autoplayHoverPause:!0,items:1})),document.querySelector(".slide-video")&&(s=(t=document.querySelector(".slide-video")).querySelector("source").getAttribute("src"),a=t.querySelector("source").dataset.time,t.paused&&(t.querySelector("source").src=s,t.load(),t.currentTime=0,t.volume=0,t.play(),t.addEventListener("timeupdate",function(){this.currentTime>=a&&(t.currentTime=0,t.volume=0,t.play())})),jQuery(".slides").on("classChanged","li:first",function(){t.currentTime=0,t.volume=0,t.play(),t.addEventListener("timeupdate",function(){26<=this.currentTime&&(t.currentTime=0,t.volume=0,t.play())})})),l("#back-btn").on("click",function(e){e.preventDefault(),window.history.back()});var s=".form-control";l(s).on("focusin",function(){l(this).parent().find("label").addClass("active")}),l(s).on("focusout",function(){this.value||l(this).parent().find("label").removeClass("active")});s=".wpcf7-form-control";l(s).on("focusin",function(){l(this).closest(".floating-label").find("label").addClass("active")}),l(s).on("focusout",function(){this.value||l(this).closest(".floating-label").find("label").removeClass("active")}),l(".wpcf7-form-control.wpcf7-validates-as-required").closest(".floating-label").find("label").append("<sup> *</sup>"),c.body.classList.add("window-loaded");s=c.getElementById("preloader");s&&s.classList.add("loaded")},l(".header-special .close-wrapper a").on("click",function(){l(this).closest(".header-special").removeClass("active-slide-side-header"),l("#body").removeClass("active-side-header slide-right")});var t=l(".page_header_side");t.length&&(s=l("#body"),l(".toggle_menu_side").on("click",function(){var e=l(this);e.hasClass("header-slide")?t.toggleClass("active-slide-side-header"):e.parent().hasClass("header_side_right")?s.toggleClass("active-side-header slide-right"):s.toggleClass("active-side-header")}),s.on("mousedown touchstart",function(e){l(e.target).closest(".page_header_side").length||(t.removeClass("active-slide-side-header"),s.removeClass("active-side-header slide-right"),(e=l(".toggle_menu_side")).hasClass("active")&&e.removeClass("active"))})),l("ul.menu-side-click").find("li").each(function(){var i=l(this);i.find("ul").length&&i.append('<span class="activate_submenu"></span>').find(".activate_submenu, > a").on("click",function(e){var t=l(this);"#"!==t.attr("href")&&t.parent().hasClass("active-submenu")||e.preventDefault(),(t.parent().hasClass("active-submenu")?t.parent():i.addClass("active-submenu").siblings()).removeClass("active-submenu")})});var s,n=l(".page_header_side_special");n.length&&(s=l("#body"),l(".toggle_menu_side_special").on("click",function(){l(this).hasClass("header-slide")?n.toggleClass("active-slide-side-header-special"):l(this).parent().hasClass("header_side_right")?s.toggleClass("active-side-header slide-right"):s.toggleClass("active-side-header")})),l(".blog .bg_teaser, .archive .bg_teaser").each(function(){var e=l(this),t=e.find("img").first().attr("src");t&&e.find(".item-content").css("background-image","url("+t+")"),e.find(".bg_overlay").length||e.find(".item-content").prepend('<div class="bg_overlay"/>')}),l("blockquote.blockquote-bg").each(function(){let e=l(this),t=e.find("img");0<t.length&&(e.wrap('<div class="i"></div>'),e.attr("style",'background-image: url("'+t.attr("src")+'")'),e.addClass("blockquote-has-image"),t.remove())}),l("blockquote").find(".wp-block-image").each(function(){l("blockquote").addClass("with-image")}),l("a.share_button").on("click",function(e){l(".dropdown-menu").toggleClass("show")}),l(".comment-respond").addClass("with_shadow"),l("footer.footer-with-special-column").find(".widget-2").addClass("l text-center footer-special-column"),l(".widget_top_rated_products, .widget_products, .widget_recent_reviews, .widget_recently_viewed_products").addClass("widget_popular_entries darklinks"),l(".widget_shopping_cart").addClass("darklinks"),l(".widget_categories").addClass("greylinks"),l(".woocommerce-product-search").find(".search-field").addClass("form-control"),l(".widget_product_categories, .widget_layered_nav").addClass("widget_categories greylinks").find("span.count").addClass("highlight"),l(".widget_product_tag_cloud").addClass("widget_tag_cloud"),l(".widget_rating_filter .wc-layered-nav-rating").find("a").wrapInner('<span class="count"></span>').find(".star-rating").each(function(){l(this).insertBefore(l(this).parent())}),l("section.related.products h3 span").each(function(){var e=l(this);e.html(e.html().replace(/^(\w+)/,"<span>$1</span>"))}),l("ul.product_list_widget li a>img, ul.cart_list li a>img").wrap('<span class="product-img-wrapper"></span>'),l(r).resize(function(){v(),m()}),l("#uploadtextfield").on("click",function(){l("#fileuploadfield").click()}),l("#uploadbrowsebutton").on("click",function(){l("#fileuploadfield").click()}),l("#fileuploadfield").on("change",function(){l("#uploadtextfield").val(l(this).val())}),l(".with-particles").each(function(){var e=l(this),t=e.find(".particles-js").attr("id"),e=e.hasClass("l")?"#61728a":"#fff";particlesJS(t,{particles:{number:{value:90,density:{enable:!0,value_area:800}},color:{value:e},shape:{type:"circle",stroke:{width:0,color:"#color"},polygon:{nb_sides:5},image:{src:"img/github.svg",width:100,height:100}},opacity:{value:.15,random:!1,anim:{enable:!1,speed:1,opacity_min:.1,sync:!1}},size:{value:5,random:!0,anim:{enable:!1,speed:40,size_min:.1,sync:!1}},line_linked:{enable:!0,distance:150,color:e,opacity:.1,width:1},move:{enable:!0,speed:1,direction:"none",random:!1,straight:!1,out_mode:"out",bounce:!1,attract:{enable:!1,rotateX:600,rotateY:1200}}},interactivity:{detect_on:"canvas",events:{onhover:{enable:!0,mode:"grab"},onclick:{enable:!0,mode:"bubble"},resize:!0},modes:{grab:{distance:350,line_linked:{opacity:.65}},bubble:{distance:350,size:6,duration:1.542946703372556,opacity:.5,speed:3},repulse:{distance:350,duration:.4},push:{particles_nb:4},remove:{particles_nb:2}}},retina_detect:!0})})}(window,document,jQuery);
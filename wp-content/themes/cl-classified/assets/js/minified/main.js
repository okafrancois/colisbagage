!function(i){i(document).ready(function(){i(".scrollToTop").on("click",function(){i("body,html").animate({scrollTop:0},360)}),i(window).on("scroll",function(){200<i(this).scrollTop()?i(".scrollToTop").fadeIn():i(".scrollToTop").fadeOut()}),1==CLClassified.hasStickyMenu&&(e=i('<div class="main-header-sticky-wrapper"></div>'),n=".main-header-sticky-wrapper",i(".main-header").clone(!0).appendTo(e),i("body").append(e),e=i(n).outerHeight()+30,i(n).css("margin-top","-"+e+"px"),i(window).scroll(function(){300<i(this).scrollTop()?i("body").addClass("rdthemeSticky"):i("body").removeClass("rdthemeSticky")}));var e,o=i(".offscreen-navigation .menu"),n=(o.length&&(o.children("li").addClass("menu-item-parent"),o.find(".menu-item-has-children > a").on("click",function(e){e.preventDefault(),i(this).toggleClass("opened");var e=i(this).next(".sub-menu"),n=i(this).closest(".menu-item-parent").find(".sub-menu");o.find(".sub-menu").not(n).slideUp(250).prev("a").removeClass("opened"),e.slideToggle(250)}),o.find(".menu-item:not(.menu-item-has-children) > a").on("click",function(e){i(".rt-slide-nav").slideUp(),i("body").removeClass("slidemenuon")})),i(".sidebarBtn").on("click",function(e){e.preventDefault(),i(".rt-slide-nav").is(":visible")?(i(".rt-slide-nav").slideUp(),i("body").removeClass("slidemenuon")):(i(".rt-slide-nav").slideDown(),i("body").addClass("slidemenuon"))}),document.querySelectorAll('[data-bs-toggle="tooltip"]'));[...n].map(e=>new bootstrap.Tooltip(e))})}(jQuery);
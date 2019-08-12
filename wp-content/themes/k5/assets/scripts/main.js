/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        $(document).on("click", '#sound-button', function(event){
          var myAudio = document.getElementById("sound");
          if (myAudio.paused) {
            myAudio.play();
            $(this).text('Sound off');
          } else {
            myAudio.pause();
            $(this).text('Sound on');
          }
        });

        $(document).on("click", '.popup__close, .popup__image', function(event){
            console.log(event);
            $('.popup').removeClass('popup__open');
            $('body').removeClass('no-scroll');
        });

        $('<div/>', {
            class: 'popup popup--image',
            html: '<div class="popup__wrapper"></div>'
        }).insertAfter('.footer');

        $(document).on("click", '.c-product__image--scale', function(event){
            event.preventDefault();
            var imageUrl = $(this).attr('href');
            var popupWrapper = $('.popup--image .popup__wrapper');
            popupWrapper.html('');
            if(imageUrl) {
                var fullImg = $('<img class="popup__image">'); //Equivalent: $(document.createElement('img'))
                fullImg.attr('src', imageUrl);
                fullImg.appendTo(popupWrapper);
            }
            $('.popup--image').addClass('popup__open');
            $('<div/>', {
                class: 'popup__close',
                html: '<span class="t-visually-hidden">Close popup</span>'
            }).appendTo(popupWrapper);
            $('body').addClass('no-scroll');
        });

        function setCookie(name,value,days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        $(document).on("click", '.c-product__button--add', function(event){
            event.preventDefault();
            $(this).attr('disabled','disabled');
            $(this).text('Added');
            var prodID = $(this).data('id');
            var products = getCookie('products');
            var countProdArr = 0;
            if(products) {
                var cookieArray = JSON.parse(products);
                if ($.inArray(prodID, cookieArray) > -1) {
                    $(this).text('Product already added');
                } else {
                    cookieArray.push(prodID);
                    setCookie('products', JSON.stringify(cookieArray), 7);
                    countProdArr = cookieArray.length;
                }
                countProdArr = cookieArray.length;
            } else {
                var prodArr = [];
                prodArr.push(prodID);
                setCookie('products', JSON.stringify(prodArr), 7);
                $('.header__cart a').removeClass('hide');
                countProdArr = prodArr.length;
            }

            $('.header__cart-qty').text(countProdArr);
        });

        $(document).on("submit", '.c-checkout__form', function(event){
            event.preventDefault();
            $.ajax({
                type:"post",
                dataType:"json",
                url: ajaxurl,
                data: {action: 'submitForm', data: $(this).serialize()},
                success: function(data) {
                    console.log(data);
                    var successmessage = 'Data was succesfully captured';
                    console.log(successmessage);
                },
                error: function(data) {
                    var successmessage = 'Error';
                    console.log(successmessage);
                },
            });
        });

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'main': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

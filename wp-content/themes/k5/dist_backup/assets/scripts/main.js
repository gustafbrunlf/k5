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

        $('#checkout-email-alt').hide();

        if($('body').find('#sound').length) {
            var audio = document.getElementById("sound");

            if (audio.paused) {
              $('#sound-button').text('Sound off');
            } else {
              $('#sound-button').text('Sound on');
            }

            $(document).on("click", '#sound-button', function(event){
                var myAudio = document.getElementById("sound");
                if (myAudio.paused) {
                    myAudio.play();
                    $(this).text('Sound on');
                } else {
                    myAudio.pause();
                    $(this).text('Sound off');
                }
            });
        }

        // $(document).on("click", '.popup__close, .popup__image', function(event){
        //     console.log(event);
        //     $('.popup').removeClass('popup__open');
        //     $('body').removeClass('no-scroll');
        // });

        // $('<div/>', {
        //     class: 'popup popup--image',
        //     html: '<div class="popup__wrapper"></div>'
        // }).insertAfter('.footer');
        //
        // $(document).on("click", '.c-product__image--scale', function(event){
        //     event.preventDefault();
        //     var imageUrl = $(this).attr('href');
        //     var popupWrapper = $('.popup--image .popup__wrapper');
        //     popupWrapper.html('');
        //     if(imageUrl) {
        //         var fullImg = $('<img class="popup__image">'); //Equivalent: $(document.createElement('img'))
        //         fullImg.attr('src', imageUrl);
        //         fullImg.appendTo(popupWrapper);
        //     }
        //     $('.popup--image').addClass('popup__open');
        //     $('<div/>', {
        //         class: 'popup__close',
        //         html: '<span class="t-visually-hidden">Close popup</span>'
        //     }).appendTo(popupWrapper);
        //     $('body').addClass('no-scroll');
        // });

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
                while (c.charAt(0)===' ') { c = c.substring(1,c.length); }
                if (c.indexOf(nameEQ) === 0) {return c.substring(nameEQ.length,c.length); }
            }
            return null;
        }

        $(document).on("click", '.c-product__button--add', function(event){
            event.preventDefault();
            $(this).attr('disabled','disabled');
            $(this).text('Added');
            var prodID = $(this).data('id').toString();
            var prodSize = $(this).closest('.o-grid').find('input[name="size"]:checked').val();
            var products = getCookie('products');
            var countProdArr = 0;
            if(products) {
                var cookieArray = JSON.parse(products);
                var cookieObj = {};
                cookieObj.id = prodID;
                cookieObj.size = prodSize;
                cookieArray.push(cookieObj);
                setCookie('products', JSON.stringify(cookieArray), 0.5);
                countProdArr = cookieArray.length;
            } else {
                var prodArr = [];
                var prodObj = {};
                prodObj.id = prodID;
                prodObj.size = prodSize;
                prodArr.push(prodObj);
                setCookie('products', JSON.stringify(prodArr), 0.5);
                countProdArr = prodArr.length;
            }

            setTimeout(function(){
                $('.c-product__button--add').text('Add to cart');
                $('.c-product__button--add').removeAttr('disabled');
            }, 2000);

            $('.c-header__cart').html();
            var new_cart = '<a href="' + window.location.href + '/checkout">Cart / <span class="c-header__cart-qty">' + countProdArr + '</span><span class="c-header__cart-checkout"> / Checkout</span></a>';
            $('.c-header__cart').html(new_cart);
        });

        function updateCartTotals() {
            var totalPrice = 0;
            var totalQty = 0;

            $('.c-checkout__form .c-checkout__item').each(function() {
                if($(this).find('.c-checkout__item-price').length > 0) {
                    var productPrice = $(this).find('.c-checkout__item-price span').html();
                    var qty = $(this).find('.c-checkout__item-qty select').val();
                    totalPrice += parseInt(productPrice);
                    totalQty += parseInt(qty);
                }
            });

            totalPrice += parseInt($('.c-checkout__item-shipping select').find(':selected').data('amount'));

            $('#checkout-total-hidden').val(totalPrice);
            $('#checkout-total').val(totalPrice + ' ' + $('#checkout-currency').val());
            $('.c-header__cart-qty').text(totalQty);
        }

        $(document).on("change", '.c-checkout__item-qty select', function(event){
            event.preventDefault();
            var qty = $(this).val();
            var price = $(this).data('price');
            var total = qty * price;

            $(this).parent().siblings('.c-checkout__item-price').find('span').html(total);
            $(this).parent().siblings('.c-checkout__item-price--hidden').val(total);

            updateCartTotals();
        });

        $(document).on("change", '.c-checkout__item-shipping select', function(event){
            event.preventDefault();

            var shipping_cost = $(this).find(':selected').data('amount');

            $('.c-checkout__item-price-shipping').html(shipping_cost + ' SEK');

            if($(this).val() !== 'Sweden') {
                $('#checkout-currency').val('EUR');
                $('.c-checkout__item-price-shipping').html(shipping_cost + ' EUR');
            } else {
                $('#checkout-currency').val('SEK');
                $('.c-checkout__item-price-shipping').html(shipping_cost + ' SEK');
            }

            $('.c-checkout__form .c-checkout__item').each(function() {
                if($(this).find('.c-checkout__item-price').length > 0) {
                    var item_qty = $(this).find('.c-checkout__item-qty select').val();

                    if($('#checkout-currency').val() === 'SEK') {
                        var price_sek = $(this).find('.c-checkout__item-price').data('price-sek');
                        var total_sek = price_sek * item_qty;

                        $(this).find('.c-checkout__item-price').html('<span>' + total_sek + '</span> SEK');
                        $(this).find('.c-checkout__item-price--hidden').val(total_sek);
                        $('.c-checkout__item-qty select').data('price', price_sek);
                    } else {
                        var price_eur = $(this).find('.c-checkout__item-price').data('price-eur');
                        var total_eur = price_eur * item_qty;

                        $(this).find('.c-checkout__item-price').html('<span>' + total_eur + '</span> EUR');
                        $(this).find('.c-checkout__item-price--hidden').val(total_eur);
                        $('.c-checkout__item-qty select').data('price', price_eur);
                    }
                }
            });

            $('#checkout-total-shipping').val(shipping_cost);

            updateCartTotals();
        });

        $(document).on("submit", '.c-checkout__form', function(event){
            event.preventDefault();

            if(!$('#checkout-email-alt').val()) {
                $('#checkout-email').attr('disabled', 'disabled');
                $('#checkout-name').attr('disabled', 'disabled');
                $('#checkout-address').attr('disabled', 'disabled');
                $('#checkout-zip').attr('disabled', 'disabled');
                $('#checkout-country').attr('disabled', 'disabled');
                $('.c-checkout__item-shipping select').attr('disabled', 'disabled');

                $('.c-checkout__button').attr('disabled', 'disabled');

                var total = $('#checkout-total-hidden').val();
                var email = $('#checkout-email').val();
                var name = $('#checkout-name').val();
                var address = $('#checkout-address').val();
                var zip = $('#checkout-zip').val();
                var country = $('#checkout-country').val();
                var shipping = $('.c-checkout__item-shipping select').val();
                var shipping_total = $('#checkout-total-shipping').val();
                var currency = $('#checkout-currency').val();

                var error = '<h3 class="c-checkout__error">Something went wrong, try again or contact <a href="mailto:order@kultur5.com">order@kultur5.com</a>.</h3>';

                $.ajax({
                    type:"post",
                    dataType:"json",
                    url: ajaxurl,
                    data: {
                        action: 'submitForm',
                        email: email,
                        name: name,
                        address: address,
                        zip: zip,
                        country: country,
                        total: total,
                        shipping: shipping,
                        shipping_total: shipping_total,
                        currency: currency,
                        data: $(this).serializeArray()
                    },
                    success: function(data) {
                        if(data.success) {
                            $.ajax({
                                type: "post",
                                url: window.location.href + 'order',
                                dataType: "html",
                                success: function(html){
                                    var result = html;
                                    document.documentElement.innerHTML = result;
                                    var cookieProd = getCookie('products');
                                    if(cookieProd) {
                                        setCookie('products', [], 0.5);
                                    }
                                    history.pushState({}, "Order - kultur5", window.location.href + 'order');
                                }
                              });
                        } else {
                            $('.c-checkout__button').after(error);
                        }
                    },
                    error: function(data) {
                        if(!data.success) {
                            $('.c-checkout__button').after(error);
                        }
                    },
                });
            }
        });

        $(document).on("click", '.c-checkout__item-remove', function(event){
            $(this).closest('.c-checkout__item').remove();
            var cookieProd = getCookie('products');

            if(($('.c-checkout__form').find('.c-checkout__item').length - 1) === 0) {
                $('.c-checkout__items').html('<h2>Cart empty</h2>');
                $('.c-checkout__customer, .c-checkout__button, .c-product__description').remove();
                if(cookieProd) {
                    setCookie('products', [], 0.5);
                }
            } else {
                var productID = $(this).attr('data-prod');
                var productSize = $(this).parent().siblings('.c-checkout__item-size').find('select').val();
                var products = JSON.parse(cookieProd);
                var haj = false;
                var updatedProd = [];
                for (var i = 0; i < products.length; i++) {
                    if(!haj && productID === products[i].id && productSize === products[i].size) {
                        haj = true;
                    } else {
                        updatedProd.push(products[i]);
                    }
                }
                setCookie('products', JSON.stringify(updatedProd), 0.5);
            }

            updateCartTotals();
        });

        $('#checkout-email').on('input',function(e){
            $('.c-checkout__button').removeAttr("disabled");
        });

        $(document).on("click", '.c-product__button--size', function(event){
            $('.c-product-size-guide').slideToggle();
        });

        var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if(width > 1024) {
            $(".c-project__image-wrapper").on({
                mouseenter: function () {
                    $(this).siblings('.c-project__image-title').addClass('hover');
                },
                mouseleave: function () {
                    $(this).siblings('.c-project__image-title').removeClass('hover');
                }
            });
        }

        $(document).on("click", '.media_placeholder--close', function(event){
            $(this).parent().remove();
        });

        $(document).on("click", '.c-subnav a', function(event){
            var href=$(this).prop('href');
            if (href.indexOf('#') > -1) {
                console.log("Contains questionmark");
                event.preventDefault();
                var aid = $(this).attr("href");
                $('html,body').animate({scrollTop: $(aid).offset().top - 40},'slow');
            }
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

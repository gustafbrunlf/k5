// Debouncer
function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

// Scroll observer and styling for it
var scrollObserver = function(selectorArray, offsetConfig) {
    var offset = offsetConfig ? offsetConfig : {top: 0.5, bottom: 0.5};
    var requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(callback) {window.setTimeout(callback, 1000 / 60)}

    var elementInViewpor = function(element) {
        var scroll = window.scrollY || window.pageYOffset
        var elementTop = element.getBoundingClientRect().top + scroll

        var viewport = {
            top: scroll,
            bottom: scroll + window.innerHeight
        }

        var rect = {
            top: elementTop,
            bottom: elementTop + element.clientHeight,
        }

        var offsetTop = window.innerHeight * offset.top;
        var offsetBottom = window.innerHeight * offset.bottom;

        return (rect.top - offsetTop >= viewport.top && rect.top + offsetBottom <= viewport.bottom);
    }

    var getRandomInt = function(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    var setVisibility = function(element, boolean) {
        if (boolean && !element.classList.contains('visible')) {
            element.classList.add('visible');
            element.style.left = getRandomInt(0, 10) + '%';
            element.style.transform = 'transformY(' + getRandomInt(-10, 50) + '%)';
        } else if (!boolean && element.classList.contains('visible')) {
            element.classList.remove('visible');
        } else {
            return;
        }
    }

    var handleElement = function(element) {
        setVisibility(element, elementInViewpor(element));
    }

    var initObserver = function(element) {
        handleElement(element);

        var debouncer = debounce(function() {
            requestAnimationFrame(function() {
                handleElement(element)
            });
        }, 75);
        window.addEventListener('scroll', debouncer);
    }

    if (!selectorArray) {
        return false;
    }

    for (var i = 0; i < selectorArray.length; i++) {
		selectorArray[i].classList.add('absolute-image');
        initObserver(selectorArray[i]);
    }
}

// Init
document.addEventListener('DOMContentLoaded', function() {
    if (!document.body.classList.contains('page-template-template-about')) {
        return;
    }

	scrollObserver(document.querySelectorAll('.c-project__image-wrapper img'), {top: 0.9, bottom: 0.9});
});

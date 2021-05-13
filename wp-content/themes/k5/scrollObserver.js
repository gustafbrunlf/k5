// Här
var instaellningar = {
    showImageWhen: {
        topIs: -0.75,
        bottomIs: -0.4
    },
    positionImageRandomFrom: {
        leftBetween: [-75, 50],
        topBetween: [-50, 50]
    },
    multiplyImageHeightBy: 1.2 // Set this one to more if you want more of the image
}

// Inte här
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

var scrollObserver = function(selectorArray) {
    var requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(callback) {window.setTimeout(callback, 1000 / 60)}

    var elementInViewpor = function(obj) {
        var element = obj.element;
        var image = obj.image;
        var scroll = window.scrollY || window.pageYOffset;
        var elementTop = element.getBoundingClientRect().top;

        var offset = {
            top: image.clientHeight * instaellningar.showImageWhen.topIs,
            bottom: image.clientHeight * instaellningar.showImageWhen.bottomIs
        };

        var scrollPosition = {
            top: scroll,
            bottom: scroll + window.innerHeight
        };

        var element = {
            top: elementTop + scrollPosition.top + offset.top,
            bottom: elementTop + scrollPosition.bottom + (image.clientHeight * instaellningar.multiplyImageHeightBy) + offset.bottom
        };

        return (element.top <= scrollPosition.top && element.bottom >= scrollPosition.bottom);
    }

    var getRandomInt = function(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    var setVisibility = function(obj, boolean) {
        var element = obj.element;
        if (boolean && !element.classList.contains('visible')) {
            element.classList.add('visible');
        } else if (!boolean && element.classList.contains('visible')) {
            element.classList.remove('visible');
        } else {
            return;
        }
    }

    var initObserver = function(obj) {
        obj.image.style.transform = 'translateX(' + obj.position.left + ') translateY(' + obj.position.top + ')';

        setVisibility(obj, elementInViewpor(obj));

        var debouncer = debounce(function() {
            requestAnimationFrame(function() {
                setVisibility(obj, elementInViewpor(obj));
            });
        }, 15);
        window.addEventListener('scroll', debouncer);
    }

    if (!selectorArray) {
        return false;
    }

    var posLeft = instaellningar.positionImageRandomFrom.leftBetween;
    var posTop = instaellningar.positionImageRandomFrom.topBetween;
    for (var i = 0; i < selectorArray.length; i++) {
        var element = selectorArray[i];
        var image = element.querySelector('img');

        if (!image) {
            continue;
        }

        if (!element.classList.contains('absolute-image')) {
            element.classList.add('absolute-image');
        }

        var object = {
            element: element,
            image: image,
            position: {
                left: getRandomInt(posLeft[0], posLeft[1]) + '%',
                top: getRandomInt(posTop[0], posTop[1]) + '%',
            }
        };
        initObserver(object);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    if (!document.body.classList.contains('page-template-template-about')) {
        return;
    }

    scrollObserver(document.querySelectorAll('.c-project__image-wrapper'));
});

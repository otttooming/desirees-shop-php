var initPhotoSwipeFromDOM = function(gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {

        var thumbElements = document.querySelectorAll('.lightbox'),
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes
            if(figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML;
            }

            if(linkEl.querySelector('img') !== null) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.querySelector('img').getAttribute('src');
            }

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    var createTemplate = function() {
        var isPresent = document.querySelector('.pswp');

        if (isPresent) {
            return;
        }

        var html = '\
                <div class="pswp__bg"></div>\
                <div class="pswp__scroll-wrap">\
                    <div class="pswp__container">\
                        <div class="pswp__item"></div>\
                        <div class="pswp__item"></div>\
                        <div class="pswp__item"></div>\
                    </div>\
                    <div class="pswp__ui pswp__ui--hidden">\
                        <div class="pswp__top-bar">\
                            <div class="pswp__counter"></div>\
                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>\
                            <button class="pswp__button pswp__button--share" title="Share"></button>\
                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>\
                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>\
                            <div class="pswp__preloader">\
                                <div class="pswp__preloader__icn">\
                                <div class="pswp__preloader__cut">\
                                    <div class="pswp__preloader__donut"></div>\
                                </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">\
                            <div class="pswp__share-tooltip"></div>\
                        </div>\
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">\
                        </button>\
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">\
                        </button>\
                        <div class="pswp__caption">\
                            <div class="pswp__caption__center"></div>\
                        </div>\
                    </div>\
                    </div>\
                    ';
        
        var newDiv = document.createElement('div');
        
        newDiv.setAttribute('class', 'pswp');
        newDiv.setAttribute('tabindex', '-1');
        newDiv.setAttribute('role', 'dialog');
        newDiv.setAttribute('aria-hidden', 'true');
        newDiv.innerHTML = html;

        document.body.insertBefore(newDiv, document.querySelector('.wrapper'));

    }

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        createTemplate();

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) {
                continue;
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if(index >= 0) {
            var idNum = e.target.closest('.lightbox').getAttribute('data-pswp-uid') - 1;
            // open PhotoSwipe if valid index found
            openPhotoSwipe( idNum, document.querySelectorAll( gallerySelector )[idNum] );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if(pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),
            shareEl: false,
            barsSize: {top: 0, bottom:'auto'}, 
            tapToClose: true,
            tapToToggleControls: false,

            getThumbBoundsFn: function(index) {

                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el, // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }

        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};

// execute above function
initPhotoSwipeFromDOM('.lightbox');

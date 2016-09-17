$(document).ready(function() {
  listSwitcher();
  check_view_mod();
});

var productRelatedSlider = new Swiper ('.product__related-slider', {
  // Optional parameters
  direction: 'horizontal',
  loop: false,
  slidesPerView: 4,
  spaceBetween: 1,

  // If we need pagination
  pagination: '.swiper-pagination',
  paginationClickable: true,

  // Navigation arrows
  nextButton: '.product__control-items .control__next',
  prevButton: '.product__control-items .control__prev',

  breakpoints: {
            1024: {
                slidesPerView: 4
            },
            992: {
                slidesPerView: 4
            },
            768: {
                slidesPerView: 2
            },
            640: {
                slidesPerView: 2
            },
            320: {
                slidesPerView: 1
            }
        }
});

var productGallerySlider = new Swiper ('.product__gallery-slider', {
    direction: 'horizontal',
    slidesPerView: '5',

    // Navigation arrows
    nextButton: '.product__gallery-control .control__next',
    prevButton: '.product__gallery-control .control__prev'
});

var productGallerySlider = new Swiper ('.slider-promo', {
    direction: 'horizontal',
    slidesPerView: '1',
    autoplay: '1500',
    pagination: '.swiper-pagination',
    paginationClickable: true
});

// Clear WooCommerce product variations
function clearSelected(event){
  event.preventDefault();

  var elements = document.querySelectorAll('.product-cart__variations select');

  for (var select = 0; select < elements.length; select++) {
    var elementsOptions = elements[select].options;

    for(var option = 0; option < elementsOptions.length; option++){
      elementsOptions[option].selected = false;
    }
  }
};

if (document.getElementsByClassName('cart__reset-variations')[0]) {

  document.getElementsByClassName('cart__reset-variations')[0].addEventListener('click', function() {
    clearSelected(event);
  });

}

var Desirees = Desirees || {};

Desirees.nav = {

  mobileMenuOpen: function() {
    if (document.body.classList.contains('menu-mobile_open')) {
      document.body.classList.remove('menu-mobile_open');
    } else {
      document.body.classList.add('menu-mobile_open');
    }
  }
};

var mobileMenuToggleBtns = document.querySelectorAll('.menu-mobile__toggle');

for (var i = 0; i < mobileMenuToggleBtns.length; i++) {
  mobileMenuToggleBtns[i].addEventListener('click', Desirees.nav.mobileMenuOpen, false);
}

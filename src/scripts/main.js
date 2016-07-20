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

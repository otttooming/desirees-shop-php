var Desirees = Desirees || {};

Desirees.nav = {
	subCatToggle: function() {
		var catGroup = event.target.closest('.cat-list__group'),
				catGroupControl = catGroup.querySelector('svg');

		if (catGroupControl.classList.contains('control__down')) {
			catGroupControl.classList.remove('control__down');
			catGroupControl.classList.add('control__up')
		} else {
			catGroupControl.classList.remove('control__up');
			catGroupControl.classList.add('control__down')
		}

		if (catGroup.classList.contains('cat-list__group-open')) {
			catGroup.classList.remove('cat-list__group-open');
		} else {
			catGroup.classList.add('cat-list__group-open');
		}
	},

	init: function() {
		var subCatToggleBtns = document.querySelectorAll('.cat-list__subcat-control');

		for (var i = 0; i < subCatToggleBtns.length; i++) {
			subCatToggleBtns[i].addEventListener('click', Desirees.nav.subCatToggle, false);
		}
	}
};

Desirees.navMobile = {
	mobileMenuOpen: function() {
		if (document.body.classList.contains('menu-mobile_open')) {
			document.body.classList.remove('menu-mobile_open');
		} else {
			document.body.classList.add('menu-mobile_open');
		}
	},

	init: function() {
		var mobileMenuToggleBtns = document.querySelectorAll('.menu-mobile__toggle');

		for (var i = 0; i < mobileMenuToggleBtns.length; i++) {
			mobileMenuToggleBtns[i].addEventListener('click', Desirees.navMobile.mobileMenuOpen, false);
		}
	}
}

Desirees.navDropdown = {

	init: function() {
		var submenus = document.querySelectorAll('.menu .sub-menu');

		for (var i = 0; i < submenus.length; i++) {
			new Tippy(submenus[i].parentNode, {
				html: '#' + submenus[i].getAttribute('id'),
				arrow: true,
				animation: 'fade',
				interactive: true,
				position: 'bottom',
				hideOnClick: 'persistent',
				popperOptions: {
					modifiers: {
						flip: {
							behavior: ['bottom']
						}
					}
				}
			})
		}
	}
}

Desirees.descPopover = {

	init: function() {
		var descriptions = document.querySelectorAll('.products-listing__item');

		for (var i = 0; i < descriptions.length; i++) {
			new Tippy(descriptions[i], {
				arrow: true,
				html: '#' + descriptions[i].querySelector('.products-listing__desc').getAttribute('id'),
				animation: 'fade',
				position: 'left',
				hideOnClick: 'persistent',
				theme: 'desc-tooltip',
				trigger: 'mouseenter',
				interactive: true,
				popperOptions: {
					modifiers: {
						flip: {
							behavior: ['left', 'right', 'bottom']
						}
					}
				}
			})
		}
	}
}

Desirees.filterOrdering = {
	filterSubmit: function() {
		this.submit();
	},

	init: function() {
		var filterOrderingSubmit = document.querySelectorAll('.woocommerce-ordering');

		for (var i = 0; i < filterOrderingSubmit.length; i++) {
			filterOrderingSubmit[i].addEventListener('change', Desirees.filterOrdering.filterSubmit, false)
		}
	}
};

Desirees.slider = {
	init: function() {

		var relatedItems = document.querySelectorAll('.related .products-listing__item').length;

		var relatedSlider = new Swiper('.related', {
			slidesPerView: 5,
			slideClass: 'products-listing__item',
			centeredSlides: relatedItems > 3 ? false : true,
			initialSlide: relatedItems > 3 ? 0 : 1,
			loop: relatedItems > 5 ? true : false,

			breakpoints: {
				320: {
					slidesPerView: 1
				},
				480: {
					slidesPerView: 2
				},
				768: {
					slidesPerView: 3
				},
				1024: {
					slidesPerView: 4
				}
			}
		});
	}
};

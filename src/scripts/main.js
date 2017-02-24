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
		var productGallerySlider = new Swiper('.product__gallery-slider', {
			direction: 'horizontal',
			slidesPerView: '3',

			// Navigation arrows
			nextButton: '.product__gallery-control .control__next',
			prevButton: '.product__gallery-control .control__prev'
		});

		var productGallerySlider = new Swiper('.slider-promo', {
			direction: 'horizontal',
			slidesPerView: '1',
			autoplay: '1500',
			pagination: '.swiper-pagination',
			paginationClickable: true
		});
	}
};

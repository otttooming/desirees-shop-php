jQuery(document).ready(function(){

    /* Mobile navigation
    -------------------------------------------------------------- */

    var navList = jQuery('div.menu > ul').clone();
    var etOpener = '<span class="open-child">(open)</span>';
    navList.removeClass('menu').addClass('et-mobile-menu');


	navList.find('li:has(ul)',this).each(function() {
		jQuery(this).prepend(etOpener);
	})

    navList.find('.open-child').toggle(function(){
        jQuery(this).parent().addClass('over').find('>ul').slideDown(200);
    },function(){
        jQuery(this).parent().removeClass('over').find('>ul').slideUp(200);
    });

    jQuery('.header-bg').after(navList[0]);
    jQuery('div.menu').after('<span class="et-menu-title"><i class="icon-reorder"></i></span>');

    jQuery('.et-menu-title').toggle(function(){
        jQuery('.et-mobile-menu').slideDown(200);
    },function(){
        jQuery('.et-mobile-menu').slideUp(200);
    });

    /* Fixed menu */

    jQuery(window).scroll(function(){
    	var fixedHeader = jQuery('.fixed-header-area');
    	var scrollTop = jQuery(this).scrollTop();
    	var headerHeight = jQuery('.header-top').height() + jQuery('.header-bg').height();

    	if(scrollTop > headerHeight){
    		if(!fixedHeader.hasClass('fixed-already')) {
		    	fixedHeader.stop().addClass('fixed-already');
    		}
    	}else{
    		if(fixedHeader.hasClass('fixed-already')) {
		    	fixedHeader.stop().removeClass('fixed-already');
    		}
    	}
    });

    /* Tabs
    -------------------------------------------------------------- */
    var tabs = jQuery('.tabs');
    jQuery('.tabs > p > a').unwrap('p');

    var leftTabs = jQuery('.left-tabs');
	var newTitles;

    leftTabs.each(function(){
    	var currTab = jQuery(this);
	    //currTab.find('> a.tab-title').each(function(){
		    newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
	    //});

	    var newHtml = newTitles;

	    var tabNewTitles = jQuery('<div class="left-titles"></div>').prependTo(currTab);
	    tabNewTitles.html(newTitles);
    });


    tabs.each(function(){
    	var currTab = jQuery(this);
	    currTab.find('.tab-title, .tab-title-left').click(function(e){

	    	e.preventDefault();

	    	var tabId = jQuery(this).attr('id');

	        if(jQuery(this).hasClass('opened')){
	            jQuery(this).removeClass('opened');
	            jQuery('#content_'+tabId).hide();
	        }else{
	            currTab.find('.tab-title, .tab-title-left').each(function(){
	            	var tabId = jQuery(this).attr('id');
	                jQuery(this).removeClass('opened');
		            jQuery('#content_'+tabId).hide();
	            });
                jQuery('html, body').animate({
                    scrollTop: jQuery(this).offset().top - 100
                }, 800);
	            jQuery('#content_'+tabId).show();
	            jQuery(this).addClass('opened');
	        }
	    });
    });

    /* "Top" button
    -------------------------------------------------------------- */

    var scroll_timer;
    var displayed = false;
    var $message = jQuery('#back-to-top');
    var $window = jQuery(window);

    $window.scroll(function () {
        window.clearTimeout(scroll_timer);
        scroll_timer = window.setTimeout(function () {
        if($window.scrollTop() <= 0)
        {
            displayed = false;
            $message.fadeOut(500);
        }
        else if(displayed == false)
        {
            displayed = true;
            $message.stop(true, true).fadeIn(500).click(function () { $message.fadeOut(500); });
        }
        }, 400);
    });

    jQuery('#top-link').click(function(e) {
            jQuery('html, body').animate({scrollTop:0}, 1000);
            return false;
    });


    /* Accordion Navigation
    -------------------------------------------------------------- */
    jQuery(function(){
        if(!nav_accordion){
            jQuery('.categories-group .wpsc_category_title .btn-show ').hide();
        }else{
            jQuery('.block.cats').addClass('acc_enabled');
            jQuery('.categories-group').each(function(){
                jQuery(this).has('.wpsc_top_level_categories').addClass('has-subnav');
                jQuery(this).has('.current-cat').addClass('current-parent opened');
            });


            var nav_section = jQuery('.categories-group .wpsc_top_level_categories');
            var nav_toggle_element = jQuery('.categories-group .wpsc_category_title .btn-show ');
            var nav_speed = 150;


            nav_toggle_element.click(function(){
                if(jQuery(this).parent().parent().hasClass('opened')){
                    hideActiveSection();
                }else{
                    showNext(jQuery(this));
                }
            });

            if(jQuery('.categories-group.opened').length > 0) {
                //jQuery('.categories-group.has-subnav').addClass('opened');
            }else{
                // If doesnt exitst opened point
                jQuery('.categories-group.has-subnav:first').addClass('opened').find('ul').show();
            }

            function showNext(element) {
                hideActiveSection();
                element.parent().parent().addClass('opened');
                element.parent().next().show(nav_speed);
            }

            function hideActiveSection(){
                jQuery('.categories-group.opened').removeClass('opened').find('.wpsc_top_level_categories').hide(nav_speed);
            }
        }
    });

    /* Load in view */

    var progressBars = jQuery('.progress-bar');

	progressBars.bind('inview', function (event, visible) {
	  if (visible == true) {

		  	i = 0;
			progressBars.each(function () {
				i++;

				var el = jQuery(this);
				var width = jQuery(this).data('width');
				setTimeout(function(){
					el.find('div').animate({
						'width' : width + '%'
					},300);
					el.find('span').css({
						'opacity' : 1
					});
				},i*150, "easeOutCirc");

			});
	  }
	});


}); // End Ready
/* Product Hover
-------------------------------------------------------------- */


function check_view_mod(){
    var activeClass = 'switcher-active';
    if(jQuery.cookie('products_page') == 'grid') {
        jQuery('#products-grid').removeClass('products-list').addClass('products-grid');
        jQuery('.switchToGrid').addClass(activeClass);
    }else if(jQuery.cookie('products_page') == 'list') {
        jQuery('#products-grid').removeClass('products-grid').addClass('products-list');
        jQuery('.switchToList').addClass(activeClass);
    }else{
        if(view_mode_default == 'list_grid' || view_mode_default == 'list') {
            jQuery('.switchToList').addClass(activeClass);
        }else{
            jQuery('.switchToGrid').addClass(activeClass);
        }
    }
}

function listSwitcher() {
    /* Listswitcher
    -------------------------------------------------------------- */
    var activeClass = 'switcher-active';
    var gridClass = 'products-grid';
    var listClass = 'products-list';
    jQuery('.switchToList').click(function(){
        if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'grid'){
            switchToList();
        }
    });
    jQuery('.switchToGrid').click(function(){
        if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'list'){
            switchToGrid();
        }
    });

    function switchToList(){
        jQuery('.switchToList').addClass(activeClass);
        jQuery('.switchToGrid').removeClass(activeClass);
        jQuery('#products-grid').fadeOut(300,function(){
            jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
            jQuery.cookie('products_page', 'list');
        });
    }

    function switchToGrid(){
        jQuery('.switchToGrid').addClass(activeClass);
        jQuery('.switchToList').removeClass(activeClass);
        jQuery('#products-grid').fadeOut(300,function(){
            jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
            jQuery.cookie('products_page', 'grid');
        });
    }
}

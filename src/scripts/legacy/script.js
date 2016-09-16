$(document).ready(function() {

  /* Tabs
  -------------------------------------------------------------- */
  var tabs = $('.tabs');
  $('.tabs > p > a').unwrap('p');

  var leftTabs = $('.left-tabs');
  var newTitles;

  leftTabs.each(function() {
    var currTab = $(this);
    //currTab.find('> a.tab-title').each(function(){
    newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
    //});

    var newHtml = newTitles;

    var tabNewTitles = $('<div class="left-titles"></div>').prependTo(currTab);
    tabNewTitles.html(newTitles);
  });

  tabs.each(function() {
    var currTab = $(this);
    currTab.find('.tab-title, .tab-title-left').click(function(e) {

      e.preventDefault();

      var tabId = $(this).attr('id');

      if ($(this).hasClass('opened')) {
        $(this).removeClass('opened');
        $('#content_' + tabId).hide();
      } else {
        currTab.find('.tab-title, .tab-title-left').each(function() {
          var tabId = $(this).attr('id');
          $(this).removeClass('opened');
          $('#content_' + tabId).hide();
        });
        $('html, body').animate({
          scrollTop: $(this).offset().top - 100
        }, 800);
        $('#content_' + tabId).show();
        $(this).addClass('opened');
      }
    });
  });

  /* "Top" button
  -------------------------------------------------------------- */
  var scroll_timer;
  var displayed = false;
  var $message = $('#back-to-top');
  var $window = $(window);

  $window.scroll(function() {
    window.clearTimeout(scroll_timer);
    scroll_timer = window.setTimeout(function() {
      if ($window.scrollTop() <= 0) {
        displayed = false;
        $message.fadeOut(500);
      } else if (displayed == false) {
        displayed = true;
        $message.stop(true, true).fadeIn(500).click(function() {
          $message.fadeOut(500);
        });
      }
    }, 400);
  });

  $('#top-link').click(function(e) {
    $('html, body').animate({
      scrollTop: 0
    }, 1000);
    return false;
  });

  /* Accordion Navigation
  -------------------------------------------------------------- */
  $(function() {
    if (!nav_accordion) {
      $('.categories-group .wpsc_category_title .btn-show ').hide();
    } else {
      $('.block.cats').addClass('acc_enabled');
      $('.categories-group').each(function() {
        $(this).has('.wpsc_top_level_categories').addClass('has-subnav');
        $(this).has('.current-cat').addClass('current-parent opened');
      });


      var nav_section = $('.categories-group .wpsc_top_level_categories');
      var nav_toggle_element = $('.categories-group .wpsc_category_title .btn-show ');
      var nav_speed = 150;

      nav_toggle_element.click(function() {
        if ($(this).parent().parent().hasClass('opened')) {
          hideActiveSection();
        } else {
          showNext($(this));
        }
      });

      if ($('.categories-group.opened').length > 0) {
        //$('.categories-group.has-subnav').addClass('opened');
      } else {
        // If doesnt exitst opened point
        $('.categories-group.has-subnav:first').addClass('opened').find('ul').show();
      }

      function showNext(element) {
        hideActiveSection();
        element.parent().parent().addClass('opened');
        element.parent().next().show(nav_speed);
      }

      function hideActiveSection() {
        $('.categories-group.opened').removeClass('opened').find('.wpsc_top_level_categories').hide(nav_speed);
      }
    }
  });

  /* Load in view */

  var progressBars = $('.progress-bar');

  progressBars.bind('inview', function(event, visible) {
    if (visible == true) {

      i = 0;
      progressBars.each(function() {
        i++;

        var el = $(this);
        var width = $(this).data('width');
        setTimeout(function() {
          el.find('div').animate({
            'width': width + '%'
          }, 300);
          el.find('span').css({
            'opacity': 1
          });
        }, i * 150, "easeOutCirc");

      });
    }
  });


}); // End Ready
/* Product Hover
-------------------------------------------------------------- */

function check_view_mod() {
  var activeClass = 'switcher-active';
  if (Cookies.get('products_page') == 'grid') {
    $('#products-grid').removeClass('products-list').addClass('products-grid');
    $('.switchToGrid').addClass(activeClass);
  } else if (Cookies.get('products_page') == 'list') {
    $('#products-grid').removeClass('products-grid').addClass('products-list');
    $('.switchToList').addClass(activeClass);
  } else {
    if (view_mode_default == 'list_grid' || view_mode_default == 'list') {
      $('.switchToList').addClass(activeClass);
    } else {
      $('.switchToGrid').addClass(activeClass);
    }
  }
}

function listSwitcher() {
  /* Listswitcher
  -------------------------------------------------------------- */
  var activeClass = 'switcher-active';
  var gridClass = 'products-grid';
  var listClass = 'products-list';
  $('.switchToList').click(function() {
    if (!Cookies.get('products_page') || Cookies.get('products_page') == 'grid') {
      switchToList();
    }
  });
  $('.switchToGrid').click(function() {
    if (!Cookies.get('products_page') || Cookies.get('products_page') == 'list') {
      switchToGrid();
    }
  });

  function switchToList() {
    $('.switchToList').addClass(activeClass);
    $('.switchToGrid').removeClass(activeClass);
    $('#products-grid').fadeOut(300, function() {
      $(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
      Cookies.set('products_page', 'list');
    });
  }

  function switchToGrid() {
    $('.switchToGrid').addClass(activeClass);
    $('.switchToList').removeClass(activeClass);
    $('#products-grid').fadeOut(300, function() {
      $(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
      Cookies.set('products_page', 'grid');
    });
  }
}

$.fn.clicktoggle = function(a, b) {
    return this.each(function() {
        var clicked = false;
        $(this).click(function() {
            if (clicked) {
                clicked = false;
                return b.apply(this, arguments);
            }
            clicked = true;
            return a.apply(this, arguments);
        });
    });
};

<?php
/**
 * The template for displaying the footer.
 *
 */
?>

  <footer class="container container__footer mt1 py1">
      <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) ) : ?>
          <div class="row">
              <div class="col-md-3 col-sm-4 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-1' ); ?>
                  <?php endif; ?>
              </div>

              <div class="col-md-9 col-sm-8 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-2' ); ?>
                  <?php endif; ?>
              </div>
          </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
          <div class="row">
              <div class="col-md-6 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-3' ); ?>
                  <?php endif; ?>
              </div>

              <div class="col-md-6 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-4' ); ?>
                  <?php endif; ?>
              </div>
          </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer-wide' ) ) : ?>
          <div class="row">
              <div class="col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-wide' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-wide' ); ?>
                  <?php endif; ?>
              </div>
          </div>
      <?php endif; ?>
  </footer>

</div>
<?php // END .wrapper ?>

<?php

  // Get mobile menu navigation
  require get_template_directory() . '/inc/components/menu-mobile.php';

	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>

<script src="https://unpkg.com/vue"></script>

<script>
  var apiUrl = '/wp-json/wc/v2/products?',
      auth = 'consumer_key=ck_3e64f8da47867765c0360bb6dc5d4354fd776e88&consumer_secret=cs_ad710227795f7544d35e79f9bb5014cc18d70642';

  var cartObj = [{
    product_id: 245
  }, {
    product_id: 250
  }]

  var apiIDs = cartObj.map(function(obj) {
    return obj.product_id;
  })

  var regexLang = /.+?(?=\]).+?(?=\[)/g;

    var getText = function(text, lang) {
      // Builds regex based on supplied language
      var re = new RegExp("\\[:" + lang + "\\](.*?)\\[");
      //http://techqa.info/programming/question/6520452/how-to-split-a-language-string-(wordpress-qtranslate)-in-javascript
      // Returns first backreference
      return text.match(re)[1];
    }

  var app = new Vue({
    el: '#app',
    data: {
      message: 'Hello Vue!',
      products: []
    },

    created: function () {
      this.fetchData()
    },

    methods: {
      fetchData: function() {
        var xhr = new XMLHttpRequest()
        var self = this
        console.log(xhr);
        console.log(apiUrl + 'include[]=' + apiIDs.join('&include[]=') + '&' + auth);
        xhr.open('GET', apiUrl + 'include[]=' + apiIDs.join('&include[]=') + '&' + auth);

        xhr.onload = function() {
          var responseJSON = JSON.parse(xhr.responseText);
          console.log(responseJSON);
          self.message = responseJSON[1].name

          responseJSON.forEach(function(el) {
            self.products.push(el)
          }, this)
        }

        xhr.send()
      }
    }
  })

  Vue.component('product-item', {
    props: ['product'],

    template: '\
      <div class="comp-item">\
        <div class="comp-item__visual-section">\
          <img :src="product.images[0].src">\
        </div>\
        <div class="comp-item__meta-section">\
          <h2 class="comp-item__title">{{ nameI18n }}</h2>\
          <p>{{ product.price }}€</p>\
          <div class="comp-item__desc" v-html="product.description"></div>\
          <ul class="comp-item__attr list-reset">\
            <li class="comp-item__attr-item" v-for="item in product.attributes">\
              {{ item.name }}\
                <span v-for="subitem in item.options">\
                {{ subitem }}\
                </span>\
            </li>\
          </ul>\
        </div>\
      </div>\
    ',

    computed: {
      nameI18n: function() {
        return getText(this.product.name, window.navigator.languages[1])
      }
    }
  })
</script>

<script>
    Desirees.nav.init();
    Desirees.navMobile.init();
    Desirees.navDropdown.init();
    Desirees.descPopover.init();
    Desirees.filterOrdering.init();
    Desirees.slider.init();
</script>

</body>
</html>

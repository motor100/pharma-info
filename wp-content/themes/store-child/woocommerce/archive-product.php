<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 29.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' ); ?>

<?php
if (is_shop()) {
  get_template_part( 'templates/content', 'shop' );
} else { ?>

  <?php $cat = get_queried_object(); ?>
  <?php if ($cat->term_id == 437): // внутриаптечные прописи ?>
    <div class="rubriki-page custom-page has-filter">
  <?php else : ?>
    <div class="archive-product single__prod has-filter">
  <?php endif; ?>
  
    <div class="container">
      <div class="catalog-inside">
        <div class="section-title"><?php echo woocommerce_page_title(); ?></div>
      </div>

      <?php if ($cat->term_id == 438): // Гомеопатия ?>

        <div class="filter-buttons-alphabet">
          <div class="button-group filters-button-group">
            <div class="eng-letters">
              <button class="filtered-button filtered-button-all active" onclick="location = this.value;">Все</button>
              <button class="filtered-button js-filtered-button" value="a">A</button>
              <button class="filtered-button js-filtered-button" value="b">B</button>
              <button class="filtered-button js-filtered-button" value="c">C</button>
              <button class="filtered-button js-filtered-button" value="d">D</button>
              <button class="filtered-button js-filtered-button" value="e">E</button>
              <button class="filtered-button js-filtered-button" value="f">F</button>
              <button class="filtered-button js-filtered-button" value="g">G</button>
              <button class="filtered-button js-filtered-button" value="h">H</button>
              <button class="filtered-button js-filtered-button" value="i">I</button>
              <button class="filtered-button js-filtered-button" value="j">J</button>
              <button class="filtered-button js-filtered-button" value="k">K</button>
              <button class="filtered-button js-filtered-button" value="l">L</button>
              <button class="filtered-button js-filtered-button" value="m">M</button>
              <button class="filtered-button js-filtered-button" value="n">N</button>
              <button class="filtered-button js-filtered-button" value="o">O</button>
              <button class="filtered-button js-filtered-button" value="p">P</button>
              <button class="filtered-button js-filtered-button" value="q">Q</button>
              <button class="filtered-button js-filtered-button" value="r">R</button>
              <button class="filtered-button js-filtered-button" value="s">S</button>
              <button class="filtered-button js-filtered-button" value="t">T</button>
              <button class="filtered-button js-filtered-button" value="u">U</button>
              <button class="filtered-button js-filtered-button" value="v">V</button>
              <button class="filtered-button js-filtered-button" value="w">W</button>
              <button class="filtered-button js-filtered-button" value="x">X</button>
              <button class="filtered-button js-filtered-button" value="y">Y</button>
              <button class="filtered-button js-filtered-button" value="z">Z</button>
            </div>
            <div class="ru-letters">
              <button class="filtered-button js-filtered-button" value="а">А</button>
              <button class="filtered-button js-filtered-button" value="б">Б</button>
              <button class="filtered-button js-filtered-button" value="в">В</button>
              <button class="filtered-button js-filtered-button" value="г">Г</button>
              <button class="filtered-button js-filtered-button" value="д">Д</button>
              <button class="filtered-button js-filtered-button" value="е">Е</button>
              <button class="filtered-button js-filtered-button" value="ж">Ж</button>
              <button class="filtered-button js-filtered-button" value="з">З</button>
              <button class="filtered-button js-filtered-button" value="и">И</button>
              <button class="filtered-button js-filtered-button" value="к">К</button>
              <button class="filtered-button js-filtered-button" value="л">Л</button>
              <button class="filtered-button js-filtered-button" value="м">М</button>
              <button class="filtered-button js-filtered-button" value="н">Н</button>
              <button class="filtered-button js-filtered-button" value="о">О</button>
              <button class="filtered-button js-filtered-button" value="п">П</button>
              <button class="filtered-button js-filtered-button" value="р">Р</button>
              <button class="filtered-button js-filtered-button" value="с">С</button>
              <button class="filtered-button js-filtered-button" value="т">Т</button>
              <button class="filtered-button js-filtered-button" value="у">У</button>
              <button class="filtered-button js-filtered-button" value="ф">Ф</button>
              <button class="filtered-button js-filtered-button" value="х">Х</button>
              <button class="filtered-button js-filtered-button" value="ц">Ц</button>
              <button class="filtered-button js-filtered-button" value="ч">Ч</button>
              <button class="filtered-button js-filtered-button" value="ш">Ш</button>
              <button class="filtered-button js-filtered-button" value="щ">Щ</button>
              <button class="filtered-button js-filtered-button" value="э">Э</button>
              <button class="filtered-button js-filtered-button" value="ю">Ю</button>
              <button class="filtered-button js-filtered-button" value="я">Я</button>
            </div>
          </div>
        </div>

      <?php endif; ?>

      <?php if($cat->term_id != 444) : // Обучение ?>
      <div class="grid-container">

        <div class="filter">
          <form class="filter" action="" method="get">
            <div class="checkbox-group">
              <div class="checkbox-group__title">Рубрика</div>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Все рубрики</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Детокс и дренаж</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Беременность</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Воспаление</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Детский возраст</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Детский возраст</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Диета и здоровый образ жизни</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
            </div>
            <div class="checkbox-group">
              <div class="checkbox-group__title">Проблемы</div>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Проблема 1</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
              <label class="checkbox-label">
                <span class="custom-checkbox-text">Проблема 2</span>
                <input type="checkbox" name="name" class="checkbox" value="">
                <span class="custom-checkbox"></span>
              </label>
            </div>
            <button type="submit" class="submit-btn primary-btn">Применить</button>
            <a href="#" class="secondary-btn clear-btn">Очистить</a>
          </form>
        </div>
      <?php endif; ?>

        <div class="content">

          <?php if ($cat->term_id == 437): // Внутриаптечные прописи ?> 

            <div class="products">
              <div class="products-item">
                <div class="image-wrapper">
                  <div class="products-item__image">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-image.png" alt="">
                  </div>
                  <div class="products-item__icon">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
                  </div>
                </div>
                <div class="products-item__title">Заголовок рубрики</div>
                <ul class="list">
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                </ul>
                <div class="see-more-btn-wrapper">
                  <a href="#" class="see-more-btn">Подробнее</a>
                </div>
              </div>
              <div class="products-item">
                <div class="image-wrapper">
                  <div class="products-item__image">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-image.png" alt="">
                  </div>
                  <div class="products-item__icon">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
                  </div>
                </div>
                <div class="products-item__title">Заголовок рубрики</div>
                <ul class="list">
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                </ul>
                <div class="see-more-btn-wrapper">
                  <a href="#" class="see-more-btn">Подробнее</a>
                </div>
              </div>
              <div class="products-item">
                <div class="image-wrapper">
                  <div class="products-item__image">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-image.png" alt="">
                  </div>
                  <div class="products-item__icon">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
                  </div>
                </div>
                <div class="products-item__title">Заголовок рубрики</div>
                <ul class="list">
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                </ul>
                <div class="see-more-btn-wrapper">
                  <a href="#" class="see-more-btn">Подробнее</a>
                </div>
              </div>
              <div class="products-item">
                <div class="image-wrapper">
                  <div class="products-item__image">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-image.png" alt="">
                  </div>
                  <div class="products-item__icon">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
                  </div>
                </div>
                <div class="products-item__title">Заголовок рубрики</div>
                <ul class="list">
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                </ul>
                <div class="see-more-btn-wrapper">
                  <a href="#" class="see-more-btn">Подробнее</a>
                </div>
              </div>
              <div class="products-item">
                <div class="image-wrapper">
                  <div class="products-item__image">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-image.png" alt="">
                  </div>
                  <div class="products-item__icon">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
                  </div>
                </div>
                <div class="products-item__title">Заголовок рубрики</div>
                <ul class="list">
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                </ul>
                <div class="see-more-btn-wrapper">
                  <a href="#" class="see-more-btn">Подробнее</a>
                </div>
              </div>
              <div class="products-item">
                <div class="image-wrapper">
                  <div class="products-item__image">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-image.png" alt="">
                  </div>
                  <div class="products-item__icon">
                    <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
                  </div>
                </div>
                <div class="products-item__title">Заголовок рубрики</div>
                <ul class="list">
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                  <li class="list-item">описание 1</li>
                </ul>
                <div class="see-more-btn-wrapper">
                  <a href="#" class="see-more-btn">Подробнее</a>
                </div>
              </div>
            </div>

          <?php else : ?>

          <?php
          if ( woocommerce_product_loop() ) {

            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action( 'woocommerce_before_shop_loop' );

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
              while ( have_posts() ) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action( 'woocommerce_shop_loop' );

                wc_get_template_part( 'content', 'product' );
              }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action( 'woocommerce_after_shop_loop' );
          } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action( 'woocommerce_no_products_found' );
          } ?>

        <?php endif; ?>

        </div>
      <?php if($cat->term_id != 444) : // Обучение ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
<?php } ?>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );

<?php
/**
 * About salts page
 *
 * @package WordPress
 * @subpackage Store-Child Theme
 * @since Store-Child Theme
 */
?>

<?php get_header(); ?>
  
<div class="substanczii-page rubriki-page custom-page has-filter">
  <div class="container">
    <div class="page-title">Гомеопатия</div>

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
      <div class="content">
        <div class="products">
          <div class="products-item">
            <div class="image-wrapper">
              <div class="products-item__icon">
                <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
              </div>
            </div>
            <div class="products-item__second-title">Название препарата может быть в две строки</div>
            <div class="price">1850 P</div>
            <div class="button">Выбрать потенции</div>
          </div>
          <div class="products-item">
            <div class="image-wrapper">
              <div class="products-item__icon">
                <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
              </div>
            </div>
            <div class="products-item__second-title">Название препарата может быть в две строки</div>
            <div class="price">1850 P</div>
            <div class="button">Выбрать потенции</div>
          </div>
          <div class="products-item">
            <div class="image-wrapper">
              <div class="products-item__icon">
                <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
              </div>
            </div>
            <div class="products-item__second-title">Название препарата может быть в две строки</div>
            <div class="price">1850 P</div>
            <div class="button">Выбрать потенции</div>
          </div>
          <div class="products-item">
            <div class="image-wrapper">
              <div class="products-item__icon">
                <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
              </div>
            </div>
            <div class="products-item__second-title">Название препарата может быть в две строки</div>
            <div class="price">1850 P</div>
            <div class="button">Выбрать потенции</div>
          </div>
          <div class="products-item">
            <div class="image-wrapper">
              <div class="products-item__icon">
                <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
              </div>
            </div>
            <div class="products-item__second-title">Название препарата может быть в две строки</div>
            <div class="price">1850 P</div>
            <div class="button">Выбрать потенции</div>
          </div>
          <div class="products-item">
            <div class="image-wrapper">
              <div class="products-item__icon">
                <img src="/wp-content/themes/store-child/includes/images/product-item-icon.png" alt="">
              </div>
            </div>
            <div class="products-item__second-title">Название препарата может быть в две строки</div>
            <div class="price">1850 P</div>
            <div class="button">Выбрать потенции</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
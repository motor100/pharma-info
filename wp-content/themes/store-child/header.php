<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
  
</head>

<body <?php body_class(); ?>>

  <?php wp_body_open(); ?>

  <?php do_action('storefront_before_site'); ?>

  <div id="page" class="hfeed site">
    <?php do_action('storefront_before_header'); ?>

    <header class="header">
      <div class="header-content">
        <div class="container">
          <div class="flex-container">
            <div class="header-logo">
              <a href="/" class="header-logo__link">
                <img src="/wp-content/themes/store-child/includes/images/logo-header.svg" alt="лого">
              </a>
            </div>
            <a href="/catalog/" class="catalog-btn header-content-btn hidden-mobile">
              <img src="/wp-content/themes/store-child/includes/images/svg/catalog-rectangle.svg" class="catalog-btn__image" alt="">
              <span class="catalog-btn__text">Каталог</span>
            </a>
            <a href="/lekarstva#personal-order-section" class="select-salt-btn header-content-btn hidden-mobile">
              <img src="/wp-content/themes/store-child/includes/images/svg/notepad.svg" class="catalog-btn__image" alt="">
              <span class="catalog-btn__text">Рецепт онлaйн</span>
            </a>
            <div class="header-search">
              <?php echo do_shortcode('[fibosearch]'); ?>
            </div>
            <div class="header-login">
              <img src="/wp-content/themes/store-child/includes/images/svg/user.svg" class="header-login__image" alt="">
              <a href="/nn-cnt" class="full-link"></a>
            </div>
            <div class="header-cart hidden-mobile">
              <img src="/wp-content/themes/store-child/includes/images/svg/basket.svg" class="header-cart__basket" alt="корзина">
              <span class="header-cart__text">Корзина</span>
              <span class="header-cart__counter"><?php global $woocommerce; echo $woocommerce->cart->get_cart_contents_count(); ?></span>
              <a href="/cart" class="full-link"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="header-nav hidden-mobile">
        <div class="container">
          <div class="menu-container">
            <ul id="header_menu" class="menu">
              <li class="menu-item menu-item-has-children">
                <a href="/o-nas">О нас</a>
                <ul class="sub-menu">
                  <li class="sub-menu-item">
                    <a href="/o-nas#mission">Миссия</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/o-nas#for-whom">Для кого</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/o-nas#how-it-works">Как это работает</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/o-nas#how-to-order">Как сделать заказ</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/faq">Вопрос-ответ</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item menu-item-has-children">
                <a href="/lekarstva">Лекарства</a>
                <ul class="sub-menu">
                  <li class="sub-menu-item">
                    <a href="/lekarstva/#personal-order-section">Персональный рецепт</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/vnutriaptechnye-propisi/">Внутриаптечные прописи</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/substanczii/">Субстанции</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item menu-item-has-children">
                <a href="/catalog/product-category/dobavki/">Добавки</a>
                <ul class="sub-menu">
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/dobavki/mineraly/">Минералы</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/dobavki/vitaminy/">Витамины</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/dobavki/bad/">БАД</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="#">Суперфуды</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item menu-item-has-children">
                <a href="/catalog/product-category/naturopatiya/">Натуропатия</a>
                <ul class="sub-menu">
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/soli-schuesslera/">Соли Шюсслера</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/cvetochnye-ehssencii-baha/">Цветочные эссенции Баха</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/gomeopatiya/">Гомеопатия</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="#">Медицина низких доз</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/travy/">Травы</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="/catalog/product-category/naruzhnye-sredstva/">Наружные средства</a>
              </li>
              <li class="menu-item menu-item-has-children">
                <a href="/catalog/product-category/dlya-zhivotnyh/">Для животных</a>
                <ul class="sub-menu">
                  <li class="sub-menu-item">
                    <a href="/lekarstva/#personal-order-section">Персональный рецепт</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/vnutriaptechnye-propisi/">Внутриаптечные прописи</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/substanczii/">Субстанции</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/dlya-zhivotnyh/">Натуропатия для животных</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/naruzhnye-sredstva/">Наружные средства</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item menu-item-has-children">
                <a href="/resursy/">Ресурсы</a>
                <ul class="sub-menu">
                  <li class="sub-menu-item">
                    <a href="/sostoyaniya-ot-a-do-ya/">Состояния от А до Я</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/obuchenie/">Обучение</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/blog/">Блог</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/novosti/">Новости</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/kontakty/">Контакты</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/soobshchestvo-inflyuehnserov/">Сообщество инфлюэнсеров</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item menu-item-has-children">
                <a href="/naturaproff/">NaturaProff</a>
                <ul class="sub-menu">
                  <li class="sub-menu-item">
                    <a href="/konsultacii/">Консультации</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/naturaproff#partner-section">Партнерская программа</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/catalog/product-category/obuchenie/">Обучающие материалы</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/naturaproff#white-label-section">Сотрудничество</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/naturaproff#for-experts-section">Партнеры</a>
                  </li>
                  <li class="sub-menu-item">
                    <a href="/naturaproff#white-label-section">White lable</a>
                  </li>
                </ul>
              </li>                
            </ul>
          </div>
        </div>
      </div>
      <div class="header-horizontal-line hidden-mobile">
        <div class="container">
          <div class="horizontal-line"></div>
        </div>
      </div>
    </header>

    <div id="content" class="site-content" tabindex="-1">

      <?php if (!is_front_page()) { ?>
        <div class="breadcrumbs-wrapper">
          <div class="container">
            <?php
            /**
             * Functions hooked in to storefront_before_content
             *
             * @hooked storefront_header_widget_region - 10
             * @hooked woocommerce_breadcrumb - 10
             */
            do_action('storefront_before_content');
            ?>
          </div>
        </div>
      <?php } ?>

      <?php //do_action('storefront_content_top');

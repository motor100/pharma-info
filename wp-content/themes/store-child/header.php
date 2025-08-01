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
                <img src="/wp-content/themes/store-child/includes/images/logo_header.png" alt="лого">
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
            <div class="header-login hidden-mobile">
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
                    <a href="/o-nas#faq">Вопрос-ответ</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="/lekarstva">Лекарства</a>
              </li>
              <li class="menu-item">
                <a href="/catalog/product-category/dobavki/">Добавки</a>
              </li>
              <li class="menu-item">
                <a href="/catalog/product-category/naturopatiya/">Натуропатия</a>
              </li>
              <li class="menu-item">
                <a href="/catalog/product-category/naruzhnye-sredstva/">Наружные средства</a>
              </li>
              <li class="menu-item">
                <a href="/catalog/product-category/dlya-zhivotnyh/">Для животных</a>
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
                    <a href="/blog/">Блог Статьи</a>
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
              <li class="menu-item">
                <a href="/naturaprof/">NaturaProf</a>
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

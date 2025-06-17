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
      <div class="header-desktop hidden-mobile">
        <div class="header-content">
          <div class="container">
            <div class="flex-container">
              <div class="header-logo">
                <a href="/" class="header-logo__link">
                  <img src="/wp-content/themes/store-child/includes/images/logo_header.png" alt="лого">
                  <!-- <div class="underlogo-text">since 1873</div> -->
                </a>
              </div>
              <a href="/catalog/product-category/soli-schuesslera/" class="catalog-btn header-content-btn">
                <img src="/wp-content/themes/store-child/includes/images/svg/catalog-rectangle.svg" class="catalog-btn__image" alt="">
                <span class="catalog-btn__text">Каталог</span>
              </a>
              <a href="/expert-system" class="select-salt-btn header-content-btn">
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
              <div class="header-cart">
                <img src="/wp-content/themes/store-child/includes/images/svg/basket.svg" class="header-cart__basket" alt="корзина">
                <span class="header-cart__text">Корзина</span>
                <span class="header-cart__counter"><?php global $woocommerce; echo $woocommerce->cart->get_cart_contents_count(); ?></span>
                <a href="/cart" class="full-link"></a>
              </div>
            </div>
          </div>
        </div>
        <div class="header-nav">
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
                      <a href="/o-nas#how-to-place-order">Как сделать заказ</a>
                    </li>
                    <li class="sub-menu-item">
                      <a href="/o-nas#faq">Вопрос-ответ</a>
                    </li>
                  </ul>
                </li>
                <li class="menu-item menu-item-has-children">
                  <a href="/lekarstva">Лекарства</a>
                </li>
                <li class="menu-item menu-item-has-children">
                  <a href="/lekarstva#">Добавки</a>
                </li>
                <li class="menu-item menu-item-has-children">
                  <a href="/lekarstva#">Натуропатия</a>
                </li>
                <li class="menu-item menu-item-has-children">
                  <a href="/lekarstva#">Наружные средства</a>
                </li>
                <li class="menu-item menu-item-has-children">
                  <a href="/lekarstva#">Для животных</a>
                </li>
                <li class="menu-item menu-item-has-children">
                  <a href="/lekarstva#">NaturaProf</a>
                </li>
                <li class="menu-item menu-item-has-children">
                  <a href="/lekarstva#">Ресурсы</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="header-horizontal-line">
          <div class="container">
            <div class="horizontal-line"></div>
          </div>
        </div>
      </div>
      <div class="header-mobile hidden-desktop">
        <div class="header-top">
          <div class="container">
            <div class="address-text">Московская область, совхоз им Ленина, Техцентр <br> Пн-Пт: 10:00 до 20:00, Сб-Вс: выходной</div>
          </div>
        </div>
        <div class="header-logo">
          <div class="container">
            <div class="logo">
              <img src="/wp-content/themes/store-child/includes/images/logo_header.png" class="header-logo__image" alt="лого">
              <!-- <div class="underlogo-text">since 1873</div> -->
            </div>
          </div>
        </div>
        <div class="header-search">
          <div class="container">
            <?php echo do_shortcode('[fibosearch]'); ?>
          </div>
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

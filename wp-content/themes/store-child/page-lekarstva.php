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
  
<div class="lekarstva-page custom-page">

  <div class="order-online-section section">
    <div class="container">
      <div class="page-title">Лекарства</div>
      <div class="flex-container">
        <div class="image">
          <img src="/wp-content/themes/store-child/includes/images/o-nas-image4.jpg" alt="">
        </div>
        <div class="description">
          <div class="description-title">Закажите Свой рецепт Онлайн</div>
          <div class="order-online-btn primary-btn">
            <img src="/wp-content/themes/store-child/includes/images/svg/notepad-light.svg" class="order-online-btn__image" alt="">
            <span class="order-online-btn__text">Закажи рецепт онлайн</span>
          </div>
          <div class="main-advantages">
            <div class="main-advantages-item">
              <img src="/wp-content/themes/store-child/includes/images/svg/advantages-check.svg" class="main-advantages-item__image" alt="">
              <span class="main-advantages-item__text">Ингредиенты премиум-класса</span>
            </div>
            <div class="main-advantages-item">
              <img src="/wp-content/themes/store-child/includes/images/svg/advantages-check.svg" class="main-advantages-item__image" alt="">
              <span class="main-advantages-item__text">Приоритетная доставка</span>
            </div>
            <div class="main-advantages-item">
              <img src="/wp-content/themes/store-child/includes/images/svg/advantages-check.svg" class="main-advantages-item__image" alt="">
              <span class="main-advantages-item__text">Доставка по всей России</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="desc-section section">
    <div class="container">
      <div class="text">
        <p>Мы производим персональные лекарства по рецептам врачей и внутриаптечные прописи  из зарегистрированных в Государственном реестре лекарственных средств фармацевтических субстанций высшего качества.</p>
        <p>Субстанции проходят приемочный контроль. Проверка качества субстанций осуществляется в независимой аналитической лаборатории, препараты готовятся согласно фармакопее , валидация и разработка экстемпоральных рецептур проходит в нашем R&D центре.</p>  
        <p>Подробнее про экстемпоральные препараты можно прочитать здесь</p>
      </div>
      <div class="read-more-btn">Читать подробнее</div>
    </div>
  </div>

  <div class="personal-order-section section">
    <div class="container">
      <div class="form-wrapper">
        <div class="form-title">Заказ по вашему персональному рецепту</div>
        <div class="form-description">Вы можете прикрепить фото вашего рецепта</div>
        <form class="form" action="">
          <input type="text" class="input-field js-required-phone" name="name" min="3" max="100" required placeholder="Ваше имя">
          <input type="text" class="input-field js-required-phone js-input-phone-mask" name="phone" required placeholder="+7 (000) 000 00 00">
          <div class="form-group">
            <input type="file" name="input-photo-file" id="input-photo-file" class="inputfile" accept="image/jpeg,image/png" multiple>
            <label for="input-photo-file" class="custom-inputfile-label">
              <span class="custom-inputfile-label-text">Прикрепить фото</span>
              <img src="/wp-content/themes/store-child/includes/images/paperclip.png" class="paperclip" alt="">
            </label>
            <!-- <span class="namefile photo-file-text">Файлы не выбраны</span> -->
          </div>
          <button type="button" class="submit-btn primary-btn">Отправить</button>
        </form>
      </div>
    </div>
  </div>

  <div class="vnutriaptechnye-propisi-section section">
    <div class="container">
      <div class="flex-container">
        <div class="vnutriaptechnye-propisi-title">Внутриаптечные прописи</div>
        <div class="catalog-btn">Перейти в каталог</div>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>
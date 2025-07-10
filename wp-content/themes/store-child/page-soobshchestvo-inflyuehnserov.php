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
  
<div class="soobshchestvo-inflyuehnserov-page custom-page">
  <div class="container">
    <div class="page-title">Сообщество инфлюэнсеров</div>
  </div>

  <div class="content-section section">
    <div class="container">
      <div class="wide-image content-image">
        <img src="/wp-content/themes/store-child/includes/images/temp-image.jpg" alt="">
      </div>
      <div class="content-text">Хотите присоединиться к нашему постоянно растущему сообществу влиятельных людей? Вы увлечены оздоровлением и ищете возможность предложить своей аудитории персонализированные наборы витаминов?</div>
      <div class="flex-container">
        <div class="thin-image content-image">
          <img src="/wp-content/themes/store-child/includes/images/temp-image.jpg" alt="">
        </div>
        <div class="thin-image content-image">
          <img src="/wp-content/themes/store-child/includes/images/temp-image.jpg" alt="">
        </div>
        <div class="thin-image content-image">
          <img src="/wp-content/themes/store-child/includes/images/temp-image.jpg" alt="">
        </div>
        <div class="thin-image content-image">
          <img src="/wp-content/themes/store-child/includes/images/temp-image.jpg" alt="">
        </div>
      </div>
    </div>
  </div>

  <div class="partner-section section">
    <div class="container">
      <div class="section-title">Подайте заявку, чтобы стать партнером</div>
      <form action="" class="form">
        <div class="flex-container">
          <div class="inputs">
            <div class="inputs-row">
              <div class="form-group">
                <input type="text" name="first-name" id="first-name" class="input-field">
                <label for="first-name" class="label">Имя<span class="purple-color">*</span></label>
              </div>
              <div class="form-group">
                <input type="text" name="second-name" id="second-name" class="input-field">
                <label for="second-name" class="label">Фамилия<span class="purple-color">*</span></label>
              </div>
            </div>
            <div class="inputs-row">
              <div class="form-group">
                <input type="text" name="country" id="country" class="input-field">
                <label for="country" class="label">Страна<span class="purple-color">*</span></label>
              </div>
              <div class="form-group">
                <input type="text" name="city" id="city" class="input-field">
                <label for="city" class="label">Город<span class="purple-color">*</span></label>
              </div>
            </div>
            <div class="inputs-row">
              <div class="form-group">
                <input type="text" name="phone" id="phone" class="input-field js-input-phone-mask">
                <label for="phone" class="label">Телефон<span class="purple-color">*</span></label>
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email" class="input-field">
                <label for="email" class="label">Эл.почта<span class="purple-color">*</span></label>
              </div>
            </div>
          </div>
          <div class="form-group textarea-group">
            <textarea name="message" class="textarea" id="message"></textarea>
            <label for="message" class="label">Комментарий</label>
          </div>
        </div>

        <div class="agreement-text">
          <input type="checkbox" name="checkbox-read" class="custom-checkbox js-required-checkbox" id="checkbox-read-callback" checked required onchange="document.getElementById('callback-top-submit-btn').disabled = !this.checked;">
          <label for="checkbox-read-callback" class="custom-checkbox-label"></label>
          <span class="checkbox-text">Я согласен (-на) с <a href="/politika-v-otnoshenii-obrabotki-personalnyh-dannyh/" class="privacy-policy-link" target="_blank">политикой конфиденциальности</a></span>
        </div>
        <div class="agreement-text">
          <input type="checkbox" name="checkbox-agree" class="custom-checkbox js-required-checkbox" id="checkbox-agree-callback" checked required onchange="document.getElementById('callback-top-submit-btn').disabled = !this.checked;">
          <label for="checkbox-agree-callback" class="custom-checkbox-label"></label>
          <span class="checkbox-text">Я согласен (-на) с <a href="/soglasie-posetitelya-sajta-na-obrabotku-personalnyh-dannyh/" class="agreement-link" target="_blank">обработку персональных данных</a></span>
        </div>

        <button type="button" class="submit-btn primary-btn">Отправить форму</button>

      </form>
    </div>
  </div>
</div>

<?php get_footer(); ?>
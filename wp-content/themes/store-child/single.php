 <?
/**
 * @package WordPress
 * @subpackage Classic_Theme
 * Template Name: Шаблон блога
 */

?>

<?php get_header(); ?>

<div class="single-page custom-page">

  <div class="single-section">
    <div class="container">
      <div class="page-title"><?php the_title(); ?></div>
    </div>

    <?php

    $specialisty_cat_id = 445; // ID категории Специалисты local = 445 prod = 445

    $cat = get_the_category();

    if ($cat[0]->parent == $specialisty_cat_id) : ?>
      
      <div class="container">
        <div class="flex-container">
          <div class="single-image">
            <?php the_post_thumbnail(''); ?>
          </div>
          <div class="single-content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>

      <div class="partner-section section">
        <div class="container">
          <div class="section-title">Записаться на консультацию</div>
          <form id="lfs-form" class="form">
            <div class="flex-container">
              <div class="inputs">
                <div class="inputs-row">
                  <div class="form-group">
                    <input type="text" name="name" id="first-name" class="input-field js-required-name" autocomplete="on">
                    <label for="first-name" class="label">Имя<span class="purple-color">*</span></label>
                  </div>
                  <div class="form-group">
                    <input type="text" name="surname" id="second-name" class="input-field js-required-surname" autocomplete="on">
                    <label for="second-name" class="label">Фамилия<span class="purple-color">*</span></label>
                  </div>
                </div>
                <div class="inputs-row">
                  <div class="form-group">
                    <input type="text" name="telegram" id="lfs-telegram" class="input-field js-input-telegram-mask" autocomplete="on" placeholder="формат @name">
                    <label for="lfs-telegram" class="label">Телеграм</label>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" class="input-field js-required-email" autocomplete="on">
                    <label for="email" class="label">Эл.почта<span class="purple-color">*</span></label>
                  </div>
                </div>
                <div class="inputs-row">
                  <div class="form-group">
                    <input type="text" name="phone" id="phone" class="input-field js-input-phone-mask js-required-phone" autocomplete="on">
                    <label for="phone" class="label">Телефон<span class="purple-color">*</span></label>
                  </div>
                </div>
              </div>
              <div class="form-group textarea-group">
                <textarea name="message" class="textarea" id="message"></textarea>
                <label for="message" class="label">Комментарий</label>
              </div>
            </div>

            <button type="button" id="lfs-submit-btn" class="submit-btn primary-btn">Отправить форму</button>

            <div class="agreement-text">
              <input type="checkbox" name="checkbox-read" class="custom-checkbox js-required-checkbox" id="checkbox-read-callback9" checked required onchange="document.getElementById('lfs-submit-btn').disabled = !this.checked;">
              <label for="checkbox-read-callback9" class="custom-checkbox-label"></label>
              <span class="checkbox-text">Я согласен (-на) с <a href="/politika-v-otnoshenii-obrabotki-personalnyh-dannyh/" class="privacy-policy-link" target="_blank">политикой конфиденциальности</a></span>
            </div>
            <div class="agreement-text">
              <input type="checkbox" name="checkbox-agree" class="custom-checkbox js-required-checkbox" id="checkbox-agree-callback9" checked required onchange="document.getElementById('lfs-submit-btn').disabled = !this.checked;">
              <label for="checkbox-agree-callback9" class="custom-checkbox-label"></label>
              <span class="checkbox-text">Я согласен (-на) с <a href="/soglasie-posetitelya-sajta-na-obrabotku-personalnyh-dannyh/" class="agreement-link" target="_blank">обработку персональных данных</a></span>
            </div>

            <?php $expert_email = get_post_meta( $post->ID, 'expert_email', true ); ?>
            <input type="hidden" name="cc" value="<?php echo $expert_email ? $expert_email : ""; ?>">
            <input type="hidden" name="expert" value="<?php the_title(); ?>">

          </form>
        </div>
      </div>

    <?php else : ?>

      <div class="container">
        <?php if (get_the_post_thumbnail()) { ?>
          <div class="single-image">
            <?php the_post_thumbnail(''); ?>
          </div>
        <?php } ?>
        <div class="single-content">
          <?php the_content(); ?>
        </div>
      </div>

    <?php endif ?>
  </div>

</div>

<?php get_footer();?>
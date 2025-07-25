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
      <p>Это карточка специалиста</p>
    <?php else : ?>

      <div class="container">
        <div class="single-image">
          <?php the_post_thumbnail(''); ?>
        </div>
        <div class="single-content">
          <?php the_content(); ?>
        </div>
      </div>

    <?php endif ?>
  </div>

</div>

<?php get_footer();?>
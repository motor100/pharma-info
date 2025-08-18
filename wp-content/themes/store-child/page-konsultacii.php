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
  
<div class="konsultacii-page sw-page specialisty-page custom-page">

  <div class="container">
    <div class="page-title">Консультации</div>
  </div>

  <?php
  $specialisty_cat_id = 445; // ID категории Специалисты local = 445 prod = 445
  $doctors_cat_id = 449; // ID дочерней категории Врачи local = 449
  $psychologists_cat_id = 460; // ID дочерней категории Психологи local = 460
  $naturopaths_cat_id = 463; // ID дочерней категории Натуропаты local = 463
  $practices_cat_id = 464; // ID дочерней категории Практики local = 464
  ?>

  <?php

  $args1 = array(
    'cat' => [
      $specialisty_cat_id,
      -$doctors_cat_id, // исключить дочернюю категорию
      -$psychologists_cat_id // исключить дочернюю категорию
    ],
    'posts_per_page' => -1,
  );
  
  $query1 = new WP_Query( $args1 );

  $cat_array = [];
  ?>

  <div class="cities section">
    <div class="container">

      <div class="flex-container filter-by-doctors">
        <a href="/konsultacii" class="cities-item active">Все</a>
        <div class="cities-item js-city-btn" data-term-id="<?php echo $doctors_cat_id; ?>">Врачи</div>
        <div class="cities-item js-city-btn" data-term-id="<?php echo $psychologists_cat_id; ?>">Психологи</div>
        <div class="cities-item js-city-btn" data-term-id="<?php echo $naturopaths_cat_id; ?>">Натуропаты</div>
        <div class="cities-item js-city-btn" data-term-id="<?php echo $practices_cat_id; ?>">Практики</div>
      </div>

      <div class="flex-container filter-by-cities">
        <a href="/konsultacii" class="cities-item active">Все города</a>

        <?php
        /**
         * Вывод городов
         * Города это названия дочерних категорий для родительской категории $specialisty_cat_id
        */
        while( $query1->have_posts() ) :
          $query1->the_post();

          // Создание массива с id и названиями дочерних категорий
          $cats = get_the_category();

          foreach ($cats as $ct) :
            if ($ct->term_id != $specialisty_cat_id) :
              if (!in_array($ct->term_id, $cat_array)) : ?>
                <div class="cities-item js-city-btn" data-term-id="<?php echo $ct->term_id; ?>"><?php echo $ct->name; ?></div>
                <?php $cat_array[] = $ct->term_id;
              endif;
            endif;
          endforeach;
        endwhile; ?>

      </div>
    </div>
  </div>

  <div class="specialists">
    <div class="container">
      <div class="grid-container js-insert-specialists">
        <?php

        // Номер страницы пагинации
        // $current = absint( max( 1, get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' ) ) );
        $args2 = array(
          'cat' => $specialisty_cat_id,
          'posts_per_page' => -1,
          // 'paged' => $current,
        );
        
        $query2 = new WP_Query( $args2 );
        $cat_array = [];

        if ( $query2->have_posts() ) :
          while( $query2->have_posts() ) :
            $query2->the_post(); ?>

            <div class="specialists-item">
              <div class="specialists-item__image">
                <a href="<?php the_permalink(); ?>" class="item-link">
                  <?php the_post_thumbnail(); ?>
                </a>
                <div class="specialists-item__icon">

                  <?php
                  // Вывод разных иконок в завимости от категории

                  $cats = get_the_category($post->ID);

                  foreach($cats as $cat) {

                    switch ($cat->term_id) {
                      case $doctors_cat_id:
                        echo '<img src="/wp-content/themes/store-child/includes/images/specialists-stethoscope.png" alt="">';
                        break;
                      case $psychologists_cat_id:
                        echo '<img src="/wp-content/themes/store-child/includes/images/specialists-brain.png" alt="">';
                        break;
                      case $naturopaths_cat_id:
                        echo '<img src="/wp-content/themes/store-child/includes/images/specialists-first-aid.png" alt="">';
                        break;
                      case $practices_cat_id:
                        echo '<img src="/wp-content/themes/store-child/includes/images/specialists-flower-lotus.pngg" alt="">';
                        break;
                    }
                  }
                  ?>
                  
                </div>
              </div>

              <div class="specialists-item__content">
                <div class="specialists-item__title"><?php the_title(); ?></div>
                <div class="specialists-item__excerpt"><?php echo the_text_max_charlength(get_the_excerpt(), 100); ?></div>
                <a href="<?php the_permalink(); ?>" class="specialists-item__link">Подробнее</a>
              </div>
            </div>
          
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <p>Записей нет.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>
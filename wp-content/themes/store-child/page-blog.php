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
  
<div class="bn-page blog-page custom-page">
  <div class="container">
    <div class="page-title">Блог</div>
  </div>

  <div class="bn-section">
    <div class="container">
      <div class="grid-container">

        <?php
        // получаем номер страницы пагинации
        $current = absint( max( 1, get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' ) ) );

        $param = array(
          'cat' => 105,
          'posts_per_page' => 12,
          'nopaging' => false,
          'paged' => $current,
        );
    
        $query = new WP_Query( $param );

        if ( $query->have_posts() ) :
          while( $query->have_posts() ) :
            $query->the_post(); ?>
            <div class="bn-item">
              <div class="bn-item__image">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="bn-item__title"><?php the_title(); ?></div>
              <a href="<?php the_permalink(); ?>" class="bn-item__link full-link"></a>
            </div>
            
          <?php
          endwhile
          ?>

          <?php wp_reset_postdata(); ?>

        <?php else : ?>
          <p>Записей нет.</p>
        <?php endif; ?>

      </div>

    </div>
  </div>

  <div class="pagination-section">
    <div class="container">
      <div class="pagination">
        <?php 
        echo wp_kses_post(
          paginate_links(
            [
              'total'   => $query->max_num_pages, // количество берем из дефолтной опции запроса
              'current' => $current, // текущая страница
            ]
          )
        );
        ?>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>
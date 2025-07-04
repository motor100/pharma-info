<?php if ( !is_page('catalog') ) { ?>

  <div class="text-page">
    <div class="container">
      <div class="row">
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php
              /**
               * Functions hooked in to storefront_page add_action
               *
               * @hooked storefront_page_header          - 10
               * @hooked storefront_page_content         - 20
               */
              do_action( 'storefront_page' );
          ?>
        </div> 
      </div>
    </div>
  </div>

<?php } else { ?>

  <div class="catalog-page">
    <div class="catalog-section">
      <div class="container">
        <div class="catalog-section-title">Каталог</div>
        <div class="cat-wrapper">
          <?php
          $args = array(
            'taxonomy'     => 'product_cat',
            'orderby'      => 'ID',
            'show_count'   => 0,
            // 'parent'       => 25,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'exclude'      => '15',
            'hide_empty'   => 0
          );

          $categories = get_categories( $args );

          foreach ($categories as $cat) {
            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            //$img = $image ? $image : '/wp-content/uploads/woocommerce-placeholder.png';
            $img = $image ? $image : '/wp-content/themes/store-child/includes/images/temp-placeholder.png';
            ?>

            <div class="cat-item">
              <div class="flex-container">
                <div class="cat-image">
                  <img src="<?php echo $img; ?>" alt="">
                </div>
                <?php $cat_id = $cat->term_id; 
                // тут switch 

                ?>
                <div class="cat-icon">
                  <img src="/wp-content/themes/store-child/includes/images/catalog-icon1.png" alt="">
                </div>
               </div>
              <div class="cat-title" href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?></div>
              <div class="cat-view-more">Подробнее</div>
              <a href="<?php echo get_term_link($cat->term_id); ?>" class="full-link"></a>
            </div>
          <?php
          }
          ?>

        </div>
      </div>
    </div>
  </div>

<?php } ?>
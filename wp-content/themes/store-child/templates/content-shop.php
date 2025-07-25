<div class="archive-product catalog-page single__prod">
  <div class="catalog-inside">
    <div class="container">
      <div class="section-title">Магазин</div>
    </div>
  </div>
  
  <div class="container">

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
              <div class="cat-icon">
                <?php $cat_id = $cat->term_id;
                switch ($cat_id) {
                  case 25: // Соли Шюсслера ?>
                      <img src="/wp-content/themes/store-child/includes/images/catalog-icon1.png" alt="">
                      <?php
                      break;
                  case 437: // Внутриаптечные прописи ?>
                    <img src="/wp-content/themes/store-child/includes/images/catalog-icon2.svg" alt="">
                    <?php
                    break;
                  case 438: // Гомеопатия ?>
                    <img src="/wp-content/themes/store-child/includes/images/catalog-icon3.svg" alt="">
                    <?php
                    break;
                  default: ?>
                    <img src="/wp-content/themes/store-child/includes/images/catalog-icon1.png" alt="">
                    <?php
                    break;
                }
                ?>
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
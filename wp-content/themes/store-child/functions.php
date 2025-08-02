<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

add_action( 'wp_enqueue_scripts', 'my_dequeue_style', 99 );

function my_dequeue_style(){
    wp_dequeue_style( 'storefront-child-style' ); // отключение файла /store-child/style.css
}

// Добавление версии в css и js
/*
* $temp_debug = true добавляется версия на основе даты и времени
* $temp_debug = false добавляется версия wp
*/

$temp_debug = true;
$ver = '';
if ($temp_debug) {
  $ver = date('dis');
}

// Scripts
add_action( 'wp_enqueue_scripts', 'add_scripts' );

function add_scripts() {
    global $ver;
	// wp_enqueue_script( 'fancy', get_stylesheet_directory_uri() . '/includes/js/fancy.js' );
	// wp_enqueue_script( 'isotope', get_stylesheet_directory_uri() . '/includes/js/isotope.js' );
  	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/includes/js/app.min.js' );
    wp_enqueue_script( 'jquery-ui', get_stylesheet_directory_uri() . '/includes/js/jquery-ui.min.js' );
	// wp_enqueue_script( 'iso', get_stylesheet_directory_uri() . '/includes/js/iso.js' );

    if ( is_front_page() ) {
        wp_enqueue_script( 'swiper', get_stylesheet_directory_uri() . '/includes/js/swiper-bundle.min.js' );
    }

    wp_enqueue_script( 'imask', get_stylesheet_directory_uri() . '/includes/js/imask.min.js' );

    if ( is_product() ) {
        wp_enqueue_script( 'slim-select', get_stylesheet_directory_uri() . '/includes/js/slimselect.min.js' );
    }

    wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/includes/js/main.js','',$ver);

    // включение файла admin-ajax.php для front
    wp_localize_script('custom-script', 'my_ajax_obj', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    // включение файла admin-ajax.php для front
    wp_localize_script('main', 'Myscrt', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'dequeue_storefront_child_theme_style', 9999);
function dequeue_storefront_child_theme_style() {
    wp_dequeue_style('storefront-child-style');
}


// Styles
add_action('wp_print_styles', 'add_styles');

function add_styles() {
    global $ver;
    if ( is_front_page() ) {
        wp_enqueue_style( 'swiper', get_stylesheet_directory_uri() . '/includes/css/swiper-bundle.min.css' );
    }

    if ( is_product() ) {
        wp_enqueue_style( 'slim-select', get_stylesheet_directory_uri() . '/includes/css/slimselect.min.css' );
    }

    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/includes/css/style.css','',$ver );
}


// Удалить атрибут type у scripts
function clean_script_tag($src) {
  return str_replace("type='text/javascript'", '', $src);
}
add_filter('script_loader_tag', 'clean_script_tag');

// Удалить атрибут type у style
function clean_css_tag($tag, $handle) {
  return preg_replace( "/type=['\"]text\/(css)['\"]/", '', $tag );
}
add_filter('style_loader_tag', 'clean_css_tag', 10, 2);

// Disable the emoji's
function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }
  return $urls;
}


// Каталог продукции
function render__catalog($id_gr) {
    $taxonomy     = 'product_cat';
    $orderby      = 'ID';
    $show_count   = 0;
    $pad_counts   = 0;
    $hierarchical = 1;
    $title        = '';
    $empty        = 0;
    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'parent'       => $id_gr,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'exclude'      => '15',
        'hide_empty'   => $empty
    );

    $all_categories = get_categories( $args );

    $html = '';

    foreach ($all_categories as $cat) {
        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        if ($id_gr == '96') {
            $css_w = 'w110px';
        } else {
            $css_w = 'img';
        }
        $image = wp_get_attachment_url( $thumbnail_id );
        $img = $image ? $image : '/wp-content/uploads/woocommerce-placeholder.png';
        $html .= '<div class="children__item">';
        $html .= '<div class="flex-container">';
        $html .= '<div class="children__image">';
        $html .= '<img class="' . $css_w . '" src="' . $img . '" alt="' . $cat->name . '">';
        $html .= '</div>';
        $html .= '<div class="children__icon">';
        $html .= '<img src="" alt="">';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<a class="children__title" href="' . get_term_link($cat->term_id) . '">' . $cat->name . '</a>';
        $html .= '</div>';
    }

    return $html;
}


// Регистрация нового типа поста home_page_slider для слайдера на главной странице
function slider_register_cpt() {
    $args = array(
        'labels' => array(
            'menu_name' => 'Слайдер'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-airplane',
        'publicly_queryable' => false,
        'supports' => ['title', 'thumbnail', 'custom-fields'],
    );
    register_post_type( 'home_page_slider', $args );
}

add_action( 'init', 'slider_register_cpt' );

// Добавление метабокса product_link на кастомный тип постов home_page_slider
function home_page_slider_add_metabox() {
    add_meta_box(
        'product_link', // ID нашего метабокса
        'Ссылка на препараты', // заголовок
        'home_page_slider_metabox_callback', // функция, которая будет выводить поля в мета боксе
        'home_page_slider', // типы постов, для которых его подключим
        'normal', // расположение (normal, side, advanced)
        'default' // приоритет (default, low, high, core)
    );
}

add_action( 'add_meta_boxes', 'home_page_slider_add_metabox' );
 
function home_page_slider_metabox_callback( $post ) {
    // сначала получаем значения этих полей
    // ссылка на товар
    $product_link = get_post_meta( $post->ID, 'product_link', true );
 
    // одноразовые числа, кстати тут нет супер-большой необходимости их использовать
    wp_nonce_field( 'seopostsettingsupdate-' . $post->ID, '_truenonce' );
 
    echo '<table class="form-table">
        <tbody>
            <tr>
                <th><label for="seo_title">Ссылка</label></th>
                <td><input type="text" id="product_link" name="product_link" value="' . esc_attr( $product_link ) . '" class="regular-text"></td>
            </tr>
        </tbody>
    </table>';
}

// Сохранение кастомного типа постов home_page_slider
function home_page_slider_save_metabox( $post_id, $post ) {
 
    // проверка одноразовых полей
    if ( ! isset( $_POST[ '_truenonce' ] ) || ! wp_verify_nonce( $_POST[ '_truenonce' ], 'seopostsettingsupdate-' . $post->ID ) ) {
        return $post_id;
    }
 
    // проверяем, может ли текущий юзер редактировать пост
    $post_type = get_post_type_object( $post->post_type );
 
    if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
        return $post_id;
    }
 
    // ничего не делаем для автосохранений
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return $post_id;
    }
 
    // проверяем тип записи
    if( 'home_page_slider' !== $post->post_type ) {
        return $post_id;
    }
 
    if( isset( $_POST[ 'product_link' ] ) ) {

        // Создание относительной ссылки
        $link = $_POST[ 'product_link' ];
        if( strpos($link,'//') === false ) {
            $link='//'.$link;
        }
        $n_link = parse_url($link, PHP_URL_PATH);

        update_post_meta( $post_id, 'product_link', sanitize_text_field( $n_link ) );
    } else {
        delete_post_meta( $post_id, 'product_link' );
    }
 
    return $post_id;
}

add_action( 'save_post', 'home_page_slider_save_metabox', 10, 2 );


/**
 * Вывод записей по буквам на странице Состояния от А до Я
 *
 * @param
 * @return string
 */
function get_posts_per_letter() {

    $html = "";

    $query = new WP_Query(array(
        'cat' => 425, // ID категории Состояния от А до Я
        'orderby' => 'title', // Сортировка по названию 
        'order' => 'ASC', // Сортировка в алфавитном порядке
        'posts_per_page' => -1, // Вывод всех постов
    ));

    if ( $query->have_posts() ) { 
        $prev_letter = ''; // Первая буква предыдущего заголовка поста

        $index = 0;
        while ($query->have_posts()) { 
            global $prev_letter;

            $query->the_post();
            $content1 = "";
            $first_letter = mb_substr(get_the_title(), 0, 1); // Получение первой буквы заголовка поста

            // Вывод первой буквы заголовка поста
            if ($prev_letter != $first_letter) {
                if ($index > 0) {
                    $content1 .= "</div>";
                }
                $content1 .= "<div class=\"letter\">" . $first_letter . "</div>";
                $content1 .= "<div class=\"flex-container\">";
            }
            
            $content1 .= "<a href=\"" . get_permalink() . "\" class=\"title\">";
            $content1 .= esc_html( get_the_title() );
            $content1 .= "</a>";
              
            $html .= $content1;
            $prev_letter = $first_letter;

            $index++;
        }

        wp_reset_postdata();

    } else {
        $content = "Записей нет.";
    }

    return $html;
}


// Добавление post_type post в результаты поска
/*
add_filter( 'dgwt/wcas/search_query/args', function ( $args ) {
    if ( current_user_can( 'manage_options' ) ) {
        $args['post_status'] = [ 'publish' ];
        $args['post_type'] = [ 'product', 'post' ];
    }
   
   return $args;
} );
*/


// Добавление post_type product в результаты поска
// add_filter( 'pre_get_posts', 'modified_pre_get_posts'); 
function modified_pre_get_posts( $query ) { 
  if ( $query->is_search() ) { 
    $query->set( 'post_type', 'product' ); 
  }
  return $query;
}


/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query The main WordPress query.
 */
function tg_include_custom_post_types_in_search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array( 'post', 'products' ) );
    }
}
// add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_search_results' );


// Личный кабинет my account
// Ссылка входа в личный кабинет
/*
function my_account_loginout_link() {    

    if (is_user_logged_in() ) {
        global $wp;
        $current_user = get_user_by( 'id', get_current_user_id() ); 
        echo '<a class="nav-link" href="'. wp_logout_url( get_permalink( wc_get_page_id( 'shop' ) ) ) .'">выйти</a>'; echo '<strong><a class="nav-link" href="'. get_permalink( wc_get_page_id( 'myaccount' ) ) .'">'.$current_user->display_name.'</a></strong>';
    } elseif (!is_user_logged_in() ) {
        echo '<a class="nav-link" href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">Авторизация/Регистрация</a>';
    }

}
*/

// Переимнование элементов меню
add_filter( 'woocommerce_account_menu_items', 'lk_rename_menu', 25 );
 
function lk_rename_menu( $menu_links ) {
    unset( $menu_links[ 'customer-logout' ] ); // Удаление ссылки из меню
    unset( $menu_links[ 'payment-methods' ] ); // Удаление ссылки из меню
    $menu_links[ 'dashboard' ] = 'Главная';
    $menu_links[ 'downloads' ] = 'Загрузки';
    $menu_links[ 'edit-address' ] = 'Адреса';
    $menu_links[ 'edit-account' ] = 'Профиль';

    // Добавление элементов меню для пользователя Специалист
    // Специалист это пользователь с ролью Клиент у которого в поле Биография слово "Специалист"
    $user = wp_get_current_user();

    $description = get_the_author_meta('description', $user->ID);

    if ($description == 'Специалист') {
        $menu_links[ 'coupon' ] = 'Купоны';
    }

    $menu_links[ 'knowledge-base' ] = 'База знаний'; // Добавление нового элемента меню База знаний
    $menu_links[ 'support' ] = 'Поддержка'; // Добавление нового элемента меню Купоны
    $menu_links[ 'customer-logout' ] = 'Выйти'; // Добавление ссылки в меню

    return $menu_links;
}


// Удаление заголовка страницы
add_action( 'wp', 'remove_storefront_title' );

function remove_storefront_title() {
    if ( is_account_page() ) {
        remove_action( 'storefront_page', 'storefront_page_header', 10 );
    }
}


// Добавление новой страницы База знаний
function add_endpoint_knowledge_base() {
    add_rewrite_endpoint( 'knowledge-base', EP_PAGES );
}
add_action( 'init', 'add_endpoint_knowledge_base', 20 );
 
function knowledge_base_content() {
    echo '<h2 class="tr-title">База знаний</h2>';
    echo '<p>Описание базы знаний</p>';
    echo '<p><a href="#">Ссылка на базу знаний</a></p>';
}
add_action( 'woocommerce_account_knowledge-base_endpoint', 'knowledge_base_content', 20 );


// Добавление новой страницы Поддержка
add_action( 'init', 'add_endpoint_support', 25 );
function add_endpoint_support() {
    add_rewrite_endpoint( 'support', EP_PAGES );
}

add_action( 'woocommerce_account_support_endpoint', 'support_content', 25 );
function support_content() {
    echo '<h2 class="tr-title">Поддержка</h2>';
    echo '<p>Описание поддержки</p>';
    echo '<p>Телефон: +7 (495) 927-4-928</p>';
    echo '<p>Whatsapp: +7 (495) 927-4-928</p>';
    echo '<p>Почта: info@naturapharma.ru</p>';
}

// Добавление новой страницы Купоны
add_action( 'init', 'add_endpoint_coupon', 30 );
function add_endpoint_coupon() {
    add_rewrite_endpoint( 'coupon', EP_PAGES );
}

add_action( 'woocommerce_account_coupon_endpoint', 'coupon_content', 30 );
function coupon_content() {

    echo '<h2 class="tr-title">Купон</h2>';

    // Текущий пользователь
    $user_id = get_current_user_id();

    $args = array(
        'post_type' => 'shop_coupon',
        'post_status' => 'publish',
        'posts_per_page' => 1, // Одна запись
        'author' => $user_id
    );

    $query = new WP_Query($args);

    if ( $query->have_posts() ) { 

        $i = 0;
        while ($query->have_posts()) {
            // Одна запись
            if ($i == 0) {
                $query->the_post();

                // Объект купона
                $coupon = new WC_Coupon( get_the_id() );

                echo '<a href="/nn-cnt/update-coupon" class="coupon-create-btn primary-btn">Обновить купон</a>';

                if ($coupon) {
                    echo '<div class="coupon-description">';
                    echo '<p>Код</p>';
                    echo '<p><strong>' . $coupon->get_code() . '</strong></p>';
                    echo '<p>Скидка</p>';
                    echo '<p><strong>' . $coupon->get_amount() . '%</strong></p>';
                    echo '<p>Использовано/Лимит</p>';
                    echo '<p><strong>' . $coupon->get_usage_count() . '/' . $coupon->get_usage_limit() . '</strong></p>';
                    echo '<p>Сумма заказов</p>';
                    $summ = get_order_by_coupon($coupon->get_code());
                    echo '<p><strong>' . ($summ > 0 ? number_format($summ, 0, '.', ' ') : '0') . 'р</strong></p>';
                    echo '<p>Бонус</p>';
                    echo '<p><strong>' . ($summ > 0 ? $summ * 0.05 : '0') . 'р</strong></p>';
                    echo '</div>';
                }                
            }
            $i++;
        }
        wp_reset_postdata();
    } else {
        echo '<a href="/nn-cnt/add-coupon" class="coupon-create-btn primary-btn">Добавить купон</a>';
    }

}


// Добавление нового купона
add_action( 'init', 'add_endpoint_add_coupon', 35 );
function add_endpoint_add_coupon() {
    add_rewrite_endpoint( 'add-coupon', EP_PAGES );
}

add_action( 'woocommerce_account_add-coupon_endpoint', 'add_coupon_content', 35 );
function add_coupon_content() {
    // Специалист это пользователь с ролью Клиент у которого в поле Биография слово "Специалист"
    $user = wp_get_current_user();

    $description = get_the_author_meta('description', $user->ID);

    if ($description == 'Специалист') {

        $coupon_code = 'k' . $user->ID . '_' . strtoupper(wp_generate_password(6, false)); // Уникальный код купона
        $discount_amount = '5'; // По умолчанию скидка 5%
        $coupon = array(
            'post_title' => $coupon_code,
            'post_excerpt' => $user->user_firstname . ' ' . $user->user_lastname,
            'post_status' => 'publish',
            'post_author' => $user->ID,
            'post_type' => 'shop_coupon',
        );
        
        // Вставляем купон в базу данных
        $coupon_id = wp_insert_post($coupon);
        
        // Устанавливаем мета-данные для купона
        update_post_meta($coupon_id, 'discount_type', 'percent');
        update_post_meta($coupon_id, 'coupon_amount', $discount_amount);
        // update_post_meta($coupon_id, 'usage_limit', '1');
        // update_post_meta($coupon_id, 'expiry_date', date('Y-m-d', strtotime('+1 month')));
        update_post_meta($coupon_id, 'apply_before_tax', 'yes');
        update_post_meta($coupon_id, 'exclude_sale_items', 'no');
    }

    echo '<script>location.href = "http://biosalts.loc/nn-cnt/coupon"</script>';
}

// Обновление текущего купона
add_action( 'init', 'add_endpoint_update_coupon', 35 );
function add_endpoint_update_coupon() {
    add_rewrite_endpoint( 'update-coupon', EP_PAGES );
}

// Сумма всех заказов по купону
function get_order_by_coupon($coupon) {
    global $wpdb;

    $table_woocommerce_order_items = $wpdb->prefix . 'woocommerce_order_items';
    $table_wc_orders = $wpdb->prefix . "wc_orders";

    $items = $wpdb->get_results($wpdb->prepare("SELECT order_id FROM $table_woocommerce_order_items WHERE order_item_name = %s AND order_item_type = 'coupon'", $coupon), ARRAY_A);

    if (!$items) {
        return '0';
    }

    $order_items = [];

    foreach($items as $item) {
        $order_items[] = $item['order_id'];
    }

    $sql = "SELECT total_amount FROM $table_wc_orders WHERE id IN(".implode(', ', array_fill(0, count($order_items), '%s')).")";

    $query = call_user_func_array(array($wpdb, 'prepare'), array_merge(array($sql), $order_items));
    
    $orders = $wpdb->get_results($query);
    
    $summ = 0;

    foreach($orders as $order) {
        $summ += $order->total_amount;
    }

    return $summ;
}


add_action( 'woocommerce_account_update-coupon_endpoint', 'update_coupon_content', 35 );
function update_coupon_content() {

    // Специалист это пользователь с ролью Клиент у которого в поле Биография слово "Специалист"
    $user = wp_get_current_user();

    $description = get_the_author_meta('description', $user->ID);

    if ($description == 'Специалист') {

        // Удаление старого купона
        $args = array(
            'post_type' => 'shop_coupon',
            'post_status' => 'publish',
            'posts_per_page' => 1, // Одна запись
            'author' => $user_id
        );

        $query = new WP_Query($args);

        if ( $query->have_posts() ) { 

            $i = 0;
            while ($query->have_posts()) {
                // Одна запись
                if ($i == 0) {
                    $query->the_post();

                    // Объект купона
                    $coupon = new WC_Coupon( get_the_id() );

                    // Удаление meta полей
                    delete_post_meta( get_the_id(), 'discount_type' );
                    delete_post_meta( get_the_id(), 'coupon_amount' );
                    delete_post_meta( get_the_id(), 'apply_before_tax' );
                    delete_post_meta( get_the_id(), 'exclude_sale_items' );

                    // Удаление
                    wp_delete_post($coupon->id);
                }
                $i++;
            }
            wp_reset_postdata();
        } else {
            echo '<script>location.href = "http://biosalts.loc/nn-cnt/coupon"</script>';
        }

        // Создание нового купона
        $coupon_code = 'k' . $user->ID . '_' . strtoupper(wp_generate_password(6, false)); // Уникальный код купона
        $discount_amount = '5'; // По умолчанию скидка 5%
        $coupon = array(
            'post_title' => $coupon_code,
            'post_excerpt' => $user->user_firstname . ' ' . $user->user_lastname,
            'post_status' => 'publish',
            'post_author' => $user->ID,
            'post_type' => 'shop_coupon',
        );
        
        // Вставляем купон в базу данных
        $coupon_id = wp_insert_post($coupon);
        
        // Устанавливаем мета-данные для купона
        update_post_meta($coupon_id, 'discount_type', 'percent');
        update_post_meta($coupon_id, 'coupon_amount', $discount_amount);
        // update_post_meta($coupon_id, 'usage_limit', '1');
        // update_post_meta($coupon_id, 'expiry_date', date('Y-m-d', strtotime('+1 month')));
        update_post_meta($coupon_id, 'apply_before_tax', 'yes');
        update_post_meta($coupon_id, 'exclude_sale_items', 'no');
    }
    
    echo '<script>location.href = "http://biosalts.loc/nn-cnt/coupon"</script>';
}


add_action( 'woocommerce_account_content', 'action_woocommerce_account_content', 5 );
function action_woocommerce_account_content(  ) {
    if (is_wc_endpoint_url( 'downloads' ) ) {
        $title = "Загрузки";
    }
    elseif ( is_wc_endpoint_url( 'orders' ) ) {
        $title = "Заказы";
    }
    elseif ( is_wc_endpoint_url( 'edit-address' ) ) {
        $title = "Адреса";
    }
    elseif ( is_wc_endpoint_url( 'edit-account' ) ) {
        $title = "Профиль";
    }
    elseif ( is_wc_endpoint_url( 'payment-methods' ) ) {
        $title = "Способ оплаты";
    }

    if (isset ($title)) {
        echo '<h2 class="tr-title">' . $title . '</h2>';
    }
    return;
};


// откл сортировку
// add_action( 'wp', 'bbloomer_remove_default_sorting_storefront' );

// function bbloomer_remove_default_sorting_storefront() {
//   remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
//   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
// }

/**
 *
 * Register a shortcode that creates a product categories dropdown list
 *
 * Use: [product_categories_dropdown orderby="title" count="0" hierarchical="0"]
 */
add_shortcode( 'product_categories_dropdown', 'woo_product_categories_dropdown' );
function woo_product_categories_dropdown( $atts ) {
  // Attributes
  $atts = shortcode_atts( array(
    'hierarchical' => '1', // or '1'
    'hide_empty'   => '0', // or '1'
    'show_count'   => '0', // or '1'
    'depth'        => '0', // or Any integer number to define depth
    'orderby'      => 'order', // or 'name'
    'exclude'      => '15',
  ), $atts, 'product_categories_dropdown' );

  ob_start();

  wc_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_shortcode_dropdown_args', array(
    'depth'              => $atts['depth'],
    'hierarchical'       => $atts['hierarchical'],
    'hide_empty'         => $atts['hide_empty'],
    'orderby'            => $atts['orderby'],
    'show_uncategorized' => 0,
    'show_count'         => $atts['show_count'],
    'exclude'         => $atts['exclude'],
  ) ) );

  ?>
    <script type='text/javascript'>
        jQuery(function($){
            var product_cat_dropdown = $(".dropdown_product_cat");
            function onProductCatChange() {
                if ( product_cat_dropdown.val() !=='' ) {
                    location.href = "<?php echo esc_url( home_url() ); ?>/?product_cat=" +product_cat_dropdown.val();
                }
            }
            product_cat_dropdown.change( onProductCatChange );
        });
    </script>
  <?php

  return ob_get_clean();
}

add_filter('woocommerce_default_address_fields', 'override_default_address_checkout_fields', 20, 1);
function override_default_address_checkout_fields( $address_fields ) {
    $address_fields['postcode']['placeholder'] = 'Почтовый индекс';
	$address_fields['city']['placeholder'] = 'Город';
	$address_fields['state']['placeholder'] = 'Область/Регион';
    return $address_fields;
}

add_filter('category_link', function($a){
	return str_replace( 'category/', '', $a );
}, 99 );

add_filter( 'the_excerpt', 'filter_the_excerpt', 10, 2 );
    function filter_the_excerpt( ) {
    return ' ';
 }
 
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');

function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="basket-btn__counter">(<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</span>
    <?php
    $fragments['.basket-btn__counter'] = ob_get_clean();
    return $fragments;
}

add_filter( 'woocommerce_product_tabs', 'rk_remove_product_tabs', 25 );
 
function rk_remove_product_tabs( $tabs ) {
 
	unset( $tabs[ 'reviews' ] ); // вкладка Отзывы
	unset( $tabs[ 'additional_information' ] ); // вкладка Детали
 
	return $tabs;
}

/*
add_filter( 'woocommerce_product_tabs', 'ql_reorder_product_tabs', 98 );

function ql_reorder_product_tabs( $tabs ) {
    $tabs['description']['priority'] = 0; // Description first
    return $tabs;
}


add_filter('woocommerce_product_tabs', 'rk_new_product_tab', 1);
function rk_new_product_tab( $tabs ) {
	if ( get_field('sostavnoj_tovar') ) {
		$tabs['sostav_tab'] = array(
			'title' =>  'Состав комплекса',
			'priority' => 1,
			'callback' => 'rk_new_tab_content',
			'content' => get_field('sostav_kompleksa'),
		);
	} else unset( $tabs['sostav_tab'] );
	return $tabs;
}
function rk_new_tab_content($tab_name, $tab) {
    echo $tab['content'];
}

add_filter('woocommerce_product_tabs', 'rk_new_product_tab_2', 2);
function rk_new_product_tab_2( $tabs ) {
	if ( get_field('sostavnoj_tovar') ) {
		$tabs['pokazakia_tab'] = array(
			'title' =>  'Показания и противопоказания',
			'priority' => 2,
			'callback' => 'rk_new_tab_content_2',
			'content' => get_field('pokazaniya_i_protivopokazaniya'),
		);
	} else unset( $tabs['pokazakia_tab'] );
	return $tabs;
}

function rk_new_tab_content_2($tab_name, $tab) {
    echo $tab['content'];
}

add_filter('woocommerce_product_tabs', 'rk_new_product_tab_4', 4);
function rk_new_product_tab_4( $tabs ) {
	if ( get_field('sostavnoj_tovar') ) {
		$tabs['fiz_tab'] = array(
			'title' =>  'Физиология и психосоматика',
			'priority' => 4,
			'callback' => 'rk_new_tab_content_4',
			'content' => get_field('fiziologiya_i_psihosomatika'),
		);
	} else unset( $tabs['fiz_tab'] );
	return $tabs;
}
function rk_new_tab_content_4($tab_name, $tab) {
        echo $tab['content'];
}

add_filter('woocommerce_product_tabs', 'rk_new_product_tab_5', 5);
function rk_new_product_tab_5( $tabs ) {
	$tabs[ 'doz_tab' ] = array(
		'title' 	=> 'Дозирование',
		'priority' 	=> 5,
		'callback' 	=> 'rk_new_tab_content_5'
	);
	return $tabs;
}

function rk_new_tab_content_5() {
	if(get_field('dozirovanie')) { 
		echo '<div class="">';
		the_field('dozirovanie');
		echo '</div>';
	}
}

add_filter('woocommerce_product_tabs', 'rk_new_product_tab_6', 6);
function rk_new_product_tab_6( $tabs ) {
	if ( !get_field('sostavnoj_tovar') ) {
		$tabs['pok_tab'] = array(
			'title' =>  'Показания',
			'priority' => 4,
			'callback' => 'rk_new_tab_content_6',
			'content' => get_field('pokazaniya'),
		);
	} else unset( $tabs['pok_tab'] );
	return $tabs;
}

function rk_new_tab_content_6($tab_name, $tab) {
    echo $tab['content'];
}
*/

add_action( 'woocommerce_before_quantity_input_field', 'truemisha_quantity_plus', 25 );
add_action( 'woocommerce_after_quantity_input_field', 'truemisha_quantity_minus', 25 );
 
function truemisha_quantity_plus() {
	echo '<button type="button" class="minus">-</button>';
}
 
function truemisha_quantity_minus() {
	echo '<button type="button" class="plus">+</button>';
}

add_action( 'wp_footer', 'my_quantity_plus_minus' );
 
function my_quantity_plus_minus() {
 
   if ( ! is_product() && ! is_cart() ) return;
   ?>
      <script type="text/javascript">
 
      jQuery( function( $ ) {   
 
         $(document).on( 'click', 'button.plus, button.minus', function() {
 
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
       });
 });
       </script>
   <?php
}

/*
// Функция для удаления пустых табов в карточке товара WooCommerce
function remove_empty_product_tabs( $tabs ) {
    foreach ( $tabs as $key => $tab ) {
        ob_start();
        if ( isset( $tab['callback'] ) ) {
            call_user_func( $tab['callback'], $key, $tab );
        }
        $content = ob_get_clean();
        if ( empty( trim( $content ) ) ) {
            unset( $tabs[ $key ] );
        }
    }
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_empty_product_tabs', 98 );
*/


add_shortcode( 'products_dropdown', 'wc_products_from_cat_dropdown' );
function wc_products_from_cat_dropdown( $atts ) {
        // Shortcode Attributes
        $atts = shortcode_atts( array(
            'product_id' => '', 
        ), $atts, 'products_dropdown' );
        
    $product_id = is_product() ? get_the_id() : $atts['product_id'];
    
    if ( empty($product_id) )
        return;

    ob_start();

    $query = new WP_Query( array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => '-1',
        'post__not_in'     => array( $product_id ),
        'tax_query' => array( array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'ids' ) ) ,
        ) ),
    ) );

    if ( $query->have_posts() ) :

    echo '<div class="products-dropdown"><select name="products-select" id="products-select">
    <option value="">'.__('Choose a related product').'</option>';

    while ( $query->have_posts() ) : $query->the_post();

    echo '<option value="'.get_permalink().'">'.get_the_title().'</option>';

    endwhile;

    echo '</select> <button type="button" style="padding:2px 10px; margin-left:10px;">'._("Go").'</button></div>';

    wp_reset_postdata();

    endif;

    ?>
    <script type='text/javascript'>
        jQuery(function($){
            var a = '.products-dropdown', b = a+' button', c = a+' select', s = '';
            $(c).change(function(){
                s = $(this).val();
            });
             $(b).click(function(){
                if( s != '' ) location.href = s;
            });

        });
    </script>
    <?php

    return ob_get_clean();
}


// Изменение текста related products
function change_relatedproducts_text($new_text, $related_text, $source) {
    if ($related_text === 'Related products' && $source === 'woocommerce') {
        $new_text = esc_html__('Также рекомендуем', $source);
    }
    return $new_text;
}
add_filter('gettext', 'change_relatedproducts_text', 10, 3);


// Вывод товаров в карточке товара Также рекомендуем related products limit
function jk_related_products_args( $args ) {
    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 1; // arranged in 1 columns
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );


// AJAX получить специалистов по городу на странице Специалисты
/*
add_action( 'wp_ajax_get_specialists', 'get_specialists_from_city' ); // хук wp_ajax
add_action( 'wp_ajax_nopriv_get_specialists', 'get_specialists_from_city' ); // хук wp_ajax для незалогиненных пользователей

function get_specialists_from_city() {
    
    // Получение id подкатегории из запроса
    $cat_id = ! empty( $_POST['cat_id'] ) ? esc_attr( $_POST['cat_id'] ) : false;
    
    // Получение подкатегории
    $cat = get_term_by( 'id', $cat_id, 'category' );

    // Если нет категории, то return false
    if ( ! $cat ) {
        return false;
    }

    // Запрос
    $query = new WP_Query( array (
        'cat' => $cat_id,
        'post_status'    => 'publish',
        'nopaging' => true,
        'posts_per_page' => '-1',
    ) );

    // Вывод записей
    if ( $query->have_posts() ) {

        while ( $query->have_posts() ) {
            $query->the_post();

            // Подключение шаблона content-specialists
            require ( get_stylesheet_directory() . '/templates/content-specialists.php' );
        }

        wp_reset_postdata();

    }
    
    wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего (0), только то что возвращает функция
}
*/

add_action('wp_ajax_start_payment', 'start_payment');
add_action('wp_ajax_nopriv_start_payment', 'start_payment');


// AJAX обновление количество товара у значка корзины в хэдере и нижнем мобильном меню add to cart
add_action( 'wp_ajax_set_cart_counters', 'set_counters' ); // хук wp_ajax
add_action( 'wp_ajax_nopriv_set_cart_counters', 'set_counters' ); // хук wp_ajax для незалогиненных пользователей

// Функция получения данных из корзины
function set_counters() {
    echo json_encode([
        'count' => WC()->cart->get_cart_contents_count(),
        'total' => WC()->cart->get_cart_contents_total()
    ]);
    
    wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего (0), только то что возвращает функция
}


// AJAX фильтр товаров в категории Гомеопатические монопрепараты term-id=18
add_action( 'wp_ajax_get_products_term_gomeopatiya', 'get_term_gomeopatiya_products' );
add_action( 'wp_ajax_nopriv_get_products_term_gomeopatiya', 'get_term_gomeopatiya_products' );

function get_term_gomeopatiya_products() {

    // Получение letter из запроса
    $letter = ! empty( $_POST['letter'] ) ? esc_attr( $_POST['letter'] ) : false;

    // Если нет letter, то return false
    if ( ! $letter ) {
        return false;
    }

    // Запрос
    $query = new WP_Query( array (
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => '-1',
        'tax_query' => array( array (
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => 438,
        ) ),
    ) );

    // Вывод записей
    if ( $query->have_posts() ) {

        while ( $query->have_posts() ) {
            $query->the_post();

            // Получение первой буквы названия товара
            $title = get_the_title();
            $first_letter = mb_strtolower(mb_substr($title, 0, 1));

            // Вывод товаров у которых первая буква названия как буква из запроса
            if ($first_letter == $letter) {
                // Подключение шаблона product loop
                require ( WP_PLUGIN_DIR . '/woocommerce/templates/content-product.php' );
            }
        }

        wp_reset_postdata();

    }
    
    wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего (0), только то что возвращает функция
}


/**
 * Работа с купонами из woocommerce
 * Генерация купона
 * 
 * @param string $user_email Емайл пользователя
 * @return string $coupon_code Код купона
 */
function create_discount_coupon($user_email) {
    $coupon_code = 'DISCOUNT_' . strtoupper(wp_generate_password(8, false)); // Уникальный код купона
    $discount_amount = '10';
    $coupon = array(
        'post_title' => $coupon_code,
        'post_content' => '10% discount coupon',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'shop_coupon',
    );
    
    // Вставляем купон в базу данных
    $coupon_id = wp_insert_post($coupon);
    
    // Устанавливаем мета-данные для купона
    update_post_meta($coupon_id, 'discount_type', 'percent');
    update_post_meta($coupon_id, 'coupon_amount', $discount_amount);
    update_post_meta($coupon_id, 'usage_limit', '1');
    update_post_meta($coupon_id, 'expiry_date', date('Y-m-d', strtotime('+1 month')));
    update_post_meta($coupon_id, 'apply_before_tax', 'yes');
    update_post_meta($coupon_id, 'exclude_sale_items', 'no');
    
    // Привязываем купон к пользователю // FIXME?
    update_post_meta($coupon_id, 'customer_email', $user_email->user_email);
    
    return $coupon_code;
}


add_action('wp_ajax_handle_questionnaire_completion', 'handle_questionnaire_completion');
add_action('wp_ajax_nopriv_handle_questionnaire_completion', 'handle_questionnaire_completion');


// AJAX получение купона по коду
function get_coupon_amount() {
    global $wpdb;

    // Получение кода купона из запроса
    $coupon_code = ! empty( $_POST['coupon_code'] ) ? sanitize_text_field( $_POST['coupon_code'] ) : false;

    if ( ! $coupon_code ) {
        return;
    }

    $coupon_code = esc_sql($coupon_code);

    $args = array(
        'post_type' => 'shop_coupon',
        'post_status' => 'publish',
        'posts_per_page' => 1, // Одна запись
        'title' => $coupon_code
    );

    $query = new WP_Query($args);

    if ( $query->have_posts() ) { 

        $i = 0;
        while ($query->have_posts()) {
            // Одна запись
            if ($i == 0) {
                $query->the_post();

                // Объект купона
                $coupon = new WC_Coupon( get_the_id() );

                if ( $coupon == '' ) {
                    return;
                }

                // Счетчик количества использований купона
                $usage_count = $coupon->get_usage_count();
                // Лимит использования купона
                $usage_limit = $coupon->get_usage_limit();
                // Тип скидки
                $discount_type = $coupon->get_discount_type();
                // Срок действия
                $date_expires = $coupon->get_date_expires();

                // Проверка на количество использований купона
                if ($usage_limit > 0) {
                    if ($usage_count >= $usage_limit) {
                        return;
                    }
                }

                // Проверка на тип скидки купона
                if ($discount_type != 'percent') {
                    return;
                }

                // Проверка срока действия купона
                if ($date_expires != '') {
                    if ($date_expires < date("Y-m-d\TH:i:sP")) {
                        return;
                    }
                }

                // Название таблицы
                $table_name = $wpdb->prefix . 'postmeta';

                $result = '';

                if ($usage_count == 0) {
                    // Вставляем запись в таблице
                    $result = $wpdb->insert(
                        $table_name,
                        array(
                            'post_id' => get_the_id(),
                            'meta_key' => 'usage_count',
                            'meta_value' => intval($usage_count) + 1
                        ),
                        array('%d', '%s', '%s')
                    );
                } else {
                    // Обновляем запись в таблице
                    $result = $wpdb->update(
                        $table_name,
                        array('meta_value' => intval($usage_count) + 1), // Новое значение meta_value
                        array('post_id' => get_the_id(), 'meta_key' => 'usage_count'), // Условие where для обновления
                        array('%s'), // Формат для meta_value
                    );
                }

                // Проверяем результат и отправляем ответ
                if ($result !== false) {
                    echo $coupon->get_amount();
                } else {
                    return;
                }

            }
            $i++;
        }
        wp_reset_postdata();
    } else {
        return;
    }

    wp_die();
}

add_action( 'wp_ajax_get_coupon', 'get_coupon_amount' );
add_action( 'wp_ajax_nopriv_get_coupon', 'get_coupon_amount' );


// Замена символа рубля на букву Р
function woocommerce_change_rub_symbol( $valyuta_symbol, $valyuta_code ) {
    if( $valyuta_code === 'RUB' ) {
        return 'Р';
    }
    return $valyuta_symbol;
}

add_filter('woocommerce_currency_symbol', 'woocommerce_change_rub_symbol', 9999, 2);


/*
* Disable pagination
* Priority=11 to go after the Storefront's hook.
* Отключение пагинации в карточке товаров
* С включенной пагинацией некоторые товары выдают ошибку
*/
add_filter( 'theme_mod_storefront_product_pagination', '__return_false', 11 );


/**
 * Ограничение количества выводимых символов в тексте
 * 
 * @param string $text
 * @param integer $charlength
 * @return string
 */
function the_text_max_charlength( $text, $charlength ) {
    $charlength++;

    if ( mb_strlen( $text ) > $charlength ) {
        $subex = mb_substr( $text, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            return mb_substr( $subex, 0, $excut ) . '...';
        } else {
            return $subex;
        }
    } else {
        return $text;
    }
}


// AJAX получить товары из подкатегории на странице Соли Щюсслера
add_action( 'wp_ajax_get_subcat', 'get_subcat_products' ); // хук wp_ajax
add_action( 'wp_ajax_nopriv_get_subcat', 'get_subcat_products' ); // хук wp_ajax для незалогиненных пользователей

function get_subcat_products() {

    // Получение id подкатегории из запроса
    $subcat_id = ! empty( $_POST['subcat_id'] ) ? esc_attr( $_POST['subcat_id'] ) : false;

    // Получение подкатегории
    $subcat = get_term_by( 'id', $subcat_id, 'product_cat' );

    // Если нет подкатегории, то return false
    if ( ! $subcat ) {
        return false;
    }

    // Запрос
    $query = new WP_Query( array (
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => '-1',
        'order' => 'ASC',
        'tax_query' => array( array (
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $subcat_id,
        ) ),
    ) );

    // Вывод записей
    if ( $query->have_posts() ) {

        while ( $query->have_posts() ) {
            $query->the_post();

            // Подключение шаблона product loop
            require ( WP_PLUGIN_DIR . '/woocommerce/templates/content-product.php' );
        }

        wp_reset_postdata();
    }
    
    wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего (0), только то что возвращает функция
}


// Отключение скриптов и стилей плагина Contact Form 7
// На страницах Главная, Каталог, Карточка товара, Блог, Специалисты
add_action( 'wp_enqueue_scripts', 'disable_contact_form_css_and_js', 999 );
 
function disable_contact_form_css_and_js() {
 
    if( is_home() || 
        is_front_page() || 
        is_page( 'contacts' ) || 
        is_page( 'blog' ) || 
        is_page( 'specialisty' ) || 
        is_page( 'catalog' ) ) {
        
        wp_dequeue_style( 'contact-form-7' );
        wp_dequeue_script( 'contact-form-7' );
    }

    return; 
}


/*WooCommerce - убираем WooC Generator tag, стили, и скрипты для страниц, не относящихся к плагину*/
add_action( 'wp_enqueue_scripts', 'my_on_woocommerce_scripts', 999 );

function my_on_woocommerce_scripts() {
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) ); //убираем generator meta tag
    if ( function_exists( 'is_woocommerce' ) ) { //проверяем, активен ли WooCommerce - исключим ошибеи
        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) { //отменяем загрузку скриптов/стилей
            wp_dequeue_style( 'woocommerce_frontend_styles' ); // стили
            wp_dequeue_style( 'woocommerce_fancybox_styles' );
            wp_dequeue_style( 'woocommerce_chosen_styles' );
            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
            wp_dequeue_script( 'wc_price_slider' );
            wp_dequeue_script( 'wc-single-product' );
            //wp_dequeue_script( 'wc-add-to-cart' ); //этот скрипт ДЛЯ отработки кнопки Добавить в корзину
            // подключаются: plugins/woocommerce/assets/js/frontend/add-to-cart.min.js И ещё: plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js
            wp_dequeue_script( 'wc-cart-fragments' );
            wp_dequeue_script( 'wc-checkout' );
            wp_dequeue_script( 'wc-add-to-cart-variation' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-cart' );
            wp_dequeue_script( 'wc-chosen' );
            wp_dequeue_script( 'woocommerce' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'jquery-blockui' );
            //wp_dequeue_script( 'jquery-placeholder' );
            wp_dequeue_script( 'fancybox' );
            wp_dequeue_script( 'jqueryui' );
        }
    }
}
/*оптимизируем работу Woocommerce*/


// Disable global styles
add_action( 'wp_enqueue_scripts', 'remove_global_styles', 999 );

function remove_global_styles(){
    wp_dequeue_style( 'global-styles' );
}


// Disable gutenberg frontend styles @ https://m0n.co/15
function disable_gutenberg_wp_enqueue_scripts() {
    
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');

    wp_dequeue_style('wc-block-style'); // disable woocommerce frontend block styles
    wp_dequeue_style('storefront-gutenberg-blocks'); // disable storefront frontend block styles
    
}
add_filter('wp_enqueue_scripts', 'disable_gutenberg_wp_enqueue_scripts', 999);


// Disable classic theme styles
add_action( 'wp_enqueue_scripts', 'disable_classic_theme_styles', 999);

function disable_classic_theme_styles() {
    wp_dequeue_style( 'classic-theme-styles' );
}


// Disable wp blocks
function disable_wp_blocks() {
    $wstyles = array(
        'wp-block-library',
        'wc-blocks-style',
        'wc-blocks-style-active-filters',
        'wc-blocks-style-add-to-cart-form',
        'wc-blocks-packages-style',
        'wc-blocks-style-all-products',
        'wc-blocks-style-all-reviews',
        'wc-blocks-style-attribute-filter',
        'wc-blocks-style-breadcrumbs',
        'wc-blocks-style-catalog-sorting',
        'wc-blocks-style-customer-account',
        'wc-blocks-style-featured-category',
        'wc-blocks-style-featured-product',
        'wc-blocks-style-mini-cart',
        'wc-blocks-style-price-filter',
        'wc-blocks-style-product-add-to-cart',
        'wc-blocks-style-product-button',
        'wc-blocks-style-product-categories',
        'wc-blocks-style-product-image',
        'wc-blocks-style-product-image-gallery',
        'wc-blocks-style-product-query',
        'wc-blocks-style-product-results-count',
        'wc-blocks-style-product-reviews',
        'wc-blocks-style-product-sale-badge',
        'wc-blocks-style-product-search',
        'wc-blocks-style-product-sku',
        'wc-blocks-style-product-stock-indicator',
        'wc-blocks-style-product-summary',
        'wc-blocks-style-product-title',
        'wc-blocks-style-rating-filter',
        'wc-blocks-style-reviews-by-category',
        'wc-blocks-style-reviews-by-product',
        'wc-blocks-style-product-details',
        'wc-blocks-style-single-product',
        'wc-blocks-style-stock-filter',
        'wc-blocks-style-cart',
        'wc-blocks-style-checkout',
        'wc-blocks-style-mini-cart-contents',
        'classic-theme-styles-inline'
    );

    if (!is_admin()) {
        foreach ( $wstyles as $wstyle ) {
            wp_deregister_style( $wstyle );
        }
    }

    $wscripts = array(
        'wc-blocks-middleware',
        'wc-blocks-data-store'
    );

    if (!is_admin()) {
        foreach ( $wscripts as $wscript ) {
            wp_deregister_script( $wscript );  
        }
    }
}

add_action( 'init', 'disable_wp_blocks', 100 );

// Добавление параметров url в ссылку на анкету
add_filter( 'woocommerce_download_product_filepath', 'woocommerce_download_product_filepath_filter', 10, 5 );

/**
 * Функция добавление параметров url в ссылку на анкету
 * 
 * Function for `woocommerce_download_product_filepath` filter-hook.
 * 
 * @param string               $file_path     File path.
 * @param string               $email_address Email address.
 * @param WC_Order|bool        $order         Order object or false.
 * @param WC_Product           $product       Product object.
 * @param WC_Customer_Download $download      Download data.
 *
 * @return string
 */
function woocommerce_download_product_filepath_filter( $file_path, $email_address, $order, $product, $download ){
    return $file_path . '?d=' . $order->get_id();
}


// Создание уникальной строки длина 30 символов
function get_random_string() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    $length = 30;

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

/**
 * Функция для отправки письма с купоном
 * 
 * @param $user_email string почта для отправки
 * @param $coupon_code string код купона
 * @param $results array массив с результатами прохождения анкеты
 * @param $order_id string номер заказа
 * @return void
 * */
function send_coupon_email($user_email, $coupon_code, $results, $order_id) {

    // Преобразование массива с результатами
    $str = '<p><b>Ваш результат</b></p>';
    foreach($results as $value) {
      $tmp = '<p>';
      $tmp .= 'Соль: ' . $value['salt'] . '<br>';
      $tmp .= $value['description'];
      $tmp .= '</p>';
      $str .= $tmp;
    }

    $str .= '<p><b>Как принимать</b></p>';
    foreach($results as $value) {
      $tmp = '<p>';
      $tmp .= $value['prescription_14'];
      $tmp .= '</p>';
      $str .= $tmp;
    }

    $subject = 'Ваш купон на скидку';
    $message = '
        <html>
        <head>
            <title>Ваш купон на скидку</title>
        </head>
        <body>
            <p>Здравствуйте!</p>
            <p>Спасибо за ваш запрос. Мы рады предоставить вам одноразовый купон на скидку 10% на любой заказ в нашем магазине. Используйте код купона при оформлении заказа:</p>
            <p><strong>' . $coupon_code . '</strong></p>
            <p>Купон действует в течение 1 месяца.</p>'
            . $str .
            '<p>Номер заказа: ' . $order_id . '</p>
            <p>С уважением,<br> Соли Шюсслера</p>
        </body>
        </html>
    ';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    
    wp_mail($user_email, $subject, $message, $headers);
}


// Cоздание маршрута для проверки заказа
add_action( 'rest_api_init', function(){
    // Пространство имен
    $namespace = 'myplugin/v1';

    // Маршрут
    $route = '/posts/(?P<id>\d+)';

    // Параметры конечной точки (маршрута)
    $route_params = [
        'methods'  => 'GET',
        'callback' => 'check_order',
        'permission_callback' => '__return_true',
    ];

    register_rest_route( $namespace, $route, $route_params );
} );

// Функция обработчик конечной точки (маршрута)
function check_order( WP_REST_Request $request ) {
    global $wpdb;

    // Преобразование символов в html сущности
    $order_id = htmlspecialchars($request['id']);

    // Проверка строки на преобразование в число
    if ( !is_numeric($order_id) ) {
        return [
            'status' => false,
            'error' => 'order_id is not numeric'
        ];
    }

    // Получение объекта заказа WC_Order
    $order = wc_get_order( (int) $order_id );

    if ( $order ) {

        /**
         * Объект загрузок
         * Документация https://wp-kama.ru/plugin/woocommerce/function/WC_Customer_Download_Data_Store
         *
         */
        $WC_Customer_Download_Data_Store = new WC_Customer_Download_Data_Store();

        /**
         * @param string $order_id номер заказа
         * @return array массив с вложенными объектами
         */
        $cdds = $WC_Customer_Download_Data_Store->get_downloads( ['order_id' => $order_id] );

        // Если у этого заказа нет загружаемых товаров
        if ($cdds == []) {
            return [
                'status' => false,
                'error' => 'order have no downloable product'
            ];
        }

        // Счетчик Загрузок осталось
        // Если счетчик Загрузок осталось не установлен, то значение ключа download_remaining будет пустая строка
        // С каждой загрузкой счетчик количества загрузок увеличивается на 1, счетчик Загрузок осталось уменьшается на 1
        // После прохождения анкеты увеличиваю на 1 счетчик количества загрузок. Функция questionnaire_rezult()
        // В массиве $cdds ключ [0] - первый и единственный товар в этом заказе
        $downloads_remaining = $cdds[0]['data']['downloads_remaining'];

        // Если счетчик Загрузок осталось установлен, то значение ключа download_remaining будет число
        if ($downloads_remaining != '') {
            
            // Счетчик количества загрузок
            $download_count = $cdds[0]['data']['download_count'];

            // Сравнение счетчик количества загрузок со счетчиком Загрузок осталось + 1, то возвращаю ошибку
            if (intval($download_count) > intval($downloads_remaining) + 1) {
                return [
                    'status' => false,
                    'download_count' => 'download count: ' . $download_count,
                    'downloads_remaining' => 'downloads remaining: ' . $downloads_remaining
                ];
            }
        }

        // Дата окончания действия ссылки в формате WC_DateTime
        // Если дата окончания не установлена, то будет пустая строка или null
        $access_expires = $cdds[0]->get_access_expires();

        // Если установлена дата окончания действия
        if ($access_expires) {
            // Преобразование даты окончания и текущей даты в форматах 'Ymd' в число и сравнение чисел
            if (intval(date('Ymd')) > intval($access_expires->format('Ymd'))) {
                return [
                    'status' => false,
                    'error' => 'expires date'
                ];
            }
        }

        // Вставка записи в таблицу custom_api_tokens
        $table_name = $wpdb->prefix . 'custom_api_tokens';

        // Генерация токена
        $token = get_random_string();

        $rezult = $wpdb->insert(
            $table_name,
            array(
                'order_id' => intval($order_id),
                'token' => $token,
                'created_at' => date("Y-m-d H:i:s"),
            ),
            array('%d', '%s', '%s')
        );

        // Проверяем результат и отправляем ответ
        if ($rezult == false) {
            return [
                'status' => false,
                'error' => 'have no results'
            ];
        }

        return [
            'status' => true,
            'token' => $token
        ];
    }

    return [
        'status' => false,
        'error' => 'No order object'
    ];
}


// Cоздание маршрута для сохранения результатов анкеты
add_action( 'rest_api_init', function(){
    // Пространство имен
    $namespace = 'myplugin/v1';

    // Маршрут
    $route = '/authors/(?P<id>\d+)';

    // Параметры конечной точки (маршрута)
    $route_params = [
        'methods'  => 'POST',
        'callback' => 'questionnaire_rezult',
        'permission_callback' => '__return_true',
        'args' => array(
            'token' => array(
                'required' => true,  // является ли параметр обязательным. Может быть только true
            )
        ),
    ];

    register_rest_route( $namespace, $route, $route_params );
} );

// Функция сохранения результатов анкеты 
function questionnaire_rezult( WP_REST_Request $request ) {
    global $wpdb;

    // Преобразование символов в html сущности
    $order_id = htmlspecialchars($request['id']);

    // Проверка строки на преобразование в число
    if ( !is_numeric($order_id) ) {
        return [
            'status' => false,
            'error' => 'order_id is not numeric'
        ];
    }

    // Проверка content_type
    $content_type = $request->get_content_type();
    if ($content_type['value'] != 'application/json') {
        return [
            'status' => false,
            'error' => 'content type is not application/json'
        ];
    }

    // Получение параметра token
    $token = $request->get_param('token');

    // Проверка параметра token
    if ( !$token ) {
        return [
            'status' => false,
            'error' => 'token is required'
        ];
    }

    // Получение записи из таблицы custom_api_tokens с условиями order_id и token
    $table_name = $wpdb->prefix . 'custom_api_tokens';

    $result_token = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE order_id = %d AND token = %s", $order_id, $token), ARRAY_A);

    // Проверка результатов
    if ( !$result_token ) {
        return [
            'status' => false,
            'error' => 'order_id and token not found in db'
        ];
    }

    // Удаление записи из таблицы custom_api_tokens с условиями order_id и token
    $wpdb->delete($table_name, ["order_id" => $order_id], ["%d"]);

    // Получение json из запроса
    $data = $request->get_json_params();

    // Вставка в таблицу
    $table_name = $wpdb->prefix . 'questionnaire_rezults';

    $rezult = $wpdb->insert(
        $table_name,
        array(
            'order_id' => $order_id,
            'firstname' => $data['customer']['firstname'],
            'secondname' => $data['customer']['secondname'],
            'lastname' => $data['customer']['lastname'],
            'email' => $data['customer']['email'],
            'phone' => $data['customer']['phone'],
            'checkboxes' => json_encode($data['checkboxes']),
            'rezults' => json_encode($data['rezults']),
            'created_at' => date("Y-m-d H:i:s"),
        ),
        array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    // Проверяем результат и отправляем ответ
    if ($rezult == false) {
        return [
            'status' => false,
            'error' => 'data not insert to db',
        ];
    }

    // Обновление счетчика количества загрузок товара. Увеличение на 1
    // Создание объекта WC_Customer_Download_Data_Store
    $WC_Customer_Download_Data_Store = new WC_Customer_Download_Data_Store();

    // Получение загрузок
    $cdds = $WC_Customer_Download_Data_Store->get_downloads( ['order_id' => $order_id] );
    
    // В массиве $cdds ключ [0] - первый и единственный товар в этом заказе
    $download_count = $cdds[0]['data']['download_count'];

    // Название таблицы
    $table_name = $wpdb->prefix . 'woocommerce_downloadable_product_permissions';

    // Обновление количества загрузок
    $result = $wpdb->update(
        $table_name,
        array('download_count' => intval($download_count) + 1), // Новое значение download_count bigint
        array('order_id' => $order_id), // Условие where для обновления bigint
        array('%d'), // Формат для download_count bigint
    );

    // Генерация купона
    $coupon_code = create_discount_coupon($data['customer']['email']);

    // Создание объекта заказа для замены старого номера заказа на новый
    // Документация https://misha.agency/woocommerce/wc_order.html
    $order = wc_get_order( $order_id );
    
    // Отправка email пользователю
    // Старый номер заказа
    // send_coupon_email($data['customer']['email'], $coupon_code, $data['rezults'], $order_id);

    // Новый номер заказа
    send_coupon_email($data['customer']['email'], $coupon_code, $data['rezults'], $order->get_order_number());

    // Отправка email админу
    // Старый номер заказа
    // send_coupon_email('info@naturapharma.ru', $coupon_code, $data['rezults'], $order_id);

    // Новый номер заказа
    send_coupon_email('info@naturapharma.ru', $coupon_code, $data['rezults'], $order->get_order_number());

    return ['status' => true];
}


// Добавление нового элемента меню для вывода результатов анкеты
/*
function view_personal_orders() {

    add_menu_page(
        'Персональный рецепт', // тайтл страницы
        'Рецепт', // текст ссылки в меню
        'manage_options', // права пользователя, необходимые для доступа к странице
        'personal-orders', // ярлык страницы
        'personal_orders_callback', // функция, которая выводит содержимое страницы
        'dashicons-images-alt2', // иконка, в данном случае из Dashicons
        98 // позиция в меню
    );
}

add_action( 'admin_menu', 'view_personal_orders', 25 );
*/

// Функция для вывода html и показа последних 50 рецептов в админке
/*
function personal_orders_callback() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'personal_orders';

    // Выполняем запрос для получения данных
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 50", ARRAY_A);

    echo '<div class="wrap"><h2>' . get_admin_page_title() . '</h2>';
    echo '<table class="wp-list-table widefat fixed striped table-view-list">';
    echo '<thead><tr><td width="80px">№</td><td>Имя</td><td>Файл</td></tr></thead>';
    echo '<tbody>';

    foreach($results as $value) {
        echo '<tr>';
        echo '<td>' . $value['order_id'] . '</td>';
        echo '<td class="title column-title has-row-actions column-primary page-title">' ;
        // echo '<strong><a href="#" class="row-title">' . $value['firstname'] . ' ' . $value['lastname'] . '</a></strong>';
        echo '<strong><a href="#" class="row-title">Имя111</a></strong>';
        echo '</td>';
        $created_at = strtotime($value['created_at']);
        echo '<td>' . date("d-m-Y", $created_at) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
*/


// Изменение заголовка на странице оформления заказа
add_filter( 'woocommerce_endpoint_order-received_title', 'title_custom_order_received_h1', 25 );
 
function title_custom_order_received_h1( $title ) {
 
    return "Спасибо за заказ! :)";
}


/* Изменение шаблонов Woocommerce */

// Изменение текста label для select вариации на странице Карточка товара
// Было "Таблетки по" стало "Выберите параметры"
// plugins/woocommerce/templates/single-product/add-to-cart/variable.php строка 38
// Документация https://wp-kama.ru/plugin/woocommerce/hook/woocommerce_attribute_label
function custom_attribute_label( $label, $name, $product ) {
    $label = __('Выберите параметры', 'woocommerce');
    return $label;
}
add_filter( 'woocommerce_attribute_label', 'custom_attribute_label', 10, 3 );


// Добавление количества товаров в корзине
function action_woocommerce_review_order_before_shipping() {
    $tr = '<tr class="cart-subtotal">';
    $tr .= '<th>Всего товаров</th>';
    $tr .= '<td data-title="Всего товаров:">';
    $tr .= WC()->cart->get_cart_contents_count();
    $tr .= '</td>';
    $tr .= '</tr>';
    echo $tr;
}

add_action( 'woocommerce_cart_totals_before_shipping', 'action_woocommerce_review_order_before_shipping' );


// Добавление текста о бесплатной доставке в корзине
function action_woocommerce_review_order_after_shipping() {
    $tr = '<tr class="cart-subtotal">';
    $tr .= '<th>Стоимость доставки</th>';
    $tr .= '<td data-title="Стоимость доставки:">Доставка от 7000 бесплатно до пункта выдачи</td>';
    $tr .= '</tr>';
    echo $tr;
}

add_action( 'woocommerce_cart_totals_after_shipping', 'action_woocommerce_review_order_after_shipping' );


/** Отключение полей woocommerce_checkout_shipping  **/
function wc_remove_checkout_fields( $fields ) {
    if (is_checkout()) {

        // Billing fields
        unset( $fields['billing']['billing_address_2'] );

        // Shipping fields
        unset( $fields['shipping']);
        unset( $fields['shipping']['shipping_company'] );
        unset( $fields['shipping']['shipping_country'] );
        unset( $fields['shipping']['shipping_phone'] );
        unset( $fields['shipping']['shipping_state'] );
        unset( $fields['shipping']['shipping_first_name'] );
        unset( $fields['shipping']['shipping_last_name'] );
        unset( $fields['shipping']['shipping_address_1'] );
        unset( $fields['shipping']['shipping_address_2'] );
        unset( $fields['shipping']['shipping_city'] );
        unset( $fields['shipping']['shipping_postcode'] );

        // Order fields
        unset( $fields['order']['order_comments'] );

        return $fields;
    }
}
add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' );

add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false');


// Добавление заголовка Ваш заказ
add_action( 'woocommerce_checkout_order_review', 'woo_order_review_heading', 5 );

function woo_order_review_heading() {
  echo '<h3 id="custom-order-review-heading" class="order_review_heading">' . __('Ваш заказ') . '</h2>';
}


// add_action('woocommerce_checkout_terms_and_conditions', 'disable_woocommerce_checkout_options', 10 );
function disable_woocommerce_checkout_options(){
    if ( empty( $available_gateways ) ) {
            remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );
            remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
        }
}


// add_action( 'woocommerce_review_order_before_submit', 'custom_terms_and_conditions_checkbox_text' );
function custom_terms_and_conditions_checkbox_text(){
    $text = '<p class="form-row validate-required agreement-text">
                <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox custom-checkbox js-required-checkbox" name="terms" id="terms" onchange="document.getElementById(\'place_order\').disabled = !this.checked;" checked>
                <label for="terms" class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox custom-checkbox-label"></label>
                <span class="woocommerce-terms-and-conditions-checkbox-text">Я прочитал(а) и принимаю <a href="/politika-v-otnoshenii-obrabotki-personalnyh-dannyh/" target="_blank">правила и условия</a> сайта</span>&nbsp;<span class="required">*</span>
                </span>
            </p>';
    echo $text;
}


// Добавление обертки woocommerce_single_product_wrapper
add_action( 'woocommerce_before_single_product_summary', 'wp_kama_woocommerce_before_single_product_summary_action' );

/**
 * Function for `woocommerce_before_single_product_summary` action-hook.
 * 
 * @return void
 */
function wp_kama_woocommerce_before_single_product_summary_action() {
    echo '<div class="woocommerce_single_product_wrapper">';
}

function product_summary() {
    echo '</div>';
}

add_action( 'woocommerce_after_single_product_summary', 'product_summary', 5);


// Privacy policy checkbox checked default
add_filter( 'woocommerce_terms_is_checked_default', '__return_true' );


// Изменение порядка в карточке товара
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 ); // Удаление

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
// add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
// add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

// Добавление Прайс и Добавить в корзину для товаров из всех категорий, кроме Обучение
function woocommerce_summary_after_title() {

    $obuchenie_cat_id = 444; // ID категории Обучение

    $product_id = get_the_ID(); // Получаем ID текущего товара
    $categories = get_the_terms( $product_id, 'product_cat' ); // Получаем категории товара

    foreach ($categories as $cat) {
        if ($cat->term_id != $obuchenie_cat_id) {
            woocommerce_template_single_price();
            woocommerce_template_single_add_to_cart();
        }
    }
}

add_action( 'woocommerce_single_product_summary', 'woocommerce_summary_after_title', 20 );


// Добавление дополнительнго текстового поля в карточку товара
function art_woo_add_custom_fields() {
    global $product, $post;
    echo '<div class="options_group">';// Группировка полей 
    
    woocommerce_wp_text_input( array(
       'id'                => '_text_field',
       'label'             => __( 'Ссылка', 'woocommerce' ),
       'placeholder'       => 'Ссылка',
       //'custom_attributes' => array( 'required' => 'required' ),
       'description'       => __( 'Введите ссылку', 'woocommerce' ),
    ) );

    echo '</div>';
}

add_action( 'woocommerce_product_options_general_product_data', 'art_woo_add_custom_fields' );


/**
 * Сохранение данных произвольльных полей методами ядра
 *
 * @source https://wpruse.ru/woocommerce/custom-fields-in-products/
 */
function art_woo_custom_fields_save( $post_id ) {

    // Сохранение текстового поля.
    $woocommerce_text_field = $_POST['_text_field'];
    if ( ! empty( $woocommerce_text_field ) ) {
        update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_text_field ) );
    } else {
        // Иначе удаляем созданное поле из бд
        delete_post_meta( $post_id, '_text_field' );
    }
}

add_action( 'woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10 );

// Вывод текстового поля после названия товара
function art_get_text_field_before_add_card() {

    $product = wc_get_product();
    $text_field = $product->get_meta( '_text_field', true );

    if ($text_field) {
        echo "<a href='" . $text_field . "' id='to-page-btn' class='to-page-btn primary-btn' target='_blank'>Перейти на страницу</a>";
    }

}

add_action( 'woocommerce_share', 'art_get_text_field_before_add_card' );

// Добавление ссылки в письмо при оформлении заказа 
function add_content_after_order_table( $order, $sent_to_admin, $plain_text, $email ) {
    // $email->id == 'customer_processing_order' шаблон 'Заказ в обработке'
    // $email->id == 'customer_completed_order' шаблон 'Выполненный заказ'
    if ( $email->id == 'customer_processing_order' || $email->id == 'customer_completed_order' ) {

        $rand = mt_rand(1, 38);

        // url сайта
        $site_url = get_site_url();
        
        echo '<strong><a href="'. $site_url .'/wp-content/themes/store-child/includes/pdf/email/'. $rand . '.pdf' .'" download><b>Скачать Мандалу</b></a><strong><p></p><br>';

        echo 'Приглашаем Вас поработать с цветом и своим внутренним состоянием.<br>
        В прикрепленном файле Вы найдете Мандалу определенной цветочной эссенции Баха. Мандалы отправляются рандомно, но в этом мире нет ничего случайного. Вы можете внимательно изучить описание эссенции (<a href="https://natura-pharma.ru/catalog/product-category/series/czvety-baha/" target="_blank">раздел «Эссенции цветов Баха» на сайте Аптеки</a>) и попробовать найти это состояние в себе.<br>
        Мандалы созданы и предоставлены флоротерапевтом, врачом натуропатом <a href="https://natura-pharma.ru/aoki-albina-sharifullovna/" target="_blank">Альбиной Аоки</a>. Они позволяют погрузиться в совершенное единение со своей душой и успокоить разум, немного отдохнуть и перезагрузиться.<br>
        Данные Мандалы представляют собой симметричные фигуры с определенной последовательностью цвета, в каждой из которых зашифровано слово, переведенное в цифры благодаря последовательности чисел Фибоначчи. Они помогают поддерживать состояние медитации и концентрации в зависимости от случая.<br>
        Вы можете распечатать Мандалу, взять в руки цветные карандаши и погрузиться в мир творчества и энергии.<br>
        Рандомные Мандалы не предназначены для диагностики и лечения. Но у Вас всегда есть возможность обратиться к специалисту (<a href="https://natura-pharma.ru/specialisty/" target="_blank">раздел «Специалисты» на сайте Аптеки</a>) и заказать цветочные эссенции Баха.<br>
        Приятного Вам путешествия в свой внутренний мир.<p></p><br>';
    }
}

add_action( 'woocommerce_email_after_order_table', 'add_content_after_order_table', 20, 4 );


// Скрывание поля Адрес
// Hide Local Pickup shipping method
add_filter( 'woocommerce_checkout_fields', 'hide_local_pickup_method' );
function hide_local_pickup_method( $fields_pickup ) {
    // change below for the method
    $shipping_method_pickup ='local_pickup:7';
    // change below for the list of fields. Add (or delete) the field name you want (or don’t want) to use
    $hide_fields_pickup = array( 'billing_country', 'billing_postcode', 'billing_address_1', 'billing_address_2' , 'billing_state');
 
    $chosen_methods_pickup = WC()->session->get( 'chosen_shipping_methods' );
    $chosen_shipping_pickup = $chosen_methods_pickup[0];
 
    foreach($hide_fields_pickup as $field_pickup ) {
        if ($chosen_shipping_pickup == $shipping_method_pickup) {
            $fields_pickup['billing'][$field_pickup]['required'] = false;
            $fields_pickup['billing'][$field_pickup]['class'][] = 'hide_pickup';
        }
        $fields_pickup['billing'][$field_pickup]['class'][] = 'billing-dynamic_pickup';
    }
    return $fields_pickup;
}
// Local Pickup - hide fields
add_action( 'wp_head', 'local_pickup_fields', 999 );
function local_pickup_fields() {
    if (is_checkout()) :
    ?>
    <style>
        .hide_pickup {display: none!important;}
    </style>
    <script>
        jQuery( function( $ ) {
            if ( typeof woocommerce_params === 'undefined' ) {
                return false;
            }
            $(document).on( 'change', '#shipping_method input[type="radio"]', function() {
                // change local_pickup:4 accordingly
            $('.billing-dynamic_pickup').toggleClass('hide_pickup', this.value == 'local_pickup:7');
            });
        });
    </script>
    <?php
    endif;
}


// Изменение значения в "Номер" при формировании XML по заказам
\add_filter('itglx_wc1c_xml_order_info_custom', function (array $mainOrderData, int $orderId, \WC_Order $order) {
    $mainOrderData['Номер'] = $order->get_order_number();

    return $mainOrderData;
}, 10, 3);

// коды купонов заказа в реквизите
\add_filter('itglx_wc1c_order_xml_requisites_data_array', function (array $requisites, \WC_Order $order) {
    if (empty($order->get_coupon_codes())) {
        return $requisites;
    }

    $requisites['Код купона'] = implode(', ', $order->get_coupon_codes());

    return $requisites;
}, 10, 2);


// Отключение колонки Действия в личном кабинете Заказы
function unset_account_order_actions_column( $columns ) {

    unset($columns['order-actions']);

    return $columns;
}
add_filter( 'woocommerce_account_orders_columns', 'unset_account_order_actions_column', 10, 1 );


// Накопительная скидка

/**
 * Добавление накопительной скидки в итоговую сумму в корзине
 * @param WC_Cart
 */
function calc_discount_total(WC_Cart $cart) {

    // Если пользователь не авторизован, то ничего не делаю
    if ( !is_user_logged_in() ) {
        return;
    }

    // Для специалистов суммируются 2 скидки: специалист 15% и накопительная
    // Для розничных покупателей только накопительная скидка
    // Специалист это пользователь с ролью Клиент у которого в поле Биография слово "Специалист"
    $user = wp_get_current_user();

    $description = get_the_author_meta('description', $user->ID);

    if ($description == 'Специалист') { // скидки для специалистов

        // Фиксированная скидка для специалистов 15%
        $discount = $cart->subtotal * 0.15; 
        $cart->add_fee("Специалист 15%", -$discount);

        $customer_total_spent = wc_get_customer_total_spent( get_current_user_id() );

        $customer_discount = 0;

        // Накопительная скидка для специалистов
        if ($customer_total_spent >= 50000 && $customer_total_spent < 100000) {
            $customer_discount = 3;
        } elseif ($customer_total_spent >= 100000 && $customer_total_spent < 150000) {
            $customer_discount = 5;
        } elseif ($customer_total_spent >= 150000 && $customer_total_spent < 300000) {
            $customer_discount = 7;
        }

        if ($customer_discount > 0) {
            $discount = $cart->subtotal * $customer_discount / 100;
            $cart->add_fee('Накопительная скидка ' . $customer_discount . "%", -$discount);
        } else {
            return;
        }

    } else { // скидки для розничных покупателей

        $customer_total_spent = wc_get_customer_total_spent( get_current_user_id() );

        $customer_discount = 0;

        // Накопительная скидка для розничных покупателей
        if ($customer_total_spent >= 10000 && $customer_total_spent < 25000) {
            $customer_discount = 2;
        } elseif ($customer_total_spent >= 25000 && $customer_total_spent < 40000) {
            $customer_discount = 3;
        } elseif ($customer_total_spent >= 40000 && $customer_total_spent < 55000) {
            $customer_discount = 4;
        } elseif ($customer_total_spent >= 55000 && $customer_total_spent < 60000) {
            $customer_discount = 5;
        } elseif ($customer_total_spent >= 60000) {
            $customer_discount = 6;
        }

        if ($customer_discount > 0) {
            $discount = $cart->subtotal * $customer_discount / 100;
            $cart->add_fee('Накопительная скидка ' . $customer_discount . "%", -$discount);
        } else {
            return;
        }
    }
}

add_action('woocommerce_cart_calculate_fees' , 'calc_discount_total');

// change woocommerce thumbnail image size
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'override_woocommerce_image_size_gallery_thumbnail' );
function override_woocommerce_image_size_gallery_thumbnail( $size ) {
    // Gallery thumbnails: proportional, max width 200px
    return array(
        'width'  => 300,
        'height' => 300,
        'crop'   => 0,
    );
}


# Закрывает все маршруты REST API от публичного доступа
add_filter( 'rest_authentication_errors', function( $result ){

    if( is_null( $result ) && ! current_user_can('edit_others_posts') ){
        return new WP_Error( 'rest_forbidden', 'You are not currently logged in.', [ 'status'=>401 ] );
    }

    return $result;
} );

// Disable authors archive
// Return a 404 page for author pages if accessed directly.
add_action( 'template_redirect', function () {
    if ( is_author() ) {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        nocache_headers();
    }
} );

// Remove the author links.
add_filter( 'author_link', '__return_empty_string', 1000 );
add_filter( 'the_author_posts_link', 'get_the_author', 1000, 0 );
// Remove the author pages from the WP 5.5+ sitemap.
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
    if ( 'users' === $name ) {
        return false;
    }
    return $provider;
}, 10, 2 );

// Remove admin links in the list of users.
add_filter( 'user_row_actions', function ( $actions, $user ) {
    unset( $actions['view'] );
    unset( $actions['posts'] );
    return $actions;
}, 10, 2 );

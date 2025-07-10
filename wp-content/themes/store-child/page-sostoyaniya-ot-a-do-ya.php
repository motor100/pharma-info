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
  
<div class="sostoyaniya-ot-a-do-ya-page custom-page">
  <div class="container">
    <div class="page-title">Состояния от А до Я</div>
  </div>

  <div class="container">
    <?php echo get_posts_per_letter(); ?>
  </div>
</div>

<?php get_footer(); ?>
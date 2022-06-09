<?php

/**
 * トップページ
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
  exit;
}
get_header();
?>

<div class="top-kv">

</div>

<?php
$list_count = 3;
$sticky = get_option('sticky_posts');
if (!empty($sticky)) $list_count -= count($sticky);
$arg = array(
  'posts_per_page' =>  $list_count,
  'orderby' => 'date',
  'order' => 'DESC'
);
$recentPosts = new WP_Query($arg);
if ($recentPosts->have_posts()) :  ?>
  <section class="section-news">
    <div class="container-lg section-news__container">
      <div class="section-news__left">
        <div class="section-news__title section-title">
          <p class="section-title__en">
            News
          </p>
          <h2 class="section-title__ja">新着情報</h2>
        </div>
        <div class="section-news__btn">
          <a href="<?php echo get_permalink(get_page_by_path('news')->ID); ?>" class="btn--outline btn--en">
            <span class="btn__text">View All</span>
            <span class="link-arrow link-arrow--sm"></span>
          </a>
        </div>
      </div>
      <div class="section-news__right">
        <ul class="list-news">
          <?php if ($recentPosts->have_posts()) :
            while ($recentPosts->have_posts()) :
              $recentPosts->the_post();
              get_template_part('parts/news', 'list');
            endwhile;
            wp_reset_query();
          endif;
          ?>
        </ul>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(null, array("class" => "light")); ?>
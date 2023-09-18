<?php

/**
 * シンプルカード
 *
 * @package WordPress
 *
 *
 *
 */

// 呼び出し元
//  get_template_part('components/card/workCard', "",
//  array(
//    "image" => "***",
//    "title" => "***",
//    "text" => "***"
//  )
// );


if (!defined('ABSPATH')) {
  exit;
}
$args = wp_parse_args(
  $args,
  array(
    'property'     => '',
  )
);
$title = get_the_title();
$post_cats = array();
$post_category = get_the_terms($post->ID, 'works_category');
if (!empty($post_category)) {
  foreach ($post_category as $term) {
    $post_cats[] = $term->name;
  }
}
?>

<a href="<?php the_permalink(); ?>" class="works-card<?php echo $args["property"]; ?>">
  <div class="works-card__image">
    <img src="<?php echo my_get_thumbs($post->ID, false, 'large'); ?>" alt="<?php the_title(); ?>">
  </div>
  <div class="works-card__main">
    <p class="works-card__title">
      <?php echo $title; ?>
    </p>
    <ul class="works-card__cats">
      <?php foreach ($post_cats as $work_cat) : ?>
      <li><?php echo  $work_cat; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</a>
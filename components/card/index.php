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
//  get_template_part('components/card/index', "",
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
    'image'     => '',
    'title'     => '',
    'text'     => '',
    'url' => '',
  )
);

$rootTag = $args["url"] ? "a" : "div";
$permalink = $args["url"] ? "href='" . $args["url"] . "'" : "";

?>

<<?php echo $rootTag; ?> <?php echo $permalink; ?> class="card">
  <p class="card__image">
    <?php echo $args["image"]; ?>
  </p>
  <div class="card__main">
    <p class="card__title">
      <span><?php echo $args["title"]; ?></span>
      <?php if ($args["url"]) : ?>
        <span class="link-arrow"></span>
      <?php endif; ?>
    </p>
    <?php if ($args["text"]) : ?>
      <div class="card__text">
        <p>
          <?php echo $args["text"]; ?>
        </p>
      </div>
    <?php endif; ?>
  </div>
</<?php echo $rootTag; ?>>
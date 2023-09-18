<?php

/**
 * ドロップダウンアイテム
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
  exit;
}

$args = wp_parse_args(
  $args,
  array(
    'url'     => '',
    'image'     => '',
    'text'     => '',
    'hash'     => '',
  )
);


?>
<li class="dropdown-list__item">
  <a href="<?php echo $args["url"]; ?><?php if ($args["hash"]) echo "#" . $args["hash"]; ?>" class=" dropdown-list__linkArea">
    <?php if ($args["image"]) : ?>
      <div class="dropdown-list__image">
        <div class="dropdown-list__image-inner">
          <?php echo $args["image"]; ?>
        </div>
      </div>
    <?php endif; ?>
    <p class="dropdown-list__text"><span><?php echo $args["text"]; ?></span><span class="link-arrow"></span></p>
  </a>
</li>
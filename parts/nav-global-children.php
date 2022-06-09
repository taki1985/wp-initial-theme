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
    'slug'     => '',
    'thumb'     => '',
    'text'     => '',
  )
);

?>
<li class="dropdown-nav__item">
  <a href="<?php echo get_permalink(get_page_by_path($args["slug"])->ID); ?>" class="dropdown-nav__linkarea">
    <div class="dropdown-nav__thumb">
      <figure class="dropdown-nav__thumb-inner"><img src="<?php echo IMG_URI; ?>/common/img-<?php echo $args["thumb"]; ?>.jpg" alt=""></figure>
    </div>
    <p class="dropdown-nav__text"><?php echo $args["text"]; ?><span class="link-arrow link-arrow--red link-arrow--md"></span></p>
  </a>
</li>
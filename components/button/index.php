<?php
if (!defined('ABSPATH')) {
  exit;
}


$args = wp_parse_args(
  $args,
  array(
    'url'     => '',
    'text'     => 'View More',
    'property'     => '',
    "icon" => "",
    'target'     => '',
  )
);

?>
<a href="<?php echo $args["url"]; ?>" class="btn<?php echo $args["property"]; ?>" <?php if ($args["target"]) echo "target='" . $args['target'] . "'"; ?> <?php if ($args["target"] == "_blank") echo "rel='noopener'"; ?>>
  <span class="btn__text">
    <?php echo $args["text"]; ?>
  </span>
  <?php if ($args["icon"]) : ?>
    <span class="btn__icon">
      <svg width="24" height="24">
        <use xlink:href="#pdf"></use>
      </svg>
    </span>
  <?php else : ?>
    <span class="link-arrow--white"></span>
  <?php endif; ?>
</a>
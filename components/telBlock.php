<?php
if (!defined('ABSPATH')) {
  exit;
}
$args = wp_parse_args(
  $args,
  array(
    'property' => "",
  )
);
?>
<div class="tel-block<?php echo $args["property"]; ?>">
  <div class="tel-block__icon">
    <svg width="24" height="24">
      <use xlink:href="#phone"></use>
    </svg>
  </div>
  <div class="tel-block__number">
    <span data-action="call">042-531-4356</span>
  </div>
</div>
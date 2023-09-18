<?php
if (!defined('ABSPATH')) {
  exit;
}
$args = wp_parse_args(
  $args,
  array(
    'taxonomies'     => array(),
    "post_type" => "",
    "is_side" => false,
  )
);
?>
<?php
foreach ($args["taxonomies"] as $my_tax) :
?>
<div class="child-block--sm">
  <div class="dropdown-cats<?php if ($args["is_side"]) echo "--side"; ?> js-openToggle">
    <p class="dropdown-cats__title js-openToggleTitle">
        <span><?php echo $my_tax["title"] ?></span><span class="dropdown-cats__icon"></span>
      </p>
    <div class="dropdown-cats__list js-openToggleList">
      <ul class="cats-list">
        <li <?php if (is_page("blog") ||  is_home() || is_post_type_archive($args["post_type"])) echo 'class="current-cat"'; ?>>
          <a href="<?php echo get_post_type_archive_link($args["post_type"]); ?>">すべて</a>
        </li>
        <?php
          $tax_slug = $my_tax["taxonomy"];
          $terms = get_terms(array(
            'taxonomy' => $tax_slug,
            'hide_empty' => false,
          ));
          if ($terms) {
            foreach ($terms as $term) {
              $classes = array();
              if (is_tax($tax_slug, $term->slug)) {
                $classes[] = 'current-cat';
              }
              if (is_category($term->slug)) {
                $classes[] = 'current-cat';
              }
              $class_names = implode(' ', $classes);
              echo '<li class="' . $class_names . '"><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
            }
          }
          ?>
      </ul>
    </div>
  </div>
</div>
<?php endforeach; ?>
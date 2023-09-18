<?php

/**
 * お知らせリスト
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
  exit;
}

$is_text = get_post_meta($post->ID, 'is_text', true);
$permalink = get_post_meta($post->ID, 'url', true);
$is_pdf = (!$is_text && $permalink) ? preg_match('/.pdf$/', $permalink) : null;
$is_external = false;
if (!$is_text && $permalink && false === strpos($permalink, home_url())) $is_external = true;
$permalink = isset($permalink) ? $permalink : get_the_permalink();
$rootTag = $is_text ? "a" : "div";
?>

<<?php echo $rootTag; ?> class="newsSummary" <?php if ($is_external || $is_pdf) echo 'target="_blank" rel="noopener"'; ?>>

  <?php if (has_post_thumbnail()) : ?>
  <div class="newsSummary__image">
    <?php the_post_thumbnail("large"); ?>
  </div>
  <?php endif; ?>
  <div class="newsSummary__main">
    <div class="newsSummary__meta">
      <?php
      $days = 7;
      $today = date_i18n('U');
      $entry_day = get_the_time('U');
      $keika = date('U', ($today - $entry_day)) / 86400;
      if ($days > $keika) :
        echo '<div class="newsSummary__new">New</div>';
      endif;
      ?>
      <div class="newsSummary__time"><?php the_time('Y.m.d'); ?></div>
      <div class="newsSummary__cats">
        <?php
        $categories = get_the_category();
        foreach ($categories as $category) :
        ?>
        <span class="newsSummary__cat">
          <?php echo $category->cat_name; ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="newsSummary__text">
      <?php the_title(); ?>
    </div>
  </div>


  <?php if ($is_pdf) : ?>
  <span class="newsSummary__icon">
    <svg width="24" height="24">
        <use xlink:href="#pdf"></use>
      </svg>
  </span>
  <?php elseif ($is_external) : ?>
  <span class="newsSummary__icon">
    <svg width="24" height="24">
        <use xlink:href="#external"></use>
      </svg>
  </span>
  <?php elseif (!$is_text) : ?>
  <span class="link-arrow"></span>
  <?php endif; ?>
</<?php echo $rootTag; ?>>
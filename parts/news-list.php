<?php

/**
 * お知らせリスト
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
  exit;
}

$is_txt = get_post_meta($post->ID, 'is_txt', true);
$permalink = get_post_meta($post->ID, 'url', true);
$is_pdf = ($permalink) ? preg_match('/.pdf$/', $permalink) : null;
$is_external = false;
?>
<li class="list-news__item">
  <?php if ($is_txt) : //記事詳細なし
  ?>
    <div class="list-news__content">

    <?php elseif ($permalink) : //投稿以外のリンクあり

    if (false === strpos($permalink, home_url())) $is_external = true;
    ?>
      <a href="<?php echo $permalink; ?>" class="list-news__content<?php if ($is_pdf) echo ' icon-pdf'; ?><?php if ($is_external) echo ' icon-external'; ?>" <?php if ($is_external || $is_pdf) echo 'target="_blank"'; ?>>

      <?php else : //通常の投稿
      ?>
        <a href="<?php the_permalink() ?>" class="list-news__content">
        <?php endif; ?>

        <?php if (has_post_thumbnail()) : ?>
          <div class="list-news__thumb">
            <?php the_post_thumbnail("large"); ?>
          </div>
        <?php endif; ?>
        <div class="list-news__main">
          <div class="list-news__meta">
            <?php
            $days = 7;
            $today = date_i18n('U');
            $entry_day = get_the_time('U');
            $keika = date('U', ($today - $entry_day)) / 86400;
            if ($days > $keika) :
              echo '<div class="list-news__new">New</div>';
            endif;
            ?>
            <div class="list-news__time"><?php the_time('Y.m.d'); ?></div>
            <div class="list-news__cats">
              <?php
              $categories = get_the_category();
              foreach ($categories as $category) :
              ?>
                <span class="list-news__cat">
                  <?php echo $category->cat_name; ?>
                </span>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="list-news__txt">
            <?php the_title(); ?>
          </div>
        </div>

        <?php if ($is_txt) : //記事詳細なし
        ?>
    </div>
  <?php else : //投稿などへのリンクあり
  ?>
    <span class="link-arrow link-arrow--light link-arrow--xs"></span>
    </a>
  <?php endif; ?>
</li>
<?php

/**
 * ヘッダーパーツ
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
  exit;
}

$args = wp_parse_args(
  $args,
  array(
    'class'          => '',
  )
);

?>

<header id="header" class="header">
  <?php $tag = (is_front_page()) ? 'h1' : 'div'; ?>
  <<?php echo $tag; ?> class="header__logo">
    <a href="<?php echo home_url(); ?>" class="header-logo">
      <?php bloginfo('name'); ?>
    </a>
  </<?php echo $tag; ?>>

  <button type="button" class="drawer-btn js-drawerBtn" aria-controls="drawer" aria-expanded="false">
    <span class="drawer-btn__bars">
      <span class="drawer-btn__bar"></span>
      <span class="drawer-btn__bar"></span>
      <span class="drawer-btn__bar"></span>
    </span>
    <span class="drawer-btn__text--open">
      Menu
    </span>
    <span class="drawer-btn__text--close">
      Close
    </span>
  </button>

  <div id="drawer" class="js-drawer drawer" aria-hidden="true">
    <div class="drawer__backdrop js-drawerBackdrop"></div>
    <div class="drawer__inner">
      <nav class="global-nav">
        <div class="global-nav__list">
          <ul class="global-list js-dropdownRoot">
            <li class="global-list__item visible-xs visible-sm">
              <a href="<?php echo home_url(); ?>" class="global-list__text" <?php if (is_front_page()) echo "data-isCurrent='true'"; ?>>
                トップページ
              </a>
            </li>
            <li class="global-list__item--dropdown js-dropdownItem">
              <span class="global-list__text js-dropdownBtn" <?php if (is_page("company") || my_is_ancestor('company')) echo "data-isCurrent='true'" ?>>
                会社情報
              </span>
              <div class="dropdown-menu js-dropdownMenu" aria-hidden="true">
                <div class="dropdown-menu__container">
                  <div class="dropdown-menu__header">
                    <div class="dropdown-menu__title">
                      <div class="dropdown-title">
                        <p class="dropdown-title__en">Company</p>
                        <p class="dropdown-title__ja">会社情報</p>
                      </div>
                    </div>
                    <a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>" class="dropdown-menu__btn">View More<span class="link-arrow"></span></a>
                  </div>
                  <div class="dropdown-menu__main">
                    <ul class="dropdown-list">
                      <?php
                      $children = [
                        array(
                          'url'     => get_permalink(get_page_by_path('company/about')->ID),
                          'text'     => "会社概要",
                          'image' => my_get_img_tag("common/img-company-about_sm.jpg", "会社概要")
                        ),
                        array(
                          'url'     => get_permalink(get_page_by_path('company/history')->ID),
                          'text'     => "会社沿革",
                          'image' => my_get_img_tag("common/img-company-history_sm.jpg", "会社沿革")
                        ),
                      ];
                      foreach ($children as $child) {
                        $args = array(
                          'url' => $child["url"],
                          'text' => $child["text"],
                          'image' => $child["image"],
                        );
                        get_template_part('components/nav/children', '', $args);
                      }
                      ?>
                    </ul>
                  </div>
                </div>
            </li>

            <li class="global-list__item">
              <a href="<?php echo get_post_type_archive_link('work'); ?>" class="global-list__text" <?php if (is_post_type_archive('work')) echo "data-isCurrent='true'" ?>>
                実績紹介
              </a>
            </li>

            <li class="global-list__item">
              <a href="<?php echo get_permalink(get_page_by_path('news')->ID); ?>" class="global-list__text" <?php if (is_page("news") || is_home() || is_singular('post') || is_category()) echo "data-isCurrent='true'"; ?>>
                お知らせ
              </a>
            </li>

            <li class="global-list__item--btn">
              <a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>" class="global-list-btn" <?php if (is_page("contact") || my_is_ancestor('contact')) echo "data-isCurrent='true'" ?>>
                <span class="global-list-btn__icon">
                  <svg width="24" height="24">
                    <use xlink:href="#mail"></use>
                  </svg>
                </span>
                <span class="global-list-btn__text">お問い合わせ</span>
              </a>
            </li>

          </ul>
        </div>
      </nav>
    </div>
  </div>

</header>

<main class="main">
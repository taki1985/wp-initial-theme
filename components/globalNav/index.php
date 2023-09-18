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
    'property'          => '',
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

            <li class="global-list__item">
              <a href="<?php echo get_permalink(get_page_by_path('about')->ID); ?>" class="global-list__text" <?php if (is_page("about")) echo "data-isCurrent='true'" ?>>
                <span class="global-list__lg">光翔について</span>
                <span class="global-list__sm"><span>About</span></span>
              </a>
            </li>

            <li class="global-list__item">
              <a href="<?php echo get_permalink(get_page_by_path('flow')->ID); ?>" class="global-list__text" <?php if (is_page("flow")) echo "data-isCurrent='true'" ?>>
                <span class="global-list__lg">ご利用の流れ</span>
                <span class="global-list__sm"><span>Flow</span></span>
              </a>
            </li>

            <li class="global-list__item">
              <a href="<?php echo get_permalink(get_page_by_path('service')->ID); ?>" class="global-list__text" <?php if (is_page("service")) echo "data-isCurrent='true'" ?>>
                <span class="global-list__lg">業務内容</span>
                <span class="global-list__sm"><span>Service</span></span>
              </a>
            </li>


            <li class="global-list__item">
              <a href="<?php echo get_post_type_archive_link('works'); ?>" class="global-list__text" <?php if (is_post_type_archive('works')) echo "data-isCurrent='true'" ?>>
                <span class="global-list__lg">施工事例</span>
                <span class="global-list__sm"><span>Works</span></span>
              </a>
            </li>

            <li class="global-list__item">
              <a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>" class="global-list__text" <?php if (is_page("company")) echo "data-isCurrent='true'" ?>>
                <span class="global-list__lg">会社案内</span>
                <span class="global-list__sm"><span>Company</span></span>
              </a>
            </li>

            <li class="global-list__item">
              <a href="<?php echo get_permalink(get_page_by_path('staf')->ID); ?>" class="global-list__text" <?php if (is_page("staf")) echo "data-isCurrent='true'" ?>>
                <span class="global-list__lg">スタッフ紹介</span>
                <span class="global-list__sm"><span>Staff</span></span>
              </a>
            </li>

            <li class="global-list__item">
              <a href="<?php echo get_permalink(get_page_by_path('blog')->ID); ?>" class="global-list__text" <?php if (is_page("blog") || is_home() || is_singular('blog') || is_category()) echo "data-isCurrent='true'"; ?>>
                <span class="global-list__lg">ブログ</span>
                <span class="global-list__sm"><span>Blog</span></span>
              </a>
            </li>

          </ul>
        </div>

        <div class="global-nav__sub">
          <div class="global-sub">
            <div class="global-sub__tel">
              <?php get_template_part('components/telBlock'); ?>
            </div>
            <div class="global-sub__btn">
              <a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>" class="global-subBtn">
                <span class="global-subBtn__icon">
                  <svg width="24" height="24">
                    <use xlink:href="#contact"></use>
                  </svg>
                </span>
                <span class="global-subBtn__text">
                  無料見積り・お問い合わせ
                </span>
              </a>
            </div>
          </div>
        </div>

      </nav>
    </div>
  </div>

</header>

<main class="page-wrapper__main">
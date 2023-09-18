<?php

/**
 * トップページ
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
  exit;
}
get_header();
?>


<div id="topKv" class="top-kv">
  <div class="top-kv__slider">
    <div id="kvSlider" class="kv-slider swiper">
      <ul class="kv-slider__list swiper-wrapper">
        <li class='kv-slider__item swiper-slide'><?php echo my_get_img_tag("top/mv-01.jpg", bloginfo('name')); ?></li>
        <li class='kv-slider__item swiper-slide'><?php echo my_get_img_tag("top/mv-02.jpg", bloginfo('name')); ?></li>
        <li class='kv-slider__item swiper-slide'><?php echo my_get_img_tag("top/mv-03.jpg", bloginfo('name')); ?></li>
        <li class='kv-slider__item swiper-slide'><?php echo my_get_img_tag("top/mv-03.jpg", bloginfo('name')); ?></li>
        <li class='kv-slider__item swiper-slide'><?php echo my_get_img_tag("top/mv-03.jpg", bloginfo('name')); ?></li>
      </ul>
      <div class="kv-slider__pagination"></div>
    </div>
  </div>
  <div class="top-kv__container">
    <div class="top-kv__main">
      <div class="top-kv__lg">
        <p>安心・信頼の<strong>解体サービス</strong></p>
        <p><strong>プロの技術</strong>でお任せください</p>
      </div>
      <ul class="top-kv__pointList">
        <li>
          <div class="top-kv-point">
            <div class="top-kv-point__lead">
              <span class="top-kv-point__deco"><img src="<?php echo IMG_URI; ?>/top/deco.svg" alt=""></span>
              <span class="top-kv-point__lead-inner">スピード対応</span>
            </div>
            <p class="top-kv-point__text">
              現地調査最短当日 <br class="hidden-xs hidden-sm">お見積り現地調査翌日
            </p>
          </div>
        </li>
        <li>
          <div class="top-kv-point">
            <div class="top-kv-point__lead">
              <span class="top-kv-point__deco"><img src="<?php echo IMG_URI; ?>/top/deco.svg" alt=""></span>
              <span class="top-kv-point__lead-inner">低価格で安心安全</span>
            </div>
            <p class="top-kv-point__text">
              自社スタッフ+自社一貫施工 <br class="hidden-xs hidden-sm">だから安くて安心
            </p>
          </div>
        </li>
        <li>
          <div class="top-kv-point">
            <div class="top-kv-point__lead">
              <span class="top-kv-point__deco"><img src="<?php echo IMG_URI; ?>/top/deco.svg" alt=""></span>
              <span class="top-kv-point__lead-inner">キレイな解体</span>
            </div>
            <p class="top-kv-point__text">
              解体中も仕上がりも<br class="hidden-xs hidden-sm">キレイにこだわり
            </p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

<?php
$worksPosts = new WP_Query(array('post_type' => 'works', 'posts_per_page' => 6));
if ($worksPosts->have_posts()) : ?>

<section class="top-works">
  <p class="top-works__illust">
      <?php echo my_get_img_tag("top/illust-top-01.png"); ?>
    </p>
  <div class="top-works__container">
    <div class="top-header">
      <div class="top-header__main">
        <div class="top-header__title">
          <div class="top-h2">
            <p class="top-h2__en">
                Works
              </p>
            <h2 class="top-h2__ja">
                施工事例
              </h2>
          </div>
        </div>
        <div class="top-header__text">
          <p>
              技術と心を兼ね備えたプロフェッショナルの集団として、<br class="hidden-xs hidden-sm">スムーズに解体作業を進め、お客さまのご要望に真摯にお応えしていきます。
            </p>
        </div>
      </div>
    </div>

    <div id="worksSlider" class="works-slider swiper">
      <ul class="works-slider__list swiper-wrapper">
        <?php
          while ($worksPosts->have_posts()) :
            $worksPosts->the_post();
            echo "<li class='works-list__item swiper-slide'>";
            get_template_part('components/card/worksCard');
            echo "</li>";
          endwhile;
          wp_reset_query();
          ?>
      </ul>
      <div class="top-works__ui">
        <div class="swiper-ui">
          <div class="swiper-scrollbar swiper-scrollbar"></div>
          <div class="swiper-buttons">
            <div class="swiper-buttons__button--prev"></div>
            <div class="swiper-buttons__button--next"></div>
          </div>
        </div>
        <div class="top-works__btn">
          <?php
            get_template_part(
              'components/button/index',
              "",
              array(
                "url" => get_post_type_archive_link('works'),
                "text" => "すべて見る",
              )
            );
            ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="top-about">
  <div class="top-about__image">
    <?php echo my_get_img_tag("top/img-about.jpg", bloginfo('name')); ?>
  </div>
  <div class="top-about__container">
    <div class="top-about__header">
      <div class="top-about__title">
        <div class="top-h2--white">
          <p class="top-h2__en">
            Strengths
          </p>
          <h2 class="top-h2__ja">
            光翔の強み
          </h2>
        </div>
      </div>
    </div>
    <div class="top-about__main">
      <div class="top-about__inner">
        <ol class="top-aboutList">
          <li class="top-aboutList__item">
            <div class="top-aboutBlock">
              <div class="top-aboutBlock__icon">
                <span class="top-aboutBlock__index"></span>
                <?php echo my_get_img_tag("common/illust-about-01.png"); ?>
              </div>
              <div class="top-aboutBlock__main">
                <p class="top-aboutBlock__lead">
                  <strong>安心</strong>して任せられる解体業者
                </p>
                <p class="top-aboutBlock__text">
                  明るくてクリーンなイメージを大切にして、日々の業務に励んでいます。
                </p>
              </div>
            </div>
          </li>
          <li class="top-aboutList__item">
            <div class="top-aboutBlock">
              <div class="top-aboutBlock__icon">
                <span class="top-aboutBlock__index"></span>
                <?php echo my_get_img_tag("common/illust-about-02.png"); ?>
              </div>
              <div class="top-aboutBlock__main">
                <p class="top-aboutBlock__lead">
                  安心・安全の <strong>自社一貫施工</strong>
                </p>
                <p class="top-aboutBlock__text">
                  全ての工程を自社で一貫して行っております。そのためコストを抑えたご提案が可能です。
                </p>
              </div>
            </div>
          </li>
          <li class="top-aboutList__item">
            <div class="top-aboutBlock">
              <div class="top-aboutBlock__icon">
                <span class="top-aboutBlock__index"></span>
                <?php echo my_get_img_tag("common/illust-about-03.png"); ?>
              </div>
              <div class="top-aboutBlock__main">
                <p class="top-aboutBlock__lead">
                  <strong>「キレイ」</strong>にこだわった解体工事
                </p>
                <p class="top-aboutBlock__text">
                  解体中も仕上がりもキレイな現場づくりを大切にしています。
                </p>
              </div>
            </div>
          </li>
        </ol>
        <div class="top-about__btn">
          <?php
          get_template_part(
            'components/button/index',
            "",
            array(
              "url" => get_permalink(get_page_by_path('about')->ID),
              "text" => "光翔について",
            )
          );
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="top-company">
  <p class="top-company__illust">
    <?php echo my_get_img_tag("top/illust-top-02.png"); ?>
  </p>
  <div class="top-company__container">
    <div class="top-company__image">
      <?php echo my_get_img_tag("top/img-company.jpg", bloginfo('name')); ?>
    </div>
    <div class="top-company__main">
      <div class="top-company__inner">
        <div class="top-company__title">
          <div class="top-h2">
            <p class="top-h2__en">
              Company
            </p>
            <h2 class="top-h2__ja">
              会社案内
            </h2>
          </div>
        </div>
        <div class="top-company__text">
          <p>技術と心を兼ね備えたプロフェッショナルの集団として、スムーズに解体作業を進め、お客さまのご要望に真摯にお応えしていきます。</p>
          <p>また、光翔では外国人研修生を受け入れており、解体技術、足場技術などを指導しております。母国でも習得した技術と、日本での経験を生かして欲しいと思い活動してます。</p>
        </div>
        <div class="top-company__info">
          <p>〒208-0023 東京都武蔵村山市伊奈平1-81-4</p>
          <div class="top-company__tel">
            <?php get_template_part('components/telBlock'); ?>
          </div>
        </div>
        <div class="top-company__btns">
          <?php
          get_template_part(
            'components/button/index',
            "",
            array(
              "url" => get_permalink(get_page_by_path('company')->ID),
              "text" => "会社案内",
            )
          );
          ?>
          <?php
          get_template_part(
            'components/button/index',
            "",
            array(
              "url" => get_permalink(get_page_by_path('staff')->ID),
              "text" => "スタッフ紹介",
            )
          );
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="top-other">
    <div class="top-other__col">
      <a href="<?php get_permalink(get_page_by_path('flow')->ID); ?>" class="top-other-btn">
        <span class="top-other-btn__illust">
          <?php echo my_get_img_tag("common/illust-flow.png"); ?>
        </span>
        <span class="top-other-btn__main">
          <span class="top-other-btn__en">
            Flow
          </span>
          <span class="top-other-btn__ja">
            ご利用の流れ
          </span>
        </span>
        <span class="link-arrow--lg"></span>
      </a>
    </div>
    <div class="top-other__col">
      <a href="<?php get_permalink(get_page_by_path('service')->ID); ?>" class="top-other-btn">
        <span class="top-other-btn__illust">
          <?php echo my_get_img_tag("common/illust-service.png"); ?>
        </span>
        <span class="top-other-btn__main">
          <span class="top-other-btn__en">
            Service
          </span>
          <span class="top-other-btn__ja">
            業務内容
          </span>
        </span>
        <span class="link-arrow--lg"></span>
      </a>
    </div>
  </div>
</section>

<?php
$list_count = 3;
$sticky = get_option('sticky_posts');
if (!empty($sticky)) $list_count -= count($sticky);
$arg = array(
  'posts_per_page' =>  $list_count,
  'orderby' => 'date',
  'order' => 'DESC'
);
$recentPosts = new WP_Query($arg);
if ($recentPosts->have_posts()) :  ?>
<section class="top-blog">
  <div class="top-blog__container">
    <div class="top-blog__header">
      <div class="top-blog__title">
        <div class="top-h2">
          <p class="top-h2__en">
              Blog
            </p>
          <h2 class="top-h2__ja">
              光翔ブログ
            </h2>
        </div>
      </div>
      <div class="top-blog__btn">
        <?php
          get_template_part(
            'components/button/index',
            "",
            array(
              "url" => get_permalink(get_page_by_path('blog')->ID),
              "text" => "すべて見る",
            )
          );
          ?>
      </div>
    </div>
    <div class="top-blog__right">
      <ul class="news-list">
        <?php if ($recentPosts->have_posts()) :
            while ($recentPosts->have_posts()) :
              $recentPosts->the_post();
              echo "<li class='news-list__item'>";
              get_template_part('components/newsList');
              echo "</li>";
            endwhile;
            wp_reset_query();
          endif;
          ?>
      </ul>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(null, array("property" => "--light")); ?>
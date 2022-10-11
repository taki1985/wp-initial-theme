<?php

/**
 * お問い合わせ
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header();

?>

<div class="pgttl">
  <div class="pgttl__container container-lg">
    <div class="pgttl__content">
      <p class="pgttl__en">
        Contact
      </p>
      <h1 class="pgttl__ja"><?php the_title(); ?></h1>
    </div>
  </div>
  <div class="pgttl__thumb">
    <p class="pgttl__thumb-inner">
      <img src="<?php echo IMG_URI; ?>/common/bg-pgttl-contact.jpg" alt="<?php the_title(); ?>">
    </p>
  </div>
</div>
<?php get_template_part('parts/breadcrumbs'); ?>

<div class="section-lg">
  <section class="container-md">
    <div class="contact-text">
      <p class="show-sent">
        お問い合わせありがとうございました。
      </p>
      <p>
        内容を確認次第、担当者よりご連絡させていただきます。<br>
        尚、メールフォームからのお問い合わせの場合、お客さまからいただいたメールアドレスが違っていたり、システム障害などによりお返事できない場合がございます。<br>返答のない場合は、お電話でその旨お問い合わせください。<br>
        お問い合わせ内容は、フォームにご記入頂きましたメールアドレス宛にも自動返送されます。
      </p>
      <p class="hide-sent">
        <span class="mark-req">必須</span> のついた項目は、全て入力をお願いいたします。<br>
        迷惑メール対策でドメイン指定をされている方は、メールが受信できるよう設定を変更頂きます様、宜しくお願いします。
      </p>
    </div>
    <div class="block-child--md">
      <?php echo do_shortcode('[contact-form-7 id="4" title="お問い合わせフォーム"]'); ?>
    </div>
  </section>
</div>
<?php get_footer(); ?>
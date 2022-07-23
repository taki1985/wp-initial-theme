<?php

/**
 * contact form7 カスタム
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}


if (!class_exists('MY_THEME_FORM')) {
  exit;
}

class MY_THEME_FORM
{

  function __construct()
  {


    //セレクトボックス空要素のテキスト変更
    add_filter('wpcf7_form_elements', array($this, 'custom_wpcf7_form_elements'));

    // add_filter('wpcf7_support_html5_fallback', '__return_true');

    // カスタムバリデーション
    // add_filter('wpcf7_validate', array($this, 'custom_wpcf7_validate'), 11, 2);

    add_filter('wpcf7_validate_file', array($this,  'custom_wpcf7_file_validate_filter'), 20, 2);

    //指定ページでなければCF7とreCAPTCHAのJS,CSSを読み込まない
    add_action('template_redirect', array($this, 'remove_cf7_js_css'));

    //Contact Form 7 のreCAPTCHAのしきい値変更
    add_filter('wpcf7_recaptcha_threshold', function ($score) {
      return 0.29;
    });
  }

  // カスタムバリデーション
  function custom_wpcf7_file_validate_filter($result, $tag)
  {
    if ('your_file2' == $tag->name) {
      $your_file2 = isset($_FILES['your_file2']['name']) ? trim($_FILES['your_file2']['name']) : '';
      $your_category = isset($_POST['your_category']) ? trim($_POST['your_category']) : '';

      if (strpos($your_category, '新卒') === false && strpos($your_category, 'インターン') === false && $your_file2 == '') {
        $result->invalidate($tag, '必須項目に入力してください。');
      }
    }

    return $result;
  }

  function __custom_wpcf7_validate($result, $tags)
  {

    foreach ($tags as $tag) {
      $name = $tag['name'];
      if ($name == 'your_category') {
        $cat = $_POST[$name];
      }
    }
    foreach ($tags as $tag) {
      $name = $tag['name'];
      if ($name == 'your_file2') {
        $file2 = $_POST[$name];
        if ($cat == '中途採用(職務経歴書をお送りください)' && $file2 == '') {
          $result->invalidate($name, '必須項目に入力してください。');
        }
      }
    }

    return $result;
  }

  //contact form 7 セレクトボックス空要素のテキスト変更
  function custom_wpcf7_form_elements($html)
  {
    return str_replace('---', '選択してください', $html);
  }

  //Contact Form 7で作られたフォームのページじゃなければJS,CSSを読み込まない
  function remove_cf7_js_css()
  {
    global $post;
    $valid_recaptcha = false;

    add_filter('wpcf7_load_js', '__return_false');
    add_filter('wpcf7_load_css', '__return_false');

    $getPost = get_post();
    if ($getPost) {
      $content = $getPost->post_content;

      if ($content != null) {
        //Contact Form 7のショートコードが存在する
        if (has_shortcode($content, 'contact-form-7')) {
          $valid_recaptcha = true;
          if (function_exists('wpcf7_enqueue_scripts')) {
            wpcf7_enqueue_scripts();
          }
          if (function_exists('wpcf7_enqueue_styles')) {
            wpcf7_enqueue_styles();
          }
        }
      }
      //ショートコードが存在しなければreCAPTCHAの読み込みをキャンセルする
      if ($valid_recaptcha == false) {
        wp_deregister_script('google-recaptcha');
      }
    }
  }
}

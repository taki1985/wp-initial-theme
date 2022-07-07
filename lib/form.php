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

    // add_filter('wpcf7_ajax_json_echo', array($this,'custom_wpcf7_item_error_position'), 10, 2);

    //セレクトボックス空要素のテキスト変更
    add_filter('wpcf7_form_elements', array($this, 'custom_wpcf7_form_elements'));

    // add_filter('wpcf7_support_html5_fallback', '__return_true');

    //指定ページでなければCF7とreCAPTCHAのJS,CSSを読み込まない
    add_action('template_redirect', array($this, 'remove_cf7_js_css'));

    //Contact Form 7 のreCAPTCHAのしきい値変更
    add_filter('wpcf7_recaptcha_threshold', function ($score) {
      return 0.29;
    });
  }


  /**
   * Contact Form 7のエラーメッセージの場所を必要な項目のみ変更します。
   */
  function custom_wpcf7_item_error_position($items, $result)
  {
    // メッセージを表示させたい場所のタグのエラー用のクラス名
    $class = 'wpcf7-custom-item-error';
    // メッセージの位置を変更したい項目名
    $names = array('your_year', 'your_month', 'your_day', 'your_zip');

    // 入力エラーがある場合
    // 入力エラーがある場合
    if (isset($items['invalid_fields'])) {
      foreach ($items['invalid_fields'] as $k => $v) {
        $orig = $v['into'];
        $name = substr($orig, strrpos($orig, ".") + 1);
        // 位置を変更したい項目のみ、エラーを設定するタグのクラス名を差替
        if (in_array($name, $names)) {
          $items['invalid_fields'][$k]['into'] = ".{$class}.{$name}";
        }
      }
    }
    return $items;
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

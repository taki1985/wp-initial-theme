<?php

/**
 * contact form7 カスタム
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}


/**
 * Contact Form 7のエラーメッセージの場所を必要な項目のみ変更します。
 */
function wpcf7_custom_item_error_position($items, $result)
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
// add_filter('wpcf7_ajax_json_echo', 'wpcf7_custom_item_error_position', 10, 2);


//contact form 7 セレクトボックス空要素のテキスト変更
function my_wpcf7_form_elements($html)
{
  return str_replace('---', '選択してください', $html);
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');

// add_filter('wpcf7_support_html5_fallback', '__return_true');


//Contact Form 7で作られたフォームのページじゃなければJS,CSSを読み込まない
function remove_cf7_js_css()
{
  add_filter('wpcf7_load_js', '__return_false');
  add_filter('wpcf7_load_css', '__return_false');
  //仕様ページを追加する
  if (is_page('contact')) {
    if (function_exists('wpcf7_enqueue_scripts')) {
      wpcf7_enqueue_scripts();
    }
    if (function_exists('wpcf7_enqueue_styles')) {
      wpcf7_enqueue_styles();
    }
  }
}
add_action('template_redirect', 'remove_cf7_js_css');


//Contact Form 7で作られたフォームのページじゃなければreCAPTCHAを読み込みをキャンセル
add_action('wp_enqueue_scripts', function () {
  global $post;
  $valid_recaptcha = false;
  $getPost = get_post();
  if ($getPost) {
    $content = $getPost->post_content;

    if ($content != null) {
      //Contact Form 7のショートコードが存在する
      if (has_shortcode($content, 'contact-form-7')) {
        $valid_recaptcha = true;
      }
    }

    //ショートコードが存在しなければreCAPTCHAの読み込みをキャンセルする
    if ($valid_recaptcha == false) {
      wp_deregister_script('google-recaptcha');
    }
  }
}, 100);

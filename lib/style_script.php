<?php

/**
 * js & css ファイル設置
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}

//cssをfooterで読み込ませる
function prefix_add_footer_styles()
{
  wp_enqueue_style(
    'libStyle',
    get_template_directory_uri() . '/assets/css/lib.css'
  );
};


function enqueue_scripts_and_styles()
{
  global $wp_styles;

  if (!is_admin()) {


    // Gutenbergを使わない場合
    wp_dequeue_style('wp-block-library');

    wp_enqueue_style(
      'stylesStyle',
      get_template_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css')
    );

    // jQueryの読み込み(jQuery migrate(後方互換)は読み込まない)
    global $wp_scripts;
    $jquery = $wp_scripts->registered['jquery-core'];
    $jquery_ver = $jquery->ver;
    $jquery_src = $jquery->src;
    // いったん削除
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-core');
    // 登録しなおし
    wp_register_script('jquery', false, ['jquery-core'], $jquery_ver, true);
    wp_register_script('jquery-core', $jquery_src, [], $jquery_ver, true);

    wp_enqueue_script(
      'mainJs',
      get_template_directory_uri() . '/assets/js/script.js?' . filemtime(get_stylesheet_directory() . '/assets/js/script.js'),
      array('jquery'),
      " ",
      true
    );
  }
}

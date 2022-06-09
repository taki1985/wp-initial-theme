<?php

/**
 * js & css ファイル設置
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}
function enqueue_scripts_and_styles()
{
  global $wp_styles;

  if (!is_admin()) {

    wp_enqueue_style(
      'libStyle',
      get_template_directory_uri() . '/assets/css/lib.css'
    );

    wp_enqueue_style(
      'stylesStyle',
      get_template_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css')
    );


    // jQueryの読み込み
    wp_enqueue_script('jquery');


    wp_enqueue_script(
      'modulesJs',
      get_template_directory_uri() . '/assets/js/modules.js',
      array('jquery'),
      " ",
      true
    );

    wp_enqueue_script(
      'libJs',
      get_template_directory_uri() . '/assets/js/lib.js',
      array('jquery'),
      " ",
      true
    );


    wp_enqueue_script(
      'mainJs',
      get_template_directory_uri() . '/assets/js/script.js?' . filemtime(get_stylesheet_directory() . '/assets/js/script.js'),
      array('jquery'),
      " ",
      true
    );
  }
}

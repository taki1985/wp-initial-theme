<?php

/**
 * editor カスタマイズ
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}

/******************************************
エディターにオリジナルボタンを追加
 ******************************************/
//スタイルセレクトボタンを追加
function tinymce_add_buttons($array)
{
  array_unshift(
    $array,
    'styleselect'
  );
  return $array;
}
add_filter('mce_buttons', 'tinymce_add_buttons');

//スタイルセレクトの初期設定を変更
function customize_tinymce_settings($mceInit)
{
  $style_formats = array(
    array(
      'title' => 'ファイル添付ボタン',
      'inline' => 'a',
      'classes' => 'filebtn',
      'wrapper' => false,
    ),
    array(
      'title' => 'PDF添付ボタン',
      'inline' => 'a',
      'classes' => 'filebtn filebtn--pdf',
      'wrapper' => false,
    ),
    array(
      'title' => 'エクセル添付ボタン',
      'inline' => 'a',
      'classes' => 'filebtn filebtn--excel',
      'wrapper' => false,
    ),
  );
  $mceInit['style_formats'] = json_encode($style_formats);

  return $mceInit;
}
add_filter('tiny_mce_before_init', 'customize_tinymce_settings');

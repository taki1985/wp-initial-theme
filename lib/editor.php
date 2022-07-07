<?php

/**
 * editor カスタマイズ
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists('MY_THEME_EDITOR')) {
  exit;
}


/******************************************
エディターにオリジナルボタンを追加
 ******************************************/
class MY_THEME_EDITOR
{
  function __construct()
  {

    //エディターにオリジナルボタンを追加
    add_filter('mce_buttons', array($this, 'add_tinymce_buttons'));

    //スタイルセレクトの初期設定を変更
    add_filter('tiny_mce_before_init', array($this, 'customize_tinymce_settings'));
  }

  //スタイルセレクトボタンを追加
  function add_tinymce_buttons($array)
  {
    array_unshift(
      $array,
      'styleselect'
    );
    return $array;
  }

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
}

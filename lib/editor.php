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

    //ボタンが見つかったら矢印追加
    add_filter('the_content', array($this, 'add_content_to_anchor_tags'));

    add_filter('acf_the_content', array($this, 'add_content_to_anchor_tags'));
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
        'title' => 'デザインボタン',
        'inline' => 'a',
        'classes' => 'btn',
        'wrapper' => false,
      ),
    );
    $mceInit['style_formats'] = json_encode($style_formats);

    return $mceInit;
  }

  function add_content_to_anchor_tags($content)
  {
    // 正規表現パターンで特定のクラスを持つ<a>タグを検索します
    $pattern = '/<a\s+([^>]*)class="btn"([^>]*)>(.*?)<\/a>/i';

    // コンテンツ内のマッチするすべての<a>タグに対して処理を行います
    $content = preg_replace_callback($pattern,  array($this, 'add_content_to_anchor_callback'), $content);

    return $content;
  }

  function add_content_to_anchor_callback($matches)
  {
    // <a>タグ内に追加する要素を指定します
    $additional_content = '<span class="link-arrow"></span>';
    $additional_content2 = '<span class="link-arrow--white hover"></span>';

    // <a>タグの属性を取得します
    $attributes = $matches[1] . $matches[2];

    // 元の<a>タグと追加の要素を組み合わせて新しい<a>タグを生成します
    $new_anchor_tag = '<a ' . $attributes . ' class="btn"><span class="btn__text">' . $matches[3] . '</span>' . $additional_content . $additional_content2 . '</a>';

    return $new_anchor_tag;
  }
}

<?php

/**
 * headタグ内整理
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists('MY_THEME_HEAD')) {
  exit;
}

class MY_THEME_HEAD
{

  function __construct()
  {
    remove_action('wp_head', 'feed_links_extra', 3);                       // カテゴリーなどへのフィード削除
    remove_action('wp_head', 'feed_links', 2);                            // 投稿・コメントへのフィード削除
    remove_action('wp_head', 'rsd_link');                                    // ブログ編集ツール連携停止
    remove_action('wp_head', 'wlwmanifest_link');                            // Windows Live Write連携停止
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);                // ブラウザが先読みするためのタグ削除
    remove_action('wp_head', 'start_post_rel_link', 10, 0);                // ブラウザが先読みするためのタグ削除
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);    // ブラウザが先読みするためのタグ削除
    remove_action('wp_head', 'wp_generator');                                // WP バージョン情報削除
    remove_action('wp_head', 'print_emoji_detection_script', 7);            // 絵文字表示用スクリプト削除
    remove_action('wp_print_styles', 'print_emoji_styles');                    // 絵文字表示用スタイル削除
    add_filter('style_loader_src', array($this, 'remove_wp_ver_css_js'), 9999);            // cssファイルに付くバージョン情報削除
    add_filter('script_loader_src', array($this, 'remove_wp_ver_css_js'), 9999);        // jsファイルに付くバージョン情報削除
    // RSSやAtomのWP バージョン情報 <generator>削除
    foreach (array('rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head') as $action) {
      remove_action($action, 'the_generator');
    }
  }


  // css & jsファイルに付くバージョン情報削除
  function remove_wp_ver_css_js($src)
  {
    if (strpos($src, 'ver=')) {
      $src = remove_query_arg('ver', $src);
    }
    return $src;
  }
}

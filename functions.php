<?php

/**
 * テーマ初期設定
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * テーマディレクトリパス
 */
define('T_DIRE_URI', get_template_directory_uri());
define('IMG_URI', T_DIRE_URI . '/assets/img');
define('S_DIRE_URI', get_stylesheet_directory_uri());

require_once 'lib/settings.php';
/*headタグ内整理*/
require_once 'lib/head_cleanup.php';
/*管理画面整理*/
require_once 'lib/admin.php';
/*固定ページの作成*/
require_once 'lib/pages.php';
/* js & css ファイル設置 */
require_once 'lib/style_script.php';
/*カスタム投稿タイプ設定*/
require_once 'lib/custom-post-type.php';
/*カスタムフィールド設定*/
require_once 'lib/custom-fields.php';
/*カスタムフォーム設定*/
require_once 'lib/custom-form.php';
/*カスタムエディター設定*/
require_once 'lib/custom-editor.php';
/*自作関数設定*/
require_once 'lib/custom-functions.php';
/*ページネーション*/
require_once 'lib/pagination.php';
/*OGPタグ自動挿入*/
require_once 'lib/ogp.php';
/*パンくず*/
require_once 'lib/breadclumbs.php';

/******************************************
初期化
 ******************************************/
function setup_hello()
{
	// <title> タグ自動挿入
	add_theme_support(
		'title-tag'
	);

	// エディター用CSS設定 (タイムスタンプ付加)
	add_editor_style(get_stylesheet_directory_uri() . '/editor-style.css?' . filemtime(get_stylesheet_directory() . '/editor-style.css'));

	// head内のいらないタグ削除
	add_action('init', 'head_cleanup');

	// ギャラリーのデフォルトcss削除
	// add_filter( 'use_default_gallery_style', '__return_false' );

	// デフォルトの gallery ショートコードを削除
	// remove_shortcode('gallery', 'gallery_shortcode');

	// js & css ファイル設置
	add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles', 999);

	// css フッター設置
	add_action('get_footer', 'prefix_add_footer_styles');

	// the_excerpt()の末尾に表示する内容を変更
	// add_filter( 'excerpt_more', 'change_excerpt_more' );

	// the_excerpt() 削除
	// add_filter('excerpt_more', 'remove_excerpt_more');

	// アイキャッチ画像の定義と切り抜き
	add_theme_support('post-thumbnails');
	add_action('after_setup_theme', 'set_thumbnail_size');

	/*OGPタグ自動挿入 */
	add_action('wp_head', 'add_meta_ogp');
}
add_action('after_setup_theme', 'setup_hello');

// 固定ページの作成および表示設定の変更
add_action('after_setup_theme', 'create_pages_and_setting');

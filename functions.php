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

if (!class_exists('MY_THEME')) {
	exit;
}

class MY_THEME
{
	private static $instance;

	public static function get_instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		add_action('after_setup_theme',  array($this, 'setup_hello'));

		require_once 'lib/setup.php';
		new MY_THEME_SETUP();

		/*headタグ内整理*/
		require_once 'lib/head.php';
		new MY_THEME_HEAD();

		/*管理画面整理*/
		require_once 'lib/admin.php';
		new MY_THEME_ADMIN();

		/*固定ページの作成*/
		require_once 'lib/pages.php';
		new MY_THEME_PAGES();

		/* js & css ファイル設置 */
		require_once 'lib/load-assets.php';
		new MY_THEME_LOAD_ASSETS();

		/*カスタム投稿タイプ設定*/
		require_once 'lib/custom-post-type.php';
		new MY_THEME_CPT();

		/*カスタムフィールド設定*/
		require_once 'lib/custom-fields.php';
		new MY_THEME_CUSTOM_FILED();

		/*カスタムフォーム設定*/
		require_once 'lib/form.php';
		new MY_THEME_FORM();

		/*カスタムエディター設定*/
		require_once 'lib/editor.php';
		new MY_THEME_EDITOR();

		/*OGPタグ自動挿入*/
		// require_once 'lib/ogp.php';
		// new MY_THEME_OGP();

		/*パンくず*/
		require_once 'lib/breadcrumbs.php';

		/*ページネーション*/
		require_once 'lib/pagination.php';

		/*自作関数設定*/
		require_once 'lib/export-functions.php';
	}

	public function setup_hello()
	{

		// エディター用CSS設定 (タイムスタンプ付加)
		add_editor_style(get_stylesheet_directory_uri() . '/editor-style.css?' . filemtime(get_stylesheet_directory() . '/editor-style.css'));

		// ギャラリーのデフォルトcss削除
		// add_filter( 'use_default_gallery_style', '__return_false' );

		// デフォルトの gallery ショートコードを削除
		// remove_shortcode('gallery', 'gallery_shortcode');

	}
}


MY_THEME::get_instance();


// フィルタの登録
add_filter('content_save_pre', 'test_save_pre');

function test_save_pre($content)
{
	global $allowedposttags;

	// iframeとiframeで使える属性を指定する
	$allowedposttags['iframe'] = array(
		'class' => array(), 'src' => array(), 'width' => array(),
		'height' => array(), 'frameborder' => array(), 'scrolling' => array(), 'marginheight' => array(),
		'marginwidth' => array()
	);

	return $content;
}

<?php

/**
 * 管理画面設定
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('MY_THEME_ADMIN')) {
	exit;
}

class MY_THEME_ADMIN
{

	function __construct()
	{

		// JS読み込み 子カテゴリーにチェックを入れたら親カテゴリーにも自動でチェック
		add_action('admin_print_scripts-post.php', array($this, 'category_parent_check_script'));
		add_action('admin_print_scripts-post-new.php', array($this, 'category_parent_check_script'));
		//ダッシュボード整理
		add_action('wp_dashboard_setup',  array($this, 'disable_default_dashboard_widgets'));
		remove_action('welcome_panel', array($this,  'wp_welcome_panel')); // ようこそ！非表示
		// 投稿 メタボックス整理
		add_action('admin_menu',  array($this, 'remove_default_post_screen_metaboxes'));
		// 固定ページ メタボックス整理
		add_action('admin_menu', array($this,  'remove_default_page_screen_metaboxes'));
		//サイドメニュー整理
		add_action('admin_menu',  array($this, 'remove_admin_menu'), 999);
		// 投稿一覧整理
		add_filter('manage_posts_columns',  array($this, 'disable_default_posts_columns'));
		//ツールバー(上部メニュー)整理
		add_action('admin_bar_menu',  array($this, 'remove_bar_menus'), 99);
		//サイドメニューに独自項目追加
		add_action('admin_menu', array($this, 'add_admin_menu'));
		//管理画面にファビコン設置
		add_action('admin_head', array($this, 'add_favicon_dashboard'));
		add_action('login_head', array($this, 'add_favicon_dashboard'));

		// 本体のアップデート通知を非表示
		add_filter('pre_site_transient_update_core', '__return_zero');
		remove_action('wp_version_check', 'wp_version_check');
		remove_action('admin_init', '_maybe_update_core');

		// プラグイン更新通知を非表示
		remove_action('load-update-core.php', 'wp_update_plugins');
		add_filter('pre_site_transient_update_plugins', '__return_zero');

		// テーマ更新通知を非表示
		remove_action('load-update-core.php', 'wp_update_themes');
		add_filter('pre_site_transient_update_themes', '__return_zero');

		//acfのwysiwygエディター高さ調整
		add_filter('acf-autosize/wysiwyg/min-height', function () {
			return 120;
		});
	}

	/**
	 * JS読み込み 子カテゴリーにチェックを入れたら親カテゴリーにも自動でチェック
	 */
	function category_parent_check_script()
	{
		wp_enqueue_script('parent-check', get_template_directory_uri() . '/admin/js/check_parent.js', array('jquery'));
	}

	/**
	 * ダッシュボード整理
	 */
	function disable_default_dashboard_widgets()
	{
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);       // 現在の状況表示
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // アクティビティ
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // 被リンク
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // プラグイン
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']); // サイトヘルス
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);       // クイック投稿
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // 最近の下書き表示
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           // WordPressニュース
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         // WordPressフォーラム
	}

	/**
	 * 投稿 メタボックス整理
	 */
	function remove_default_post_screen_metaboxes()
	{
		remove_meta_box('postexcerpt', 'post', 'normal');           // 抜粋
		remove_meta_box('trackbacksdiv', 'post', 'normal');         // トラックバック送信
		remove_meta_box('commentstatusdiv', 'post', 'normal');      // ディスカッション
		remove_meta_box('commentsdiv', 'post', 'normal');           // コメント
		// remove_meta_box('slugdiv', 'post', 'normal');               // スラッグ
		remove_meta_box('authordiv', 'post', 'normal');             // 作成者
		remove_meta_box('formatdiv', 'post', 'normal');             // フォーマット
		// remove_meta_box( 'revisionsdiv', 'post', 'normal' );        // リビジョン
		remove_meta_box('postcustom', 'post', 'normal');            // カスタムフィールド
		// remove_meta_box('categorydiv', 'post', 'normal');           // カテゴリー
		remove_meta_box('tagsdiv-post_tag', 'post', 'normal');       // タグ
	}


	/**
	 * 固定ページ メタボックス整理
	 */
	function remove_default_page_screen_metaboxes()
	{
		remove_meta_box('commentstatusdiv', 'page', 'normal');  // ディスカッション
		remove_meta_box('commentsdiv', 'page', 'normal');       // コメント
		remove_meta_box('slugdiv', 'page', 'normal');           // スラッグ
		remove_meta_box('authordiv', 'page', 'normal');         // 作成者
		remove_meta_box('postcustom', 'page', 'normal');        // カスタムフィールド
		// remove_meta_box( 'revisionsdiv', 'page', 'normal' );      // リビジョン
	}

	/**
	 * サイドメニュー整理
	 */
	function remove_admin_menu()
	{
		// 	remove_menu_page('index.php');                // ダッシュボード
		remove_menu_page('edit.php');                 // 投稿
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // タグ
		// remove_menu_page( 'upload.php' );               // メディア
		// remove_menu_page( 'edit.php?post_type=page' );  // 固定ページ
		remove_menu_page('edit-comments.php');        // コメント
		// remove_menu_page( 'themes.php' );               // 外観
		remove_submenu_page('themes.php', 'customize.php?return=' . urlencode($_SERVER['REQUEST_URI'])); // 外観カスタマイズ
		// remove_menu_page( 'plugins.php' );              // プラグイン
		// remove_menu_page( 'users.php' );                // ユーザー
		// remove_menu_page( 'tools.php' );                // ツール
		// remove_menu_page( 'options-general.php' );      // 設定
	}

	/**
	 * 投稿一覧 整理
	 */
	function disable_default_posts_columns($columns)
	{
		// unset($columns['cb']); // チェックボックス
		// unset($columns['title']); // 投稿タイトル
		unset($columns['author']); // 投稿者名
		// unset($columns['categories']); // カテゴリ
		unset($columns['tags']); // タグ
		unset($columns['comments']); // コメント
		// unset($columns['date']); // 投稿日時
		return $columns;
	}

	/**
	 *　ツールバー(上部メニュー)整理
	 */
	function remove_bar_menus($wp_admin_bar)
	{
		$wp_admin_bar->remove_menu('wp-logo'); // WordPressアイコン
		$wp_admin_bar->remove_menu('about'); // WordPressアイコン -> WordPress について
		$wp_admin_bar->remove_menu('wporg'); // WordPressアイコン -> WordPress.org
		$wp_admin_bar->remove_menu('documentation'); // WordPressアイコン -> ドキュメンテーション
		$wp_admin_bar->remove_menu('support-forums'); // WordPressアイコン -> サポートフォーラム
		$wp_admin_bar->remove_menu('feedback'); // WordPressアイコン -> フィードバック

		// $wp_admin_bar->remove_menu( 'site-name' );//サイト情報
		$wp_admin_bar->remove_menu('dashboard'); // サイト情報 -> ダッシュボード
		$wp_admin_bar->remove_menu('themes'); // サイト情報 -> テーマ
		$wp_admin_bar->remove_menu('widgets'); // サイト情報 -> ウィジェット
		// $wp_admin_bar->remove_menu( 'menus' );//サイト情報 -> メニュー
		// $wp_admin_bar->remove_menu( 'header' );//サイト情報 -> ヘッダー

		$wp_admin_bar->remove_menu('customize'); // カスタマイズ

		$wp_admin_bar->remove_menu('comments'); // コメント

		$wp_admin_bar->remove_menu('new-content'); // 新規
		$wp_admin_bar->remove_menu('new-post'); // 新規 -> 投稿
		$wp_admin_bar->remove_menu('new-media'); // 新規 -> メディア
		$wp_admin_bar->remove_menu('new-page'); // 新規 -> 固定ページ
		$wp_admin_bar->remove_menu('new-user'); // 新規 -> ユーザー

		$wp_admin_bar->remove_menu('edit'); // 〜の編集

		// $wp_admin_bar->remove_menu( 'my-account' );//こんにちは、[ユーザー名]　さん
		// $wp_admin_bar->remove_menu( 'user-info' ); //ユーザー -> ユーザー名・アイコン
		// $wp_admin_bar->remove_menu( 'edit-profile' );//ユーザー -> プロフィールを編集
		// $wp_admin_bar->remove_menu( 'logout' );//ユーザー -> ログアウト

		$wp_admin_bar->remove_menu('search'); // 検索
	}


	/**
	 *　サイドメニューに独自項目追加
	 */
	function add_admin_menu()
	{
		// $this->add_menu_page_by_slug('よくある質問', 'よくある質問', 'manage_options', 'culture/faq', '', 'dashicons-admin-comments', 7);
	}

	function add_menu_page_by_slug($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position)
	{
		$get_page_id = get_page_by_path($menu_slug);
		$get_page_id = $get_page_id->ID;
		add_menu_page($page_title, $menu_title, $capability, 'post.php?post=' . $get_page_id . '&action=edit', $function, $icon_url, $position);
	}

	function add_submenu_page_by_slug($parent, $page_title, $menu_title, $capability, $menu_slug, $function)
	{
		$get_page_id = get_page_by_path($menu_slug);
		$get_page_id = $get_page_id->ID;
		add_submenu_page($parent, $page_title, $menu_title, $capability, 'post.php?post=' . $get_page_id . '&action=edit', $function);
	}


	/**
	 *　管理画面にファビコン設置
	 */
	function add_favicon_dashboard()
	{
		echo '<link rel="icon" href="' . esc_html(T_DIRE_URI) . '/favicon.ico">';
	}
}

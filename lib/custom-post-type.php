<?php
if (!defined('ABSPATH')) {
	exit;
}
/*
------------------------------------
------------------------------------
custom-post-type.php
カスタム投稿登録
------------------------------------
------------------------------------
*/


/******************************************
「投稿」を「お知らせ」へ変更
 ******************************************/
function change_post_menu_label()
{
	global $menu;
	global $submenu;
	$menu[5][0]                 = 'お知らせ';
	$submenu['edit.php'][5][0]  = 'お知らせ一覧';
	$submenu['edit.php'][10][0] = '新しいお知らせ';
	$submenu['edit.php'][16][0] = 'タグ';
}
function change_post_object_label()
{
	global $wp_post_types;
	$labels                     = &$wp_post_types['post']->labels;
	$labels->name               = 'お知らせ';
	$labels->singular_name      = 'お知らせ';
	$labels->add_new            = _x('追加', 'お知らせ');
	$labels->add_new_item       = 'お知らせの新規追加';
	$labels->edit_item          = 'お知らせの編集';
	$labels->new_item           = '新規お知らせ';
	$labels->view_item          = 'お知らせを表示';
	$labels->search_items       = 'お知らせを検索';
	$labels->not_found          = '記事が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');
// 投稿にアーカイブ(投稿一覧)を持たせる
function post_has_archive($args, $post_type)
{
	if ('post' == $post_type) {
		$args['rewrite']     = true;
		$args['has_archive'] = 'news'; // ページ名
	}
	return $args;
}
// add_filter('register_post_type_args', 'post_has_archive', 10, 2);

<?php

/**
 * テーマ初期設定
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
	exit;
}

// the_excerpt()の末尾に表示する内容を変更
function change_excerpt_more($more)
{
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '">続きを読む</a>';
}
// the_excerpt()を削除
function remove_excerpt_more($more)
{
	return '';
}

// アイキャッチ画像の定義と切り抜き
function set_thumbnail_size()
{
	add_image_size('kv', 1400, 900, true);
	add_image_size('gallery', 600, 600, true);
}

function rewrite_title($title)
{
	if (is_front_page()) {
		$title['tagline'] = '';
	}
	return $title;
}
add_filter('document_title_parts', 'rewrite_title');

// 自動保存の停止
function autosave_off()
{
	wp_deregister_script('autosave');
}
add_action('wp_print_scripts', 'autosave_off');

// 投稿者アーカイブを無効化
function disable_author_archive($query)
{
	if (!is_admin() && is_author()) {
		$query->set_404();
		status_header(404);
		nocache_headers();
	}
}
add_action('parse_query', 'disable_author_archive');

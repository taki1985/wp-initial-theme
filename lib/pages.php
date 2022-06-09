<?php

/**
 * 固定ページの作成および表示設定の変更
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}

//固定ページディレクトリ分け
add_filter('page_template_hierarchy', 'my_page_templates');
function my_page_templates($templates)
{
  global $wp_query;

  $template = get_page_template_slug();
  $pagename = $wp_query->query['pagename'];

  if (!$template && $pagename) {
    $decoded = urldecode($pagename);

    if ($decoded == $pagename) {
      array_unshift($templates, "page/{$pagename}.php");
    }
  }

  return $templates;
}

function create_pages_and_setting()
{
  $pages_array[] = array('title' => 'トップページ', 'name' => 'index', 'parent' => '');
  $pages_array[] = array('title' => 'お知らせ', 'name' => 'news', 'parent' => '');
  $pages_array[] = array('title' => 'お問い合わせ', 'name' => 'contact', 'parent' => '');

  // 初期サンプルページ削除
  wp_delete_post(1, true);
  wp_delete_post(2, true);
  wp_delete_post(3, true);

  if (!isset($pages_array)) return;
  foreach ($pages_array as $value) {
    settign_pages($value);
  }
}
function settign_pages($val)
{
  if (!empty($val['parent'])) {
    $parent_id = get_page_by_path($val['parent']);
    $parent_id = $parent_id->ID;
    $page_slug = $val['parent'] . '/' . $val['name'];
  } else {
    $parent_id = '';
    $page_slug = $val['name'];
  }
  $page_by_slug = get_page_by_path($page_slug);
  if (empty($page_by_slug)) {
    $insert_id = wp_insert_post(
      array(
        'post_title'   => $val['title'],
        'post_name'    => $val['name'],
        'post_status'  => ($val['status']) ? $val['status'] : 'publish',
        'post_type'    => 'page',
        'post_parent'  => $parent_id,
        'post_content' => '',
      )
    );
    if ($insert_id) {
      // update_post_meta($insert_id, 'pgttl_name', $val['eng']);
    }
  } else {
    $page_obj = get_page_by_path($page_slug);
    if ($page_obj->post_title != $val['title']) {
      $page_id = $page_obj->ID;
      $base_post = array(
        'ID'           => $page_id,
        'post_title'   => $val['title']
      );
      wp_update_post($base_post);
      // update_post_meta($page_id, 'pgttl_name', $val['eng']);
    }
  }
}

<?php

/**
 * 固定ページの作成および表示設定の変更
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists('MY_THEME_PAGES')) {
  exit;
}

class MY_THEME_PAGES
{

  function __construct()
  {
    //固定ページディレクトリ分け
    add_filter('page_template_hierarchy', array($this, 'custom_page_template_file'));


    // 固定ページの作成および表示設定の変更
    add_action(
      'after_switch_theme',
      array($this, 'create_pages_and_setting')
    );
  }


  //固定ページディレクトリ分け
  function custom_page_template_file($templates)
  {
    global $wp_query;

    $template = get_page_template_slug();
    $pagename = $wp_query->query['pagename'];

    if (!$template && $pagename) {
      $decoded = urldecode($pagename);

      if ($decoded == $pagename) {
        if (strpos($pagename, "people/") === 0) {
          array_unshift($templates, "page/people/index.php");
        } else {
          array_unshift($templates, "page/{$pagename}.php");
        }
      }
    }
    return $templates;
  }


  function create_pages_and_setting()
  {
    $pages_array[] = array('title' => 'トップページ', 'name' => 'index', 'parent' => '');
    // $pages_array[] = array('title' => 'お知らせ', 'name' => 'news', 'parent' => '');
    $pages_array[] = array('title' => 'エントリー', 'name' => 'entry', 'parent' => '');

    $pages_array[] = array('title' => '代表者メッセージ', 'name' => 'message', 'parent' => '');

    $pages_array[] = array('title' => '働く環境を知る', 'name' => 'culture', 'parent' => '');
    $pages_array[] = array('title' => '数字で見る日本ファブテック', 'name' => 'data', 'parent' => 'culture');
    $pages_array[] = array('title' => 'キャリアパス', 'name' => 'career', 'parent' => 'culture');
    $pages_array[] = array('title' => '福利厚生', 'name' => 'welfare', 'parent' => 'culture');
    $pages_array[] = array('title' => '社内研修制度', 'name' => 'training', 'parent' => 'culture');
    $pages_array[] = array('title' => 'よくある質問', 'name' => 'faq', 'parent' => 'culture');

    $pages_array[] = array('title' => '人を知る', 'name' => 'people', 'parent' => '');
    $pages_array[] = array('title' => '石野 達也', 'name' => 'people01', 'parent' => 'people');
    $pages_array[] = array('title' => '川筋 紳平', 'name' => 'people02', 'parent' => 'people');
    $pages_array[] = array('title' => '勝 大地', 'name' => 'people03', 'parent' => 'people');
    $pages_array[] = array('title' => '加藤 由梨', 'name' => 'people04', 'parent' => 'people');
    $pages_array[] = array('title' => '大田 直矢', 'name' => 'people05', 'parent' => 'people');
    $pages_array[] = array('title' => '清水 織恵', 'name' => 'people06', 'parent' => 'people');
    $pages_array[] = array('title' => '諸岡 寛紀', 'name' => 'people07', 'parent' => 'people');
    $pages_array[] = array('title' => '皆川 拓哉', 'name' => 'people08', 'parent' => 'people');

    $pages_array[] = array('title' => '募集要項', 'name' => 'requirements', 'parent' => '');
    $pages_array[] = array('title' => '新卒募集要項', 'name' => 'new', 'parent' => 'requirements');
    $pages_array[] = array('title' => 'キャリア採用募集要項', 'name' => 'career', 'parent' => 'requirements');
    $pages_array[] = array('title' => 'インターンシップ募集要項', 'name' => 'internship', 'parent' => 'requirements');


    // 初期サンプルページ削除
    wp_delete_post(1, true);
    wp_delete_post(2, true);
    wp_delete_post(3, true);

    if (!isset($pages_array)) return;
    foreach ($pages_array as $value) {
      $this->settign_pages($value);
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
          'post_status'  => 'publish',
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
}

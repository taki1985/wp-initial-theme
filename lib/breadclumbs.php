<?php
if (!defined('ABSPATH')) {
	exit;
}

// パンくずリスト
function my_breadcrumb()
{
	global $post;
	$str = '';
	if (!is_front_page() && !is_admin()) { /* !is_admin は管理ページ以外という条件分岐 */
		$str .= '<ol class="list-inline" itemscope itemtype="http://schema.org/BreadcrumbList">';
		$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . home_url('/') . '" class="home" itemprop="item" ><span itemprop="name">採用サイト トップページ</span></a><meta itemprop="position" content="1" /></li>';

		/* 投稿のページ */
		if (is_single()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_permalink(get_page_by_path('news')->ID) . '" itemprop="item" ><span itemprop="name">お知らせ一覧</span></a><meta itemprop="position" content="2" /></li>';
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . mb_strimwidth($post->post_title, 0, 40, '…', 'UTF-8') . '</span><meta itemprop="position" content="3" /></li>';
		}

		/* 固定ページ */ elseif (is_page()) {

			if ($post->post_parent != 0) {
				$ancestors = array_reverse(get_post_ancestors($post->ID));
				foreach ($ancestors as $ancestor) {
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_permalink($ancestor) . '" itemprop="item" ><span itemprop="name">' . get_the_title($ancestor) . '</span></a><meta itemprop="position" content="2" /></li>';
				}
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $post->post_title . '</span><meta itemprop="position" content="3" /></li>';
			} else {
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $post->post_title . '</span><meta itemprop="position" content="2" /></li>';
			}
		}

		/* カテゴリページ */ elseif (is_category()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_permalink(get_page_by_path('news')->ID) . '" itemprop="item" ><span itemprop="name">お知らせ一覧</span></a><meta itemprop="position" content="2" /></li>';

			$cat  = get_queried_object();
			if ($cat->parent != 0) {
				$ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
				foreach ($ancestors as $ancestor) {
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_category_link($ancestor) . '" itemprop="item" ><span itemprop="name">' . get_cat_name($ancestor) . '</span></a><meta itemprop="position" content="3" /></li>';
				}
			}

			if (is_date()) {
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_category_link($cat->term_id) . '" itemprop="item" ><span itemprop="name">' . $cat->name . '</span></a><meta itemprop="position" content="3" /></li>';

				if (get_query_var('day') != 0) {
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_year_link(get_query_var('year')) . '" itemprop="item" ><span itemprop="name">' . get_query_var('year') . '年</span></a><meta itemprop="position" content="4" /></li>';
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_month_link(get_query_var('year'), get_query_var('monthnum')) . '" itemprop="item" ><span itemprop="name">' . get_query_var('monthnum') . '月</span></a><meta itemprop="position" content="5" /></li>';
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('day') . '日</span><meta itemprop="position" content="6" /></li>';
				} elseif (get_query_var('monthnum') != 0) {
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_year_link(get_query_var('year')) . '" itemprop="item" ><span itemprop="name">' . get_query_var('year') . '年</span></a><meta itemprop="position" content="4" /></li>';
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('monthnum') . '月</span><meta itemprop="position" content="5" /></li>';
				} else {
					$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('year') . '年</span><meta itemprop="position" content="4" /></li>';
				}
			} else {
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $cat->name . '</span><meta itemprop="position" content="3" /></li>';
			}
		}

		/* タグページ */ elseif (is_tag()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . single_tag_title('', false) . '</span><meta itemprop="position" content="3" /></li>';
		}


		/* タクソノミーページ */ elseif (is_tax('product_category')) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="item" ><span itemprop="name">製品紹介</span></span><meta itemprop="position" content="2" /></li>';
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . single_term_title('', false) . '</span><meta itemprop="position" content="2" /></li>';
		}

		/* タクソノミーページ */ elseif (is_tax()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . single_term_title('', false) . '</span><meta itemprop="position" content="2" /></li>';
		}

		/* 投稿アーカイブ*/ elseif (is_post_type_archive('post')) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . 'お知らせ一覧' . '</span><meta itemprop="position" content="2" /></li>';
		}

		/* カスタム投稿タイプのアーカイブ*/ elseif (is_post_type_archive()) {
			$cpt  = get_query_var('post_type');
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_post_type_object($cpt)->label . '一覧</span><meta itemprop="position" content="2" /></li>';
		}

		/* 時系列アーカイブページ */ elseif (is_date()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_permalink(get_page_by_path('news')->ID) . '" itemprop="item" ><span itemprop="name">お知らせ一覧</span></a><meta itemprop="position" content="2" /></li>';
			if (get_query_var('day') != 0) {
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_year_link(get_query_var('year')) . '" itemprop="item" ><span itemprop="name">' . get_query_var('year') . '年</span></a><meta itemprop="position" content="3" /></li>';
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_month_link(get_query_var('year'), get_query_var('monthnum')) . '" itemprop="item" ><span itemprop="name">' . get_query_var('monthnum') . '月</span></a><meta itemprop="position" content="4" /></li>';
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('day') . '日</span><meta itemprop="position" content="5" /></li>';
			} elseif (get_query_var('monthnum') != 0) {
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_year_link(get_query_var('year')) . '" itemprop="item" ><span itemprop="name">' . get_query_var('year') . '年</span></a><meta itemprop="position" content="3" /></li>';
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('monthnum') . '月</span><meta itemprop="position" content="4" /></li>';
			} else {
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . get_query_var('year') . '年</span><meta itemprop="position" content="5" /></li>';
			}
		}

		/* 投稿者ページ */ elseif (is_author()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">投稿者 : ' . get_the_author_meta('display_name', get_query_var('author')) . '</span><meta itemprop="position" content="3" /></li>';
		}

		/* 添付ファイルページ */ elseif (is_attachment()) {
			if ($post->post_parent != 0) {
				$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_permalink($post->post_parent) . '" itemprop="item" ><span itemprop="name">' . get_the_title($post->post_parent) . '</span></a><meta itemprop="position" content="2" /></li>';
			}
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $post->post_title . '</span><<meta itemprop="position" content="3" />/li>';
		}

		/* 検索結果ページ */ elseif (is_search()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">「' . get_search_query() . '」で検索した結果</span><meta itemprop="position" content="2" /></li>';
		}

		/* 404 Not Found ページ */ elseif (is_404()) {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">お探しのページは見つかりませんでした。</span><meta itemprop="position" content="2" /></li>';
		}

		/* その他のページ */ else {
			$str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . wp_title('', false) . '</span><meta itemprop="position" content="2" /></li>';
		}
		$str .= '</ol>';
	}
	echo $str;
}

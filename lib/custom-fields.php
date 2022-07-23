<?php
if (!defined('ABSPATH')) {
	exit;
}
/*
------------------------------------
------------------------------------
custom-fields.php
カスタムフィールド設定
------------------------------------
------------------------------------
*/


if (!class_exists('MY_THEME_ADMIN')) {
	exit;
}

class MY_THEME_CUSTOM_FILED
{

	function __construct()
	{
		add_action('admin_menu', array($this, 'add_news_fields'));
		add_action('transition_post_status', array($this, 'transition_post_status_4536'), 10, 3);
	}

	/**
	 * カスタムフィールド登録
	 */
	function add_news_fields()
	{
		// add_meta_box(表示される入力ボックスのHTMLのID, ラベル, 表示する内容を作成する関数名, 投稿タイプ, 表示方法)
		// 第4引数のpostをpageに変更すれば固定ページにオリジナルカスタムフィールドが表示されます(custom_post_typeのslugを指定することも可能)。
		// 第5引数はnormalの他にsideとadvancedがあります。
		add_meta_box('news_setting', 'お知らせ一覽表示方法', array($this,  'insert_news_fields'), 'post', 'normal');
	}

	// カスタムフィールドの入力エリア
	function insert_news_fields()
	{
		global $post;
		$is_txt_check = '';
		if (get_post_meta($post->ID, 'is_txt', true) == 'is-on') {
			$is_txt_check = 'checked';
		}

		echo '<table class="form-table">';
		echo '<tr><th scope="row"><label for="is_txt">リンクなし</label></th><td><input type="checkbox" name="is_txt" type="text" id="is_txt"  value="is-on" ' . $is_txt_check . '><p class="description" id="tagline-description">記事タイトルをそのまま表示させます。</p></td></tr>';
		echo '<tr><th scope="row"><label for="url">URL</label></th><td><input type="text" name="url" type="text" id="url"  value="' . get_post_meta($post->ID, 'url', true) . '" size="50" /><p class="description" id="tagline-description">指定ページ・外部記事・PDFへのリンクの場合URLを入力してください。</p></td></tr>';
		echo '</table>';
	}


	function transition_post_status_4536($new_status, $old_status, $post)
	{
		if (($old_status == 'auto-draft'
				|| $old_status == 'draft'
				|| $old_status == 'pending'
				|| $old_status == 'future')
			&& $new_status == 'publish'
		) {
			return $post;
		} else {
			add_action('save_post', array($this, 'save_custom_fields'));
		}
	}

	// カスタムフィールドの値を保存
	function save_custom_fields($post_id)
	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		if (isset($_POST['action']) && $_POST['action'] == 'inline-save') return $post_id;
		if (!empty($_POST['url']))
			update_post_meta($post_id, 'url', $_POST['url']);
		else delete_post_meta($post_id, 'url');

		if (!empty($_POST['is_txt']))
			update_post_meta($post_id, 'is_txt', $_POST['is_txt']);
		else delete_post_meta($post_id, 'is_txt');
	}
}

<?php
if (!defined('ABSPATH')) {
	exit;
}
/* サイドバー */
?>
<div class="col-side" id="sidebar">
	<aside class="block-aside mb-30">
		<h3 class="ttl-side">
			<span class="ja">カテゴリー</span>
			<span class="en">CATEGORY</span>
		</h3>
		<ul class="list-side">
			<?php if (is_post_type_archive('column') || is_singular('column') || is_tax('column_category')) : ?>
				<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'column_category', 'show_count' => 0)); ?>
			<?php else : ?>
				<?php wp_list_categories('depth=1&title_li='); ?>
			<?php endif; ?>
		</ul>
	</aside>

	<aside class="block-aside mb-20">
		<h3 class="ttl-side">
			<span class="ja">月別アーカイブ</span>
			<span class="en">ARCHIVE</span>
		</h3>
		<ul class="list-side">
			<?php if (is_post_type_archive('column') || is_singular('column') || is_tax('column_category')) : ?>
				<?php wp_get_archives('type=monthly&post_type=column'); ?>
			<?php else : ?>
				<?php wp_get_archives(); ?>
			<?php endif; ?>
		</ul>
	</aside>

</div>
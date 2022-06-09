<?php

/**
 * 404
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<div class="pgttl--simplified">
	<div class="pgttl__container container-lg">
		<div class="pgttl__content">
			<p class="pgttl__en">
				404 Not Found
			</p>
			<h1 class="pgttl__ja">ページが見つかりません</h1>
		</div>
	</div>
</div>
<?php get_template_part('parts/breadcrumbs'); ?>

<div class="section-lg">
	<div class="container-md">
		<p class="lead-text text-center">
			お探しのページが見つかりません。
		</p>
		<p class="block-child text-center-pc">
			webサイトのリンク（URL）が変更または削除された可能性があります。<br>
			ブックマーク登録されていた方は、お手数ですがブックマークの変更をお願いいたします。
		</p>
	</div>
</div>

<?php get_footer(); ?>
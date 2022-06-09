<?php

/**
 * お知らせアーカイブ
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
				NEWS
			</p>
			<h1 class="pgttl__ja">お知らせ</h1>
		</div>
	</div>
</div>

<?php get_template_part('parts/breadcrumbs'); ?>

<div class="section-lg">
	<div class="container-lg row-container--b">
		<div class="row-container__side">
			<div class="block-aside">
				<p class="side-title js-openToggle">Category</p>
				<ul class="list-side js-openToggleTarget">
					<li <?php if (is_home() || is_post_type_archive('post')) echo 'class="current-cat"'; ?>>
						<a href="<?php echo get_permalink(get_page_by_path('news')->ID); ?>">ALL</a>
					</li>
					<?php wp_list_categories('depth=1&title_li=&hide_empty=0'); ?>
				</ul>
			</div>
			<div class="block-aside">
				<p class="side-title js-openToggle">Archive</p>
				<div class="block-child--sm js-openToggleTarget">
					<select class="archive-dropdown" name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
						<option value=""><?php echo esc_attr(__('Select Month')); ?></option>>
						<?php wp_get_archives(array('type' => 'monthly', 'format' => 'option', 'show_post_count' => 1)); ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row-container__content">
			<div class="block-child">
				<?php if (have_posts()) : ?>
					<?php if ($year || $cat || is_tag()) : ?>
						<h2 class="tl-title">
							<?php if ($year) {
								echo $year . '年';
								if ($monthnum) {
									echo $monthnum . '月 : ';
								}
							} ?>
							<?php if ($cat) {
								single_cat_title(); ?> :<?php } ?>
								<?php if (is_tag()) { ?><?php single_tag_title(); ?> :<?php } ?>
								<span class="tl-title__min">記事一覧</span>
						</h2>
					<?php endif; ?>
					<div class="block-child--sm">
						<ul class="list-news">
							<?php while (have_posts()) : the_post();
								get_template_part('parts/news', 'list');
							endwhile; ?>
						</ul>
					</div>
					<?php original_page_navi(); ?>
				<?php else : ?>
					<div class="section-xxl post-content">
						<p class="txt-center txt-18">
							こちらのページは現在準備中です。<br>
							公開まで今しばらくお待ちください。
						</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
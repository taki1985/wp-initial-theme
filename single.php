<?php

/**
 * お知らせ詳細
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
				<?php if (have_posts()) :
					while (have_posts()) :
						the_post(); ?>
						<article class="post-single" role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

							<div class="post-single__meta">
								<div class="post-single__time"><?php the_time('Y.m.d'); ?></div>
								<div class="post-single__cats">
									<?php
									$categories = get_the_category();
									foreach ($categories as $category) :
									?>
										<span class="list-news__cat">
											<?php echo $category->cat_name; ?>
										</span>
									<?php endforeach; ?>
								</div>
							</div>
							<h1 class="post-single__title">
								<?php the_title(); ?>
							</h1>
							<div class="post-content" itemprop="articleBody">
								<?php
								the_content();
								?>
							</div>
						</article>

				<?php endwhile;
				endif; ?>
				<hr>
				<div class="block-child">
					<a href="<?php echo get_permalink(get_page_by_path('news')->ID); ?>" class="btn--outline btn--back"><span class="link-arrow link-arrow--back"></span>一覧へ戻る</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
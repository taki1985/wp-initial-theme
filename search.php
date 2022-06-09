<?php

/**
 * 検索結果
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<div class="pgttl simple">
	<div class="txt-pgttl">
		<div class="en">
			<p data-aos="slide-cover"><span><span><span class="aos-txt">SEARCH RESULT</span></span></p>
		</div>
		<h1 class="ja" data-aos="slide-cover"><span><span><span class="aos-txt">検索結果</span></h1>
	</div>
</div>

<?php get_template_part('parts', 'breadcrumbs'); ?>

<div class="section-xxl">
	<div class="container-md">
		<?php if (have_posts()) : ?>
			<ul class="list-news mb-30">
				<?php while (have_posts()) : the_post();
					get_template_part('parts/news', 'list');
				endwhile; ?>
			</ul>

			<?php original_page_navi(); ?>
		<?php else : ?>

			<section class="section-xl page-content">
				<p class="txt-center txt-18">
					検索結果はありませんでした。
				</p>
			</section>

		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
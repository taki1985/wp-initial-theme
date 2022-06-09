<?php

/**
 * 固定ページテンプレート
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>
<?php
while (have_posts()) :
	the_post();
?>
	<div class="pgttl">
		<div class="pgttl__container container-lg">
			<div class="pgttl__content">
				<p class="pgttl__en">
					<?php
					$slug = $post->post_name;
					$slug = str_replace("-", "&nbsp;", $slug);
					$slug = str_replace("_", "&nbsp;", $slug);
					echo $slug;
					?>
				</p>
				<h1 class="pgttl__ja"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
	<?php get_template_part('parts/breadcrumbs'); ?>

	<div class="section-lg">
		<div class="container-md">
			<div role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>

<?php endwhile; ?>
<?php get_footer(); ?>
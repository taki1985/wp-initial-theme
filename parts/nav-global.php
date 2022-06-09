<?php

/**
 * ヘッダーパーツ
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'class'          => '',
	)
);

?>

<header class="header<?php if (!is_front_page()) {
												echo " header--filled";
											} ?>">
	<?php $tag = (is_front_page()) ? 'h1' : 'div'; ?>
	<<?php echo $tag; ?> class="header__logo">
		<a href="<?php echo home_url(); ?>" class="header__logo-inner">
			<?php bloginfo('name'); ?>
		</a>
	</<?php echo $tag; ?>>

	<button type="button" class="header__toggle offcanvas-toggle" data-toggle="offcanvas" data-target="#nav-menu">
		<span class="header__toggle-bar"></span>
		<span class="header__toggle-bar"></span>
		<span class="header__toggle-bar"></span>
	</button>

	<div class="header__nav-wrapper navbar-offcanvas" id="nav-menu">
		<nav class="nav-global">
			<ul class="nav-global__list">
				<li class="nav-global__item visible-xs">
					<a href="<?php echo home_url(); ?>" <?php if (is_front_page()) echo "data-isCurrent='true'"; ?>>
						トップページ
					</a>
				</li>

				<li class="nav-global__item nav-global__item--dropdown">
					<a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>" <?php if (is_page("company") || is_ancestor('company')) echo "data-isCurrent='true'" ?>>
						会社情報
					</a>
					<div class="dropdown-menu">
						<div class="dropdown-menu__container container-lg">
							<div class="dropdown-menu__top">
								<div class="dropdown-menu__title">
									<p class="dropdown-menu__title-en">Company</p>
									<p class="dropdown-menu__title-ja">会社情報</p>
								</div>
								<a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>" class="dropdown-menu__btn">View More<span class="link-arrow"></span></a>
							</div>
							<ul class="dropdown-nav">
								<?php
								$children = [
									array(
										'slug'     => "company/network",
										'thumb'    => "company-network",
										'text'     => "拠点一覧"
									),
									array(
										'slug'     => "company/data",
										'thumb'    => "company-data",
										'text'     => "会社概要"
									),
									array(
										'slug'     => "company/organization",
										'thumb'    => "company-organization",
										'text'     => "機構図"
									),
									array(
										'slug'     => "company/directors",
										'thumb'    => "company-directors",
										'text'     => "役員紹介"
									),
									array(
										'slug'     => "company/history",
										'thumb'    => "company-history",
										'text'     => "沿革"
									),
									array(
										'slug'     => "company/activity",
										'thumb'    => "company-activity",
										'text'     => "企業としての取り組み"
									),
								];
								foreach ($children as $child) {
									$args = array(
										'slug'     => $child["slug"],
										'thumb'    => $child["thumb"],
										'text'     => $child["text"],
									);
									get_template_part('parts/nav', 'global-children', $args);
								}
								?>
							</ul>
						</div>
					</div>
				</li>

				<li class="nav-global__item nav-global__item--dropdown">
					<a href="<?php echo get_permalink(get_page_by_path('products')->ID); ?>" <?php if (is_page("products") || is_ancestor('products')) echo "data-isCurrent='true'" ?>>
						事業紹介
					</a>
					<div class="dropdown-menu">
						<div class="dropdown-menu__container container-lg">
							<div class="dropdown-menu__top">
								<div class="dropdown-menu__title">
									<p class="dropdown-menu__title-en">Business</p>
									<p class="dropdown-menu__title-ja">事業紹介</p>
								</div>
								<a href="<?php echo get_permalink(get_page_by_path('products')->ID); ?>" class="dropdown-menu__btn">View More<span class="link-arrow"></span></a>
							</div>
							<ul class="dropdown-nav dropdown-nav--min">
								<?php
								$children = [
									array(
										'slug'     => "products/bridge",
										'thumb'    => "products-bridge",
										'text'     => "橋梁事業"
									),
									array(
										'slug'     => "products/iron",
										'thumb'    => "products-iron",
										'text'     => "鉄骨事業"
									),
									array(
										'slug'     => "products/rebri",
										'thumb'    => "products-rebri",
										'text'     => "Re-BRI[リブリ]"
									),
									array(
										'slug'     => "products/job",
										'thumb'    => "products-job",
										'text'     => "わたしたちのしごと（旧東京鐵骨橋梁）"
									),
								];
								foreach ($children as $child) {
									$args = array(
										'slug'     => $child["slug"],
										'thumb'    => $child["thumb"],
										'text'     => $child["text"],
									);
									get_template_part('parts/nav', 'global-children', $args);
								}
								?>
							</ul>
						</div>
					</div>
				</li>

				<li class="nav-global__item">
					<a href="<?php echo get_permalink(get_page_by_path('making')->ID); ?>" <?php if (is_page("making") || is_ancestor('making')) echo "data-isCurrent='true'" ?>>
						製品が<br class="visible-sm">できるまで
					</a>
				</li>

				<li class="nav-global__item">
					<a href="<?php echo get_permalink(get_page_by_path('works')->ID); ?>" <?php if (is_page("works") || is_ancestor('works')) echo "data-isCurrent='true'" ?>>
						事例検索
					</a>
				</li>

				<li class="nav-global__item nav-global__item--dropdown">
					<a href="<?php echo get_permalink(get_page_by_path('technology')->ID); ?>" <?php if (is_page("technology") || is_ancestor('technology')) echo "data-isCurrent='true'" ?>>
						技術情報
					</a>
					<div class="dropdown-menu">
						<div class="dropdown-menu__container container-lg">
							<div class="dropdown-menu__top">
								<div class="dropdown-menu__title">
									<p class="dropdown-menu__title-en">Technology</p>
									<p class="dropdown-menu__title-ja">技術情報</p>
								</div>
								<a href="<?php echo get_permalink(get_page_by_path('technology')->ID); ?>" class="dropdown-menu__btn">View More<span class="link-arrow"></span></a>
							</div>
							<ul class="dropdown-nav dropdown-nav--min">
								<?php
								$children = [
									array(
										'slug'     => "technology/laboratory",
										'thumb'    => "technology-laboratory",
										'text'     => "技術研究所"
									),
									array(
										'slug'     => "technology/iron",
										'thumb'    => "technology-iron",
										'text'     => "技術紹介（鉄骨）"
									),
									array(
										'slug'     => "technology/bridge",
										'thumb'    => "technology-bridge",
										'text'     => "技術紹介（橋梁）"
									),
									array(
										'slug'     => "technology/archives",
										'thumb'    => "technology-archives",
										'text'     => "日本ファブテック技報"
									),
								];
								foreach ($children as $child) {
									$args = array(
										'slug'     => $child["slug"],
										'thumb'    => $child["thumb"],
										'text'     => $child["text"],
									);
									get_template_part('parts/nav', 'global-children', $args);
								}
								?>
							</ul>
						</div>
					</div>
				</li>

				<li class="nav-global__item">
					<a href="<?php echo get_permalink(get_page_by_path('recruit')->ID); ?>" <?php if (is_page("recruit") || is_ancestor('recruit')) echo "data-isCurrent='true'" ?>>
						採用情報
					</a>
				</li>

				<li class="nav-global__item nav-global__item--btn">
					<a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>" <?php if (is_page("contact") || is_ancestor('contact')) echo "data-isCurrent='true'" ?>>
						<span class="icon"><img src="<?php echo IMG_URI; ?>/common/icon-mail.svg" alt=""></span>
						<span class="text">お問い合わせ</span>
					</a>
				</li>

			</ul>
		</nav>
	</div>

</header>

<main class="main">
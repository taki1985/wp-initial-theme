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

<header id="header" class="header<?php if (!is_front_page()) {
																		echo " header--filled";
																	} ?>">
	<?php $tag = (is_front_page()) ? 'h1' : 'div'; ?>
	<<?php echo $tag; ?> class="header__logo">
		<a href="<?php echo home_url(); ?>" class="header__logo-inner">
			<?php bloginfo('name'); ?>
		</a>
	</<?php echo $tag; ?>>

	<button type="button" class="header__toggle js-toggleDrawer" aria-controls="drawer" aria-expanded="false">
		<span class="header__toggle-bar"></span>
		<span class="header__toggle-bar"></span>
		<span class="header__toggle-bar"></span>
	</button>

	<div id="drawer" class="header__nav-wrapper js-drawer drawer" aria-hidden="true">
		<div class="drawer__backdrop js-backdrop"></div>
		<div class="drawer__inner">
			<nav id="navGlobal" class="nav-global">
				<ul class="nav-global__list">
					<li class="nav-global__item visible-xs">
						<a href="<?php echo home_url(); ?>" <?php if (is_front_page()) echo "data-isCurrent='true'"; ?>>
							トップページ
						</a>
					</li>

					<li class="nav-global__item--dropdown">
						<a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>" <?php if (is_page("company") || my_is_ancestor('company')) echo "data-isCurrent='true'" ?>>
							会社情報
						</a>
						<div class="dropdown-menu" aria-hidden="true">
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
											'text'     => "拠点一覧",
											"hash"     => "security"
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
											'hash'     => isset($child["hash"]) ? $child["hash"] : "",
										);
										get_template_part('parts/nav', 'global-children', $args);
									}
									?>
								</ul>
							</div>
						</div>
					</li>

					<li class="nav-global__item--dropdown">
						<a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>" <?php if (is_page("company") || my_is_ancestor('company')) echo "data-isCurrent='true'" ?>>
							会社情報2
						</a>
						<div class="dropdown-menu" aria-hidden="true">
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

					<li class="nav-global__item">
						<a href="<?php echo get_post_type_archive_link('work'); ?>" <?php if (is_post_type_archive('work')) echo "data-isCurrent='true'" ?>>
							実績紹介
						</a>
					</li>

					<li class="nav-global__item">
						<a href="<?php echo get_permalink(get_page_by_path('news')->ID); ?>" <?php if (is_page("news") || is_home() || is_singular('post') || is_category()) echo "data-isCurrent='true'"; ?>>
							お知らせ
						</a>
					</li>

					<li class="nav-global__item--btn">
						<a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>" <?php if (is_page("contact") || my_is_ancestor('contact')) echo "data-isCurrent='true'" ?>>
							<span class="icon"><img src="<?php echo IMG_URI; ?>/common/icon-mail.svg" alt=""></span>
							<span class="text">お問い合わせ</span>
						</a>
					</li>

				</ul>
			</nav>
		</div>
	</div>

</header>

<main class="main">
<?php

/**
 * フッターパーツ
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
</main>

<?php if (!is_page("contact")) : ?>
	<section class="section-contact">
		<div class=" section-contact__container container-lg">
			<a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>" class="section-contact__linkarea">
				<div class="section-contact__content">
					<div class="section-contact__title section-title">
						<p class="section-title__en">
							Contact
						</p>
						<h2 class="section-title__ja">お問い合わせ</h2>
					</div>
					<div class="section-contact__text">
						お問い合わせ・資料請求、ご質問等はこちらの<br class="hidden-xs">フォームからお願い致します。
					</div>
				</div>
				<span class="link-arrow link-arrow--white link-arrow--lg"></span>
			</a>
		</div>
	</section>
<?php endif; ?>

<footer class="footer">
	<div class="footer__container container-lg">
		<div class="footer-company">
			<h2 class="footer-company__logo">
				<a href="<?php echo home_url(); ?>" class="footer__logo-img"><img src="<?php echo IMG_URI; ?>/common/logo-white.png" alt="<?php bloginfo('name'); ?>"></a>
			</h2>
		</div>
		<div class="footer__nav">
			<ul class="footer__list">
				<li><a href="<?php echo home_url(); ?>"><span class="link-arrow link-arrow--white"></span>トップページ</a></li>
				<li><a href="<?php echo get_permalink(get_page_by_path('news')->ID); ?>"><span class="link-arrow link-arrow--white"></span>お知らせ</a></li>
			</ul>
			<ul class="footer__list footer__list--long">
				<li>
					<a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>"><span class="link-arrow link-arrow--white"></span>会社情報</a>
					<ul class="footer__list--child">
						<li>
							<a href="<?php echo get_permalink(get_page_by_path('company/network')->ID); ?>">
								拠点一覧
							</a>
						</li>
						<li>
							<a href="<?php echo get_permalink(get_page_by_path('company/data')->ID); ?>">
								会社概要
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="footer-bottom__container container-lg">
			<div class="footer-bottom__other">
				<ul class="footer-bottom__other-list">
					<li><a href="<?php echo get_permalink(get_page_by_path('privacy')->ID); ?>">プライバシーポリシー</a></li>
					<li><a href="<?php echo get_permalink(get_page_by_path('guideline')->ID); ?>">サイトのご利用について</a></li>
				</ul>
				<p class="footer-bottom__copy">
					© ------. All rights reserved.
				</p>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
<script>
	scrolltotop.controlHTML = '<span class="txt">PAGE TOP<' + '/span>';
	scrolltotop.init();
</script>
</body>

</html>
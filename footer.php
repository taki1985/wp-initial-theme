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
		'property'          => '',
	)
);
?>
</main>

<div class="footer-wrapper<?php echo $args["property"]; ?>">

  <?php if (!is_page("contact")) : ?>
  <section class="common-contact">
    <div class="common-contact__container">
      <div class="common-contact__header">
        <div class="common-contact__title">
          <div class="top-h2--white">
            <p class="top-h2__en">
								Contact
							</p>
            <h2 class="top-h2__ja">
								お問い合わせ
							</h2>
          </div>
        </div>
      </div>
      <div class="common-contact__main">
        <div class="common-contact__col">
          <div class="common-contact-block">
            <p class="common-contact-block__title">
								お電話でのお問い合わせ
							</p>
            <div class="common-contact-block__main">
              <div class="common-contact-block__tel">
                <?php get_template_part('components/telBlock'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="common-contact__col">
          <div class="common-contact-block">
            <p class="common-contact-block__title">
								メールでのお問い合わせ
							</p>
            <div class="common-contact-block__main">
              <a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>" class="common-contact-btn">
                <span class="common-contact-btn__icon">
                  <svg width="24" height="24">
											<use xlink:href="#contact"></use>
										</svg>
                </span>
                <span class="common-contact-btn__text">
                  メールフォーム
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <footer class="footer">
    <div class="footer__container">
      <a href="#pagetop" id="pagetopbtn" class="pagetopbtn" title="Scroll Back to Top"><span class="pagetopbtn__text">PAGE TOP</span></a>

      <div class="footer__nav">
        <ul class="footer-list">
          <li><a href="<?php echo home_url(); ?>">トップページ</a></li>
          <li><a href="<?php echo get_permalink(get_page_by_path('about')->ID); ?>">光翔について</a></li>
          <li><a href="<?php echo get_permalink(get_page_by_path('flow')->ID); ?>">ご利用の流れ</a></li>
        </ul>
        <ul class="footer-list">
          <li><a href="<?php echo get_permalink(get_page_by_path('service')->ID); ?>">業務内容</a></li>
          <li><a href="<?php echo get_post_type_archive_link('works'); ?>">施工事例</a></li>
          <li><a href="<?php echo get_permalink(get_page_by_path('company')->ID); ?>">会社案内</a></li>
        </ul>
        <ul class="footer-list">
          <li><a href="<?php echo get_permalink(get_page_by_path('staf')->ID); ?>">スタッフ紹介</a></li>
          <li><a href="<?php echo get_permalink(get_page_by_path('blog')->ID); ?>">ブログ</a></li>
          <li><a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>">お問い合わせ</a></li>
        </ul>
      </div>

      <p class="footer__copy">
				<small>©KOHSHO</small>
			</p>
    </div>
  </footer>
</div>
</div>
<!-- /.page-wrapper -->

<?php if (!is_page("contact")) : ?>
<div class="fixed-btns">
  <span class="fixed-btns__spacer"></span>
  <div class="fixed-btns__main">
    <div class="fixed-btns__tel">
      <?php get_template_part('components/telBlock'); ?>
    </div>
    <a href="<?php echo get_permalink(get_page_by_path('contact')->ID); ?>" class="fixed-btns__btn">
      <span class="fixed-btns__icon">
        <svg width="24" height="24">
						<use xlink:href="#contact"></use>
					</svg>
      </span>
      <span class="fixed-btns__text">
        無料見積り・お問い合わせ
      </span>
    </a>
  </div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>

</html>
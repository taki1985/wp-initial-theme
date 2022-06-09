<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/* 検索フォーム */
?>
<form method="get" class="searchform mb-30" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <input type="text" placeholder="記事を探す" name="s" class="searchfield" value="" />
  <input type="submit" value="" alt="検索" title="検索" class="searchsubmit">
</form>

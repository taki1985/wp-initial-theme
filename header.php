<?php

/**
 * ヘッダー
 *
 * @package WordPress
 */
if (!defined('ABSPATH')) {
	exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="keywords" content="">
	<meta name="description" content="<?php if (is_single()) {
																			single_post_title('', true);
																		} else {
																			bloginfo('description');
																		} ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_html(T_DIRE_URI); ?>/apple-touch-icon.png">
	<link rel="icon" href="<?php echo esc_html(T_DIRE_URI); ?>/favicon.ico">
	<!--[if IE]>
	<link rel="shortcut icon" href="<?php echo esc_html(T_DIRE_URI); ?>/favicon.ico">
<![endif]-->
	<?php /* WordPress head functions*/ ?>
	<?php wp_head(); ?>
	<?php /* Wend of WordPress head */ ?>
</head>

<body id="pagetop" <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php get_template_part('parts/icons'); ?>
	<?php get_template_part('parts/nav', 'global'); ?>
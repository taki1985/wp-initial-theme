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
  <link rel="icon" href="<?php echo esc_html(T_DIRE_URI); ?>/favicon.ico" sizes="any">
  <link rel="icon" href="<?php echo esc_html(T_DIRE_URI); ?>/favicon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="<?php echo esc_html(T_DIRE_URI); ?>/apple-touch-icon.png">
  <link rel="manifest" href="<?php echo esc_html(T_DIRE_URI); ?>/site.webmanifest">
  <meta name="theme-color" content="#ffffff">
  <?php /* WordPress head functions*/ ?>
  <?php wp_head(); ?>
  <?php /* Wend of WordPress head */ ?>
</head>

<body id="pagetop" <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
  <?php get_template_part('components/icons'); ?>
  <?php get_template_part('components/globalNav/index'); ?>
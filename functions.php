<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * テーマの基本サポート設定
 */
function devgloomyjp_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => 'メインメニュー',
	) );
}
add_action( 'after_setup_theme', 'devgloomyjp_setup' );

/**
 * style.css を読み込む
 */
function devgloomyjp_enqueue_assets() {
	wp_enqueue_style(
		'devgloomyjp-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'devgloomyjp_enqueue_assets' );

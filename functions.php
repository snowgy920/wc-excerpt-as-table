<?php

add_action('wp_enqueue_scripts', 'porto_child_css', 1001);

// Load CSS
function porto_child_css()
{
	// porto child theme styles
	wp_deregister_style('styles-child');
	wp_register_style('styles-child', esc_url(get_stylesheet_directory_uri()) . '/style.css');
	wp_enqueue_style('styles-child');

	if (is_rtl()) {
		wp_deregister_style('styles-child-rtl');
		wp_register_style('styles-child-rtl', esc_url(get_stylesheet_directory_uri()) . '/style_rtl.css');
		wp_enqueue_style('styles-child-rtl');
	}
}

add_action( 'wp_enqueue_scripts', 'porto_child_js', 1002 );
function porto_child_js() {
	wp_register_script( 'porto-child-js', esc_url( get_stylesheet_directory_uri() ) . '/custom.js', array('jquery'), '', true);
	wp_enqueue_script( 'porto-child-js' );
}

add_action( 'init', 'porto_child_init', 100 );
function porto_child_init() {
	// add_filter( 'porto_woocommerce_short_description_length', function(){
	// 	return 20;
	// });
	add_filter('woocommerce_short_description', 'porto_child_excerpt_table');
}

function porto_child_excerpt_table($description) {
	$content = get_the_excerpt();
	return $content;
}

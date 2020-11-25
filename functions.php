<?php

add_action('wp_enqueue_scripts', 'porto_child_css', 1001);

// Load CSS
function porto_child_css() {
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

add_action( 'init', 'porto_child_init', 100 );
function porto_child_init() {
	add_filter('woocommerce_short_description', 'porto_child_excerpt_table');
	add_filter('woocommerce_loop_add_to_cart_link', function($link){
		global $porto_settings;
		$catalog_mode   = false;
		if ( $porto_settings['catalog-enable'] ) {
			if ( $porto_settings['catalog-admin'] || ( ! $porto_settings['catalog-admin'] && ! ( current_user_can( 'administrator' ) && is_user_logged_in() ) ) ) {
				if ( ! $porto_settings['catalog-cart'] ) {
					$catalog_mode = true;
				}
			}
		}
		return $catalog_mode && !$porto_settings['catalog-readmore'] ? '' : $link;
	});
}

function porto_child_excerpt_table($description) {
	$content = get_the_excerpt();
	return $content;
}

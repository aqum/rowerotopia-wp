<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Alegreya:400,700|Lato:400,700&amp;subset=latin-ex' );
}

add_action( 'wp_enqueue_scripts', 'cleanup_parent_styles', 100 );
function cleanup_parent_styles() {
  wp_dequeue_style( 'twentyseventeen-fonts' );
  wp_deregister_style( 'twentyseventeen-fonts' );
}

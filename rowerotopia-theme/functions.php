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

add_action( 'after_setup_theme', 'image_sizes_setup' );
function image_sizes_setup() {
  add_image_size( 'rowerotopia-content', 800, 800 );
  add_image_size( 'rowerotopia-content-zoom', 1400, 1400 );
}

// [rt-image id="1"]
add_shortcode( 'rt-image', 'rt_image_shortcode' );
function rt_image_shortcode( $atts ) {
  $image_id = intval( $atts['id'] );

  $full_size_spec = wp_get_attachment_image_src( $image_id, 'rowerotopia-content-zoom' );

  var_dump(wp_get_attachment_caption( $image_id ));
  $html =
  '<figure class="wp-caption aligncenter rt-image-wide">'
    . '<a href="' . $full_size_spec[0] . '" class="rt-image-wide__image">'
      . wp_get_attachment_image( $image_id, 'rowerotopia-content' )
    . '</a>'
    . '<figcaption class="wp-caption-text">'
      . wp_get_attachment_caption( $image_id )
    . '</figcaption>'
  . '</figure>';

  return $html;
}

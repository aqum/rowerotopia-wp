<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Alegreya:400,700|Lato:400,700&amp;subset=latin-ext' );
  wp_enqueue_style( 'magnific-popup', 'https://unpkg.com/magnific-popup@1.1.0/dist/magnific-popup.css' );

  if ( is_page() || is_single() ) {
    wp_enqueue_script( 'magnific-popup', 'https://unpkg.com/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'post-scripts', get_stylesheet_directory_uri() . '/single.js', array( 'jquery' ) );
  }
}

// by some reason wordpress includes version of parent theme for child assets
function append_child_asset_version( $src ) {
	// Don't touch admin scripts
	if ( is_admin() )
		return $src;

  $child_version = wp_get_theme()->get('Version');

	return preg_replace( '/\.(js|css)\?ver=(.+)$/', '.$1', $src ) . '?' . $child_version;
}
add_filter( 'script_loader_src', 'append_child_asset_version' );
add_filter( 'style_loader_src', 'append_child_asset_version' );

add_action( 'wp_enqueue_scripts', 'cleanup_parent_styles', 100 );
function cleanup_parent_styles() {
  wp_dequeue_style( 'twentyseventeen-fonts' );
  wp_deregister_style( 'twentyseventeen-fonts' );
}

add_action( 'after_setup_theme', 'image_sizes_setup' );
function image_sizes_setup() {
  add_image_size( 'rowerotopia-thumbnail', 300, 300 );
  add_image_size( 'rowerotopia-content', 800, 800 );
  add_image_size( 'rowerotopia-content-zoom', 1400, 1400 );
}

// [rt-image id="1"]
add_shortcode( 'rt-image', 'rt_image_shortcode' );
function rt_image_shortcode( $atts ) {
  $image_id = intval( $atts['id'] );

  $full_size_spec = wp_get_attachment_image_src( $image_id, 'rowerotopia-content-zoom' );
  $small_size_spec = wp_get_attachment_image_src( $image_id, 'rowerotopia-content' );
  $caption = wp_get_attachment_caption( $image_id );

  $html =
    '<figure class="wp-caption aligncenter rt-image-wide">'
      . '<a href="' . $full_size_spec[0] . '" class="rt-image-wide__image" data-rt-lightbox-caption="' . $caption . '">'
        . '<img src="' . $small_size_spec[0] . '" alt="' . $caption . '">'
      . '</a>'
      . '<figcaption class="wp-caption-text">'
        . $caption
      . '</figcaption>'
    . '</figure>';

  return $html;
}

// [rt-gallery ids="1,2"]
add_shortcode( 'rt-gallery', 'rt_gallery_shortcode' );
function rt_gallery_shortcode( $atts ) {
  $image_ids = explode(',', $atts['ids']);

  $html = '<div class="rt-gallery">';

  foreach ($image_ids as $image_id_str) {
    $image_id = intval($image_id_str);
    $full_size_spec = wp_get_attachment_image_src( $image_id, 'rowerotopia-content-zoom' );
    $small_size_spec = wp_get_attachment_image_src( $image_id, 'rowerotopia-thumbnail' );
    $caption = wp_get_attachment_caption( $image_id );

    $html = $html
        . '<a href="' . $full_size_spec[0] . '" class="rt-gallery__image" data-rt-lightbox-caption="' . $caption . '">'
          . '<img src="' . $small_size_spec[0] . '" alt="' . $caption . '">'
        . '</a>';
  }

  $html = $html . '</div>';


  return $html;
}

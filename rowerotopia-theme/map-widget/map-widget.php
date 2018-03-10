<?php
  function appendScript($localFilePath, $slug)
  {
    wp_enqueue_script(
      $slug,
      get_stylesheet_directory_uri() . $localFilePath,
      array(),
      filemtime( get_stylesheet_directory() . $localFilePath )
    );
  }

  function appendStyle($localFilePath, $slug)
  {
    wp_enqueue_style(
      $slug,
      get_stylesheet_directory_uri() . $localFilePath,
      array(),
      filemtime( get_stylesheet_directory() . $localFilePath )
    );
  }

  wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.3.1/dist/leaflet.css');
  wp_enqueue_script('leaflet', 'https://unpkg.com/leaflet@1.3.1/dist/leaflet.js');
  appendStyle('/map-widget/assets/map-widget.css', 'map-widget');
  appendScript('/map-widget/assets/map-widget.js', 'map-widget');

  $args = array(
    'posts_per_page' => -1,
    'meta_key' => 'rowerotopia_coordinates',
  );
  $posts_array = get_posts($args);
  $create_map_post = function($post)
  {
    $coordinates_string = get_post_meta($post->ID, 'rowerotopia_coordinates', true);
    $cover_url = get_the_post_thumbnail_url($post->ID, 'medium');

    return array(
      'title' => $post->post_title,
      'coordinates' => explode(',', $coordinates_string),
      'coverUrl' => $cover_url,
      'url' => get_permalink($post->ID),
    );
  };
  $map_posts = array_map($create_map_post, $posts_array);
?>

<div id="rt-map" class="rt-map"></div>

<script>
  window.rt_routes = <?php echo json_encode($map_posts) ?>;
</script>

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

    return array(
      'title' => $post->post_title,
      'coordinates' => explode(',', $coordinates_string),
    );
  };
  $map_posts = array_map($create_map_post, $posts_array);
?>

<div class="wrap">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div class="rt-map-widget">
        <div class="widget">
          <h2 class="widget-title">Mapa moich wycieczek rowerowych</h2>

          <div id="rt-map" class="rt-map"></div>

          <script>
            window.rt_routes = <?php echo json_encode($map_posts) ?>;
          </script>
        </div>
      </div>
    </main>
  </div>
</div>

<?php get_header(); ?>

<?php 

$args = array(
	'posts_per_page' => -1,
	'meta_key' => 'rowerotopia_coordinates',
);
$posts_array = get_posts( $args );

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

    <style>
      #map {
        width: 100%;
        height: 300px;
      }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>

    <div id="map"></div>

    <script>
      const mapInstance = L.map('map').setView([52.069341, 19.480255], 5);
      const routes = <?php echo json_encode($map_posts) ?>;
      routes.forEach((routeSpec) => {
        L.marker(routeSpec.coordinates).addTo(mapInstance);
      });

      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
          '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
          'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.outdoors'
      }).addTo(mapInstance);

    </script>

    </main>
  </div>
</div>

<?php get_footer();

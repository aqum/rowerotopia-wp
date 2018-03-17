<?php
  $post_meta = get_post_meta( get_the_ID() );
  if ( !empty( $post_meta['rt_distance_km'] ) ): ?>
<section class="widget widget_text">
  <h2 class="widget-title">Statystyki trasy</h2>
  <div class="textwidget">
    <div class="rt-trip-stats">
      <div class="rt-trip-stat">
        <dt class="rt-trip-stat__label">Dystans</dt>
        <dl class="rt-trip-stat__value">
          <?php echo $post_meta['rt_distance_km'][0]; ?> km
          <br><a class="rt-trip-stat__link" href="#mapa">Mapa + GPX</a>
        </dl>
        <dt class="rt-trip-stat__label">Przewyższenie</dt>
        <dl class="rt-trip-stat__value">
          <?php echo $post_meta['rt_ascent_m'][0]; ?> m
        </dl>
        <dt class="rt-trip-stat__label">Dni</dt>
        <dl class="rt-trip-stat__value">
          <?php echo $post_meta['rt_days'][0]; ?>
        </dl>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

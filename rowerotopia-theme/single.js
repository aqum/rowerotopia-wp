jQuery(document).ready(function() {
  elements = jQuery('.wp-block-image a, .blocks-gallery-item a, .rt-gallery a, .rt-image-wide a')

  elements.magnificPopup({
    type: 'image',
    mainClass: 'mfp-with-zoom',
    gallery: {
      enabled: true
    },
    image: {
      titleSrc: function(item) {
        rtImageCaption = item.el.data('rt-lightbox-caption')
        if (rtImageCaption) {
          return rtImageCaption;
        }

        const wpFigure = item.el.closest('figure')
        if (wpFigure) {
          return wpFigure.find('figcaption').text().trim();
        }
      }
    },
    zoom: {
      enabled: true,
      duration: 300,
      easing: 'ease-in-out',
      opener: function(openerElement) {
        return openerElement.is('img')
          ? openerElement
          : openerElement.find('img');
      }
    }
  });
});

jQuery(document).ready(function() {
  jQuery('a.rt-image-wide__image').each(function(index, element) {
    setupMaginificPopup(element, false);
  });

  jQuery('.rt-gallery').each(function(index, element) {
    setupMaginificPopup(jQuery(element).find('a'), true);
  });

  function setupMaginificPopup(elements, isGallery) {
    const $elements = jQuery(elements);
    $elements.magnificPopup({
      type: 'image',
      mainClass: 'mfp-with-zoom',
      gallery: {
        enabled: isGallery
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
  }
});

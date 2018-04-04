document.addEventListener("DOMContentLoaded", setupZoom);
function setupZoom() {
  const zoomableImages = ['.rt-image-wide__image img', '.rt-gallery__image img'];

  zoomableImages
    .reduce((elements, cssPath) => {
      const found = Array.from(document.querySelectorAll(cssPath));
      if (found.length > 0) {
        return elements.concat(found);
      }

      return elements;
    }, [])
    .forEach(element => {
      element.setAttribute('data-zoom-target', element.parentElement.href);
      mediumZoom(element, { margin: 30 });
    });
}

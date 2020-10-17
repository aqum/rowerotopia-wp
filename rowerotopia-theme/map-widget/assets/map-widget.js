const mapInstance = L.map("rt-map").setView([52.069341, 19.480255], 5);
window.rt_routes.forEach(routeSpec => {
  const marker = L.marker(routeSpec.coordinates).addTo(mapInstance);
  marker.bindPopup(
    `
    <a href="${routeSpec.url}">
      <img src="${routeSpec.coverUrl}" class="rt-map-popup__image">
      <h4 class="rt-map-popup__title">${routeSpec.title}</h4>
    </a>
  `,
    {
      className: "rt-map-popup",
      maxWidth: 200,
      minWidth: 200,
      closeButton: false
    }
  );
});

L.tileLayer(
  "https://api.mapbox.com/styles/v1/mapbox/outdoors-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYXF1bSIsImEiOiJjamVseWQ0MHEwZ3NtMzNxbXA2NjR0YWh5In0.Q3QXBlDX_g9HJOtca2QFrA",
  {
    maxZoom: 18,
    attribution:
      'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
      '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="http://mapbox.com">Mapbox</a>',
    id: "mapbox.outdoors"
  }
).addTo(mapInstance);
mapInstance.scrollWheelZoom.disable();

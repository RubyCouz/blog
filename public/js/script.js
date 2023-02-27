// initialisation et ajout de la map
function initMap() {
    // location
    const scb = { lat: 46.063930, lng: -73.488400 };
    // options de la map
    const mapOptions = {
        zoom: 15,
        center: scb,
        mapTypeId: 'satellite'
    };

    // carte centré sur la location
    const map = new google.maps.Map(document.getElementById("map"), mapOptions);
    // marqueur, centré sur la location
    const marker = new google.maps.Marker({
        position: scb,
        map: map,
    });
}

window.initMap = initMap;
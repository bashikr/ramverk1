<?php

namespace Bashar\WeatherView;

/**
 * Render content.
 */

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script type="text/javascript">
    var latPos = <?= $geoData["latitude"] ?>;
    var lngPos = <?= $geoData["longitude"]?>;
    var givenIp = document.getElementById('ip').innerText;
    var locationMarker = L.icon({
        iconUrl: '../img/location.png',
        iconSize:     [20, 30],
        iconAnchor:   [12, 12],
        popupAnchor:  [0, 0]
    });
        setTimeout(() => {
            if (latPos && lngPos) {
                var map = new L.Map('map');
                var osUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    osmAttrib = 'Map data &copy; 2018 OpenStreetMap contributors',
                    osm = new L.TileLayer(osUrl, { maxZoom: 18, attribution: osmAttrib 
            });
            L.marker(
                [latPos, lngPos],
                {icon: locationMarker}
            ).addTo(map).bindPopup("CurrentIP: " + givenIp);
            map.setView(new L.LatLng(latPos, lngPos), 13).addLayer(osm);
        }
    }, 300);
</script>

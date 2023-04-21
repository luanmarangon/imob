/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */

class CoordMapType {
    tileSize;
    alt = null;
    maxZoom = 10;
    minZoom = 0;
    name = null;
    projection = null;
    radius = 6378137;
    constructor(tileSize) {
        this.tileSize = tileSize;
    }
    getTile(coord, zoom, ownerDocument) {
        const div = ownerDocument.createElement("div");
        return div;
    }
    releaseTile(tile) { }
}

function initMap() {
    // Create the map.
    const latitude = parseFloat(document.getElementById("latitude").value);
    const longitute = parseFloat(document.getElementById("longitute").value);

    const location = { lat: latitude, lng: longitute };
    console.log(latitude);
    console.log(longitute);
    console.log(location);
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: location,
        // mapTypeId: "satellite",

    });
    const raio = 3000;
    const cityCircle = new google.maps.Circle({
        strokeColor: "green",
        strokeOpacity: 0.8,
        strokeWeight: 1,
        fillColor: "green",
        fillOpacity: 0.35,
        map,
        center: location,
        radius: Math.sqrt(raio),
    });
}

window.initMap = initMap;


import mapboxgl from 'mapbox-gl';
import 'mapbox-gl/dist/mapbox-gl.css';
import mapboxSdk from '@mapbox/mapbox-sdk';

mapboxgl.accessToken = document.querySelector('meta[name="mapbox-token"]').getAttribute('content');

// Enable the RTL text plugin
mapboxgl.setRTLTextPlugin(
    'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js',
    null,
    true // Lazy load the plugin
);

const map = new mapboxgl.Map({
    container: 'orderMap', // ID of the HTML element to render the map in
    style: 'mapbox://styles/mapbox/streets-v12',
    center: [36, 32], // Starting position [lng, lat]
    zoom: 5
});

// Create a draggable marker (initially not visible on the map)
const marker = new mapboxgl.Marker({
    draggable: true
});

// Add geolocate control to the map
const geolocate = new mapboxgl.GeolocateControl({
    positionOptions: {
        enableHighAccuracy: true
    },
});
map.addControl(geolocate);

// Debounce function to limit the frequency of updates
function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

// When the user's location is found, place the draggable marker there
map.on('load', () => {
    geolocate.trigger(); // Trigger the geolocate control

    // Attach an event listener for the geolocation event
    geolocate.on('geolocate', debounce((e) => {
        const lng = e.coords.longitude; // Get the longitude from user's current location
        const lat = e.coords.latitude; // Get the latitude from user's current location

        // Place the draggable marker at the user's location
        marker.setLngLat([lng, lat]).addTo(map);

        // Update hidden input fields in the form with the user's coordinates
        document.getElementById('longitude').value = lng;
        document.getElementById('latitude').value = lat;

        const mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
        
        mapboxClient.geocoding
          .reverseGeocode({
            query: [lng, lat]
          })
          .send()
          .then(response => response.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    let city = '';
                    let area = '';

                    // Extract city and area from the response
                    data.features.forEach(feature => {
                        if (feature.place_type.includes('region')) {
                            city = feature.text;
                        }
                        if (feature.place_type.includes('place')) {
                            area = feature.text;
                        }
                    });
                    // Find the city option in the dropdown that matches the city name
                    const cityDropdown = document.getElementById('city');
                    if (cityDropdown) {
                        const cityOptions = Array.from(cityDropdown.options);
                        const matchingCityOption = cityOptions.find(option => option.getAttribute('data-name')?.trim().toLowerCase() === city.trim().toLowerCase());

                        // If a matching city is found, select it and trigger the onchange event
                        if (matchingCityOption) {
                            cityDropdown.value = matchingCityOption.value;
                            cityDropdown.dispatchEvent(new Event('change'));
                        } else {
                            console.warn(`City "${city}" not found in the dropdown.`);
                        }
                    } else {
                        console.error('City dropdown element not found.');
                    }
                }
            })
            .catch(error => console.error('Error fetching location details:', error));
    }, 500)); // Limit updates to once every 500ms

    // If geolocation fails or is not available, place the marker at a default location
    geolocate.on('error', () => {
        const DEFAULT_LNG = 36;
        const DEFAULT_LAT = 32;
        marker.setLngLat([DEFAULT_LNG, DEFAULT_LAT]).addTo(map);
    });
});

// Get coordinates when marker position changes after dragging
marker.on('dragend', debounce(() => {
    const lngLat = marker.getLngLat();

    // Update hidden input fields in the form with the new coordinates
    document.getElementById('longitude').value = lngLat.lng;
    document.getElementById('latitude').value = lngLat.lat;
}, 500)); // Limit updates to once every 500ms

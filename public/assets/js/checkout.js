mapboxgl.accessToken = 'pk.eyJ1IjoicmVlbW9vIiwiYSI6ImNtOGZ0emhoZzBidDMyanM3eHpmaHdmbnkifQ.FoaLI1jxV7HDU_8eepOfNQ'; // Replace with your actual Mapbox access token

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
    trackUserLocation: true
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
        console.log(`User's location: ${lng}, ${lat}`);

        // Place the draggable marker at the user's location
        marker.setLngLat([lng, lat]).addTo(map);

        // Update hidden input fields in the form with the user's coordinates
        document.getElementById('longitude').value = lng;
        document.getElementById('latitude').value = lat;
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


function updateDeliveryFee(deliveryFee) {
    // Update the delivery fee
    document.getElementById('delivery_fee').textContent = deliveryFee;

    // Get the subtotal value
    let subtotal = parseFloat(document.getElementById('subtotal').textContent);

    // Calculate the total
    let total = subtotal + parseFloat(deliveryFee);

    // Update the total value
    document.getElementById('total').textContent = total;//.toFixed(2);
}

function getAreas(cityId) {
    fetch(`${appUrl}/areas/${cityId}`)
        .then(response => response.json())
        .then(data => {
            let areaDropdown = document.getElementById('area');
            areaDropdown.innerHTML = '';
            data.forEach(area => {
                let option = document.createElement('option');
                option.value = area.id;
                option.textContent = area.name;
                areaDropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
}

function toggleDeliveryMethod(value) {
    if (value === 'delivery') {
        document.getElementById('delivery_address').style.display = 'block';
        document.getElementById('pickup_branch').style.display = 'none';
    } else if (value === 'pickup') {
        document.getElementById('delivery_address').style.display = 'none';
        document.getElementById('pickup_branch').style.display = 'block';
    } else {
        document.getElementById('delivery_address').style.display = 'none';
        document.getElementById('pickup_branch').style.display = 'none';
    }
}
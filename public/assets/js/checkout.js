function activeDeliverymapbox() {

mapboxgl.accessToken = document.querySelector('meta[name="mapbox-token"]').getAttribute('content');//'pk.eyJ1IjoicmVlbW9vIiwiYSI6ImNtOGZ0emhoZzBidDMyanM3eHpmaHdmbnkifQ.FoaLI1jxV7HDU_8eepOfNQ'; 

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

        // Fetch the city and area using reverse geocoding
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxgl.accessToken}`)
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
}

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
    let areaDropdown = document.getElementById('area');
    areaDropdown.innerHTML = '';
    if (!cityId) {
        return;
    }
    fetch(`${appUrl}/areas/${cityId}`)
        .then(response => response.json())
        .then(data => {
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
        activeDeliverymapbox();
    } else if (value === 'pickup') {
        document.getElementById('delivery_address').style.display = 'none';
        document.getElementById('pickup_branch').style.display = 'block';
        updateDeliveryFee(0); // Reset delivery fee to 0 for pickup
    } else {
        document.getElementById('delivery_address').style.display = 'none';
        document.getElementById('pickup_branch').style.display = 'none';
        updateDeliveryFee(0); // Reset delivery fee to 0 for pickup
    }
}
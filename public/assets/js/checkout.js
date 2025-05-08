function activeDeliverymapbox(){
    let script = document.createElement('script');
    script.src = '../js/mapbox.js';
    document.head.appendChild(script);
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
        if (!document.querySelector('script[src="../js/mapbox.js"]')) {
            activeDeliverymapbox();
        }
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
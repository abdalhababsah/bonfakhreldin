function activeDeliverymapbox() {
    const script = document.getElementById('mapboxScript');
    if (script && script.dataset.loaded !== "true") {

        script.dataset.loaded = "true";
    }
}
function handleOrderSubmission(event) {
    event.preventDefault();

    let requiredFields = document.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (isVisible(field)) {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error'); // Add error class
            } else {
                field.classList.remove('error'); // Clear error class
            }
        }
    });

    if (!isValid) {
        Swal.fire({
            title: localSentence["validation_error"],
            text: localSentence["please_fill_required"],
            icon: 'error',
        });
        return;
    }

    Swal.fire({
        title: localSentence["confirm_order"],
        text: localSentence["thank_you_order"],
        icon: 'success',
        confirmButtonText: localSentence["confirm_order"]
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.closest('form').submit();
        }
    });
}

function isVisible(element) {
    return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
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
    const delivery = document.getElementById('delivery_address');
    const pickup = document.getElementById('pickup_branch');

    delivery.classList.add('hidden');
    pickup.classList.add('hidden');

    if (value === 'delivery') {
        delivery.classList.remove('hidden');
        activeDeliverymapbox();
    } else if (value === 'pickup') {
        pickup.classList.remove('hidden');
        updateDeliveryFee(0);
    } else {
        updateDeliveryFee(0);
    }
}


function addToCart(){
    let form = document.getElementById('add-to-cart-form');
    const url = form.action;
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            size_id: form.querySelector('select[name="size_id"]').value,
            quantity: form.querySelector('input[name="quantity"]').value
        })
        })
        .then(response => {
            if (response.headers.get('content-type').includes('application/json')) {
                return response.json();
            } else {
                throw new Error('Response is not JSON');
            }
        })
        .then(data => {
        if (data.errors) {
            console.log('Validation errors:', data.errors);
        } else {
            console.log('Success:', data);
        }
        })
        .catch(error => {
        console.error('Error:', error);
        });
}

function removeItem(btn) {
    var form = btn.closest('form');
    var formData = new FormData(form);
    var url = form.action;

    fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    var itemTotal = parseFloat(form.closest('tr').querySelector('.total').textContent);
                    var cartSubtotal = parseFloat(document.getElementById('cart-subtotal').textContent);
                    // var cartQuantity = parseInt(document.getElementById('cart-quantity').textContent);

                    form.closest('tr').remove();

                    document.getElementById('cart-subtotal').textContent = (cartSubtotal - itemTotal).toFixed(2);
                    // document.getElementById('cart-quantity').textContent = cartQuantity - 1;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
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




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


document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.qty-btn').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.product-quantity-count').querySelector('.product-quantity-box');
            const isIncrement = this.classList.contains('inc');
            let currentQty = parseInt(input.value);
            const key = input.dataset.key;
            const sizeId = input.dataset.sizeId;
            const price = parseFloat(input.dataset.price);

            if (isNaN(currentQty)) currentQty = 0;

            const newQty = isIncrement ? currentQty + 1 : Math.max(currentQty - 1, 1);
            input.value = newQty;

            updateCartItem(key, newQty, price);
        });
    });

    document.querySelectorAll('.product-quantity-box').forEach(input => {
        input.addEventListener('input', function () {
            const key = this.dataset.key;
            const price = parseFloat(this.dataset.price);
            let newQty = parseInt(this.value);

            if (isNaN(newQty) || newQty < 1) {
                newQty = 1;
                this.value = newQty;
            }

            updateCartItem(key, newQty, price);
        });
    });

    function updateCartItem(key, newQty, price) {
        fetch(`/cart/update/${key}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                quantity: newQty,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const newTotal = (newQty * price).toFixed(2);
                document.getElementById(`total-${key}`).innerText = newTotal;

                updateCartSubtotal();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Update failed", error));
    }

    function updateCartSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('.quantity-input').forEach(input => {
            const qty = parseFloat(input.value);
            const price = parseFloat(input.dataset.price);
            subtotal += qty * price;
        });

        document.getElementById('cart-subtotal').innerText = `${subtotal.toFixed(2)}`;
    }
});

function confirmAndRemove(btn) {
    if (confirm('Are you sure you want to remove this item?')) {
        btn.closest('form').submit();
        return true;
    }
    return false;
}
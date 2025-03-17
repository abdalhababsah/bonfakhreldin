
function addToCart(){
    let form = document.getElementById('add-to-cart-form');
    let url = form.action;
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
window.onload = function(){
    let decodedCookie =decodeURIComponent(document.cookie);
    let ca = decodedCookie//.split(';').find(cookie => cookie.trim().startsWith('cart='));
    console.log(ca);
    if(cart){

    }
}

function removeItem() {
    if (confirm('Are you sure you want to remove this item?')) {
    const form = this.closest('form');
    const url = form.action;
    const token = form.querySelector('input[name="_token"]').value;
    const method = form.querySelector('input[name="_method"]').value;

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-HTTP-Method-Override': method
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            form.closest('tr').remove();
        } else {
            alert('Failed to remove item');
        }
    })
    .catch(error => console.error('Error:', error));
};
};


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

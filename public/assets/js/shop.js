document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.size-select').forEach(function (select) {
        const productId = select.dataset.productId;
        const priceDisplay = document.getElementById(`price-display-${productId}`);

        function updatePrice() {
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.dataset.price;
            if (price && priceDisplay) {
                const parsedPrice = parseFloat(price);
                if (!isNaN(parsedPrice)) {
                    priceDisplay.textContent = `Price: ${parsedPrice.toFixed(2)} JOD`;
                }
            }
        }

        updatePrice();
        select.addEventListener('change', updatePrice);
    });

    document.querySelectorAll('.see-options-btn').forEach(button => {
        button.addEventListener('click', function () {
            const product = JSON.parse(this.getAttribute('data-product'));
            window.selectedProduct = product;

            document.getElementById('modal-product-title').textContent = product.name_en;

            const sizeSelect = document.getElementById('modal-size-select');
            sizeSelect.innerHTML = '';
            if (product.sizes && product.sizes.length > 0) {
                product.sizes.forEach(size => {
                    const option = document.createElement('option');
                    option.value = size.id;
                    option.setAttribute('data-price', size.price);
                    option.setAttribute('data-size-name', size.value);
                    option.textContent = size.value;
                    sizeSelect.appendChild(option);
                });

                const firstPrice = product.sizes[0].price;
                document.getElementById('modal-price-display').textContent = `Price: ${parseFloat(firstPrice).toFixed(2)} JOD`;
            }

            sizeSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                document.getElementById('modal-price-display').textContent = `Price: ${parseFloat(price).toFixed(2)} JOD`;
            });

            const optionWrapper = document.getElementById('modal-options-wrapper');
            const optionSelect = document.getElementById('modal-option-select');

            if (Array.isArray(product.options) && product.options.length > 0) {
                optionWrapper.style.display = 'block';
                optionSelect.innerHTML = '';
                product.options.forEach(opt => {
                    const option = document.createElement('option');
                    option.value = opt;
                    option.textContent = opt;
                    optionSelect.appendChild(option);
                });
            } else {
                optionWrapper.style.display = 'none';
                optionSelect.innerHTML = '';
            }

            document.getElementById('modal-qty').value = 1;
        });
    });

    // Add to cart logic (Updated with alert)
    document.getElementById('add-to-cart-modal-btn').addEventListener('click', function () {
        const sizeSelect = document.getElementById('modal-size-select');
        const selectedSizeOption = sizeSelect.options[sizeSelect.selectedIndex];
        const sizeId = selectedSizeOption.value;
        const sizeName = selectedSizeOption.getAttribute('data-size-name');
        const price = selectedSizeOption.getAttribute('data-price');

        const option = document.getElementById('modal-option-select')?.value || null;
        const quantity = parseInt(document.getElementById('modal-qty').value);
        const product = window.selectedProduct;

        const payload = {
            product_id: product.id,
            name: product.name_en,
            image_url: product.image ? `/storage/${product.image}` : 'https://via.placeholder.com/150',
            size_id: sizeId,
            size: sizeName,
            price: parseFloat(price),
            quantity: quantity,
            option: option,
            total: parseFloat(price) * quantity
        };
        

        fetch("/cart/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then(data => {
            if (data.message === 'Added to cart') {
                Swal.fire({
                    title: "Done!",
                    text: "Added To Cart successfully!",
                    icon: "success",
                    timer: 1500, 
                    timerProgressBar: true,
                    showConfirmButton: false,
                  }).then(() => {
                    // window.location.href = "/shop";
                  });
            } else {
                alert("There was an issue adding this product to your cart.");
            }
        })
        .catch(error => {
            console.error("❌ Error adding to cart:", error);
            alert("There was an error processing your request.");
        });
        
    });
});

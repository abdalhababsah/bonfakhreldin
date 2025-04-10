document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.see-options-btn').forEach(button => {
        button.addEventListener('click', function () {
            const product = JSON.parse(this.getAttribute('data-product'));
            window.selectedProduct = product;

            document.getElementById('modal-product-title').textContent = product.name;
            document.getElementById('modal-product-description').textContent = product.description;
            const sizeWrapper = document.getElementById('modal-size-wrapper');
            sizeWrapper.innerHTML = '';
            if (product.sizes && product.sizes.length > 0) {
                const sizeContainer = document.createElement('div');
                sizeContainer.classList.add('single-product-variation-size-wrap');

                product.sizes.forEach((size, index) => {
                    const sizeItem = document.createElement('div');
                    sizeItem.classList.add('single-product-variation-size-item');

                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = 'qv-size';
                    input.id = `qv-size-${size.id}`;
                    input.value = size.id;
                    input.setAttribute('data-price', size.price);
                    input.setAttribute('data-size-name', size.value);
                    if (index === 0) {
                        input.checked = true; // Check the first size by default
                        document.getElementById('modal-price-display').textContent = `${parseFloat(size.price).toFixed(2)} JOD`;
                    }

                    const label = document.createElement('label');
                    label.setAttribute('for', `qv-size-${size.id}`);
                    label.textContent = size.value;

                    sizeItem.appendChild(input);
                    sizeItem.appendChild(label);
                    sizeContainer.appendChild(sizeItem);

                    input.addEventListener('change', function () {
                        const price = this.getAttribute('data-price');
                        document.getElementById('modal-price-display').textContent = `${parseFloat(price).toFixed(2)} JOD`;
                    });
                });

                sizeWrapper.appendChild(sizeContainer);
            }
            const optionWrapper = document.getElementById('modal-options-wrapper');
            const optionLi = optionWrapper.closest('li'); // Get the parent <li> element
            optionWrapper.innerHTML = '';
            if (product.options && product.options.length > 0) {
                const optionContainer = document.createElement('div');
                optionContainer.classList.add('single-product-variation-wrap');

                product.options.forEach((opt, index) => {
                    const optionItem = document.createElement('div');
                    optionItem.classList.add('single-product-variation-item');

                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = 'qv-option';
                    input.id = `qv-option-${opt.id}`;
                    input.value = opt.id;
                    input.setAttribute('data-option-name', opt.name);
                    if (index === 0) {
                        input.checked = true; // Check the first option by default
                    }

                    const label = document.createElement('label');
                    label.setAttribute('for', `qv-option-${opt.id}`);
                    label.textContent = opt.name;

                    optionItem.appendChild(input);
                    optionItem.appendChild(label);
                    optionContainer.appendChild(optionItem);
                });

                optionWrapper.appendChild(optionContainer);
                optionLi.style.display = 'flex'; // Ensure the <li> is visible
            } else {
                optionLi.style.display = 'none'; // Hide the <li> if no options are available
            }

            const addtionWrapper = document.getElementById('modal-addtions-wrapper');

            if (product.additions && product.additions.length > 0) {
                addtionWrapper.closest('li').style.display = 'flex';
                
                const additionsContainer = document.createElement('div');
                additionsContainer.classList.add('additions-container', 'text-secondary');

                product.additions.forEach(add => {
                    const additionWrapper = document.createElement('div');
                    additionWrapper.classList.add('single-product-variation-item', 'addition-wrapper');

                    const input = document.createElement('input');
                    input.type = 'checkbox';
                    input.name = 'addition';
                    input.value = add.id;
                    input.id = `addition-${add.id}`;

                    const label = document.createElement('label');
                    label.setAttribute('for', `addition-${add.id}`);
                    label.textContent = add.name;
                    if (add.price > 0) {
                        label.textContent += ` (+${parseFloat(add.price).toFixed(2)} JOD)`; // Append price to the label text
                    }

                    additionWrapper.appendChild(input);
                    additionWrapper.appendChild(label);
                    
                    let qtyInput;
                    if (add.with_qty) {
                        qtyInput = document.createElement('input');
                        qtyInput.type = 'number';
                        qtyInput.min = 1;
                        qtyInput.value = 1;
                        qtyInput.classList.add('addition-qty');
                        qtyInput.disabled = true; // Initially disabled
                        label.textContent += ' x '; // Append 'x' to the label text
                        label.appendChild(qtyInput);
                    }

                    input.addEventListener('change', function () {
                        // Uncheck all other checkboxes
                        document.querySelectorAll('.additions-container input[type="checkbox"]').forEach(checkbox => {
                            if (checkbox !== this) {
                                checkbox.checked = false;
                                const siblingQtyInput = checkbox.closest('.addition-wrapper').querySelector('.addition-qty');
                                if (siblingQtyInput) {
                                    siblingQtyInput.disabled = true; // Disable other qty inputs
                                }
                            }
                        });

                        if (qtyInput) {
                            qtyInput.disabled = !this.checked; // Enable/disable qty input based on checkbox state
                        }
                    });

                    additionsContainer.appendChild(additionWrapper);
                });

                addtionWrapper.innerHTML = '';
                addtionWrapper.appendChild(additionsContainer);
            }

            document.getElementById('modal-qty').value = 1;
        });
    });

    // Add to cart logic (Updated with alert)
    document.getElementById('add-to-cart-modal-btn').addEventListener('click', function () {
        const selectedSizeRadio = document.querySelector('input[name="qv-size"]:checked');
        const sizeId = selectedSizeRadio ? selectedSizeRadio.value : null;

        const selectedOption = document.querySelector('input[name="qv-option"]:checked');
        const option = selectedOption ? selectedOption.value : null;

        const qtyElement = document.getElementById('modal-qty');
        const quantity = qtyElement ? parseInt(qtyElement.value) || 0 : 0;
        const product = window.selectedProduct;
        const additions = {};
        document.querySelectorAll('.additions-container input[type="checkbox"]:checked').forEach(checkbox => {
            const additionId = checkbox.value;
            const qtyInput = checkbox.closest('.addition-wrapper').querySelector('.addition-qty');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
            additions[additionId] = quantity;
        });

        const payload = {
            product_id: product.id,
            size_id: sizeId,
            quantity: quantity,
            option_id: option,
            additions: additions,
        };
        

        fetch(appUrl + "/cart/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                throw new Error('Response is not JSON');
            }
        })
        .then(data => {
        if (data.errors) {
            console.log('Validation errors:', data.errors);
        } else {
            Swal.fire({
                title: "Done!",
                text: data.message,
                icon: data.status,
                timer: 1500, 
                timerProgressBar: true,
                showConfirmButton: false,
              }).then(() => {
                updateCartCount();
                const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                if (modal) {
                    modal.hide(); // Properly hide the modal using Bootstrap's method
                }
            });
        }
        })
        .catch(error => {
        console.error('Error:', error);
        });
        
    });
});


    /* Product Quantity */
    $('.product-quantity-count').on('click', '.qty-btn', function (e) {
        e.preventDefault()
        const $btn = $(this),
            $box = $btn.siblings('.product-quantity-box')[0];
        if ($btn.hasClass('inc')) {
            $box.value = Number($box.value) + 1
        } else if ($btn.hasClass('dec') && Number($box.value) > 1) {
            $box.value = Number($box.value) - 1
        }
    })

@extends('admin.layout.mainlayout')

@section('title', __('Create Product - Bonfkeralden'))

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Left Side: Main Form -->
        <div class="col-lg-8 col-md-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Create Product</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div id="productForm">
                        @csrf

                        <!-- Product Information Section -->
                        <section class="mb-4">
                            <h5 class="mb-3">Product Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name_en" class="form-label">Name (English)</label>
                                    <input type="text" name="name_en" id="name_en"
                                           class="form-control styled-input" required>
                                    <span id="name_en_error" class="text-danger small" style="display:none;">This field is required</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name_ar" class="form-label">Name (Arabic)</label>
                                    <input type="text" name="name_ar" id="name_ar"
                                           class="form-control styled-input" required>
                                    <span id="name_ar_error" class="text-danger small" style="display:none;">This field is required</span>
                                </div>
                            </div>
                        </section>

                        <!-- Description -->
                        <section class="mb-4">
                            <h5 class="mb-3">Product Description</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="description_en" class="form-label">Description (English)</label>
                                    <textarea name="description_en" id="description_en" class="form-control styled-input" rows="3"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_ar" class="form-label">Description (Arabic)</label>
                                    <textarea name="description_ar" id="description_ar" class="form-control styled-input" rows="3"></textarea>
                                </div>
                            </div>
                        </section>

                        <!-- Images -->
                        <section class="mb-4">
                            <h5 class="mb-3">Product Images</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="images" class="form-label">Upload Images</label>
                                    <div id="imageDropzone" class="dropzone"></div>
                                    <span id="imageError" class="text-danger small" style="display:none;">Please upload at least one image</span>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Options -->
        <div class="col-lg-4 col-md-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Options</h6>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select styled-input" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                            @endforeach
                        </select>
                        <span id="category_id_error" class="text-danger small" style="display:none;">Please select a category</span>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select styled-input">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                   <!-- Product Options -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="my-2">Product Options</label>
                            <button type="button" id="addOptionRow" class="btn btn-sm btn-outline-secondary">+ Add</button>
                        </div>

                        <div id="optionsRepeater">
                        </div>
                    </div>


                    <!-- Sizes -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Sizes & Prices</label>
                            <button type="button" id="addSizeRow" class="btn btn-sm btn-outline-primary mt-2">+ Add </button>
                        </div>
                        <div id="sizePriceRepeater">
                            <div class="row g-2 mb-2 size-price-row">
                                <div class="col-6">
                                    <input type="text" name="size_value[]" class="form-control size-value" placeholder="Size (e.g. 250g)">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="size_price[]" class="form-control size-price" placeholder="Price (e.g. 4.99)" step="0.01">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="button" id="submitBtn" class="btn btn-primary mb-2">Create Product</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Dropzone -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

        <style>
            .dropzone {
                border: 2px dashed #007bff;
                border-radius: 5px;
                background: #f9f9f9;
                padding: 20px;
                text-align: center;
            }

            .styled-input {
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 10px;
                background-color: #f8f9fa;
            }

            .styled-input:focus {
                border-color: #007bff;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }

            .dropzone .dz-preview .dz-image img {
                border-radius: 5px;
                width: 100%;
                height: auto;
            }
        </style>

<script>
Dropzone.autoDiscover = false;

const myDropzone = new Dropzone("#imageDropzone", {
    url: "{{ route('admin.products.store') }}",
    autoProcessQueue: false,
    uploadMultiple: true,
    addRemoveLinks: true,
    acceptedFiles: "image/*",
    parallelUploads: 10,
    maxFiles: 10,
    paramName: "images[]",
    headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    init: function () {
        this.on("addedfile", validateImages);
        this.on("removedfile", validateImages);
    }
});

function validateImages() {
    const acceptedFiles = myDropzone.getAcceptedFiles();
    const imageError = document.getElementById('imageError');
    imageError.style.display = (acceptedFiles.length < 1) ? 'inline' : 'none';
}

// ✅ Submit form
document.getElementById('submitBtn').addEventListener('click', function () {
    this.disabled = true;

    const name_en = document.getElementById('name_en').value.trim();
    const name_ar = document.getElementById('name_ar').value.trim();
    const category_id = document.getElementById('category_id').value;
    const status = document.getElementById('status').value;
    const description_en = document.getElementById('description_en').value.trim();
    const description_ar = document.getElementById('description_ar').value.trim();

    const name_en_error = document.getElementById('name_en_error');
    const name_ar_error = document.getElementById('name_ar_error');
    const category_id_error = document.getElementById('category_id_error');
    const imageError = document.getElementById('imageError');

    let isValid = true;

    if (!name_en) { name_en_error.style.display = 'inline'; isValid = false; } else { name_en_error.style.display = 'none'; }
    if (!name_ar) { name_ar_error.style.display = 'inline'; isValid = false; } else { name_ar_error.style.display = 'none'; }
    if (!category_id) { category_id_error.style.display = 'inline'; isValid = false; } else { category_id_error.style.display = 'none'; }

    const acceptedFiles = myDropzone.getAcceptedFiles();
    if (acceptedFiles.length < 1) {
        imageError.style.display = 'inline';
        isValid = false;
    } else {
        imageError.style.display = 'none';
    }

    // ✅ Get sizes and prices correctly
    const sizes = [];
    document.querySelectorAll('.size-price-row').forEach(row => {
        const sizeInput = row.querySelector('.size-value')?.value.trim();
        const priceInput = row.querySelector('.size-price')?.value.trim();

        if (sizeInput && priceInput) {
            sizes.push({ value: sizeInput, price: priceInput });
        }
    });
    if (sizes.length === 0) {
        alert("Please add at least one size and price.");
        this.disabled = false;
        return;
    }


    const options = [];
    document.querySelectorAll('.option-row').forEach(row => {
        const nameEn = row.querySelector('.option-name-en')?.value.trim();
        const nameAr = row.querySelector('.option-name-ar')?.value.trim();

        if (nameEn && nameAr) {
            options.push({ name_en: nameEn, name_ar: nameAr });
        }
    });


    if (!isValid) {
        this.disabled = false;
        return;
    }

    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('name_en', name_en);
    formData.append('name_ar', name_ar);
    formData.append('description_en', description_en);
    formData.append('description_ar', description_ar);
    formData.append('category_id', category_id);
    formData.append('status', status);
    formData.append('sizes', JSON.stringify(sizes)); 
    formData.append('options', JSON.stringify(options));

    acceptedFiles.forEach((file, index) => {
        formData.append(`images[${index}]`, file);
    });

    fetch("{{ route('admin.products.store') }}", {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: formData
    })
    .then(response => response.json().then(data => {
        if (response.ok) {
            window.location.href = "{{ route('admin.products.index') }}";
        } else {
            console.error('Error:', data);
            alert('Error: ' + (data.message || 'An error occurred while creating the product.'));
            document.getElementById('submitBtn').disabled = false;
        }
    }).catch(err => {
        console.error('Not JSON:', err);
        alert('Error: An error occurred while creating the product.');
        document.getElementById('submitBtn').disabled = false;
    }))
    .catch(error => {
        console.error('Error:', error);
        this.disabled = false;
    });
});


// ➕ Add new size row
document.getElementById('addSizeRow').addEventListener('click', function () {
    const container = document.getElementById('sizePriceRepeater');
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 size-price-row';
    row.innerHTML = `
        <div class="col-6">
            <input type="text" class="form-control size-value" placeholder="Size (e.g. 250g)">
        </div>
        <div class="col-5">
            <input type="number" class="form-control size-price" placeholder="Price" step="0.01">
        </div>
        <button type="button" class="btn-close btn-close-white col-1 remove-size" aria-label="Close"></button>
    `;
    container.appendChild(row);
});

// ❌ Remove size row
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-size')) {
        e.target.closest('.size-price-row').remove();
    }
});

// ➕ Add new option row
document.getElementById('addOptionRow').addEventListener('click', function () {
    const container = document.getElementById('optionsRepeater');
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 option-row';
    row.innerHTML = `
        <div class="">
            <label for="option_name_en" class="d-flex justify-content-end">
                <button type="button" class="btn-close btn-close-white remove-option " aria-label="Close"></button>
            </label>
            <input type="text" name="option_name_en[]" class="form-control option-name-en" placeholder="Name En">
            <input type="text" name="option_name_ar[]" class="form-control option-name-ar" placeholder="Name Ar">
        </div>
    `;
    container.appendChild(row);
});

// ❌ Remove option row
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-option')) {
        e.target.closest('.option-row').remove();
    }
});
</script>



@endsection

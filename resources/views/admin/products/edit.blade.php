@extends('admin.layout.mainlayout')

@section('title', __('Edit Product - Bonfkeralden'))

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Left Side: Main Form -->
            <div class="col-lg-8 col-md-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Edit Product</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Form for editing the product -->
                        <form id="productForm">
                            @csrf
                            @method('PUT') <!-- For method spoofing -->

                            <!-- Product Information Section -->
                            <section class="mb-4">
                                <h5 class="mb-3">Product Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name_en" class="form-label">Name (English)</label>
                                        <input type="text" name="name_en" id="name_en"
                                            class="form-control styled-input" required
                                            value="{{ old('name_en', $product->name_en) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name_ar" class="form-label">Name (Arabic)</label>
                                        <input type="text" name="name_ar" id="name_ar"
                                            class="form-control styled-input" required
                                            value="{{ old('name_ar', $product->name_ar) }}">
                                    </div>
                                </div>
                            </section>

                            <!-- Product Description Section -->
                            <section class="mb-4">
                                <h5 class="mb-3">Product Description</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="description_en" class="form-label">Description (English)</label>
                                        <textarea name="description_en" id="description_en" class="form-control styled-input" rows="3">{{ old('description_en', $product->description_en) }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                                        <textarea name="description_ar" id="description_ar" class="form-control styled-input" rows="3">{{ old('description_ar', $product->description_ar) }}</textarea>
                                    </div>
                                </div>
                            </section>

                            <div class="d-grid">
                                <button type="submit" id="submitBtn" class="btn btn-primary mb-2">Update Product</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                            <!-- Product Images Section -->
                            <section class="mb-4">
                                <h5 class="mb-3">Product Images</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="images" class="form-label">Upload Images</label>
                                        <div id="imageDropzone" class="dropzone"></div>
                                    </div>
                                </div>
                            </section>

                            <!-- Submit Buttons -->
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: Status & Category -->
            <div class="col-lg-4 col-md-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Options</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Category Selection -->
                        <div class="mb-4">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select styled-input" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category_id', $product->category_id) == $category->id) selected @endif>
                                        {{ $category->name_en }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status Selection -->
                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select styled-input">
                                <option value="active" @if (old('status', $product->status) == 'active') selected @endif>Active</option>
                                <option value="inactive" @if (old('status', $product->status) == 'inactive') selected @endif>Inactive</option>
                            </select>
                        </div>

                        <!-- Product Options -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label class="my-2">Product Options</label>
                                <button type="button" id="addOptionRow" class="btn btn-sm btn-outline-secondary">+ Add</button>
                            </div>

                            <div id="optionsRepeater">
                                @if ($product->options)
                                @foreach ($product->options as $option)
                                <input type="hidden" name="option_id[]" value="{{$option->id}}" class="option-id">
                                <div class="">
                                    <label for="option_name_en" class="d-flex justify-content-end">
                                        <button type="button" class="btn-close btn-close-white remove-option " aria-label="Close"></button>
                                    </label>
                                    <input type="text" name="option_name_en[]" value="{{ $option->name_en }}" class="form-control option-name-en" placeholder="Name En">
                                    <input type="text" name="option_name_ar[]" value="{{ $option->name_ar }}" class="form-control option-name-ar" placeholder="Name Ar">
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>


                        <!-- Sizes -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Sizes & Prices</label>
                                <button type="button" id="addSizeRow" class="btn btn-sm btn-outline-primary mt-2">+ Add </button>
                            </div>
                            <div id="sizePriceRepeater">
                                @foreach ($product->sizes as $size)
                                <div class="row g-2 mb-2 size-price-row">
                                    <input type="hidden" name="size_id[]" value="{{$size->id}}" class="size-id">
                                    <div class="col-6">
                                        <input type="text" name="size_value[]" value="{{$size->value}}" class="form-control size-value" placeholder="Size (e.g. 250g)">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="size_price[]" value="{{$size->price}}" class="form-control size-price" placeholder="Price (e.g. 4.99)" step="0.01">
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dropzone.js and Custom Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        // Function to fetch and render images
        function fetchImages(dropzoneInstance) {
            fetch("{{ route('admin.products.getImages', $product->id) }}", {
                    headers: {
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.images) {
                        // Clear existing Dropzone previews
                        dropzoneInstance.removeAllFiles(true);

                        // Render fetched images
                        data.images.forEach(image => {
                            const mockFile = {
                                name: image.image_url.split('/').pop(),
                                size: 123456, // Approximate size
                                dataURL: `{{ asset('storage/') }}/${image.image_url}`,
                                imageId: image.id
                            };

                            dropzoneInstance.emit("addedfile", mockFile);
                            dropzoneInstance.emit("thumbnail", mockFile, mockFile.dataURL);
                            mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching images:', error);
                });
        }

        // Initialize Dropzone
        const myDropzone = new Dropzone("#imageDropzone", {
            url: "{{ route('admin.products.uploadImage', $product->id) }}",
            autoProcessQueue: true,
            uploadMultiple: false,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            maxFilesize: 2, // MB
            paramName: "image",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            init: function() {
                const dropzone = this;

                // Initial fetch of images
                fetchImages(dropzone);

                // Handle file removal
                this.on("removedfile", function(file) {
                    if (file.imageId) {
                        // Remove image via AJAX
                        let url = "{{ route('admin.products.removeImage', ':id') }}".replace(':id',
                            file.imageId);

                        fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Accept": "application/json"
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire('Success', data.message, 'success');
                                // Re-fetch images
                                fetchImages(dropzone);
                            })
                            .catch(error => {
                                console.error('Error deleting image:', error);
                                Swal.fire('Error', 'An error occurred while deleting the image.',
                                    'error');
                            });
                    }
                });

                // Handle successful upload
                this.on('success', function(file, response) {
                    Swal.fire('Success', response.message, 'success');
                    // Re-fetch images
                    fetchImages(dropzone);
                });

                // Handle errors
                this.on('error', function(file, response) {
                    Swal.fire('Error', response.message ||
                        'An error occurred while uploading the image.', 'error');
                    this.removeFile(file);
                });
            }
        });

        // Handle form submission
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Disable the submit button to prevent multiple submissions
            document.getElementById('submitBtn').disabled = true;

            // Gather form data
            const formData = new FormData(this);

            const sizes = [];
            document.querySelectorAll('.size-price-row').forEach(row => {
                const sizeId = row.querySelector('.size-id')?.value.trim() ?? null;
                const sizeInput = row.querySelector('.size-value')?.value.trim();
                const priceInput = row.querySelector('.size-price')?.value.trim();

                if (sizeInput && priceInput) {
                    sizes.push({ id:sizeId, value: sizeInput, price: priceInput });
                }
            });
            if (sizes.length === 0) {
                alert("Please add at least one size and price.");
                this.disabled = false;
                return;
            }


            const options = [];
            document.querySelectorAll('.option-row').forEach(row => {
                const optionId = row.querySelector('.option-id')?.value.trim() ?? null;
                const nameEn = row.querySelector('.option-name-en')?.value.trim();
                const nameAr = row.querySelector('.option-name-ar')?.value.trim();

                if (nameEn && nameAr) {
                    options.push({ id:optionId, name_en: nameEn, name_ar: nameAr });
                }
            });


            // Append category_id and status
            const categoryId = document.getElementById('category_id').value;
            const status = document.getElementById('status').value;

            formData.append('category_id', categoryId);
            formData.append('status', status);
            formData.append('sizes', JSON.stringify(sizes));
            formData.append('options', JSON.stringify(options));

            fetch("{{ route('admin.products.update', $product->id) }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire('Success', 'Product updated successfully.', 'success').then(() => {
                            window.location.href = "{{ route('admin.products.index') }}";
                        });
                    } else {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'An error occurred while updating the product.', 'error');
                    document.getElementById('submitBtn').disabled = false;
                });
        });
        // Function to remove images via AJAX
        function removeImage(imageId) {
            let url = "{{ route('admin.products.removeImage', ':id') }}".replace(':id', imageId);

            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    } else {
                        return response.json();
                    }
                })
                .then(data => {
                    Swal.fire('Success', data.message, 'success');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'An error occurred while deleting the image.', 'error');
                });
        }

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

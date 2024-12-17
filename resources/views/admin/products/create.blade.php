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

                            <!-- Product Description Section -->
                            <section class="mb-4">
                                <h5 class="mb-3">Product Description</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="description_en" class="form-label">Description (English)</label>
                                        <textarea name="description_en" id="description_en" class="form-control styled-input" rows="3"></textarea>
                                        <!-- Not strictly required field, so no mandatory error span here -->
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                                        <textarea name="description_ar" id="description_ar" class="form-control styled-input" rows="3"></textarea>
                                        <!-- Not strictly required field, so no mandatory error span here -->
                                    </div>
                                </div>
                            </section>

                            <!-- Product Images Section -->
                            <section class="mb-4">
                                <h5 class="mb-3">Product Images</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="images" class="form-label">Upload Images</label>
                                        <div id="imageDropzone" class="dropzone"></div>
                                        <span id="imageError" class="text-danger small" style="display:none;">Please upload exactly one image</span>
                                    </div>
                                </div>
                            </section>
                        </div>
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
                                    <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                @endforeach
                            </select>
                            <span id="category_id_error" class="text-danger small" style="display:none;">Please select a category</span>
                        </div>

                        <!-- Status Selection -->
                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select styled-input">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-grid">
                            <button type="button" id="submitBtn" class="btn btn-primary mb-2">Create Product</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dropzone.js and Custom Scripts -->
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
            init: function() {
                this.on("addedfile", validateImages);
                this.on("removedfile", validateImages);
            }
        });

        function validateImages() {
            const acceptedFiles = myDropzone.getAcceptedFiles();
            const imageError = document.getElementById('imageError');
            if (acceptedFiles.length !== 1) {
                imageError.style.display = 'inline';
            } else {
                imageError.style.display = 'none';
            }
        }

        document.getElementById('submitBtn').addEventListener('click', function() {
            this.disabled = true;

            // Get inputs
            const name_en = document.getElementById('name_en').value.trim();
            const name_ar = document.getElementById('name_ar').value.trim();
            const category_id = document.getElementById('category_id').value;
            const status = document.getElementById('status').value;
            const description_en = document.getElementById('description_en').value.trim();
            const description_ar = document.getElementById('description_ar').value.trim();

            // Get error elements
            const name_en_error = document.getElementById('name_en_error');
            const name_ar_error = document.getElementById('name_ar_error');
            const category_id_error = document.getElementById('category_id_error');
            const imageError = document.getElementById('imageError');

            let isValid = true;

            // Validate required fields
            if (!name_en) {
                name_en_error.style.display = 'inline';
                isValid = false;
            } else {
                name_en_error.style.display = 'none';
            }

            if (!name_ar) {
                name_ar_error.style.display = 'inline';
                isValid = false;
            } else {
                name_ar_error.style.display = 'none';
            }

            if (!category_id) {
                category_id_error.style.display = 'inline';
                isValid = false;
            } else {
                category_id_error.style.display = 'none';
            }

            // Validate exactly one image
            const acceptedFiles = myDropzone.getAcceptedFiles();
            if (acceptedFiles.length !== 1) {
                imageError.style.display = 'inline';
                isValid = false;
            } else {
                imageError.style.display = 'none';
            }

            if (!isValid) {
                this.disabled = false;
                return; // Stop submission if not valid
            }

            // If valid, create FormData and submit
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name_en', name_en);
            formData.append('name_ar', name_ar);
            formData.append('description_en', description_en);
            formData.append('description_ar', description_ar);
            formData.append('category_id', category_id);
            formData.append('status', status);
            formData.append('images[]', acceptedFiles[0]);

            fetch("{{ route('admin.products.store') }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                })
                .then(data => {
                    window.location.href = "{{ route('admin.products.index') }}";
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Optionally handle errors with spans as well
                    // For now, just re-enable submit on error
                    this.disabled = false;
                });
        });
    </script>
@endsection
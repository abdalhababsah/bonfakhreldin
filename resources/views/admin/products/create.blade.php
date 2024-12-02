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
                    <!-- Removed the traditional <form> tag -->
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
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name_ar" class="form-label">Name (Arabic)</label>
                                    <input type="text" name="name_ar" id="name_ar"
                                        class="form-control styled-input" required>
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
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_ar" class="form-label">Description (Arabic)</label>
                                    <textarea name="description_ar" id="description_ar" class="form-control styled-input" rows="3"></textarea>
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

        // Initialize Dropzone
        const myDropzone = new Dropzone("#imageDropzone", {
            url: "{{ route('admin.products.store') }}", // Not used since we'll handle via Fetch
            autoProcessQueue: false, // Prevent automatic uploads
            uploadMultiple: true,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            parallelUploads: 10, // Adjust as needed
            maxFiles: 10, // Maximum number of files
            paramName: "images[]", // Laravel-compatible field name
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            init: function () {
                // Optionally handle Dropzone events here
            }
        });

        document.getElementById('submitBtn').addEventListener('click', function () {
            // Disable the submit button to prevent multiple submissions
            this.disabled = true;

            // Gather form inputs
            const name_en = document.getElementById('name_en').value;
            const name_ar = document.getElementById('name_ar').value;
            const description_en = document.getElementById('description_en').value;
            const description_ar = document.getElementById('description_ar').value;
            const category_id = document.getElementById('category_id').value;
            const status = document.getElementById('status').value;

            // Validate required fields
            if (!name_en || !name_ar || !category_id) {
                alert('Please fill in all required fields.');
                this.disabled = false;
                return;
            }

            // Create FormData object
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name_en', name_en);
            formData.append('name_ar', name_ar);
            formData.append('description_en', description_en);
            formData.append('description_ar', description_ar);
            formData.append('category_id', category_id);
            formData.append('status', status);

            // Append images from Dropzone
            myDropzone.getAcceptedFiles().forEach((file, index) => {
                formData.append('images[]', file);
                // If you have alt texts, append them as well
                // Example:
                // formData.append(`alt_text_en[${index}]`, altTextEnValue);
                // formData.append(`alt_text_ar[${index}]`, altTextArValue);
            });

            // Send the data via Fetch API
            fetch("{{ route('admin.products.store') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    // 'Content-Type': 'multipart/form-data', // Do not set Content-Type; browser sets it automatically
                },
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json(); // Assuming the server returns JSON
                } else {
                    return response.json().then(err => { throw err; });
                }
            })
            .then(data => {
                // Handle success (e.g., redirect or show a success message)
                window.location.href = "{{ route('admin.products.index') }}";
            })
            .catch(error => {
                // Handle errors (e.g., show validation errors)
                console.error('Error:', error);
                alert('An error occurred while creating the product. Please check your inputs and try again.');
                // Re-enable the submit button
                document.getElementById('submitBtn').disabled = false;
            });
        });
    </script>
@endsection
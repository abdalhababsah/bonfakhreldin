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
                                <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected @endif>{{ $category->name_en }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select styled-input">
                            <option value="active" @if(old('status', $product->status) == 'active') selected @endif>Active</option>
                            <option value="inactive" @if(old('status', $product->status) == 'inactive') selected @endif>Inactive</option>
                        </select>
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

// Initialize Dropzone
const myDropzone = new Dropzone("#imageDropzone", {
    url: "{{ route('admin.products.uploadImage', $product->id) }}",
    autoProcessQueue: true, // Process immediately
    uploadMultiple: false,
    addRemoveLinks: true,
    acceptedFiles: "image/*",
    maxFilesize: 2, // MB
    maxFiles: 10,
    paramName: "image",
    headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    init: function () {
        var myDropzone = this;

        // Load existing images
        @foreach($product->images as $image)
            var mockFile = {
                name: "{{ basename($image->image_url) }}",
                size: 123456,
                dataURL: "{{ asset('storage/' . $image->image_url) }}",
                imageId: "{{ $image->id }}",
                isPrimary: {{ $image->is_primary ? 'true' : 'false' }}
            };
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, mockFile.dataURL);
            mockFile.previewElement.classList.add('dz-success', 'dz-complete');
            if (mockFile.isPrimary) {
                mockFile.previewElement.classList.add('primary-image');
                var badge = document.createElement('span');
                badge.className = 'badge bg-primary position-absolute';
                badge.style.top = '10px';
                badge.style.left = '10px';
                badge.innerText = 'Primary';
                mockFile.previewElement.appendChild(badge);
            }
            myDropzone.files.push(mockFile);
        @endforeach

        // Handle file removal
        this.on("removedfile", function (file) {
            if (file.upload && file.upload.filename) {
                // File just uploaded, remove from server
                removeImage(file.imageId);
            } else if (file.imageId) {
                // Remove existing image
                removeImage(file.imageId);
            }
        });

        // Handle success
        this.on('success', function (file, response) {
            // Update file data with response data
            file.imageId = response.imageId;
            file.isPrimary = response.isPrimary;

            if (file.isPrimary) {
                // Add badge to indicate primary image
                file.previewElement.classList.add('primary-image');
                var badge = document.createElement('span');
                badge.className = 'badge bg-primary position-absolute';
                badge.style.top = '10px';
                badge.style.left = '10px';
                badge.innerText = 'Primary';
                file.previewElement.appendChild(badge);
            }

            Swal.fire('Success', response.message, 'success');
        });

        // Handle errors
        this.on('error', function (file, response) {
            Swal.fire('Error', response.message || 'An error occurred while uploading the image.', 'error');
            this.removeFile(file);
        });
    }
});

// Handle form submission
// Handle form submission
document.getElementById('productForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Disable the submit button to prevent multiple submissions
    document.getElementById('submitBtn').disabled = true;

    // Gather form data
    const formData = new FormData(this);

    // Append category_id and status
    const categoryId = document.getElementById('category_id').value;
    const status = document.getElementById('status').value;

    formData.append('category_id', categoryId);
    formData.append('status', status);

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
            return response.json().then(err => { throw err; });
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
            return response.json().then(err => { throw err; });
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
</script>
@endsection
@extends('admin.layout.mainlayout')

@section('title', __('Categories - Bonfkeralden'))

@section('content')
    <div class="container-fluid py-4">
        @php
            $protectedCategoryIds = [1, 2, 3];
        @endphp

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Categories Table</h6>
                            <button type="button" class="btn btn-primary me-3" id="createCategoryButton"
                                data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                Add New Category
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0 text-center" id="categoriesTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name (EN)</th>
                                        <th>Name (AR)</th>
                                        <th>Description (EN)</th>
                                        <th>Description (AR)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name_en }}</td>
                                            <td>{{ $category->name_ar }}</td>
                                            <td>{{ $category->description_en }}</td>
                                            <td>{{ $category->description_ar }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal"
                                                    onclick="populateEditModal({{ $category }}, {{ request('page', 1) }})">
                                                    Edit
                                                </button>

                                                <!-- Delete Button -->
                                                @if (!in_array($category->id, $protectedCategoryIds))
                                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="page"
                                                            value="{{ request('page', 1) }}">
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Disabled Delete Button with Tooltip -->
                                                    <button class="btn btn-secondary btn-sm" disabled
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="This category cannot be deleted.">
                                                        Delete
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $categories->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Category Modal -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="page" value="{{ request('page', 1) }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="nameEn" class="form-label">Name (English)</label>
                                <input type="text" name="name_en" id="nameEn" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nameAr" class="form-label">Name (Arabic)</label>
                                <input type="text" name="name_ar" id="nameAr" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="descriptionEn" class="form-label">Description (English)</label>
                                <textarea name="description_en" id="descriptionEn" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="descriptionAr" class="form-label">Description (Arabic)</label>
                                <textarea name="description_ar" id="descriptionAr" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="page" id="editPage">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editCategoryId" name="id">
                            <div class="form-group mb-3">
                                <label for="editNameEn" class="form-label">Name (English)</label>
                                <input type="text" name="name_en" id="editNameEn" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editNameAr" class="form-label">Name (Arabic)</label>
                                <input type="text" name="name_ar" id="editNameAr" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editDescriptionEn" class="form-label">Description (English)</label>
                                <textarea name="description_en" id="editDescriptionEn" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editDescriptionAr" class="form-label">Description (Arabic)</label>
                                <textarea name="description_ar" id="editDescriptionAr" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Initialize Bootstrap Tooltips -->
    <script>
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <script>
        function populateEditModal(category, page) {
            document.getElementById('editCategoryId').value = category.id;
            document.getElementById('editNameEn').value = category.name_en;
            document.getElementById('editNameAr').value = category.name_ar;
            document.getElementById('editDescriptionEn').value = category.description_en;
            document.getElementById('editDescriptionAr').value = category.description_ar;
            document.getElementById('editPage').value = page;
            document.getElementById('editCategoryForm').action = `/admin/categories/${category.id}`;
        }
    </script>
@endsection

@extends('admin.layout.mainlayout')

@section('title', __('Areas - Bonfkeralden'))

@section('content')
    <div class="container-fluid py-4">
        @php
            $protectedAreaIds = [1, 2, 3];
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
                            <h6 class="text-white text-capitalize ps-3">Areas Table</h6>
                            <button type="button" class="btn btn-primary me-3" id="createAreaButton"
                                data-bs-toggle="modal" data-bs-target="#createAreaModal">
                                Add New Area
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0 text-center" id="areasTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name (EN)</th>
                                        <th>Name (AR)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($areas as $area)
                                        <tr>
                                            <td>{{ $area->id }}</td>
                                            <td>{{ $area->name_en }}</td>
                                            <td>{{ $area->name_ar }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editAreaModal"
                                                    onclick="populateEditModal({{ $area }}, {{ request('page', 1) }})">
                                                    Edit
                                                </button>

                                                <!-- Delete Button -->
                                                @if (!in_array($area->id, $protectedAreaIds))
                                                    <form action="{{ route('admin.areas.destroy', $area) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this area?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Disabled Delete Button with Tooltip -->
                                                    <button class="btn btn-secondary btn-sm" disabled
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="This area cannot be deleted.">
                                                        Delete
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $areas->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Area Modal -->
        <div class="modal fade" id="createAreaModal" tabindex="-1" aria-labelledby="createAreaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.areas.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createAreaModalLabel">Create Area</h5>
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
                                <label for="city" class="form-label">City</label>
                                <select name="city_id" id="city" required class="form-select">
                                    <option value="">Select City</option>

                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name_en }}</option>
                                    @endforeach
                                </select>
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

        <!-- Edit Area Modal -->
        <div class="modal fade" id="editAreaModal" tabindex="-1" aria-labelledby="editAreaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="POST" id="editAreaForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="page" id="editPage">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAreaModalLabel">Edit Area</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editAreaId" name="id">
                            <div class="form-group mb-3">
                                <label for="editNameEn" class="form-label">Name (English)</label>
                                <input type="text" name="name_en" id="editNameEn" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editNameAr" class="form-label">Name (Arabic)</label>
                                <input type="text" name="name_ar" id="editNameAr" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="city" class="form-label">City</label>
                                <select name="city_id" required class="form-select" id="editCityId">
                                    <option value="">Select City</option>

                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            >{{ $city->name_en }}</option>
                                    @endforeach
                                </select>
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
        function populateEditModal(area, page) {
            document.getElementById('editAreaId').value = area.id;
            document.getElementById('editNameEn').value = area.name_en;
            document.getElementById('editNameAr').value = area.name_ar;
            document.getElementById('editCityId').value = area.city_id;
            document.getElementById('editAreaForm').action = `/admin/areas/${area.id}`;
        }
    </script>
@endsection

@extends('admin.layout.mainlayout')

@section('title', __('Cities - Bonfkeralden'))

@section('content')
    <div class="container-fluid py-4">
        @php
            $protectedCityIds = [1, 2, 3];
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
                            <h6 class="text-white text-capitalize ps-3">Cities Table</h6>
                            <button type="button" class="btn btn-primary me-3" id="createCityButton"
                                data-bs-toggle="modal" data-bs-target="#createCityModal">
                                Add New City
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0 text-center" id="citiesTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name (EN)</th>
                                        <th>Name (AR)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{ $city->id }}</td>
                                            <td>{{ $city->name_en }}</td>
                                            <td>{{ $city->name_ar }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editCityModal"
                                                    onclick="populateEditModal({{ $city }}, {{ request('page', 1) }})">
                                                    Edit
                                                </button>

                                                <!-- Delete Button -->
                                                @if (!in_array($city->id, $protectedCityIds))
                                                    <form action="{{ route('admin.cities.destroy', $city) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this city?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Disabled Delete Button with Tooltip -->
                                                    <button class="btn btn-secondary btn-sm" disabled
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="This city cannot be deleted.">
                                                        Delete
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $cities->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create City Modal -->
        <div class="modal fade" id="createCityModal" tabindex="-1" aria-labelledby="createCityModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.cities.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCityModalLabel">Create City</h5>
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
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit City Modal -->
        <div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="POST" id="editCityForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="page" id="editPage">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCityModalLabel">Edit City</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editCityId" name="id">
                            <div class="form-group mb-3">
                                <label for="editNameEn" class="form-label">Name (English)</label>
                                <input type="text" name="name_en" id="editNameEn" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editNameAr" class="form-label">Name (Arabic)</label>
                                <input type="text" name="name_ar" id="editNameAr" class="form-control" required>
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
        function populateEditModal(city, page) {
            document.getElementById('editCityId').value = city.id;
            document.getElementById('editNameEn').value = city.name_en;
            document.getElementById('editNameAr').value = city.name_ar;
            document.getElementById('editCityForm').action = `/admin/cities/${city.id}`;
        }
    </script>
@endsection

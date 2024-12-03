<!-- resources/views/admin/contact_us/index.blade.php -->

@extends('admin.layout.mainlayout')

@section('title', __('Contact Us Messages - Bonfkeralden'))

@section('content')
    <div class="container-fluid py-4">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Contact Us Messages Table -->
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <!-- Card Header -->
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Contact Us Messages</h6>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0 text-center" id="messagesTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Received At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ $message->id }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ Str::limit($message->message, 50) }}</td>

                                            <td>{{ $message->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <!-- View Button -->
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#viewMessageModal"
                                                    onclick="populateViewModal({{ $message }})">
                                                    View
                                                </button>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.contact_us.destroy', $message) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this message?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center">
                                {{ $messages->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Message Modal -->
        <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewMessageModalLabel">View Contact Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Message Details -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Name:</strong></label>
                                <p id="viewName"></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Email:</strong></label>
                                <p id="viewEmail"></p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Message:</strong></label>
                                <p id="viewMessage"></p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Received At:</strong></label>
                                <p id="viewReceivedAt"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Optionally, you can add buttons to update the status -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- Example: <button type="button" class="btn btn-primary">Mark as Resolved</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Initialize Bootstrap Tooltips (if any) -->
    <script>
        // Initialize Bootstrap tooltips if you have any
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <!-- Script to Populate View Message Modal -->
    <script>
        function populateViewModal(message) {
            document.getElementById('viewName').innerText = message.name;
            document.getElementById('viewEmail').innerText = message.email;
            document.getElementById('viewMessage').innerText = message.message;
            document.getElementById('viewReceivedAt').innerText = new Date(message.created_at).toLocaleString();
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
@endsection
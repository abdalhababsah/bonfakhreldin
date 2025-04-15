@extends('admin.layout.mainlayout')

@section('title', __('Products - Bonfkeralden'))

@section('content')
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Products Table</h6>
                            <div>
                                <button type="button" class="btn btn-primary" onclick="saveInShop()">Update In Shop</button>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary me-3">
                                    Add New Product
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0 text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name (EN)</th>
                                        <th>Name (AR)</th>
                                        <th>Category</th>
                                        <th>In shop</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name_en }}</td>
                                            <td>{{ $product->name_ar }}</td>
                                            <td>{{ $product->category->name_en }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input in-shop-switch m-auto" type="checkbox" role="switch" 
                                                    data-product-id="{{ $product->id }}" 
                                                    @checked($product->in_shop)>
                                                </div>
                                            </td>
                                            <td>{{ ucfirst($product->status) }}</td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>

                                <script>
                                    function saveInShop() {
                                        const switches = document.querySelectorAll('.in-shop-switch');
                                        const data = Array.from(switches).map(switchElement => ({
                                            id: switchElement.dataset.productId,
                                            in_shop: switchElement.checked
                                        }));
                                        

                                        fetch('{{ route('admin.products.updateInShop') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({ data })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.message === 'Product updated successfully.') {
                                                alert('In-shop statuses saved successfully!');
                                            } else {
                                                alert('Failed to save in-shop statuses.');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('An error occurred while saving in-shop statuses.');
                                        });
                                    }
                                </script>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $products->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

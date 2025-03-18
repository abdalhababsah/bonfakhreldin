@extends('admin.layout.mainlayout')


@section('title', __('Orders - Bonfkeralden'))

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border shadow-none">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg p-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize">Order Details</h6>
                        <span class="text-white">{{ $order->order_number }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $item)
                                    <tr>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->total_price }}</td>
                                        <td class="d-flex align-items-center">
                                            <img
                                            @if ($item->product->primaryImage)
                                            src="{{ asset('storage/' . $item->product->primaryImage->image_url) }}"
                                            class="img-fluid rounded" style="max-height: 150px"
                                            alt="{{ $item->product->name_en }}"
                                            @else
                                            src="https://via.placeholder.com/50"
                                            alt="Primary Image"
                                            @endif
                                            class="rounded me-3" width="50">
                                            <div>
                                                <span>{{ $item->product->name }} - {{ $item->size }}</span>
                                                <br>
                                                <small>{{ $item->option }}</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <h6>Customer Information</h6>
                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>

                    <hr>

                    <h6>Delivery Information</h6>
                    <p><strong>City:</strong> {{ $order->area?->city?->name ?? 'N/A' }}</p>
                    <p><strong>Area:</strong> {{ $order->area?->name ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $order->address ?? 'N/A' }}</p>

                    <hr>

                    <p><strong>Note:</strong> {{ $order->notes ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border shadow-none">
                <div class="card-header bg-transparent border-bottom py-3 px-4">
                    <h5 class="font-size-16 mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Subtotal:</td>
                                    <td class="text-end">{{ $order->total_price }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Discount:</td>
                                    <td class="text-end">- {{ $order->discount }}</td>
                                </tr> --}}
                                <tr>
                                    <td>Delivery Price:</td>
                                    <td class="text-end">{{ $order->delivery_fee }}</td>
                                </tr>
                                <tr class="bg-light">
                                    <th>Total:</th>
                                    <td class="text-end">
                                        <strong>{{ $order->total_price + $order->delivery_fee }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card border shadow-none mt-4">
                <div class="card-header bg-transparent border-bottom py-3 px-4">
                    <h5 class="font-size-16 mb-0">Actions</h5>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mb-3">
                        <i class="mdi mdi-arrow-left"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

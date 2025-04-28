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
                    <x-table.order-items :items="$details" />
                    <hr>

                    <h6>Customer Information</h6>
                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>

                    <hr>

                    
                    @if ($order->deliverable == App\Enums\OrderDeliverableEnums::Delivery)
                    <h6>Delivery Information</h6>
                    <p><strong>City:</strong> {{ $order->delivery?->area?->city?->name ?? 'N/A' }}</p>
                    <p><strong>Area:</strong> {{ $order->delivery?->area?->name ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $order->delivery?->address ?? 'N/A' }}</p>
                        @if ($order->delivery->latitude && $order->delivery->longitude)
                            <p><strong>Location:</strong> <a href="https://www.google.com/maps?q={{ $order->delivery->latitude }},{{ $order->delivery->longitude }}" target="_blank">{{ __('View on Map') }}</a></p>
                        @endif
                    @else
                        <h6>Pickup Information</h6>
                        <p><strong>Branch:</strong> {{ $order->pickup->branch ?? 'N/A' }}</p>
                        {{-- <p><strong>{{__('Pickup Time')}}:</strong> {{ $order->pickup_time ?? 'N/A' }}</p> --}}
                    @endif

                    <hr>

                    <p><strong>Notes:</strong> {{ $order->notes ?? 'N/A' }}</p>
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
                                    <td class="text-end">{{ $order->delivery?->delivery_fee ?? '-'}}</td>
                                </tr>
                                <tr class="bg-light">
                                    <th>Total:</th>
                                    <td class="text-end">
                                        <strong>{{ $order->total_price + $order->delivery?->delivery_fee }}</strong>
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
                <!-- Update Status Button -->
                @if ($order->status == \App\Enums\OrderStatusEnums::Pending)
                    <h6>Accept order?</h6>
                    <a href="{{ route('admin.orders.update_status', [\App\Enums\OrderStatusEnums::Processing, $order]) }}" title="Accept Order">
                        <i class="material-symbols-rounded opacity-5 text-success text-4xl">check</i>
                    </a>
                    <a href="{{ route('admin.orders.update_status', [\App\Enums\OrderStatusEnums::Declined, $order]) }}" title="Reject Order">
                        <i class="material-symbols-rounded opacity-5 text-danger text-4xl">close</i>
                    </a>
                @elseif ($order->status == \App\Enums\OrderStatusEnums::Processing)
                    <h6>Complete order?</h6>
                    <a href="{{ route('admin.orders.update_status', [\App\Enums\OrderStatusEnums::Completed, $order]) }}" title="Complete Order">
                        <i class="material-symbols-rounded opacity-5 text-success text-4xl">check_circle</i>
                    </a>
                @else
                    <h6>Order {{$order->status}}</h6>
                    <i class="material-symbols-rounded opacity-5 text-secondary text-4xl">done_all</i>
                @endif
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

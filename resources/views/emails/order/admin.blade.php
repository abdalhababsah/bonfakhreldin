<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice for Order</title>
    <style>
        /* Reset styles */
        body, p, h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            color: #333333;
            line-height: 1.6;
            text-align: start;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #f7f7f7;
        }
        .content {
            {{ $order->lang == 'ar' ? 'direction: rtl;' : '' }}
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #126442;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            color: #ffffff;
            margin-top: 10px;
            font-size: 24px;
        }
        .details {
            margin: 20px 0;
        }
        .details p {
            margin: 8px 0;
            font-size: 16px;
        }
        .details p strong ,
        .details h6 strong {
            color: #126442;
        }
        .details .table-product {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .message {
            font-size: 16px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            color: #777777;
            font-size: 12px;
            margin-top: 30px;
        }
        .footer p {
            margin: 5px 0;
        }
        @media only screen and (max-width: 600px) {
            .content {
                padding: 20px;
            }
            .header h1 {
                font-size: 20px;
            }
            .details p {
                font-size: 14px;
            }
            .message {
                font-size: 14px;
            }
        }
    </style>
</head>
<body style="background-color: #f7f7f7;" {{ $order->lang == 'ar' ? 'dir=rtl' : '' }}>
    <div class="container">
        <div class="content">
            <!-- Header Section with Logo -->
            <div class="header">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo/gold-bonfakhraldin.png') }}" alt="{{ config('app.name') }} Logo"
                    style="max-width: 100px; height: auto; display: block; margin: auto;">
                </a>
                <h1>{{__('New Order')}}!</h1>
            </div>

            <!-- Order Details -->
            <div class="details">
                <p><strong>{{__('Date')}}:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                <p><strong>{{__('Total')}}:</strong> {{ number_format($order->total_price, 2) }}JD</p>
                @if ($order->deliverable == App\Enums\OrderDeliverableEnums::Delivery)
                    <p><strong>{{__('Delivery Fee')}}:</strong> {{ number_format($order->delivery?->delivery_fee, 2) }}JD</p>
                    <p><strong>{{__('Grand Total')}}:</strong> {{ number_format($order->total_price + $order->delivery?->delivery_fee, 2) }}JD</p>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>{{__('Product')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th>{{__('Total')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $item)
                                    <tr>
                                        <td class="table-product">
                                            <img
                                            @if ($item->product->primaryImage)
                                            src="{{ asset('storage/' . $item->product->primaryImage->image_url) }}"
                                            class="img-fluid rounded" style="max-height: 150px"
                                            alt="{{ $item->product->name }}"
                                            @else
                                            src="https://via.placeholder.com/50"
                                            alt="Primary Image"
                                            @endif
                                            class="rounded me-3" width="50">
                                            <div>
                                                <span>{{ $item->product->name }} - {{ $item->size }}
                                                    @if ($item->option)
                                                        - {{ $item->option }}
                                                    @endif
                                                </span>
                                                <br>
                                                <ul>
                                                    @foreach ($item->additions as $itemAddition)
                                                    <li>
                                                        <small>{{ $itemAddition['name'] ?? 'NAN' }} {{ $itemAddition['quantity'] > 1 ? '×'.$itemAddition['quantity']:''}}</small>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->total_price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <h6>{{__('Customer Info')}}</h6>
                    <p><strong>{{__('Name')}}:</strong> {{ $order->name }}</p>
                    <p><strong>{{__('Email')}}:</strong> {{ $order->email }}</p>
                    <p><strong>{{__('Phone')}}:</strong> {{ $order->phone }}</p>

                    <hr>

                    @if ($order->deliverable == App\Enums\OrderDeliverableEnums::Delivery)
                        <h6>{{__('Delivery Info')}}</h6>
                        <p><strong>{{__('City')}}:</strong> {{ $order->delivery?->area?->city?->name ?? 'N/A' }}</p>
                        <p><strong>{{__('Area')}}:</strong> {{ $order->delivery?->area?->name ?? 'N/A' }}</p>
                        <p><strong>{{__('Address')}}:</strong> {{ $order->delivery?->address ?? 'N/A' }}</p>
                        @if ($order->delivery->latitude && $order->delivery->longitude)
                            <p><strong>{{__('Location')}}:</strong> <a href="https://www.google.com/maps?q={{ $order->delivery->latitude }},{{ $order->delivery->longitude }}" target="_blank">{{ __('View on Map') }}</a></p>
                        @endif
                    @else
                        <h6>{{__('Pickup Info')}}</h6>
                        <p><strong>{{__('Branch')}}:</strong> {{ $order->pickup->branch ?? 'N/A' }}</p>
                        {{-- <p><strong>{{__('Pickup Time')}}:</strong> {{ $order->pickup_time ?? 'N/A' }}</p> --}}
                    @endif

                    <hr>

                    <p><strong>{{__('Notes')}}:</strong> {{ $order->notes ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Closing Statement -->
            <p class="message">{{__('Best Regards')}}<br>
                {{ config('app.name') }} {{__('Team')}}</p>

            <!-- Footer Section -->
            <div class="footer">
                <p>{{ config('app.name') }} | {{__('Jordan')}}</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{__('All rights reserved')}}.</p>
            </div>
        </div>
    </div>
</body>
</html>

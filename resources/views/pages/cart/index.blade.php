@extends('layout.mainlayout')

@section('title', __('Cart'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title">{{ __('Your Cart') }}</h1>

            @if(!empty($cart['items']) && is_array($cart['items']))
            <div class="cart-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Size') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Remove') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart['items'] as $item)
                        <tr>
                            <td class="image">
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" style="width: 60px;">
                            </td>
                            <td class="product">
                                {{ $item['name'] }}
                                @isset($item['option'])
                                -
                                <span>{{ $item['option'] }}</span>
                                @endisset
                                @if(!empty($item['additions']))
                                <br>
                                <ul>
                                @foreach ($item['additions'] as $itemAddition)
                                <li>
                                    <small>{{ $itemAddition['name'] ?? 'NAN' }} {{ $itemAddition['quantity'] > 1 ? '× ' . $itemAddition['quantity']:''}}</small>
                                </li>
                                @endforeach
                                </ul>
                                @endif
                            </td>
                            <td class="size">{{ $item['size'] }}</td>
                            <td class="price">{{ number_format($item['price'], 2) }} JOD</td>
                            <td class="quantity">
                                <div class="single-product-actions">
                                    <div class="single-product-actions-item">
                                        <div class="product-quantity-count">
                                            <button class="dec qty-btn">-</button>
                                            <input class="product-quantity-box quantity-input" type="number" name="quantity"
                                            data-product-id="{{ $item['product_id'] }}"
                                            data-size-id="{{ $item['size_id'] }}"
                                            data-price="{{ $item['price'] }}"
                                            data-key="{{ $item['key'] }}"
                                            value="{{ $item['quantity'] }}"
                                            >
                                            <button class="inc qty-btn">+</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="total">
                                <span id="total-{{ $item['key'] }}">
                                    {{ number_format($item['total'], 2) }}
                                </span>
                                 JOD
                            </td>
                            <td>
                                <form action="{{ url('cart/remove', $item['key']) }}" method="POST" class="remove-item-form">
                                    <button type="button" class="btn remove-item-btn" onclick="return confirmAndRemove(this);">
                                        <i class="sli-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-totals mt-4">
                <h2 class="title">{{ __('Cart Totals') }}</h2>
                <table class="table">
                    <tr>
                        <th>{{ __('Subtotal') }}</th>
                        <td>
                            <span id="cart-subtotal">
                                {{ number_format($cart['totalPrice'], 2) }}
                            </span>
                             JOD
                        </td>
                    </tr>
                </table>
                <a href="{{ url('/checkout') }}" class="btn btn-create">{{ __('Proceed to Checkout') }}</a>
            </div>
            @else
            <div class="align-items-center justify-content-center text-center">
                <img src="{{url('assets/images/empty-cart.png')}}" alt="empty cart" class="img-fluid me-3" style="width: 200px;">
                <h5 class="m-4">{{ __('Your cart is currently empty') }}.</h5>
                <a href="{{ url('/shop') }}" class="btn btn-create">{{ __('Go shopping') }}</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/js/cart.js')}}"></script>
@endsection
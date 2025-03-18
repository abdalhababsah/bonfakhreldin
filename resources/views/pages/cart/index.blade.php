@extends('layout.mainlayout')

@section('title', __('Cart'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="section-title">{{ __('Your Cart') }}</h1>
                @if(count($cart['items']) > 0)
                <div class="cart-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Size') }}</th>
                                <th>{{ __('Product') }}</th>
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
                                        <img src="{{  $item['image_url'] }}" alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="product">{{ $item['name'] }}</td>
                                    <td class="size">{{ $item['size'] }}</td>
                                    <td class="price">{{ $item['price'] }}</td>
                                    <td class="quantity">
                                        <form action="{{ url('cart/update', $item['product_id'] . '-' . $item['size_id']) }}" method="POST" class="update-quantity-form">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="total">{{ $item['total'] }}</td>
                                    <td class="">
                                        <form action="{{ url('cart/remove', $item['product_id'] . '-' . $item['size_id']) }}" method="POST" class="remove-item-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn remove-item-btn" onclick="return confirm('{{__('Are you sure you want to remove this item?')}}') ? removeItem(this) : null"><i class="sli-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-totals">
                    <h2 class="title">{{ __('Cart Totals') }}</h2>
                    <table class="table">
                        <tr>
                            <th>{{ __('Subtotal') }}</th>
                            <td id="cart-subtotal">{{ $cart['totalPrice'] }}</td>
                        </tr>
                    </table>
                    <a href="{{ url('cart/checkout') }}" class="btn btn-create">{{ __('Proceed to Checkout') }}</a>
                </div>
                @else

                <p>{{ __('Your cart is currently empty') }}.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

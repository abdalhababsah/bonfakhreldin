@extends('layout.mainlayout')

@section('title', __('Cart'))

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="section-title">{{ __('Your Cart') }}</h1>
                <div class="cart-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="image">{{ __('Image') }}</th>
                                <th class="product">{{ __('Product') }}</th>
                                <th class="size">{{ __('Size') }}</th>
                                <th class="price">{{ __('Price') }}</th>
                                <th class="quantity">{{ __('Quantity') }}</th>
                                <th class="total">{{ __('Total') }}</th>
                                <th class="remove">{{ __('Remove') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart['items'] as $item)
                                <tr>
                                    <td class="image">
                                        <img src="{{  $item['image_url'] }}" alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="product">{{ $item['name'] }}</td>
                                    <td class="price">{{ $item['price'] }}</td>
                                    <td class="size">{{ $item['size'] }}</td>
                                    <td class="quantity">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control">
                                    </td>
                                    <td class="total">{{ $item['total'] }}</td>
                                    <td class="">
                                        <form action="{{ url('cart/remove', $item['product_id'] . '-' . $item['size_id']) }}" method="POST" class="remove-item-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn remove-item-btn" onclick="removeItem()"><i class="sli-trash"></i></button>
                                        </form>
                                        <script>
                                            function removeItem() {
                                                if (confirm('Are you sure you want to remove this item?')) {
                                                    document.querySelector('.remove-item-form').submit();
                                                }
                                            }
                                        </script>
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
                            <td>{{ $cart['totalPrice'] }}</td>
                        </tr>
                        {{-- <tr>
                            <th>{{ __('Total') }}</th>
                            <td>{{ $total }}</td>
                        </tr> --}}
                    </table>
                    <a href="{{ url('checkout') }}" class="btn btn-creat">{{ __('Proceed to Checkout') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

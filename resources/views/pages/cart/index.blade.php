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
                                        <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}">
                                    </td>
                                    <td class="product">{{ $item->product->name }}</td>
                                    <td class="price">{{ $item->product->price }}</td>
                                    <td class="quantity">
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control">
                                    </td>
                                    <td class="total">{{ $item->product->price * $item->quantity }}</td>
                                    <td class="remove">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-btn"><i class="fas fa-trash-alt"></i></button>
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

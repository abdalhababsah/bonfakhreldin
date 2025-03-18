@extends('layout.mainlayout')

@section('title', __('Checkout'))

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="section-title">{{ __('Checkout') }}</h1>
            </div>
        </div>
        <form action="{{ url('orders/store') }}" method="POST">
            <div class="row">
                <!-- Billing Details -->
                <div class="col-lg-8">
                    <div class="checkout-box">
                        <h2>{{ __('Billing Details') }}</h2>
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-field" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-field" value="{{old('email')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-field" value="{{old('phone')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ __('Notes') }}</label>
                            <textarea name="notes" id="notes" class="form-field"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="checkout-box">
                        <h2>{{ __('Your Order') }}</h2>
                        <table class="checkout-summary-table">
                            <tbody>
                                @foreach($cart['items'] as $item)
                                    <tr>
                                        <td>
                                            {{ $item['name'] }}-{{$item['size']}}
                                            @if ($item['option'])
                                            <br>
                                            <small>{{$item['option']}}</small>
                                            @endif
                                        </td>
                                        <td>x {{ $item['quantity'] }}</td>
                                        <td>{{ $item['total'] }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th>{{ __('Subtotal') }}</th>
                                    <td>{{ $cart['totalPrice'] }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Total') }}</th>
                                    <td>{{ $cart['totalPrice'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="checkout-box">
                        <h2>{{ __('Address') }}</h2>
                        <div>
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <select name="city_id" id="city" class="form-field" required onchange="getAreas(this.value)">
                                    <option value="">{{ __('Select City') }}</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="area">{{ __('Area') }}</label>
                                <select name="area_id" id="area" class="form-field" required>
                                    <option value="">{{ __('Select Area') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" name="address" id="address" class="form-field" value="{{old('address')}}" required>
                            </div>
                        </div>
                        {{-- <h2>{{ __('Payment Method') }}</h2>
                        <div class="checkout-payment-method">
                            <div class="single-method">
                                <input type="radio" name="payment_method" id="payment_method_1" value="credit_card" checked>
                                <label for="payment_method_1">{{ __('Credit Card') }}</label>
                                <p>{{ __('Pay with your credit card.') }}</p>
                            </div>
                            <div class="single-method">
                                <input type="radio" name="payment_method" id="payment_method_2" value="paypal">
                                <label for="payment_method_2">{{ __('PayPal') }}</label>
                                <p>{{ __('Pay via PayPal.') }}</p>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-create mt-2 mx-auto">{{ __('Place Order') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

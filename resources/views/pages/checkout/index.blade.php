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
                        <hr>
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
                                        {{-- <td>x {{ $item['quantity'] }}</td> --}}
                                        <td>{{ $item['total'] }}</td>
                                    </tr>
                                @endforeach
                                <tr class="border-top">
                                    <th>{{ __('Subtotal') }}</th>
                                    <td id="subtotal">{{ $cart['totalPrice'] }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Delivery Fee') }}</th>
                                    <td id="delivery_fee">0</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Total') }}</th>
                                    <td id="total">{{ $cart['totalPrice'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="checkout-box">
                        <h2>{{ __('Delivery Method') }}</h2>
                        <div class="form-group">
                            <label for="deliverable">{{ __('Choose Delivery Method') }}</label>
                            <select name="deliverable" id="deliverable" class="form-field" required onchange="toggleDeliveryMethod(this.value)">
                                <option value="">{{ __('Select Method') }}</option>
                                <option value="delivery">{{ __('Delivery') }}</option>
                                <option value="pickup">{{ __('Pickup') }}</option>
                            </select>
                        </div>
                        <div id="delivery_address" style="display: none;">
                            <h2>{{ __('Address') }}</h2>
                            <div>
                                <div class="form-group">
                                    <label for="city">{{ __('City') }}</label>
                                    <select name="city_id" id="city" class="form-field" onchange="getAreas(this.value);updateDeliveryFee(this.selectedOptions[0].getAttribute('data-delivery-fee'));">
                                        <option value="" data-delivery-fee=0>{{ __('Select City') }}</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" data-delivery-fee="{{ $city->delivery_fee ?? 0.0 }}">{{ $city->name }} - {{ $city->delivery_fee ?? 0.00 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="area">{{ __('Area') }}</label>
                                    <select name="area_id" id="area" class="form-field">
                                        <option value="">{{ __('Select Area') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">{{ __('Address') }}</label>
                                    <input type="text" name="address" id="address" class="form-field" value="{{old('address')}}">
                                </div>
                            </div>
                        </div>
                        <div id="pickup_branch" style="display: none;">
                            <h2>{{ __('Branch') }}</h2>
                            <div class="form-group">
                                <label for="branch">{{ __('Choose Branch') }}</label>
                                <select name="branch" id="branch" class="form-field">
                                    <option value="">{{ __('Select Branch') }}</option>
                                    @foreach(__('branches.branches') as $branch)
                                        <option value="{{ $branch['name'] }}">{{ $branch['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-create mt-2 mx-auto">{{ __('Place Order') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

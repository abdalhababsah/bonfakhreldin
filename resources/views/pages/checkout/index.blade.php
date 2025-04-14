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
                
                @if ($errors->any())
                <div class="col-sm-12 mt-10">
                    <div class="alert alert-danger alert-dismissible show" role="alert">
                        <ul class="ul-validate">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <!-- Billing Details -->
                <div class="col-lg-8">
                    <div class="checkout-box">
                        <h2>{{ __('Billing Details') }}</h2>
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-field" value="{{old('name')}}" required minlength="2" maxlength="75">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-field" value="{{old('email')}}" required minlength="5" maxlength="75">
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-field" value="{{old('phone')}}" required minlength="9" maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ __('Notes') }}</label>
                            <textarea name="notes" id="notes" class="form-field" maxlength="400"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="checkout-box">
                        <h2>{{ __('Order Summary') }}</h2>
                        <hr>
                        <table class="checkout-summary-table">
                            <tbody>
                                @foreach($cart['items'] as $item)
                                    <tr>
                                        <td>
                                            {{ $item['name'] }}-{{$item['size']}}
                                            @if ($item['option'])
                                            -{{$item['option']}}
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
                            <select name="deliverable" id="deliverable" class="form-field" required onchange="toggleDeliveryMethod(this.value)">
                                <option value="">{{ __('Select') }} {{__('Method')}}</option>
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
                                        <option value="" data-delivery-fee=0>{{ __('Select') }} {{__('City')}}</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" data-delivery-fee="{{ $city->delivery_fee ?? 0.0 }}">{{ $city->name }} - {{ $city->delivery_fee ?? 0.00 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="area">{{ __('Area') }}</label>
                                    <select name="area_id" id="area" class="form-field">
                                        <option value="">{{ __('Select') }} {{__('Area')}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">{{ __('Address') }}</label>
                                    <input type="text" name="address" id="address" class="form-field" value="{{old('address')}}">
                                </div>
                                <div id="orderMap" class="my-3"></div>
                                <input type="hidden" name="longitude" id="longitude">
                                <input type="hidden" name="latitude" id="latitude">
                            </div>
                        </div>
                        <div id="pickup_branch" style="display: none;">
                            <h2>{{ __('Branch') }}</h2>
                            <div class="form-group">
                                <select name="branch" id="branch" class="form-field">
                                    <option value="">{{ __('Select') }} {{__('Branch')}}</option>
                                    @foreach(__('branches.branches') as $branch)
                                        <option value="{{ $branch['name'] }}">{{ $branch['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-create mt-2 mx-auto" onclick="handleOrderSubmission(event)">{{ __('Place Order') }}</button>

                        <script>
                            function handleOrderSubmission(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: '{{ __("Order Placed!") }}',
                                    text: '{{ __("Thank You for Your Order") }}',
                                    icon: 'success',
                                    confirmButtonText: '{{ __("OK") }}'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        event.target.closest('form').submit();
                                        // Swal.fire({
                                        //     title: '{{ __("Order Placed!") }}',
                                        //     text: '{{ __("Your order has been placed successfully.") }}',
                                        //     icon: 'success',
                                        //     confirmButtonText: '{{ __("OK") }}'
                                        // });
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{url('/assets/js/checkout.js')}}"></script>
@endsection
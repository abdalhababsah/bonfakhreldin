@extends('layout.mainlayout')

@section('title', __('cart.title'))

@section('content')

    <x-breadcrumb />
    <!-- BEGIN DETAIL MAIN BLOCK -->
    <div class="detail-block detail-block_margin">
        <div class="overlay"></div>
        <div class="wrapper">
            <div class="detail-block__content">
            </div>
        </div>
    </div>
    <!-- DETAIL MAIN BLOCK EOF -->

    <!-- BEGIN CART -->
    <div class="cart">
        <div class="wrapper">
            <div id="cart-container">
                <!-- Cart content will be dynamically injected via JavaScript -->
            </div>
        </div>
    </div>
    <!-- CART EOF -->
@endsection

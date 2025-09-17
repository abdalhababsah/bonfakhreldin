@extends('layout.mainlayout')

@section('title', __('Shop').' - ' . $category->name)

@section('meta')
    @parent
    <meta name="keywords" content="{{ $category->description .' , '. $category->name }}">
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
@endsection

@section('content')
<x-breadcrumb></x-breadcrumb>

<div class="container">
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4">
        @foreach ($products as $product)
            <div class="col">
                <button 
                    class="card shadow-sm h-100 p-3 see-options-btn w-100 my-3 rounded-0"
                    {{-- class=" btn btn-success"  --}}
                    data-bs-toggle="modal" 
                    data-bs-target="#productOptionsModal"
                    data-product="{{ $product->toJson() }}">
                <h5 class="product-title mb-2">{{ $product->name}}</h5>

                <img src="{{ asset( $product->primary_image_url) }}">                            

                </button>
            </div>
        @endforeach
    </div>
</div>

<div class="mt-4">
    {{ $products->withQueryString()->links() }}
</div>


<!-- Product Modal -->
<div class="modal fade" id="productOptionsModal" tabindex="-1" aria-labelledby="productOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">

                <div class="single-product-content">
                    <h2 id="modal-product-title" class="single-product-title"></h2>
                    <div id="modal-price-display" class="single-product-price"></div>
                    <div class="single-product-text">
                        <p id="modal-product-description"></p>
                    </div>

                </div>

                <ul class="single-product-variations">
                    <li>
                        <span class="label">{{__('Size')}} :</span>
                        <div class="value" id="modal-size-wrapper">
                        </div>
                    </li>
                    <li style="display: none;">
                        <span class="label">{{__('Options')}} :</span>
                        <div class="value" id="modal-options-wrapper">
                            <div id="modal-option-select"></div>
                        </div>
                    </li>
                    <hr>
                    <li style="display: none;">
                        {{-- <span class="label">{{__('Additions')}} :</span> --}}
                        <div class="value" id="modal-addtions-wrapper"></div>
                    </li>
                </ul>

                <div class="single-product-actions">
                    <div class="single-product-actions-item">
                        <div class="product-quantity-count">
                            <button class="dec qty-btn">-</button>
                                <input class="product-quantity-box" disabled name="quantity" id="modal-qty" min="1" value="1">
                            <button class="inc qty-btn">+</button>
                        </div>
                    </div>
                    <div class="single-product-actions-item">
                        <button id="add-to-cart-modal-btn"
                            class="btn btn-success rounded-0">
                            ADD TO CART
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/shop.js') }}"></script>
@endsection
@extends('layout.mainlayout')

@section('title', $product->name)

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/view-product.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <x-breadcrumb />

    <!-- Middle Section -->
    <div id="middle-section" class="section-unique">
        <div class="split-container">
            <!-- Left Content -->
            <div class="left-side">
                <h2 class="animate__animated animate__fadeIn">
                    {{ __('view_product.hero_section.heading', ['product_name' => $product->name]) }}
                </h2>
                <p class="animate__animated animate__fadeInUp">
                    {{ __('view_product.hero_section.description', ['product_description' => $product->description]) }}
                </p>
            </div>

            <!-- Right Content -->
            <div class="right-side"></div>
            <!-- Floating Image -->
            <div id="floatingProductImage" class="floating-image animate__animated animate__zoomIn">
                <img src="{{ $product->images->first() && $product->images->first()->image_url
                    ? asset('storage/' . $product->images->first()->image_url)
                    : asset('assets/images/default-placeholder.png') }}"
                    alt="{{ $product->name }}">
            </div>
        </div>
    </div>

    <form action="{{ url('cart/add', $product->id) }}" class="row" method="POST" id="add-to-cart-form">
        @csrf
        <div class="form-group col-4">
            <select name="size_id" id="size" class="form-control">
                <option value="">{{ __('view_product.select_size') }}</option>
                @if (isset($product->sizes) && count($product->sizes) > 0)
                    @foreach($product->sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->value }}</option>
                    @endforeach

                @endif
            </select>
        </div>
        <div class="form-group col-4">
            <div class="product-options">
                <div class="product-info__quantity" style="direction: ltr">
                    <div class="counter-box">
                        <span class="counter-link counter-link__prev"><i class="sli-arrow-left"></i></span>
                        {{-- <input type="text" class="counter-input" disabled value="1"> --}}
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" disabled>
                        <span class="counter-link counter-link__next"><i class="sli-arrow-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-create" onclick="addToCart()">{{ __('Add to cart') }}</button>
    </form>

    <!-- Slider Section -->
    <div id="slider-section" class="section-unique">
        <div class="content">
            <h2 class="animate__animated animate__fadeIn">
                {{ __('view_product.slider_section.heading') }}
            </h2>
            <div class="slider">
                <div class="slider-item animate__animated animate__fadeInLeft">
                    <i class="icon fas fa-gem"></i>
                    <h3>{{ __('view_product.slider_section.features.premium_materials.title') }}</h3>
                    <p>{{ __('view_product.slider_section.features.premium_materials.description') }}</p>
                </div>
                <div class="slider-item animate__animated animate__fadeInRight">
                    <i class="icon fas fa-award"></i>
                    <h3>{{ __('view_product.slider_section.features.exclusive_design.title') }}</h3>
                    <p>{{ __('view_product.slider_section.features.exclusive_design.description') }}</p>
                </div>
                <div class="slider-item animate__animated animate__fadeInLeft">
                    <i class="icon fas fa-certificate"></i>
                    <h3>{{ __('view_product.slider_section.features.certified_quality.title') }}</h3>
                    <p>{{ __('view_product.slider_section.features.certified_quality.description') }}</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollify/1.0.19/jquery.scrollify.min.js"></script>
    <script src="{{url('js/scrollify.js')}}"></script> --}}
@endsection

@section('scripts')
@endsection

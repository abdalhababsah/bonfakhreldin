@extends('layout.mainlayout')

@section('title', __('Shop'))

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

@section('content')

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="product-card card shadow-sm h-100 p-3">
                            <h5 class="product-title mb-2">{{ $product->name}}</h5>

                            @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}">
                            @endforeach

                            <button 
                                class="see-options-btn w-100 btn btn-success" 
                                data-bs-toggle="modal" 
                                data-bs-target="#productOptionsModal"
                                data-product="{{ $product->toJson() }}">
                                See Options
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
    
@endsection

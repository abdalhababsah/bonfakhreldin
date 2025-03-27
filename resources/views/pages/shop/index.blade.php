@extends('layout.mainlayout')

@section('title', __('Shop'))

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

@section('content')
<x-breadcrumb />

<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold display-6">Shop by Category</h2>
    <div class="row g-5 justify-content-center">

        @foreach ($categories as $category)
            <div class="col-md-6 d-flex justify-content-center">
                <a href="{{ url('shop', $category->slug) }}" class="text-decoration-none w-100">
                    <div class="category-box elegant-hover shadow-lg"
                         style="background-image: url('{{ asset($category->image) }}')">
                        <h2 class="fw-bold">{{ $category->name }}</h2>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

@extends('layout.mainlayout')

@section('title', __('Shop'))

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

@section('content')
<x-breadcrumb />

<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold display-6">{{__('Shop by Category')}}</h2>
    <div class="row g-5 justify-content-center">
    @foreach ($categories as $category)
        <div class="col-md-6 d-flex justify-content-center">
        @if ($category->children->isNotEmpty())
            <div class="w-100">
            <div class="category-box elegant-hover shadow-lg"
                 style="background-image: url('{{ asset($category->image) }}')">
                <h2 class="fw-bold">{{ $category->name }}</h2>
            </div>
            <ul class="list-group mt-3">
                @foreach ($category->children as $child)
                <li class="list-group-item">
                    <a href="{{ url('shop', $child->slug) }}" class="text-decoration-none">
                    {{ $child->name }}
                    </a>
                </li>
                @endforeach
            </ul>
            </div>
        @else
            <a href="{{ url('shop', $category->slug) }}" class="text-decoration-none w-100">
            <div class="category-box elegant-hover shadow-lg"
                 style="background-image: url('{{ asset($category->image) }}')">
                <h2 class="fw-bold">{{ $category->name }}</h2>
            </div>
            </a>
        @endif
        </div>
    @endforeach
    </div>
</div>
@endsection

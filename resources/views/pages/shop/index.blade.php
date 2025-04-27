@extends('layout.mainlayout')

@section('title', __('Shop'))

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

@section('content')
<x-breadcrumb />
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold display-6">{{__('Shop by Category')}}</h2>
    <div class="row g-5 justify-content-center">
    @foreach ($categories as $category)
        <div class="col-lg-3 col-sm-6 d-flex justify-content-center">
        @if ($category->children->isNotEmpty())
            <div class="w-100">
                <a href="javascript:void(0);" class="text-decoration-none w-100" 
                onclick="document.getElementById('children-{{ $category->id }}').classList.toggle('d-none');">
                    <div class="category-box elegant-hover shadow-lg"
                    style="background-image: url('{{ asset($category->image ?:'assets/images/categories/'. $category->slug .'.jpg') }}')">
                        <h3>{{ $category->name }}</h3>
                    </div>
                </a>
                <ul id="children-{{ $category->id }}" class="list-group mt-3 d-none p-0" style="overflow: hidden;">
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
                    style="background-image: url('{{ asset($category->image ?:'assets/images/categories/'. $category->slug .'.jpg') }}')">
                    <h3>{{ $category->name }}</h3>
                </div>
            </a>
        @endif
        </div>
    @endforeach
    </div>
</div>
@endsection

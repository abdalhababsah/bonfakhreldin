@extends('layout.mainlayout')

@section('title', __('products.title'))

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/products.css') }}">
    <x-breadcrumb />


    <!-- Shop Product Section -->
    <div class="shop-product-section section section-padding">
        <div class="container">
            <div class="row">

                <!-- Left Sidebar (Filter Box) -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="filter-box">
                        <h5>@lang('products.filter_title')</h5>
                        <input type="text" id="search-bar" class="form-control" placeholder="@lang('products.search_placeholder')">
                        <select id="category-filter" class="form-select">
                            <option value="">@lang('products.all_categories')</option>
                        </select>
                    </div>
                </div>

                <!-- Right Content (Products and Pagination) -->
                <div class="col-lg-9 col-md-8" >
                <!-- Product Tab Start -->
                    <div class="tab-content" id="shopProductTabContent">
                        <!-- Grid View -->
                        <div class="tab-pane fade show active" id="product-grid">
                            <!-- Loader -->
                            <div id="loader" class="text-center my-5" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1 g-4 mb-n6" id="grid-view">
                                <!-- Dynamic Products will be injected here -->
                            </div>
                        </div>
                    </div>
                    <!-- Product Tab End -->

                    <!-- Shop Bottom Bar Start -->
                    <div class="shop-bottom-bar mt-4">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- Pagination links will be dynamically updated -->
                        </ul>
                    </div>
                    <!-- Shop Bottom Bar End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Default Placeholder Image -->
    <img id="default-placeholder" src="{{ asset('assets/images/default-placeholder.png') }}" alt="Placeholder" style="display: none;">

@endsection
@section('scripts')
<script src="{{url('assets/js/products.js')}}"></script>
@endsection

@extends('layout.mainlayout')

@section('title', __('Shop'))
@section('meta_description', $category->description)
@section('meta_keywords', 'فخر الدين, تسوق, قهوة, شوكولا, بن فخر الدين الأردن')

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

@section('content')
<x-breadcrumb />
<div class="shop-product-section section section-padding">
    <div class="container">

        <!-- Shop Top Bar Start -->
        <div class="shop-top-bar">

            <div class="shop-top-bar-item">
                <div class="nav list-grid-toggle" role="tablist">
                    <button class="active" data-bs-toggle="tab" data-bs-target="#product-grid" aria-selected="true" role="tab"><i class="sli-grid"></i></button>
                    <button data-bs-toggle="tab" data-bs-target="#product-list" aria-selected="false" tabindex="-1" role="tab"><i class="sli-menu"></i></button>
                </div>
            </div>

        </div>
        <!-- Shop Top Bar End -->

        <!-- Product Tab Start -->
        <div class="tab-content" id="shopProductTabContent">
            <div class="tab-pane fade show active" id="product-grid" role="tabpanel">
                <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1 mb-n6">
                    @foreach ($products as $product)
                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="#" class="product-image"><img loading="lazy" src="{{ asset($product->primary_image_url) }}" alt="{{ $product->name }}" width="268" height="306"></a>
                                <div class="product-badge-left">
                                    @if ($product->is_new)
                                        <span class="product-badge-new">{{__('new')}}</span>
                                    @endif
                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn see-options-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"
                                    data-product="{{ $product->toJson() }}"
                                    ><i class="sli-magnifier"></i></button>
                                </div>
                            </div>
                            <div class="product-content">
                                <h5 class="product-title">{{ $product->name }}</h5>
                                <div class="product-price">
                                    @if(count($product->sizes) > 1)
                                        {{ $product->sizes->first()->price }} - {{ $product->sizes->last()->price }}
                                    @else
                                        {{ $product->sizes[0]->price }}
                                    @endif
                                    JOD
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="product-list" role="tabpanel">
                <div class="row row-cols-md-1 row-cols-sm-2 row-cols-1 gy-4">
                    @foreach ($products as $product)
                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="#" class="product-image"><img loading="lazy" src="{{ asset($product->primary_image_url) }}" alt="{{ $product->name }}" width="268" height="306"></a>
                                <div class="product-badge-left">
                                    @if ($product->is_new)
                                        <span class="product-badge-new">{{__('new')}}</span>
                                    @endif
                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn see-options-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"
                                    data-product="{{ $product->toJson() }}"
                                    ><i class="sli-magnifier"></i></button>
                                </div>
                            </div>
                            <div class="product-content">
                                <h5 class="product-title">{{ $product->name }}</h5>
                                <p class="product-excerpt">{{ $product->description }}</p>
                                <div class="product-price">
                                    @if(count($product->sizes) > 1)
                                        {{ $product->sizes->first()->price }} - {{ $product->sizes->last()->price }}
                                    @else
                                        {{ $product->sizes[0]->price }}
                                    @endif
                                    JOD
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Product Tab End -->

        <!-- Shop Bottom Bar Start -->
        <div class="shop-bottom-bar">
            <ul class="pagination">
                {{$products->links()}}
            </ul>
        </div>
        <!-- Shop Bottom Bar End -->

    </div>
</div>
<div class="quickview-product-modal modal fade" id="exampleProductModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="container">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <!-- Single Product Top Area Start -->
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
                                {{__('ADD TO CART')}}
                            </button>
                        </div>
                    </div>
                    <!-- Single Product Top Area End -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/shop.js') }}"></script>
@endsection
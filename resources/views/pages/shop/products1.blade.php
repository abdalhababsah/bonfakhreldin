@extends('layout.mainlayout')

@section('title', __('Shop'))

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
                {{-- <li class="disabled"><a href="#prev"><i class="sli-arrow-left"></i></a></li>
                <li><a class="active" href="#page=1">1</a></li>
                <li><a href="#page=2">2</a></li>
                <li><a href="#page=3">3</a></li>
                <li><a href="#next"><i class="sli-arrow-right"></i></a></li> --}}
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
                    {{-- <div class="row row-cols-md-2 row-cols-1 mb-n6">

                        <!-- Product Image Start -->
                        <div class="col mb-6">
                            <div class="single-product-image">

                                <!-- Product Badge Start -->
                                <div class="single-product-badge-left">
                                    <span class="single-product-badge-new">new</span>
                                </div>
                                <div class="single-product-badge-right">
                                    <span class="single-product-badge-sale">sale</span>
                                    <span class="single-product-badge-sale">-11%</span>
                                </div>
                                <!-- Product Badge End -->

                                <!-- Product Image Slider Start -->
                                <div class="quickview-product-image-slider swiper swiper-initialized swiper-horizontal swiper-pointer-events">
                                    <div class="swiper-wrapper" id="swiper-wrapper-f18fb97c2a2510989" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                                        <div class="swiper-slide swiper-slide-active" style="width: 304px; margin-right: 30px;"><img loading="lazy" src="./assets/images/products/single/single-product-1.jpg" alt="Signature Blend Roast Coffee"></div>
                                        <div class="swiper-slide swiper-slide-next" style="width: 304px; margin-right: 30px;"><img loading="lazy" src="./assets/images/products/single/single-product-2.jpg" alt="Signature Blend Roast Coffee"></div>
                                        <div class="swiper-slide" style="width: 304px; margin-right: 30px;"><img loading="lazy" src="./assets/images/products/single/single-product-3.jpg" alt="Signature Blend Roast Coffee"></div>
                                        <div class="swiper-slide" style="width: 304px; margin-right: 30px;"><img loading="lazy" src="./assets/images/products/single/single-product-4.jpg" alt="Signature Blend Roast Coffee"></div>
                                    </div>
                                    <div class="swiper-pagination d-none swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span></div>
                                    <div class="swiper-button-prev d-none swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-f18fb97c2a2510989" aria-disabled="true"></div>
                                    <div class="swiper-button-next d-none" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-f18fb97c2a2510989" aria-disabled="false"></div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                                <!-- Product Image Slider End -->

                                <!-- Product Thumbnail Carousel Start -->
                                <div class="quickview-product-thumb-carousel swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-thumbs">
                                    <div class="swiper-wrapper" id="swiper-wrapper-cbd2a766517610ae8" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                                        <div class="swiper-slide swiper-slide-visible swiper-slide-active swiper-slide-thumb-active" style="width: 68.75px; margin-right: 10px;"><img loading="lazy" src="./assets/images/products/single/single-product-1.jpg" alt="Signature Blend Roast Coffee"></div>
                                        <div class="swiper-slide swiper-slide-visible swiper-slide-next" style="width: 68.75px; margin-right: 10px;"><img loading="lazy" src="./assets/images/products/single/single-product-2.jpg" alt="Signature Blend Roast Coffee"></div>
                                        <div class="swiper-slide swiper-slide-visible" style="width: 68.75px; margin-right: 10px;"><img loading="lazy" src="./assets/images/products/single/single-product-3.jpg" alt="Signature Blend Roast Coffee"></div>
                                        <div class="swiper-slide swiper-slide-visible" style="width: 68.75px; margin-right: 10px;"><img loading="lazy" src="./assets/images/products/single/single-product-4.jpg" alt="Signature Blend Roast Coffee"></div>
                                    </div>
                                    <div class="swiper-pagination d-none swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></span></div>
                                    <div class="swiper-button-prev swiper-button-lock swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-cbd2a766517610ae8" aria-disabled="true"></div>
                                    <div class="swiper-button-next swiper-button-lock swiper-button-disabled" tabindex="-1" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-cbd2a766517610ae8" aria-disabled="true"></div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                                <!-- Product Thumbnail Carousel End -->

                            </div>
                        </div>
                        <!-- Product Image End -->

                        <!-- Product Content Start -->
                        <div class="col mb-6">
                            <div class="single-product-content">
                                <h1 class="single-product-title">Signature Blend Roast Coffee</h1>
                                <div class="single-product-price">$99.00 <del>$110.00</del></div>
                                <ul class="single-product-meta">
                                    <li><span class="label">Availability :</span> <span class="value">11 Left in Stock</span></li>
                                </ul>
                                <div class="single-product-text">
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                                </div>
                                <ul class="single-product-variations">
                                    <li><span class="label">Size :</span>
                                        <div class="value">
                                            <div class="single-product-variation-size-wrap">
                                                <div class="single-product-variation-size-item"><input type="radio" name="qv-size" id="qv-size-s" checked=""><label for="qv-size-s">s</label></div>
                                                <div class="single-product-variation-size-item"><input type="radio" name="qv-size" id="qv-size-m"><label for="qv-size-m">m</label></div>
                                                <div class="single-product-variation-size-item"><input type="radio" name="qv-size" id="qv-size-l"><label for="qv-size-l">l</label></div>
                                                <div class="single-product-variation-size-item"><input type="radio" name="qv-size" id="qv-size-xl"><label for="qv-size-xl">xl</label></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><span class="label">Color :</span>
                                        <div class="value">
                                            <div class="single-product-variation-color-wrap">
                                                <div class="single-product-variation-color-item"><input type="radio" name="qv-color" id="qv-color-purple" checked=""><label for="qv-color-purple" style="background-color: purple;">purple</label></div>
                                                <div class="single-product-variation-color-item"><input type="radio" name="qv-color" id="qv-color-violet"><label for="qv-color-violet" style="background-color: violet;">violet</label></div>
                                                <div class="single-product-variation-color-item"><input type="radio" name="qv-color" id="qv-color-black"><label for="qv-color-black" style="background-color: black;">black</label></div>
                                                <div class="single-product-variation-color-item"><input type="radio" name="qv-color" id="qv-color-pink"><label for="qv-color-pink" style="background-color: pink;">pink</label></div>
                                                <div class="single-product-variation-color-item"><input type="radio" name="qv-color" id="qv-color-orange"><label for="qv-color-orange" style="background-color: orange;">orange</label></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><span class="label">Material :</span>
                                        <div class="value">
                                            <div class="single-product-variation-material-wrap">
                                                <div class="single-product-variation-material-item"><input type="radio" name="qv-material" id="qv-material-metal" checked=""><label for="qv-material-metal">metal</label></div>
                                                <div class="single-product-variation-material-item"><input type="radio" name="qv-material" id="qv-material-resin"><label for="qv-material-resin">resin</label></div>
                                                <div class="single-product-variation-material-item"><input type="radio" name="qv-material" id="qv-material-leather"><label for="qv-material-leather">leather</label></div>
                                                <div class="single-product-variation-material-item"><input type="radio" name="qv-material" id="qv-material-slag"><label for="qv-material-slag">slag</label></div>
                                                <div class="single-product-variation-material-item"><input type="radio" name="qv-material" id="qv-material-fiber"><label for="qv-material-fiber">fiber</label></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="single-product-actions">
                                    <div class="single-product-actions-item">
                                        <div class="product-quantity-count">
                                            <button class="dec qty-btn">-</button>
                                            <input class="product-quantity-box" type="text" name="quantity" value="1">
                                            <button class="inc qty-btn">+</button>
                                        </div>
                                    </div>
                                    <div class="single-product-actions-item"><button class="btn btn-dark btn-primary-hover rounded-0">ADD TO CART</button></div>
                                    <div class="single-product-actions-item"><button class="btn btn-icon btn-light btn-primary-hover rounded-0"><i class="sli-heart"></i></button></div>
                                    <div class="single-product-actions-item"><button class="btn btn-icon btn-light btn-primary-hover rounded-0"><i class="sli-refresh"></i></button></div>
                                </div>
                                <ul class="single-product-meta">
                                    <li><span class="label">Categories :</span> <span class="value links">
                                    <a href="#">Coffee</a>
                                    <a href="#">Deal Collection</a>
                                    <a href="#">Featured Products</a>
                                    <a href="#">Green coffee</a>
                                    <a href="#">Italian</a>
                                </span></li>
                                    <li><span class="label">Tags :</span> <span class="value links">
                                    <a href="#">black</a>
                                    <a href="#">fiber</a>
                                    <a href="#">leather</a>
                                </span></li>
                                    <li><span class="label">Share :</span> <span class="value social">
                                    <a href="#"><img src="./assets/images/icons/social/facebook.png" alt="facebook"></a>
                                    <a href="#"><img src="./assets/images/icons/social/twitter.png" alt="twitter"></a>
                                    <a href="#"><img src="./assets/images/icons/social/pinterest.png" alt="pinterest"></a>
                                </span></li>
                                </ul>
                                <div class="single-product-safe-payment">
                                    <p>Guaranteed safe checkout</p>
                                    <img src="./assets/images/footer/footer-payment.png" alt="payment">
                                </div>
                            </div>
                        </div>
                        <!-- Product Content End -->

                    </div> --}}
                    
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
@extends('layout.mainlayout')

@section('title', __('home.title'))

@section('content')
    <style>
        /* resources/css/coffee-beans.css */

        /* Ensure sections with beans are positioned relative to contain absolute children */
        .h3-hero-section,
        .h3-feature-section.section.section-padding.pt-0 {
            position: relative;
            overflow: hidden;
            /* Hide beans that fall outside the section */
            padding-bottom: 50px;
        }

        /* Container for coffee beans */
        .coffee-beans-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            /* Allow clicks to pass through */
            z-index: 2;
            /* Ensure it sits above background but below content */
        }

        /* Individual coffee bean style */
        .coffee-bean {
            position: absolute;
            top: -50px;
            /* Start above the visible area */
            width: 30px;
            /* Default size; overridden by JS */
            height: 30px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.8;
            animation: fall linear infinite;
        }

        /* Keyframes for falling animation */
        @keyframes fall {
            to {
                transform: translateY(100vh);
            }
        }
    </style>

    <script>
        // resources/js/coffee-beans.js

        document.addEventListener('DOMContentLoaded', () => {
            const coffeeBeansContainers = document.querySelectorAll('.coffee-beans-container');
            const beanImages = [
                '/assets/images/coffeebeans/bean-1.png',
                '/assets/images/coffeebeans/bean-2.png',
                '/assets/images/coffeebeans/bean-3.png',
                '/assets/images/coffeebeans/bean-4.png'
            ];

            coffeeBeansContainers.forEach(container => {
                const numberOfBeans = parseInt(container.getAttribute('data-beans')) ||
                    20; // Default to 20 beans if not specified

                for (let i = 0; i < numberOfBeans; i++) {
                    const bean = document.createElement('div');
                    bean.classList.add('coffee-bean');

                    const randomImage = beanImages[Math.floor(Math.random() * beanImages.length)];
                    bean.style.backgroundImage = `url('${randomImage}')`;

                    const size = Math.random() * 20 + 20; // Size between 20px and 40px
                    bean.style.width = `${size}px`;
                    bean.style.height = `${size}px`;
                    bean.style.left = `${Math.random() * 100}%`;

                    const duration = Math.random() * 5 + 5; // Duration between 5s and 10s
                    const delay = Math.random() * -20; // Delay between -20s and 0s

                    bean.style.animationDuration = `${duration}s`;
                    bean.style.animationDelay = `${delay}s`;

                    bean.style.transform = `rotate(${Math.random() * 360}deg)`;

                    container.appendChild(bean);
                }
            });
        });
    </script>

    <div>
        <!-- Slider Section Start // Display Beans -->
        <div class="h3-hero-section section">
            <div class="coffee-beans-container" data-beans="30"></div> <!-- 30 beans for hero section -->
            <div class="container-fluid">
                <div class="row mb-n6">
                    <div class="col-xl-9 mb-6" style="z-index: 3">
                        <div class="hero-slider hero-slider-3 swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide hero-slide-3 bg-light"
                                    style="background-image: url(./assets/images/hero-slider/home-3/slide-1.jpg);">
                                    <div class="container">
                                        <div class="hero-slide-3-content">
                                            <h2 class="hero-slide-3-title">@lang('home.coffee_market')</h2>
                                            <p class="hero-slide-3-text">@lang('home.hero_text1')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide hero-slide-3 bg-light"
                                    style="background-image: url(./assets/images/hero-slider/home-3/slide-2.jpg);">
                                    <div class="container">
                                        <div class="hero-slide-3-content">
                                            <h2 class="hero-slide-3-title">@lang('home.coffee_market')</h2>
                                            <p class="hero-slide-3-text">@lang('home.hero_text2')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide hero-slide-3 bg-light"
                                    style="background-image: url(./assets/images/hero-slider/home-3/slide-3.jpg);">
                                    <div class="container">
                                        <div class="hero-slide-3-content text-center mx-auto">
                                            <h2 class="hero-slide-3-title">@lang('home.coffee_market')</h2>
                                            <p class="hero-slide-3-text text-white">@lang('home.hero_text3')</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev d-none d-md-flex"></div>
                            <div class="swiper-button-next d-none d-md-flex"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 mb-6" style="z-index: 3">
                        <div class="row row-cols-xl-1 row-cols-sm-3 row-cols-1 flex-xl-column mb-n6">
                            <div class="col mb-6">
                                <a class="banner">
                                    <img src="./assets/images/banner/hero-3-banner-1.jpg" width="401" height="228"
                                        alt="{{ __('home.banner_one') }}">
                                </a>
                            </div>
                            <div class="col mb-6">
                                <a class="banner">
                                    <img src="./assets/images/banner/hero-3-banner-2.jpg" width="401" height="228"
                                        alt="{{ __('home.banner_two') }}">
                                </a>
                            </div>
                            <div class="col mb-6">
                                <a class="banner">
                                    <img src="./assets/images/banner/hero-3-banner-3.jpg" width="401" height="228"
                                        alt="{{ __('home.banner_three') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Feature Section Start // Do Not Display Beans -->
        <div style="z-index: 4" class="h3-feature-section feature-section section section-padding">
            <div class="container">
                <div class="section-title section-title-center">
                    <p class="title">@lang('home.what_happens')</p>
                    <h2 class="sub-title">@lang('home.explore_service')</h2>
                </div>
                <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1 mb-n6">
                    <div class="col mb-6">
                        <div class="feature-2">
                            <div class="feature-icon">
                                <img loading="lazy" src="./assets/images/feature/two/feature-1.png"
                                    alt="{{ __('home.feature1_title') }}" width="80" height="80">
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">@lang('home.feature1_title')</h3>
                                <p class="feature-text">@lang('home.feature1_text')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-6">
                        <div class="feature-2">
                            <div class="feature-icon">
                                <img loading="lazy" src="./assets/images/feature/two/feature-5.png"
                                    alt="{{ __('home.feature2_title') }}" width="80" height="80">
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">@lang('home.feature2_title')</h3>
                                <p class="feature-text">@lang('home.feature2_text')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-6 card-3">
                        <div class="feature-2 ">
                            <div class="feature-icon">
                                <img loading="lazy" src="./assets/images/feature/two/feature-6.png"
                                    alt="{{ __('home.feature3_title') }}" width="80" height="80">
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">@lang('home.feature3_title')</h3>
                                <p class="feature-text">@lang('home.feature3_text')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature Section End -->

        <!-- Feature Section Start // Display Beans -->
        <div class="h3-feature-section section section-padding pt-0">
            <div class="coffee-beans-container" data-beans="10"></div> <!-- 20 beans for this section -->
            <div class="container">
                <div class="row row-cols-lg-2 row-cols-1 flex-lg-row-reverse mb-n8">
                    <div class="col mb-8" style="margin-bottom: 30px;">
                        <div class="section-title">
                            <h2 class="sub-title">@lang('home.finnest_ingredients')</h2>
                            <p class="text">@lang('home.finnest_text')</p>
                        </div>
                        <div class="feature-1">
                            <div class="feature-icon">
                                <img loading="lazy" src="./assets/images/feature/one/coffee-pot.svg"
                                    onload="SVGInject(this)" alt="{{ __('home.coffeemaker') }}" width="50"
                                    height="50">
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">@lang('home.coffeemaker')</h3>
                                <p class="feature-text">@lang('home.coffeemaker_text')</p>
                            </div>
                        </div>
                        <div class="feature-1">
                            <div class="feature-icon">
                                <img loading="lazy" src="./assets/images/feature/one/coffee-mug.svg"
                                    onload="SVGInject(this)" alt="{{ __('home.coffee_grinder') }}" width="50"
                                    height="50">
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">@lang('home.coffee_grinder')</h3>
                                <p class="feature-text">@lang('home.coffee_grinder_text')</p>
                            </div>
                        </div>
                        <div class="feature-1">
                            <div class="feature-icon">
                                <img loading="lazy" src="./assets/images/feature/one/coffee-alt.svg"
                                    onload="SVGInject(this)" alt="{{ __('home.coffee_cups') }}" width="50"
                                    height="50">
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">@lang('home.coffee_cups')</h3>
                                <p class="feature-text">@lang('home.coffee_cups_text')</p>
                            </div>
                        </div>
                    </div>
                    <div style="z-index: 5" class="col mb-8 d-flex justify-content-center">
                        <img style="max-height: 544px !important;" loading="lazy"
                            src="{{ asset('assets/images/home/Artboard-1.png') }}" alt="{{ __('home.feature_image') }}"
                            width="570" height="632">
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Section Start -->
        <div style="position: relative; z-index: 10;" class="h3-feature-section product-section section section-padding">
            <div class="container">
                <div class="section-title section-title-center">
                    <p class="title">@lang('home.our_products')</p>
                    <h2 class="sub-title">@lang('home.explore_our_products')</h2>
                </div>
            </div>
        </div>

        <div style="z-index: 20" class="h1-product-section section  pt-0">
            <div class="container product-container">
                <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 align-items-start gy-4">
                    <div class="col mb-8">
                        <div class="block-title-2">
                            <h4 class="title">@lang('home.hot_sale')</h4>
                            <div id="group-product-1" class="swiper-outer-nav">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                        <div class="group-product-slider swiper" data-nav-target="group-product-1">
                            <div class="swiper-wrapper">
                                @foreach ($coffeeProducts->products as $product)
                                    <div class="swiper-slide">
                                        <div class="product-small">
                                            <div class="product-small-thumb">
                                                <a href="{{ route('products.show', $product->slug) }}"
                                                    class="product-small-image">
                                                    @if ($product->images->isNotEmpty())
                                                        <img loading="lazy"
                                                            src="{{ asset('storage/' . $product->images->first()->image_url) }}"
                                                            alt="{{ $product->{'name_' . app()->getLocale()} }}"
                                                            width="110" height="126">
                                                    @else
                                                        <img loading="lazy"
                                                            src="{{ asset('storage/default_image.png') }}"
                                                            alt="{{ $product->{'name_' . app()->getLocale()} }}"
                                                            width="110" height="126">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-small-content">
                                                <h5 class="product-small-title">
                                                    <a href="{{ route('products.show', $product->slug) }}">
                                                        {{ $product->{'name_' . app()->getLocale()} }}
                                                    </a>
                                                </h5>
                                                <div class="product-small-action">
                                                    <button class="product-small-action-btn"
                                                        data-tooltip-text="@lang('home.quick_view')" data-bs-toggle="modal"
                                                        data-bs-target="#exampleProductModal">
                                                        <i class="sli-magnifier"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Add more swiper slides as needed -->
                            </div>
                            <div class="swiper-pagination d-none"></div>
                        </div>
                    </div>
                    <div class="col mb-8">
                        <div class="block-title-2">
                            <h4 class="title">@lang('home.best_rating')</h4>
                            <div id="group-product-2" class="swiper-outer-nav">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                        <div class="group-product-slider swiper" data-nav-target="group-product-2">
                            <div class="swiper-wrapper">
                                @foreach ($chocolateProducts->products as $product)
                                    <div class="swiper-slide">
                                        <div class="product-small">
                                            <div class="product-small-thumb">
                                                <a href="{{ route('products.show', $product->slug) }}"
                                                    class="product-small-image">
                                                    @if ($product->images->isNotEmpty())
                                                        <img loading="lazy"
                                                            src="{{ asset('storage/' . $product->images->first()->image_url) }}"
                                                            alt="{{ $product->{'name_' . app()->getLocale()} }}"
                                                            width="110" height="126">
                                                    @else
                                                        <img loading="lazy"
                                                            src="{{ asset('storage/default_image.png') }}"
                                                            alt="{{ $product->{'name_' . app()->getLocale()} }}"
                                                            width="110" height="126">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-small-content">
                                                <h5 class="product-small-title">
                                                    <a href="{{ route('products.show', $product->slug) }}">
                                                        {{ $product->{'name_' . app()->getLocale()} }}
                                                    </a>
                                                </h5>
                                                <div class="product-small-action">
                                                    <button class="product-small-action-btn"
                                                        data-tooltip-text="@lang('home.quick_view')" data-bs-toggle="modal"
                                                        data-bs-target="#exampleProductModal">
                                                        <i class="sli-magnifier"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Add more swiper slides as needed -->
                            </div>
                            <div class="swiper-pagination d-none"></div>
                        </div>
                    </div>
                    <div class="col mb-8  hide-on-sm">
                        <a href="shop.html" class="banner"><img style="object-fit: cover;" class="horizontal-img"
                                src="{{ asset('assets/images/home/Artboard-2.png') }}"
                                alt="{{ __('home.horizontal_banner') }}"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="h3-feature-section product-section-bottom section section-padding">
            <div class="container">

            </div>
        </div>
        <!-- Product Section End -->
        <!-- Testimonial Section Start -->
        <div class="h3-testimonial-section section section-padding bg-light">
            <div class="container">
                <div class="section-title section-title-center">
                    <p class="title">@lang('home.client_says')</p>
                    <h2 class="sub-title">@lang('home.testimonials')</h2>
                </div>
                <div class="testimonial-slider swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial">
                                <div class="testimonial-client-thumb"><img loading="lazy"
                                        src="./assets/images/testimonial/testimonial-1.png"
                                        alt="{{ __('home.testimonial1_name') }}" width="100" height="100"></div>
                                <div class="testimonial-text">
                                    <p>@lang('home.testimonial1_text')</p>
                                </div>
                                <div class="testimonial-client-info">
                                    <h5 class="testimonial-client-name">@lang('home.testimonial1_name')</h5>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial">
                                <div class="testimonial-client-thumb"><img loading="lazy"
                                        src="./assets/images/testimonial/testimonial-2.png"
                                        alt="{{ __('home.testimonial2_name') }}" width="100" height="100"></div>
                                <div class="testimonial-text">
                                    <p>@lang('home.testimonial2_text')</p>
                                </div>
                                <div class="testimonial-client-info">
                                    <h5 class="testimonial-client-name">@lang('home.testimonial2_name')</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev d-none d-md-flex"></div>
                    <div class="swiper-button-next d-none d-md-flex"></div>
                </div>
            </div>
        </div>
        <!-- Testimonial Section End -->

        <!-- Blog Section Start -->
        <div class="h3-blog-section section section-padding">
            <div class="container">
                <div class="section-title section-title-center">
                    <p class="title">@lang('home.blog_area')</p>
                    <h2 class="sub-title">@lang('home.explore_blog')</h2>
                </div>
                <div class="blog-carousel swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="blog">
                                <a class="blog-thumb"><img loading="lazy" src="./assets/images/blog/blog-1.jpg"
                                        alt="{{ __('home.blog_post1_title') }}" width="348" height="232"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog">
                                <a class="blog-thumb"><img loading="lazy" src="./assets/images/blog/blog-1.jpg"
                                        alt="{{ __('home.blog_post1_title') }}" width="348" height="232"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog">
                                <a class="blog-thumb"><img loading="lazy" src="./assets/images/blog/blog-1.jpg"
                                        alt="{{ __('home.blog_post1_title') }}" width="348" height="232"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog">
                                <a class="blog-thumb"><img loading="lazy" src="./assets/images/blog/blog-1.jpg"
                                        alt="{{ __('home.blog_post1_title') }}" width="348" height="232"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog">
                                <a class="blog-thumb"><img loading="lazy" src="./assets/images/blog/blog-1.jpg"
                                        alt="{{ __('home.blog_post1_title') }}" width="348" height="232"></a>
                            </div>
                        </div>
                        <!-- Add more blog slides as needed -->
                    </div>
                    <div class="swiper-pagination d-md-none"></div>
                    <div class="swiper-button-prev d-none d-md-flex"></div>
                    <div class="swiper-button-next d-none d-md-flex"></div>
                </div>
            </div>
        </div>
        <!-- Blog Section End -->
    @endsection

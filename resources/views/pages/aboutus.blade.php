@extends('layout.mainlayout')
@section('title', __('about_us.title'))
@section('content')

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
                <li>{{ __('about_us.title') }}</li>
            </ul>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <div class="section section-padding">
        <div class="container">
            <div class="row row-cols-lg-2 row-cols-1 mb-n8">

                <div class="col mb-8">
                    <img loading="lazy" src="./assets/images/others/about-us.png" alt="{{ __('about_us.title') }}"
                        width="560" height="472">
                </div>

                <div class="col mb-8 mt-lg-sm mt-lg-md">
                    <div class="section-title">
                        <h2 class="sub-title"><span class="text-primary"></span>
                            {{ __('about_us.sections.section1.title') }}</h2>
                        <p class="text">{{ __('about_us.sections.section1.content') }}</p>
                    </div>
                    <div class="feature-1 mw-100">
                        <div class="feature-content">
                            <h3 class="feature-title">{{ __('about_us.sections.section2.title') }}</h3>
                            <p class="feature-text">{{ __('about_us.sections.section2.content') }}</p>
                        </div>
                    </div>
                    <div class="feature-1 mw-100">
                        <div class="feature-content">
                            <h3 class="feature-title">{{ __('about_us.sections.section3.title') }}</h3>
                            <p class="feature-text">{{ __('about_us.sections.section3.content') }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Gallery Section Start -->
    <div class="h1-gallery-section section section-padding pt-0">
        <div class="container">
            <div class="section-title section-title-center">
                <p class="title">{{ __('about_us.what_happens') }}</p>
                <h2 class="sub-title">{{ __('about_us.fckereldin_gallary') }}</h2>
            </div>

            <div class="mfp-zoom-gallery row row-cols-lg-3 row-cols-sm-2 row-cols-1 mb-n6">

                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-1.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-1.jpg" alt="{{ __('gallery 1') }}"
                            width="348" height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-2.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-2.jpg" alt="{{ __('gallery 2') }}"
                            width="348" height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-3.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-3.jpg" alt="{{ __('gallery 3') }}"
                            width="348" height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-4.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-4.jpg" alt="{{ __('gallery 4') }}"
                            width="348" height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-5.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-5.jpg" alt="{{ __('gallery 5') }}"
                            width="348" height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-6.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-6.jpg" alt="{{ __('gallery 6') }}"
                            width="348" height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>

            </div>

        </div>
    </div>
    <!-- Gallery Section End -->

@endsection

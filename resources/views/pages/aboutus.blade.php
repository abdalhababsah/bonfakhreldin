@extends('layout.mainlayout')

@section('title', __('About Us - Bonfkeralden'))

@section('content')

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- About Us Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row row-cols-lg-2 row-cols-1 mb-n8">

                <div class="col mb-8">
                    <img loading="lazy" src="./assets/images/others/about-us.png" alt="about us image" width="560"
                        height="472">
                </div>

                <div class="col mb-8">
                    <div class="section-title">
                        <h2 class="sub-title"><span class="text-primary">KOFI</span> ABOUT INFO</h2>
                        <p class="text">A coffee shop is a small business that sells coffee, pastries, and other morning
                            goods. There are many different types of coffee shops around the world. Some have a barista,
                            while some just have a cashier.</p>
                    </div>
                    <div class="feature-1 mw-100">
                        <div class="feature-content">
                            <h3 class="feature-title">WE START AT 2023</h3>
                            <p class="feature-text">Some coffee shops have a seating area, while some just have a spot to
                                order and then go somewhere else to sit down. The coffee shop that I am going to describe is
                                a place with a seating area and barista.</p>
                        </div>
                    </div>
                    <div class="feature-1 mw-100">
                        <div class="feature-content">
                            <h3 class="feature-title">WIN BEST ONLINE SHOP AT 2023</h3>
                            <p class="feature-text">My goal for this coffee shop is to be able to get a coffee and get on
                                with my day. It's a Thursday morning and I am rushing between meetings. I need to
                                caffeinate, but don't have time to sit down at the cafe for fifteen minutes.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- About Us Section End -->
    <!-- Team Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="section-title section-title-center">
                <p class="title">What Happens Here</p>
                <h2 class="sub-title">OUR AWESOME TEAM</h2>

            </div>

            <div class="team-carousel swiper">

                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="team">
                            <div class="team-thumb">
                                <img loading="lazy" src="./assets/images/team/team-1.png" alt="Mr. Mike Banding" width="270" height="324">
                                <div class="team-social">
                                    <a href="#"><i class="sli-social-facebook"></i></a>
                                    <a href="#"><i class="sli-social-twitter"></i></a>
                                    <a href="#"><i class="sli-social-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4 class="team-name">Mr. Mike Banding</h4>
                                <p class="team-title">Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="team">
                            <div class="team-thumb">
                                <img loading="lazy" src="./assets/images/team/team-2.png" alt="Mr. Peter Pan" width="270" height="324">
                                <div class="team-social">
                                    <a href="#"><i class="sli-social-facebook"></i></a>
                                    <a href="#"><i class="sli-social-twitter"></i></a>
                                    <a href="#"><i class="sli-social-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4 class="team-name">Mr. Peter Pan</h4>
                                <p class="team-title">Developer</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="team">
                            <div class="team-thumb">
                                <img loading="lazy" src="./assets/images/team/team-3.png" alt="Mr. John Lee" width="270" height="324">
                                <div class="team-social">
                                    <a href="#"><i class="sli-social-facebook"></i></a>
                                    <a href="#"><i class="sli-social-twitter"></i></a>
                                    <a href="#"><i class="sli-social-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4 class="team-name">Mr. John Lee</h4>
                                <p class="team-title">Designer</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="team">
                            <div class="team-thumb">
                                <img loading="lazy" src="./assets/images/team/team-4.png" alt="Ms. Sophia" width="270" height="324">
                                <div class="team-social">
                                    <a href="#"><i class="sli-social-facebook"></i></a>
                                    <a href="#"><i class="sli-social-twitter"></i></a>
                                    <a href="#"><i class="sli-social-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4 class="team-name">Ms. Sophia</h4>
                                <p class="team-title">Chairmen</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="team">
                            <div class="team-thumb">
                                <img loading="lazy" src="./assets/images/team/team-4.png" alt="Ms. Lee" width="270" height="324">
                                <div class="team-social">
                                    <a href="#"><i class="sli-social-facebook"></i></a>
                                    <a href="#"><i class="sli-social-twitter"></i></a>
                                    <a href="#"><i class="sli-social-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4 class="team-name">Ms. Lee</h4>
                                <p class="team-title">Marketer</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="swiper-pagination d-md-none"></div>
                <div class="swiper-button-prev d-none d-md-flex"></div>
                <div class="swiper-button-next d-none d-md-flex"></div>
            </div>

        </div>
    </div>
    <!-- Team Section End -->

    <!-- Gallery Section Start -->
    <div class="h1-gallery-section section section-padding pt-0">
        <div class="container">
            <div class="section-title section-title-center">
                <p class="title">What Happens Here</p>
                <h2 class="sub-title">KOFI SHOP GALLERY</h2>

            </div>

            <div class="mfp-zoom-gallery row row-cols-lg-3 row-cols-sm-2 row-cols-1 mb-n6">

                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-1.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-1.jpg" alt="gallery 1" width="348"
                            height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-2.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-2.jpg" alt="gallery 2" width="348"
                            height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-3.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-3.jpg" alt="gallery 3" width="348"
                            height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-4.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-4.jpg" alt="gallery 4" width="348"
                            height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-5.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-5.jpg" alt="gallery 5" width="348"
                            height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>
                <div class="col mb-6">
                    <a href="./assets/images/gallery/big/gallery-6.jpg" class="gallery-item">
                        <img loading="lazy" src="./assets/images/gallery/gallery-6.jpg" alt="gallery 6" width="348"
                            height="418">
                        <div class="gallery-item-overlay"><i class="sli-size-fullscreen"></i></div>
                    </a>
                </div>

            </div>

        </div>
    </div>
    <!-- Gallery Section End -->

@endsection

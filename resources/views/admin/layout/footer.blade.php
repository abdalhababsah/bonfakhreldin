<div class="footer-3-section section bg-light">
    <!-- Footer Top Section Start -->
    <div class="footer-top section py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Footer Widget Start -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget">
                        <img loading="lazy" src="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}" alt="site logo"
                            width="198" height="70" class="mb-3">
                    </div>
                </div>

                <!-- Footer Widget Start -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget">
                        <h5 class="footer-widget-title">{{ __('footer.information') }}</h5>
                        <ul class="footer-widget-list">
                            <li><a href="#">{{ __('footer.privacy_policy') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Footer Widget Start -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget">
                        <h5 class="footer-widget-title">{{ __('footer.main_menu') }}</h5>
                        <ul class="footer-widget-list">
                            <li><a href="{{ route('home') }}">{{ __('footer.home') }}</a></li>
                            <li><a href="{{ route('about.us') }}">{{ __('footer.about_us') }}</a></li>
                            <li><a href="#">{{ __('footer.gallery') }}</a></li>
                            <li><a href="{{ route('contact.us') }}">{{ __('footer.contact_us') }}</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Widget End -->

            </div>
        </div>
    </div>
    <!-- Footer Bottom Section Start -->
    <div class="footer-bottom section py-4 text-light" style="background-color: #126442">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-auto col-12 text-center">
                    <p class="footer-copyright mb-0">
                        {{ __('footer.copyright') }} <b class="text-primary">
                            <a style="color: #C7A17A;" target="_blank">Bonfakhrladin</a>
                        </b> &copy;{{ date('Y') }} {{ __('footer.all_rights_reserved') }}
                    </p>
                </div>
            </div>
            <div class="footer-widget-social">
                <a href="#" class="me-3"><i class="sli-social-facebook"></i></a>
                <a href="#" class="me-3"><i class="sli-social-twitter"></i></a>
                <a href="#" class="me-3"><i class="sli-social-instagram"></i></a>
                <a href="#" class="me-3"><i class="sli-social-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- Footer Bottom Section End -->
</div>

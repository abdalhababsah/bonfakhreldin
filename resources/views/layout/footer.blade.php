<div class="footer-3-section section bg-light">
    <!-- Footer Top Section Start -->
    <div class="footer-top section">
        <div class="container">
            <div id="footer-top-container" class="d-flex flex-wrap align-items-center justify-content-between" >
                <div class="">
                    <div class="footer-widget">
                        <img loading="lazy" src="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}" alt="site logo"
                            width="198" height="70" class="mb-3">
                    </div>
                </div>
                <div class="">
                    <div class="footer-widget">
                        <ul class="d-flex gap-3">
                            <li><a href="{{ route('home') }}">{{ __('footer.home') }}</a></li>
                            <li><a href="{{ route('about.us') }}">{{ __('footer.about_us') }}</a></li>
                            <li><a href="#">{{ __('footer.gallery') }}</a></li>
                            <li><a href="{{ route('contactUs.index') }}">{{ __('footer.contact_us') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom Section Start -->
    <div class="footer-bottom section py-4 text-light" style="background-color: #126442">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Left side: Copyright -->
            <div class="row justify-content-start align-items-center" style="width:50%;">
                <div class="col-md-auto col-12 text-center">
                    <p class="footer-copyright mb-0">
                        {{ __('footer.copyright') }} <b class="text-primary">
                            <a style="color: #C7A17A;" target="_blank">Bonfakhrladin</a>
                        </b> &copy;{{ date('Y') }} {{ __('footer.all_rights_reserved') }}
                    </p>
                </div>
            </div>
            <!-- Right side: Social Icons -->
            <div class="footer-widget-social d-flex justify-content-end" style="width:50%;">
                <a href="#" class=""><i class="sli-social-facebook"></i></a>
                <a href="#" class=""><i class="sli-social-twitter"></i></a>
                <a href="#" class=""><i class="sli-social-instagram"></i></a>
            </div>
        </div>
    </div>
    <style>
        .footer-3-section {
            position: relative;
            z-index: 1;
        }

        ul li {
            list-style: none;
        }
    </style>
</div>

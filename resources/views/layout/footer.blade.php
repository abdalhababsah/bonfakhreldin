<div class="footer-3-section section bg-light">
    <!-- Footer Top Section Start -->
    <div class="footer-top section py-5">
        <div class="container">
            <div class="row g-4 align-items-center">

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
    <!-- Footer Bottom Section End -->
    {{-- public/assets/images/oie_676FY2TANTtw.png  footer-3-section --}}

    <style>
        .footer-3-section {
    position: relative; /* Ensure it stays in the document flow */
    z-index: 1; /* Ensure it doesn't overlap unnecessarily */
}
        /* .footer-top {
            background-image: url('{{ asset('assets/images/oie_676FY2TANTtw.png') }}');
            background-position: right center;
            /* Positions the image to the right and vertically centered */
            background-repeat: no-repeat;
            /* Prevents the image from repeating */
            background-size: contain;

            /* Adds space on the right to prevent content overlap with the background image */
            position: relative;
            /* Establishes a positioning context for pseudo-elements */
        } */
    </style>
</div>

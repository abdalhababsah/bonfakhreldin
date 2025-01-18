<style>
    .active{
        color: #126442;
    }
    /* For RTL languages */
.list-rtl {
    list-style-position: inside;
    padding-right: 0;
    padding-left: 20px;
}

.list-rtl li {
    text-align: right;
}

/* For LTR languages */
.list-ltr {
    list-style-position: inside;
    padding-left: 0;
    padding-right: 20px;
}

.list-ltr li {
    text-align: left;
}




</style>
<!-- Language Switcher Banner Start -->
<div style="background-color: #126442; color: white; padding: 10px 0;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                    style="color: white; font-size: 16px; text-decoration: none;">
                    {{ __('header.language_switcher') }}
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Language Switcher Banner End -->

<!-- Header Section Start -->
<div style="z-index: 6000;" class="header sticky-header section">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Logo Start -->
            <div class="col-lg-2 col-auto">
                <div class="header-logo">
                    <a href="{{ route('home') }}">
                        <img id="logo" src="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}" alt="bon fakhreldin logo">
                    </a>
                </div>
            </div>
            <!-- Logo End -->

            <!-- Menu Start -->
            <div class="col-lg-10 col">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav {{ app()->getLocale() == 'ar' ? 'text-end list-rtl' : 'text-start list-ltr' }}">
                            <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}" style="color: black; margin-right: 15px;">{{ __('header.home') }}</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('products.index') || request()->routeIs('products.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('products.index') }}" style="color: black; margin-right: 15px;">{{ __('header.products') }}</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('branches') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('branches') }}" style="color: black; margin-right: 15px;">{{ __('header.branches') }}</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('about.us') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about.us') }}" style="color: black; margin-right: 15px;">{{ __('header.about_us') }}</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('contactUs.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contactUs.index') }}" style="color: black;">{{ __('header.contact_us') }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- Menu End -->
        </div>
    </div>
</div>








<!-- Mobile Offcanvas Menu Start -->
<div style="z-index: 60000;" class="offcanvas offcanvas-end" id="offcanvas-header">
    <div class="offcanvas-header">
        <h5>{{ __('header.mobile_menu') }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="mobile-menu">
            <ul>
                <li class=" {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">{{ __('header.home') }}</a>
                </li>
                <li class="{{ request()->routeIs('about.us') ? 'active' : '' }}">
                    <a href="{{ route('about.us') }}">{{ __('header.about_us') }}</a>
                </li>
                <li class="{{ request()->routeIs('contactUs.index') ? 'active' : '' }}">
                    <a href="{{ route('contactUs.index') }}">{{ __('header.contact_us') }}</a>
                </li>
                <li class="{{ request()->routeIs('products.index') || request()->routeIs('products.show') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}">{{ __('header.products') }}</a>
                </li>
                <li class="{{ request()->routeIs('branches') ? 'active' : '' }}">
                    <a href="{{ route('branches') }}">{{ __('header.branches') }}</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Mobile Offcanvas Menu End -->
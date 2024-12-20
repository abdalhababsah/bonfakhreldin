<style>
    .active{
        color: #126442;
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
            <div class="col-lg-2 col">
                <div class="header-logo">
                    <a href="{{ route('home') }}">
                        <img id="logo" src="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}"
                            alt="bon fakhreldin logo">
                    </a>
                </div>
            </div>
            <!-- Logo End -->

            <!-- Menu Start -->
            <div class="col d-none d-lg-flex justify-content-end">
                <nav class="main-menu">
                    <ul>
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">{{ __('header.home') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('products.index') || request()->routeIs('products.show') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">{{ __('header.products') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('branches') ? 'active' : '' }}">
                            <a href="{{ route('branches') }}">{{ __('header.branches') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('about.us') ? 'active' : '' }}">
                            <a href="{{ route('about.us') }}">{{ __('header.about_us') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('contactUs.index') ? 'active' : '' }}">
                            <a href="{{ route('contactUs.index') }}">{{ __('header.contact_us') }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Menu End -->

            <!-- Action Start -->
            <div class="col-auto">
                <div class="header-action">
                    <div class="header-action-item d-lg-none">
                        <button class="header-action-toggle" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvas-header"><i class="sli-menu"></i></button>
                    </div>
                </div>
            </div>
            <!-- Action End -->

        </div>
    </div>
</div>
<!-- Header Section End -->

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
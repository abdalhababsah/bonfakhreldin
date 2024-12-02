<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>bon fakhreldin - Coffee Shop Website Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="bon fakhreldin - Coffee Shop Website Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon.png">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

    <!-- Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">

    @if(app()->getLocale() === 'ar')
    <!-- RTL CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/simple-line-icons.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/ion.rangeSlider.min.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

    @include('layout.header')
<main>

    @yield('content')

</main>
    <!-- Footer Section Start -->
    @include('layout.footer')
    <!-- Footer Section End -->



    <button class="scroll-to-top"><i class="sli-arrow-up"></i></button>

    <!-- JS Vendor, Plugins & Activation Script Files -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/js/vendor/modernizr-3.11.7.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>

    <!-- Plugins JS -->
    <script src="{{asset('assets/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/svg-inject.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/resize-sensor.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.sticky-sidebar.min.js')}}"></script>

    <!-- Activation JS -->
    <script src="{{asset('assets/js/active.js')}}"></script>

</body>

</html>

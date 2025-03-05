<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Dynamic Page Title -->
    <title>@yield('title', 'bon fakhreldin - Coffee Shop')</title>

    <!-- SEO Meta Tags -->
    <meta name="url" content="{{url('/')}}" />
    <meta name="robots" content="index, follow" />
    <meta name="description"
        content="اكتشف رحلة قهوة فخر الدين، شبكتنا المزدهرة التي تضم أكثر من 25 فرعاً في الأردن. نحن ملتزمون بتقديم أفضل أنواع القهوة المحمصة بعناية لنكون جزءاً من يومك." />
    <meta name="keywords"
        content="قهوة, قهوة فخر الدين, بن فخر الدين, أفضل قهوة في الأردن, محمصة القهوة, مقهى, رحلة القهوة, قيم القهوة" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

    <!-- Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">




    <link rel="stylesheet" href="{{ asset('assets/css/plugins/simple-line-icons.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/ion.rangeSlider.min.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @if (app()->getLocale() === 'ar')
        <!-- RTL CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    @endif
    <!-- Open Graph Meta Tags for Facebook, WhatsApp, Instagram -->
    <meta property="og:title" content="bon fakhreldin - Coffee Shop">
    <meta property="og:description"
        content="اكتشف رحلة قهوة فخر الدين، شبكتنا المزدهرة التي تضم أكثر من 25 فرعاً في الأردن. نحن ملتزمون بتقديم أفضل أنواع القهوة المحمصة بعناية لنكون جزءاً من يومك.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">
    <meta property="og:site_name" content="bon fakhreldin">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="bon fakhreldin - Coffee Shop">
    <meta name="twitter:description"
        content="اكتشف رحلة قهوة فخر الدين، شبكتنا المزدهرة التي تضم أكثر من 25 فرعاً في الأردن. نحن ملتزمون بتقديم أفضل أنواع القهوة المحمصة بعناية لنكون جزءاً من يومك.">
    <meta name="twitter:image" content="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}">
    <meta name="twitter:site" content="@bonfakhreldin">
    <meta name="twitter:creator" content="@bonfakhreldin">

    <meta name="apple-mobile-web-app-title" content="Bon Fakhreldin">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Structured Data with JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "CafeOrCoffeeShop",
      "name": "bon fakhreldin",
      "url": "{{ url()->current() }}",
      "logo": "{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}",
      "image": "{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}",
      "description": "اكتشف رحلة قهوة فخر الدين، شبكتنا المزدهرة التي تضم أكثر من 25 فرعاً في الأردن. نحن ملتزمون بتقديم أفضل أنواع القهوة المحمصة بعناية لنكون جزءاً من يومك.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "عنوانك هنا",
        "addressLocality": "المدينة",
        "addressCountry": "JO"
      },
      "telephone": "+962XXXXXXXXX",
      "openingHours": "08:00-22:00",
      "sameAs": [
        "https://www.facebook.com/bonfakhreldin",
        "https://www.instagram.com/bonfakhreldin",
        "https://wa.me/XXXXXXXXXX"
      ]
    }
    </script>
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
    <script src="{{ asset('assets/js/vendor/modernizr-3.11.7.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/svg-inject.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/resize-sensor.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.sticky-sidebar.min.js') }}"></script>

    <!-- Activation JS -->
    <script src="{{ asset('assets/js/active.js') }}"></script>

</body>

</html>

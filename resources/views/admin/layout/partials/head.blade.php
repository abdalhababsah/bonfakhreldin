<head>
    <meta charset="utf-8" />
    <meta name="description" content="اكتشف أفضل القهوة والمكسرات المحمصة والشوكولاتة الفاخرة في بن فخر الدين مع 22 فرعًا في جميع أنحاء الأردن.">
    <meta name="keywords" content="قهوة، مكسرات محمصة، شوكولاتة، بن فخر الدين، الأردن">
    <meta name="author" content="بن فخر الدين">
    <link rel="icon" href="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Panel</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{asset('admin/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('admin/assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
    @stack('styles')
  </head>
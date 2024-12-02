<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{('admin/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{('admin/assets/img/favicon.png')}}">
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
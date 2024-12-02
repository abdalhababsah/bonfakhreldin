<!DOCTYPE html>
<html lang="en">


@include('admin.layout.partials.head')

<body class="g-sidenav-show  bg-gray-100">

    @include('admin.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('admin.layout.header')
        <!-- End Navbar -->
        @yield('content')
    </main>
    @include('admin.layout.partials.scripts')
</body>

</html>
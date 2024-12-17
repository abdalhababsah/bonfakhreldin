<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="#" target="_blank">
            <img src="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}" class="navbar-brand-img" width="26"
                height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">Bon fakhr eldin</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="material-symbols-rounded opacity-5 text-primary">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <!-- Products -->
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" 
                   href="{{ route('admin.products.index') }}">
                    <i class="material-symbols-rounded opacity-5 text-primary">table_view</i>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>
            <!-- Categories -->
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                   href="{{ route('admin.categories.index') }}">
                    <i class="material-symbols-rounded opacity-5 text-primary">receipt_long</i>
                    <span class="nav-link-text ms-1">Categories</span>
                </a>
            </li>
            <!-- Contact -->
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('admin.contact_us.*') ? 'active' : '' }}"
                   href="{{ route('admin.contact_us.index') }}">
                    <i class="material-symbols-rounded opacity-5 text-primary">person</i>
                    <span class="nav-link-text ms-1">Contact</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
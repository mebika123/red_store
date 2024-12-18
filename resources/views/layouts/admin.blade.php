<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="shortcut icon" href="{{ asset('assets/image/favion.ico.png') }}" type="image/x-icon"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @stack('style')
</head>

<body>
    <div class="layout-rapper position-relative">
        <section class="section-left">
            <aside>
                <div class="menu">
                    <div class="d-flex justify-content-between align-items-center border-bottom  p-3">
                        <a class="menu-logo-img">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                        <i class="fa-solid fa-xmark fa-lg" id="closeMenu"></i>
                    </div>
                    <div class="menu-content">
                        <h4 class="menu-heading text-uppercase f-12 fw-bolder p-3">Main Home</h4>
                        <ul class="menu-list">
                            <li class="menu-items mb-2">
                                <a href="{{ route('admin.index') }}"
                                    class="mb-3 d-flex align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-border-all fa-lg"></i>
                                        <span class="f-14 fw-medium">Dashboard</span>
                                    </div>
                                </a>
                            </li>
                            <li class="menu-items mb-1 menu-list-collapsed">
                                <div
                                    class=" d-flex justify-content-between align-items-center gap-3 menu-button active-menu">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                                        <span class="f-14 fw-medium">Products</span>
                                    </div>
                                    <div class="angle-dir">
                                        <i class="fa-solid fa-angle-down list-down"></i>
                                    </div>
                                </div>
                                <div class="submenu-list ps-5">
                                    <ul class="submenu">
                                        <li class="submenu-item mb-2">
                                            <a href="{{ route('admin.product.create') }}">
                                                Add Product
                                            </a>
                                        </li>
                                        <li class="submenu-item mb-2">
                                            <a href="{{ route('admin.products') }}">
                                                Products
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-items mb-1 menu-list-collapsed">
                                <div class="d-flex justify-content-between align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-layer-group fa-lg"></i> <span
                                            class="f-14 fw-medium">Brand</span>
                                    </div>
                                    <div class="angle-dir">
                                        <i class="fa-solid fa-angle-down list-down"></i>
                                    </div>
                                </div>
                                <div class="submenu-list ps-5">
                                    <ul class="submenu">
                                        <li class="submenu-item mb-2">
                                            <a href="{{ route('admin.brand.add') }}">
                                                New Brands
                                            </a>
                                        </li>
                                        <li class="submenu-item mb-2">
                                            <a href="{{ route('admin.brands') }}">
                                                Brands
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-items mb-1 menu-list-collapsed">
                                <div class="d-flex justify-content-between align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-layer-group fa-lg"></i> <span
                                            class="f-14 fw-medium">Category</span>
                                    </div>
                                    <div class="angle-dir">
                                        <i class="fa-solid fa-angle-down list-down"></i>
                                    </div>
                                </div>
                                <div class="submenu-list ps-5">
                                    <ul class="submenu">
                                        <li class="submenu-item mb-2">
                                            <a href="{{ route('admin.category.create') }}">
                                                New Category
                                            </a>
                                        </li>
                                        <li class="submenu-item mb-2">
                                            <a href="{{ route('admin.categories') }}">
                                                Categories
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- <li class="menu-items mb-1 menu-list-collapsed">
                                <div class="d-flex justify-content-between align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-file-circle-plus fa-lg"></i> <span
                                            class="f-14 fw-medium">Order</span>
                                    </div>
                                    <div class="angle-dir">
                                        <i class="fa-solid fa-angle-down list-down"></i>
                                    </div>
                                </div>
                                <div class="submenu-list ps-5">
                                    <ul class="submenu">
                                        <li class="submenu-item mb-2">
                                            <a href="">
                                                Orders
                                            </a>
                                        </li>
                                        <li class="submenu-item mb-2">
                                            <a href="">
                                                Order Tracking
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                            <li class="menu-items mb-1">
                                <a href="{{ route('admin.orders') }}"
                                    class="d-flex align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-file-circle-plus fa-lg"></i>
                                        <span class="f-14 fw-medium">Orders</span>
                                    </div>
                                </a>
                            </li>
                            <li class="menu-items mb-1">
                                <a href="{{ route('admin.messages') }}"
                                    class="d-flex align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-regular fa-message fa-lg"></i>
                                        <span class="f-14 fw-medium">Message</span>
                                    </div>
                                </a>
                            </li>
                            <li class="menu-items mb-1">
                                <a href="{{ route('admin.users') }}"
                                    class="d-flex align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-regular fa-user fa-lg"></i>
                                        <span class="f-14 fw-medium">Users</span>
                                    </div>
                                </a>
                            </li>
                            <li class="menu-items mb-1">
                                <a href="{{ route('admin.user.info') }}"
                                    class="d-flex align-items-center gap-3 menu-button">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-gear fa-lg"></i>
                                        <span class="f-14 fw-medium">Setting</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>

        </section>
        <main class="section-right">
            <header>
                <div class="wrap d-flex justify-content-between align-items-center px-4 py-3">
                    <div class="header-left d-flex align-items-center gap-3">
                        <a class="logo-img d-lg-none">
                            <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Admin/images/logo/logo.png"
                                alt="">
                        </a>
                        <div class="menu-bar" id="openMenu">
                            <i class="fa-solid fa-bars-staggered fa-lg text-primary"></i>
                        </div>
                        <div class="position-relative search-bar d-none d-lg-block">
                            <input type="text" name="search" id="search" placeholder="Search Here">
                            <i class="fa-solid fa-search"></i>
                        </div>
                    </div>
                    <div class="header-right d-flex justify-content-between align-items-center gap-3">

                        <div class="dropdown-open position-relative">
                            <div class="profile-section d-flex justify-content-between align-items-center gap-2">
                                <div class="profile-img">
                                    <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Admin/images/avatar/user-1.png"
                                        alt="">
                                </div>
                                <div class="profile-info">
                                    <p class="profile-title mb-0 text-black fw-bolder">{{ Auth::user()->name }}</p>
                                    <span class="f-12">Admin</span>
                                </div>
                            </div>
                            <div class="menu-dropdown drop-width p-3 d-none">
                                <ul class="dropdown-menu-list">
                                    <li class="mt-3">
                                        <a href="{{ route('admin.user.info') }}"
                                            class="d-flex align-items-center gap-3 ">
                                            <div class="icon text-black-50">
                                                <i class="fa-regular fa-user"></i>
                                            </div>
                                            <div class="menu-text f-14 fw-semibolds text-black">
                                                Account
                                            </div>
                                        </a>
                                    </li>

                                    <li class="mt-3">
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                            @csrf
                                            <a class="d-flex align-items-center gap-3 "
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                <div class="icon text-black-50">
                                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                </div>
                                                <div class="menu-text f-14 fw-semibolds text-black">
                                                    Logout
                                                </div>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section class="main-content p-4">
                <div class="main-content-inner">
                    @yield('content')
                </div>
            </section>
        </main>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    @stack('script')
</body>

</html>

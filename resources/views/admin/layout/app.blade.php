<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ecommerce - @yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">    <link rel="stylesheet" href="{{ asset('admin/dist/assets/modules/fontawesome/css/all.min.css') }}">


    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/dist/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/assets/modules/summernote/summernote-bs4.css') }}">

    <link rel="stylesheet"
        href="{{ asset('admin/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/dist/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/assets/modules/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('myCss')
    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #loader {
            position: fixed;
            z-index: 99999999999999999999999;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background: white !important;
            display: flex;
        }

        /* Apply the spinning animation to the icon */
        #loader .text-center img {
            animation: spin 1s infinite linear;
        }

        .bg-black {
            background-color: rgb(32, 29, 29) !important;
        }
    </style>
    @livewireStyles
    <!-- /END GA -->
</head>

<body>
    <div id="loader" class="justify-content-center align-items-center bg-white" style="height: 100vh;">
        <div class="text-center">
            <div class="">
                <!-- Use the correct class for Font Awesome spinner icon -->
                <img src="{{ asset('user/assets/imgs/spin.png') }}" height="40px" alt="">
                <p>Loading...</p>
            </div>
        </div>
    </div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>

                    </ul>
                    <livewire:universal-search-bar></livewire:universal-search-bar>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="">
                        <label class="custom-switch mt-2 dark-mode-switch">
                            <input type="checkbox" class="custom-switch-input mx-2">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>

                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('admin/dist/assets/img/avatar/avatar-1.png') }}"
                                            class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b>
                                        <p>Hello, Bro!</p>
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('admin/dist/assets/img/avatar/avatar-2.png') }}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Dedik Sugiharto</b>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('admin/dist/assets/img/avatar/avatar-3.png') }}"
                                            class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Agung Ardiansyah</b>
                                        <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('admin/dist/assets/img/avatar/avatar-4.png') }}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Ardian Rahardiansyah</b>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                        <div class="time">16 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('admin/dist/assets/img/avatar/avatar-5.png') }}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Alfa Zulkarnain</b>
                                        <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>

                    <livewire:admin.notification-bell />
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('admin/dist/assets/img/avatar/avatar-1.png ') }}"
                                class="rounded-circle
                                mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, @php
                                $words = explode(' ', Auth::user()->name);
                                $firstName = $words[0];
                            @endphp
                                {{ $firstName }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title text-nowrap">Logged in at
                                {{ Auth::user()->created_at->format('Y-m-d') }}</div>
                            <div class="dropdown-title text-nowrap">
                                ({{ Auth::user()->created_at->diffForHumans() }})</div>


                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="{{ route('admin.activityLogs') }}" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" class="dropdown-item " method="POST">
                                @csrf
                                <button class="btn btn-danger btn-block" style="hover:none"><i
                                        class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#" class="text-muted">Shopify Admin Panel</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a
                                href="{{ route('admin.dashboard') }}" class="nav-link"><i
                                    class="fas fa-fire"></i><span> Dashboard</span></a></li>
                        @php
                            $newOrderCount = App\Models\Order::where('status', 1)->count();
                        @endphp
                        <li class="{{ request()->is('admin/orders/list') ? 'active' : '' }}"><a
                                href="{{ route('order.list') }}" class="nav-link"><i
                                    class="fas fa-bell"></i><span>Orders <span
                                        id="new_orders">({{ $newOrderCount }})</span> </span></a> </li>


                        <li class="menu-header">Starter</li>
                        <li class="dropdown {{ request()->is('admin/categories/*') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-th"></i> <span>Categories</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->is('admin/categories/list') ? 'active' : '' }}"><a
                                        class="nav-link" href="{{ route('category.list') }}">Categories List</a></li>
                                <li class=" {{ request()->is('admin/categories/add/page') ? 'active' : '' }}"><a
                                        class="nav-link" href="{{ route('category.addPage') }}">+ Add Category</a>
                                </li>
                            </ul>
                        </li>



                        <li class="dropdown {{ request()->is('admin/products/*') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fa-solid fa-bag-shopping"></i><span>Products</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->is('admin/products/list') ? 'active' : '' }}"><a
                                        class="nav-link" href="{{ route('product.list') }}">Products List</a></li>
                                <li class=" {{ request()->is('admin/products/add/page') ? 'active' : '' }}"><a
                                        class="nav-link" href="{{ route('product.addPage') }}">+ Add Product</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown {{ request()->is('admin/brands/*') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown"><i class="ion-ios-pricetags"></i>
                                <span>Brands</span></a>
                            <ul class="dropdown-menu">
                                <li class=" {{ request()->is('admin/brands/list') ? 'active' : '' }}"><a
                                        class="nav-link" href="{{ route('brand.list') }}">Brands</a></li>
                                <li><a class="nav-link {{ request()->is('admin/brands/add/page') ? 'active' : '' }}"
                                        href="{{ route('brand.addPage') }}">+ Add New Brand</a></li>
                            </ul>
                        </li>
                        <li class="dropdown {{ request()->is('admin/events/*') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-calendar-days"></i>
                                <span>Events</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->is('admin/events/list') ? 'active' : '' }}"><a
                                        class="nav-link " href="{{ route('event.list') }}">Events</a></li>
                                <li class="{{ request()->is('admin/events/add/page') ? 'active' : '' }}"><a
                                        class="nav-link" href="{{ route('event.addPage') }}">+ Add New Event</a></li>
                            </ul>
                        </li>

                        <li class="dropdown {{ request()->is('admin/delivery-locations/*') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-truck"></i>
                                <span>Delivery Locations</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->is('admin/delivery-locations/list') ? 'active' : '' }}"><a
                                        class="nav-link " href="{{ route('delivery-location.list') }}">Locations</a>
                                </li>
                                <li class="{{ request()->is('admin/delivery-locations/add/page') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('delivery-location.addPage') }}">+ Add New
                                        Location</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-rocket"></i> Documentation
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/dist/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/dist/assets/modules/jquery.sparkline.min.js') }}"></script>


    <script src="{{ asset('admin/dist/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->


    <!-- Template JS File -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/dist/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/js/custom.js') }}"></script>
    <script src="{{ asset('admin/dist/assets/js/jquery-ajax.js') }}"></script>
    @livewireScripts
    @yield('myScript')


</body>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

</script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('78fc17bc824cf469f0b0', {
      cluster: 'ap2'
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      toastr.info(data.title)
    });
  </script>

</html>

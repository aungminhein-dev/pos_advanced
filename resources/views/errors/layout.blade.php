<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{  asset('admin/dist/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{  asset('admin/dist/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{  asset('admin/dist/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{  asset('admin/dist/assets/css/components.css')}}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                @yield('message')
            </div>
        </div>
    </div>
</body>
 <!-- General JS Scripts -->
 <script src="{{  asset('admin/dist/assets/modules/jquery.min.js')}}"></script>
 <script src="{{  asset('admin/dist/assets/modules/popper.js')}}"></script>
 <script src="{{  asset('admin/dist/assets/modules/tooltip.js')}}"></script>
 <script src="{{  asset('admin/dist/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
 <script src="{{  asset('admin/dist/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
 <script src="{{  asset('admin/dist/assets/modules/moment.min.js')}}"></script>
 <script src="{{  asset('admin/dist/assets/js/stisla.js')}}"></script>

 <!-- JS Libraies -->

 <!-- Page Specific JS File -->

 <!-- Template JS File -->
 <script src="{{  asset('admin/dist/assets/js/scripts.js')}}"></script>
 <script src="{{  asset('admin/dist/assets/js/custom.js')}}"></script
</html>

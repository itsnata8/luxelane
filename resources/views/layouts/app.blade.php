<!DOCTYPE html>
<html lang="en">


<!-- molla/index-2.html  22 Nov 2019 09:55:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $meta_title ?? '' }}</title>
    <meta name="keywords" content="{{ $meta_keywords ?? '' }}">
    <meta name="description" content="{{ $meta_description ?? '' }}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/client/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/client/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/client/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/assets/client/images/icons/site.html">
    <link rel="mask-icon" href="/assets/client/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="/assets/client/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="/assets/client/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/client/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/assets/client/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="/assets/client/css/style.css">
    @yield('stylesheets')
</head>

<body>
    <div class="page-wrapper">
        @include('layouts._header')

        <main class="main">
            @yield('content')
        </main><!-- End .main -->

        @include('layouts._footer')
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    @include('layouts._mobileMenu')

    @include('layouts._authModal')

    @include('layouts._newsletterPopup')
    <!-- Plugins JS File -->
    <script src="/assets/client/js/jquery.min.js"></script>
    <script src="/assets/client/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/client/js/jquery.hoverIntent.min.js"></script>
    <script src="/assets/client/js/jquery.waypoints.min.js"></script>
    <script src="/assets/client/js/superfish.min.js"></script>
    <script src="/assets/client/js/owl.carousel.min.js"></script>
    <script src="/assets/client/js/bootstrap-input-spinner.js"></script>
    <script src="/assets/client/js/jquery.elevateZoom.min.js"></script>
    <script src="/assets/client/js/jquery.magnific-popup.min.js"></script>
    <!-- Main JS File -->
    @yield('scripts')
    <script src="/assets/client/js/main.js"></script>
</body>


<!-- molla/index-2.html  22 Nov 2019 09:55:42 GMT -->

</html>

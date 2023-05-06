<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPMath - Learning From The Best</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('assets/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/app.rtl.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-material-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-material-icons.rtl.css') }}" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-fontawesome-free.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-fontawesome-free.rtl.css') }}" rel="stylesheet">

    <!-- ion Range Slider -->
    <link type="text/css" href="{{ asset('assets/css/vendor-ion-rangeslider.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-ion-rangeslider.rtl.css') }}" rel="stylesheet">

    <!-- AOS -->
    <link href="{{ asset('https://unpkg.com/aos@2.3.1/dist/aos.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <link type="text/css" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="layout-default">

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout" style="min-height:100%; background-attachment: fixed; background-repeat: no-repeat; background-size: cover; -moz-background-size: cover; background-image: linear-gradient(rgba(255, 255, 255, 0.975), rgba(255, 255, 255, 0.975)), url('{{ asset('assets/images/bg3.jpg') }}'); ">

        <!-- Header -->
        @include('layout.header')
        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">
            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">

                    @yield('header')
                    @yield('content')

                </div>
                <!-- // END drawer-layout__content -->

                @include('layout.sidebar')

            </div>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->
    <div id="modal-div"></div>


    <script src="{{ asset('https://unpkg.com/aos@2.3.1/dist/aos.js') }}"></script>

    <script>
        AOS.init();
    </script>

    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('assets/vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('assets/vendor/dom-factory.js') }}"></script>

    <!-- MDK -->
    <script src="{{ asset('assets/vendor/material-design-kit.js') }}"></script>

    <!-- Range Slider -->
    <script src="{{ asset('assets/vendor/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/ion-rangeslider.js') }}"></script>

    <!-- App -->
    <script src="{{ asset('assets/js/toggle-check-all.js') }}"></script>
    <script src="{{ asset('assets/js/check-selected-row.js') }}"></script>
    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-mini.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    @stack('js')

</body>

</html>

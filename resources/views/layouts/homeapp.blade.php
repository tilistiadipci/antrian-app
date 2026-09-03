<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $settings->name }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>{{ $settings->name }} </title>
    <!-- Fonts -->
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/'.$settings->logo) }}?v={{ file_exists(base_path('assets/images/'.$settings->logo)) ? filemtime(base_path('assets/images/'.$settings->logo)) : 1 }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/animate.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ route('beranda') }}/public/css/apexcharts.css">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ route('beranda') }}/public/style.css">

    <style>
        .modal {
            text-align: center;
        }

        @media screen and (min-width: 768px) {
            .modal:before {
                display: inline-block;
                vertical-align: middle;
                content: " ";
                height: 100%;
            }
        }

        .modal-dialog {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }

        .gl-star-rating[data-star-rating] {
            position: relative;
            display: block
        }

        .gl-star-rating[data-star-rating]>select {
            overflow: hidden;
            visibility: visible !important;
            position: absolute !important;
            top: 0;
            width: 1px;
            height: 1px;
            clip: rect(1px, 1px, 1px, 1px);
            -webkit-clip-path: circle(1px at 0 0);
            clip-path: circle(1px at 0 0);
            white-space: nowrap
        }

        .gl-star-rating[data-star-rating]>select::before,
        .gl-star-rating[data-star-rating]>select::after {
            display: none !important
        }

        .gl-star-rating-ltr[data-star-rating]>select {
            left: 0
        }

        .gl-star-rating-rtl[data-star-rating]>select {
            right: 0
        }

        .gl-star-rating[data-star-rating]>select:focus+.gl-star-rating-stars::before {
            opacity: .5;
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            content: '';
            outline: dotted 1px currentColor;
            pointer-events: none
        }

        .gl-star-rating-stars {
            position: relative;
            display: inline-block;
            height: 26px;
            vertical-align: middle;
            cursor: pointer
        }

        .gl-star-rating-stars>span {
            display: inline-block;
            width: 20px;
            height: 24px;
            background-size: 20px;
            background-repeat: no-repeat;
            background-image: url({{ asset('assets/images') }}/stars/star-empty.svg);
            margin: 0 4px 0 0
        }

        .gl-star-rating-stars>span:last-of-type {
            margin-right: 0
        }

        .gl-star-rating-rtl[data-star-rating] .gl-star-rating-stars>span {
            margin: 0 0 0 4px
        }

        .gl-star-rating-rtl[data-star-rating] .gl-star-rating-stars>span:last-of-type {
            margin-left: 0
        }

        .gl-star-rating-stars.s10>span:nth-child(1),
        .gl-star-rating-stars.s20>span:nth-child(-1n+2),
        .gl-star-rating-stars.s30>span:nth-child(-1n+3),
        .gl-star-rating-stars.s40>span:nth-child(-1n+4),
        .gl-star-rating-stars.s50>span:nth-child(-1n+5),
        .gl-star-rating-stars.s60>span:nth-child(-1n+6),
        .gl-star-rating-stars.s70>span:nth-child(-1n+7),
        .gl-star-rating-stars.s80>span:nth-child(-1n+8),
        .gl-star-rating-stars.s90>span:nth-child(-1n+9),
        .gl-star-rating-stars.s100>span {
            background-image: url({{ asset('assets/images') }}/stars/star-full.svg)
        }

        .gl-star-rating-text {
            display: inline-block;
            position: relative;
            height: 20px;
            line-height: 20px;
            font-size: .8em;
            font-weight: 600;
            color: #fff;
            background-color: #1a1a1a;
            white-space: nowrap;
            vertical-align: middle;
            padding: 0 12px 0 6px;
            margin: 0 0 0 12px
        }

        .gl-star-rating-text::before {
            position: absolute;
            top: 0;
            left: -12px;
            width: 0;
            height: 0;
            content: "";
            border-style: solid;
            border-width: 13px 12px 13px 0;
            border-color: transparent #1a1a1a transparent transparent
        }

        .gl-star-rating-rtl[data-star-rating] .gl-star-rating-text {
            padding: 0 6px 0 12px;
            margin: 0 12px 0 0
        }

        .gl-star-rating-rtl[data-star-rating] .gl-star-rating-text::before {
            left: unset;
            right: -12px;
            border-width: 13px 0 13px 12px;
            border-color: transparent transparent transparent #1a1a1a
        }

        @font-face {
            font-family: "Poppins";
            src:
                local("Poppins"),
                url("{{ asset('assets/font/poppins') }}/Poppins-Regular.ttf") format("opentype");
            font-weight: 400;
        }

        @font-face {
            font-family: "Poppins";
            src:
                local("Poppins"),
                url("{{ asset('assets/font/poppins') }}/Poppins-SemiBold.ttf") format("opentype");
            font-weight: 600;
        }

        @font-face {
            font-family: "Poppins";
            src:
                local("Poppins"),
                url("{{ asset('assets/font/poppins') }}/Poppins-Bold.ttf") format("opentype");
            font-weight: 700;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>

<body>



    @yield('content')

    <!-- All JavaScript Files -->
    <script src="{{ route('beranda') }}/public/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/internet-status.js"></script>
    <script src="{{ asset('assets') }}/js/waypoints.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/jquery.easing.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/wow.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/owl.carousel.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/jquery.counterup.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/jquery.countdown.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/isotope.pkgd.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/dark-mode-switch.js"></script>
    <script src="{{ route('beranda') }}/public/js/ion.rangeSlider.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/jquery.dataTables.min.js"></script>
    <script src="{{ route('beranda') }}/public/js/active.js"></script>
    <script src="{{ route('beranda') }}/public/js/pwa.js"></script>
    @yield('script')
    @include('common.messages')
</body>

</html>

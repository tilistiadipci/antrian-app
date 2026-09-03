<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>Penilaian | Antrian</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/'.$settings->logo) }}?v={{ file_exists(base_path('assets/images/'.$settings->logo)) ? filemtime(base_path('assets/images/'.$settings->logo)) : 1 }}">
    <link href="{{ asset('assets/css/materialize.min.css') }}" type="text/css" rel="stylesheet"
        media="screen,projection">
    <link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css"
        rel="stylesheet" media="screen,projection">
    @yield('css')
    <link href="{{ asset('assets/css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <style>
        body {

            background: url("{{ asset('assets/images') }}/{{ $settings->background }}") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .card-panel-a {
            margin: 10% 0 1rem;
            padding: 2rem;
            width: 90%;
            height: 132px;
            position: relative;
            -webkit-box-shadow: linear-gradient(135deg, transparent 50px, #FFFFFF 0%, #2E4053 100%);
            -moz-box-shadow: linear-gradient(135deg, transparent 50px, #FFFFFF 0%, #2E4053 100%);
            box-shadow: linear-gradient(135deg, transparent 50px, #FFFFFF 0%, #2E4053 100%);
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px 10px 10px 0px;
            background: linear-gradient(105deg, transparent 42px, #FFFFFF 0%, #2E4053 100%);
            top: 50%;
        }

        .card-panel-b {
            margin: 2% 0 1rem;
            padding: 20px 10px 10px;
            width: 120px;
            height: 120px;
            position: absolute;
            bottom: 50%;
            right: 0px;
            background: linear-gradient(to bottom right, #fff 0%, #fff 100%);
            -webkit-box-shadow: linear-gradient(135deg, transparent 50px, #FFFFFF 0%, #2E4053 100%);
            -moz-box-shadow: linear-gradient(135deg, transparent 50px, #FFFFFF 0%, #2E4053 100%);
            box-shadow: linear-gradient(135deg, transparent 50px, #2E4053 0%, #2E4053 100%);
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 50px 0px 0px 50px;
            text-align: center;

        }

        .hari {
            color: #555;
            font-size: 18px;
            font-weight: 300;
            text-align: center;
            font-family: 'Roboto', sans-serif;
        }

        .jam {
            color: {{ $settings->background_text }};
            font-size: 25px;
            font-weight: 900;
            font-family: 'Roboto', sans-serif;
        }

        .tanggal {
            color: #555;
            font-size: 16px;
            font-weight: 300;
            letter-spacing: 1.5px;
            font-family: 'Roboto', sans-serif;

        }

        .namalay {
            position: absolute;
            top: 5px;
            left: 25px;
            padding: 0.5rem;
            width: 90%;
            background: linear-gradient(110deg, transparent 42px, {{ $settings->background_panel_ba }} 0%, {{ $settings->background_panel_bb }} 100%);
            color: {{ $settings->color_teks_layanan }};
            text-align: left;
            font-family: 'Roboto', sans-serif;
        }

        .namalaytext {
            padding: 0px 40px 10px;
        }


        .letter {}

        .badge {
            position: absolute;
            margin: 1.5em 3em;
            width: 6em;
            height: 9.5em;
            border-radius: 10px;
            display: inline-block;
            top: -28px;
            right: -45px;
            transition: all 0.2s ease;
        }

        .badge:before,
        .badge:after {
            position: absolute;
            width: inherit;
            height: inherit;
            border-radius: inherit;
            background: inherit;
            content: "";

            left: 0;
            right: 0;
            top: 0;
            margin: auto;

        }

        .badge:before {
            transform: rotate(60deg);
        }

        .badge:after {
            transform: rotate(-60deg);
        }

        .badge .circle {
            width: 90px;
            height: 90px;
            position: absolute;
            background: #fff;
            z-index: 10;
            border-radius: 50%;
            top: 10px;
            left: 0px;
            right: 0;
            bottom: 0;
            margin: auto;
            font-size: 5.2em;
            font-weight: 900;
            color: {{ $settings->color_teks_loket }};
        }


        .badge .font {
            display: inline-block;
            margin-top: 1em;
        }

        .badge .ribbon-a {
            position: absolute;
            border-radius: 4px;
            padding: 5px 5px 4px;
            width: 100px;
            z-index: 11;
            color: #fff;
            top: 2px;
            left: 50%;
            margin-left: -50px;
            height: 30px;
            font-size: 18px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.27);
            text-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            background: linear-gradient(to bottom right, {{ $settings->background_panel_ca }} 0%, {{ $settings->background_panel_cb }} 100%);
            cursor: default;
        }

        .ambilant {
            font-size: 1.8em;
            font-weight: 900;
            color: #3F4042;
        }

        .tombol {
            background: linear-gradient(to bottom right, #71757A 0%, #2E4053 100%);
            color: #c62828;

            color: #fff;
            border-radius: 20px 20px 20px 20px;
            box-shadow:
                -2px -2px 2px #ffffff;
            text-transform: uppercase;
            text-align: left;
            margin: 60px 10px -30px;
        }

        .btngmb {

            margin: 0px -20px -30px;
            width: 64px;
            height: 64px;
            float: right;
        }


        .red {
            background: linear-gradient(to bottom right, {{ $settings->background_panel_da }} 0%, {{ $settings->background_panel_db }} 100%);
            color: #c62828;

        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 132px;
            padding: 15px 0;
            background: linear-gradient(to bottom right, {{ $settings->background_panel_aa }} 0%, {{ $settings->background_panel_ab }} 100%);
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font: 700 18px/1 'Lato', sans-serif;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
            text-transform: uppercase;
            text-align: center;
            left: -50px;

        }


        /* top left*/
        .ribbon-top-left {
            top: -10px;
            left: -10px;
            transform: skewX(-20deg);

        }

        .ribbon-top-left::before,
        .ribbon-top-left::after {
            border-top-color: transparent;
            border-left-color: transparent;

        }

        .ribbon-top-left::before {
            top: 0;
            right: 0;
        }

        .ribbon-top-left::after {
            bottom: 0;
            left: 0;
        }

        .ribbon-top-left span {
            right: -25px;
            top: 21px;
            transform: rotate(90deg);

        }
    </style>
    <style>
        .no-antrian {
            padding: 0px 20px 10px;
            font-size: 6.2em;
            font-weight: 900;
            color: {{ $settings->color_teks_noangka }};
            text-align: left;
            text-shadow: -2px -2px 0 #fff, 2px -2px 0 #fff, -2px 2px 0 #fff, 2px 2px 0 #fff;

        }
    </style>
</head>

<body>



    @yield('content1')
    <div id="main" style="padding:15px;padding-bottom:0">
        <div class="wrapper">
            <section id="content">
                @yield('content2')
            </section>
        </div>
    </div>

    @yield('print')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/anime.min.js') }}"></script>
    @yield('script')
    @include('common.messages')
</body>

</html>

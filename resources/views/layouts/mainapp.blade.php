<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>@yield('title') | Antrian</title>
    <link rel="icon" href="{{ asset('assets/favicon.png') }}">
    <link href="{{ asset('assets/css/materialize.min.css') }}" type="text/css" rel="stylesheet"
        media="screen,projection">
    <link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css"
        rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/css/toastr.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    @yield('css')
    <link href="{{ asset('assets/css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

    <style>
        ul.side-nav.leftside-navigation li.user-details {
            background: url("{{ asset('assets/images') }}/{{ $background }}") center center no-repeat;
            background-size: cover;
            margin-bottom: 15px;
            padding: 15px 0 0 15px;
        }

        .required-label::after {
            content: " *";
            color: red;
            font-weight: bold;
        }

        /* .optional-label::after {
        content: " (optional)";
        color: #999;
        font-style: italic;
        font-weight: normal;
    } */
    </style>
</head>

<body>
    @if ($user->is_admin)
        <header id="header" class="page-topbar">
            <div class="navbar-fixed">
                <nav class="navbar-color" style="background:{{ $background_menu }};">
                    <div class="nav-wrapper">
                        <ul class="left">
                            <li>
                                <h1 class="logo-wrapper"><span class="brand-logo darken-1">{{ $company_name }}</span>
                                </h1>
                            </li>
                        </ul>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="javascript:void(0);"
                                    class="waves-effect waves-block waves-light notification-button"
                                    data-activates="notifications-dropdown"><i class="mdi-editor-insert-link"></i></a>
                            </li>
                            <li><a href="javascript:void(0);"
                                    class="waves-effect waves-block waves-light toggle-fullscreen"><i
                                        class="mdi-action-settings-overscan"></i></a></li>
                        </ul>
                        <ul id="translation-dropdown" class="dropdown-content" style="max-height:250px">
                            <li>
                                <h5 style="font-size:1rem;padding:0 1rem 0 1rem;font-weight:500">
                                    {{ trans('messages.mainapp.select_language') }}</h5>
                            </li>
                            <li class="divider"></li>
                            @foreach ($languages as $language)
                                <li{!! $clocale->code == $language->code ? ' class="active"' : '' !!}><a
                                        href="{{ route('change_locale', ['locale' => $language->code]) }}"><img
                                            src="{{ asset('assets/images/flag-icons/' . $language->image) }}"
                                            alt="{{ $language->name }}" /> <span
                                            class="language-select">{{ trans('messages.locales.' . $clocale->code . '.' . $language->code) }}</span></a>
                                    </li>
                            @endforeach
                        </ul>

                        <ul id="notifications-dropdown" class="dropdown-content">
                            <li class="divider"></li>
                            <li><a href="{{ route('display') }}" target="_blank"
                                    style="font-weight:400">{{ trans('messages.mainapp.display_url') }}</a></li>
                            <li><a href="{{ route('display') }}/1" target="_blank" style="font-weight:400">Display
                                    2</a></li>
                            <li><a href="{{ route('add_to_queue') }}" target="_blank"
                                    style="font-weight:400">{{ trans('messages.mainapp.issue_url') }}</a></li>
                            <li><a href="{{ url('queue') }}/2" target="_blank" style="font-weight:400">Antrian 2</a></li>
                        </ul>

                    </div>
                </nav>
            </div>
        </header>

        <div id="main">
            <div class="wrapper">
                <aside id="left-sidebar-nav">
                    <ul id="slide-out" class="side-nav fixed leftside-navigation">
                        <li class="user-details cyan darken-2">
                            <div class="row">
                                <div class="col col s4 m4 l4">
                                    <img src="{{ asset('assets/images/avatar.jpg') }}" alt=""
                                        class="circle responsive-img valign profile-image">
                                </div>
                                <div class="col col s8 m8 l8">
                                    <ul id="profile-dropdown" class="dropdown-content">
                                        <li><a class="frmsubmit" href="{{ route('logout') }}" message="false"
                                                method="post"><i class="mdi-hardware-keyboard-tab"></i>
                                                {{ trans('messages.mainapp.logout') }}</a></li>
                                    </ul>
                                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn truncate"
                                        href="#" data-activates="profile-dropdown">
                                        {{ $user->name }}<i class="mdi-navigation-arrow-drop-down right"></i>
                                    </a>
                                    <p class="user-roal">{{ $user->role_text }}</p>
                                </div>
                            </div>
                        </li>
                        @yield('menu')
                    </ul>
                    <a href="#" data-activates="slide-out"
                        class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only teal lighten-1"><i
                            class="mdi-navigation-menu"></i></a>
                </aside>
    @endif
    <section id="content">
        @yield('content')

    </section>
    </div>
    </div>
    @if ($user->is_admin)
        <footer class="page-footer">
            <div class="footer-copyright" style="background:{{ $background_menu }};">
                <div class="container">
                    <span>Powered by <a href="http://bio-experience.com" target="_blank" style="color:#ffffff">Bio
                            Experience</a></span>
                    <span class="right"> <span class="grey-text text-lighten-3">Version</span> 3.1.0</span>
                </div>
            </div>
        </footer>
    @endif
    @yield('print')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>

    @yield('script')
    <script>
        $(function() {
            $('#main').css({
                'min-height': $(window).height() - 134 + 'px'
            });
            $(window).resize(function() {
                $('#main').css({
                    'min-height': $(window).height() - 134 + 'px'
                });
            });
            $('#translation-dropdown').perfectScrollbar();
            $('select').each(function() {
                if (!$(this).parent().hasClass('picker__header')) {
                    $(this).select2();
                }
            });
        });
        $(".frmsubmit").on("click", function(e) {
            var message = 'Are you sure you want to delete?';
            if (e.currentTarget.attributes.message != undefined) message = e.currentTarget.attributes.message.value;
            var cnfrm = true;
            if (e.currentTarget.attributes.message != undefined && e.currentTarget.attributes.message.value ==
                'false') cnfrm = false;
            if (cnfrm) {
                if (confirm(message)) {
                    e.preventDefault();
                    var myForm = '<form id="hidfrm" action="' + e.currentTarget.attributes.href.value +
                        '" method="post">{{ csrf_field() }}<input type="hidden" name="_method" value="' + e
                        .currentTarget.attributes.method.value + '"></form>';
                    $('body').append(myForm);
                    myForm = $('#hidfrm');
                    myForm.submit();
                }
            } else {
                e.preventDefault();
                var myForm = '<form id="hidfrm" action="' + e.currentTarget.attributes.href.value +
                    '" method="post">{{ csrf_field() }}<input type="hidden" name="_method" value="' + e
                    .currentTarget.attributes.method.value + '"></form>';
                $('body').append(myForm);
                myForm = $('#hidfrm');
                myForm.submit();
            }
            return false;
        });
        @if (!Request::is('calls*'))
            $(document).ajaxStart(function() {
                $("body").removeClass('loaded');
                Pace.restart();
            });
            $(document).ajaxStop(function() {
                $("body").addClass('loaded');
            });
        @endif

        $('.date').on('mousedown', function(event) {
            event.preventDefault();
        })

        $('#date').on('mousedown', function(event) {
            event.preventDefault();
        })

        $(document).ready(function() {
            $("label[for]").each(function() {
                const inputId = $(this).attr("for");
                const inputEl = $("#" + inputId);

                if (inputEl.prop("required")) {
                    $(this).addClass("required-label");
                } else {
                    $(this).addClass("optional-label");
                }
            });
        });

        // toastr
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>
    @include('common.messages')
</body>

</html>

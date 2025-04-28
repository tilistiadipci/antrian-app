@extends('layouts.homeapp')
@if ($mobile)
    @section('title', trans('messages.mainapp.menu.dashboard'))

    @section('content')
        <!-- Preloader -->
        <div class="preloader d-flex align-items-center justify-content-center" id="preloader">
            <div class="spinner-grow text-primary" role="status">
                <div class="sr-only">Loading...</div>
            </div>
        </div>
        <!-- Internet Connection Status -->
        <!-- # This code for showing internet connection status -->
        <div class="internet-connection-status" id="internetStatus"></div>
        <!-- Header Area -->
        <div class="header-area" id="headerArea">
            <div class="container">
                <!-- # Paste your Header Content from here -->
                <!-- # Header Five Layout -->
                <!-- # Copy the code from here ... -->
                <!-- Header Content -->
                <div
                    class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                    <!-- Logo Wrapper -->
                    <div class="logo-wrapper"><a href="{{ route('beranda') }}"><img
                                src="{{ asset('assets/images') }}/{{ $settings->logo }}" alt=""></a></div>
                    <!-- Navbar Toggler -->
                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                    </div>
                </div>
                <!-- # Header Five Layout End -->
            </div>
        </div>
        <div class="page-content-wrapper py-3">
            <div class="container">
                <!-- User Information-->
                <div class="card user-info-card mb-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="user-profile me-3"><img src="{{ route('beranda') }}/assets/images/avatar.jpg"
                                alt="">
                        </div>
                        <div class="user-info">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-1">{{ $member->name }}</h5>
                                <a class="badge bg-warning ms-2 rounded-pill" href="{{ route('logout_user') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout_user') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </div>
                            <p class="mb-0">Member</p>
                        </div>
                    </div>
                </div>
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        @if ($errors->has('name'))
                            <div class="username alert custom-alert-2 alert-danger alert-dismissible fade show"
                                role="alert">
                                <svg class="bi bi-x-circle" width="20" height="20" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                    </path>
                                </svg>{{ $errors->first('name') }}!
                                <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->has('telp'))
                            <div class="telp alert custom-alert-2 alert-danger alert-dismissible fade show" role="alert">
                                <svg class="bi bi-x-circle" width="20" height="20" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                    </path>
                                </svg>{{ $errors->first('telp') }}
                                <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->has('password'))
                            <div class="password alert custom-alert-2 alert-danger alert-dismissible fade show"
                                role="alert">
                                <svg class="bi bi-x-circle" width="20" height="20" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                    </path>
                                </svg>{{ $errors->first('password') }}
                                <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->has('password_confirmation'))
                            <div class="password_confirmation alert custom-alert-2 alert-danger alert-dismissible fade show"
                                role="alert">
                                <svg class="bi bi-x-circle" width="20" height="20" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                    </path>
                                </svg>{{ $errors->first('password_confirmation') }}
                                <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form id="account" action="{{ route('edit_profile') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" id="username" type="text" name="username"
                                    value="{{ $member->username }}" placeholder="Username" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input class="form-control" id="name" name="name" type="text"
                                    value="{{ $member->name }}" placeholder="Full Name">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text"
                                    value="{{ $member->email }}" placeholder="Email Address" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="alamat">Alamat</label>
                                <input class="form-control" id="alamat" name="alamat" type="text"
                                    value="{{ $member->alamat }}" placeholder="Alamat">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="telp">No Hp/Whatsapp</label>
                                <input class="form-control" id="telp" name="telp" type="number"
                                    value="{{ $member->telp }}" placeholder="08XXXXXXXXXXX" data-error=".telp">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Ubah Password</label>
                                <input class="form-control" id="password" name="password" type="password"
                                    value="{{ old('password') }}" placeholder="Password" data-error=".password">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                <input class="form-control" id="password_confirmation" type="password"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}"
                                    placeholder="Konfirmasi Password" data-error=".password_confirmation">
                            </div>
                            <button class="btn btn-success w-100" type="submit">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Nav -->
        <div class="footer-nav-area" id="footerNav">
            @include('mobile.menu-bar')
        </div>

    @endsection

    @section('script')
        <script type="text/javascript" src="{{ asset('assets/js/materialize-colorpicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins/chartjs/chart.min.js') }}"></script>
        <script>
            $("#account").validate({
                rules: {
                    name: {
                        required: true
                    },
                    telp: {
                        required: true
                    },
                    password: {
                        minlength: 6
                    },
                    password_confirmation: {
                        minlength: 6,
                        equalTo: "#password"
                    },
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        </script>

    @endsection
@else
    @section('content')
        <!-- Preloader -->
        <div class="preloader d-flex align-items-center justify-content-center" id="preloader">
            <div class="spinner-grow text-primary" role="status">
                <div class="sr-only">Loading...</div>
            </div>
        </div>
        <!-- Internet Connection Status -->
        <!-- # This code for showing internet connection status -->
        <div class="internet-connection-status" id="internetStatus"></div>
        <!-- Static Backdrop Modal -->
        <div class="cs-newsletter-form modal fade" id="staticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <h6 class="mb-3">Subscribe our newsletter.</h6>
                        <form action="#">
                            <input class="form-control mb-3" type="email" placeholder="Enter your email">
                            <button class="btn btn-primary w-100" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content Wrapper -->
        <div class="coming-soon-wrapper bg-white text-center"
            style="background-image: url('{{ asset('assets/images') }}/{{ $settings->background }}')">
            <div class="container">
                <div><a href="page-home.html"><img src="{{ asset('assets/images') }}/{{ $settings->logo }}"
                            alt=""></a></div>
                <h2 class="text-black display-3">Antrian {{ $settings->name }}</h2>
                <p class="heading-text">Antrian {{ $settings->name }} hanya bisa diakses melalui handphone anda.</p>
            </div>
        </div>
    @endsection
@endif

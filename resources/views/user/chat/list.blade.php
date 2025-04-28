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
                <div class="card mb-3 timeline-card">
                    <div class="card-body">



                        <div class="row g-3">
                            @foreach ($users as $user)
                                <div class="col-2">

                                    <div class="feature-card mx-auto text-center">

                                        <a class="me-2 badge-avater badge-avater-lg" href="#"
                                            @if ($readys->where('to_id', $user->id)->where('re_id', $member->id)->count() == '0') onclick="channel_dept({{ $user->id }})" @endif><img
                                                class="img-circle" src="{{ route('beranda') }}/public/img/bg-img/user1.png"
                                                alt=""><span class="status bg-success"></span>
                                            <h6 class="mb-0" style="font-size:10px;">{{ $user->name }}</h6>
                                        </a>
                                    </div>
                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>

                <!-- Element Heading -->
                <div class="element-heading">
                    <h6 class="ps-1">Chat terakhir</h6>
                </div>
                <!-- Chat User List -->
                <ul class="ps-0 chat-user-list">
                    @foreach ($channels as $channel)
                        @foreach ($users as $user)
                            @if ($user->id == $channel->to_id)
                                <!-- Single Chat User -->
                                <li class="p-3 chat-unread"><a class="d-flex" href="{{ route('chat', $user->id) }}">
                                        <!-- Thumbnail -->
                                        <div class="chat-user-thumbnail me-3 shadow"><img class="img-circle"
                                                src="{{ route('beranda') }}/public/img/bg-img/user1.png"
                                                alt=""><span class="active-status"></span></div>
                                        <!-- Info -->
                                        <div class="chat-user-info">
                                            <h6 class="text-truncate mb-0">


                                                {{ $user->name }}

                                            </h6>
                                            <div class="last-chat">
                                                <p class="mb-0 text-truncate"> Lihat percakanan!</p>

                                            </div>
                                        </div>
                                    </a>
                                    <!-- Options -->
                                    <div class="dropstart chat-options-btn">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="bi bi-mic-mute"></i>Mute</a></li>
                                            <li><a href="#"><i class="bi bi-slash-circle"></i>Ban</a></li>
                                            <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Footer Nav -->
        <div class="footer-nav-area" id="footerNav">
            @include('mobile.menu-bar')
        </div>
    @endsection

    @section('script')
        <script type="text/javascript">
            function channel_dept(value) {
                $('body').removeClass('loaded');
                var myForm2 =
                    '<form id="hidfrm2" action="{{ route('postchannel') }}" method="post">{{ csrf_field() }}<input type="hidden" name="toid" value="' +
                    value + '"></form>';
                $('body').append(myForm2);
                myForm2 = $('#hidfrm2');
                myForm2.submit();
            }
        </script>
        <script>
            function checkcall() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('assets/files/chat') }}",
                    cache: false,
                    success: function(response) {
                        s = JSON.parse(response);
                        if (curr != response) {


                            curr = response;
                        }
                        $('#notif').html('<span class="status bg-primary">1</span>');
                        $('#display').html(s.message);
                        curr = response;
                    }
                });
            }

            window.setInterval(function() {
                checkcall();

            }, 0);




            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('assets/files/chat') }}",
                    cache: false,
                    success: function(response) {
                        s = JSON.parse(response);
                        curr = response;
                    }
                });

                checkcall();
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
        <div class="cs-newsletter-form modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

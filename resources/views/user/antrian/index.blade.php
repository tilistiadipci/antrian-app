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

                @if ($queues->where('id_member', $member->id)->count() == '0')
                    <div class="card">
                        <div class="card-body px-5 text-center"><img class="mb-4" src="img/bg-img/39.png" alt="">
                            <h4>OOPS... <br></h4>
                            <p class="mb-4">Kami tidak bisa menampilkan data antrian anda, karena anda belum mengambil
                                nomor antrian.</p><a class="btn btn-creative btn-danger"
                                href="{{ route('beranda') }}">Beranda</a>
                        </div>
                    </div>
                @endif


                <div class="row g-3 justify-content-center">
                    @foreach ($queues as $queue)
                        <!-- Single Blog Card -->
                        <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                            <div class="card shadow-sm blog-list-card">
                                <div class="d-flex align-items-center">
                                    <div class="card-blog-img position-relative bg-primary"
                                        style="background-image: url('{{ route('beranda') }}/public/img/core-img/2.png');height:195px;">
                                        <span
                                            style="position:absolute;font-size: 4em; font-weight: 600;margin:30% 5% 0px;color:#fff;font-family: Arial, Helvetica, sans-serif;">
                                            @foreach ($departments as $department)
                                                @if ($department->id == $queue->department_id)
                                                    {{ $department->letter }}{{ $queue->number }}
                                                @endif
                                            @endforeach
                                        </span>
                                        <span class="badge bg-warning text-dark position-absolute card-badge">
                                            @foreach ($departments as $department)
                                                @if ($department->id == $queue->department_id)
                                                    {{ $department->name }}
                                                @endif
                                            @endforeach
                                        </span>

                                    </div>

                                    <div class="card-blog-content" style="padding: 0.3rem">
                                        <span class="badge bg-danger rounded-pill mb-2 d-inline-block"
                                            style="font-size:10px;">
                                            {{ $queue->created_at }}
                                        </span>

                                        @if ($rattings->where('nomor', $queue->id)->first())
                                            @foreach ($rattings as $ratting)
                                                @if ($ratting->nomor == $queue->id)
                                                    <select class="star-rating">
                                                        <option value="{{ $ratting->bintang }}"></option>
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">3</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($times as $time)
                                                @if ($time->queue_id == $queue->id && $time->number == $queue->number)
                                                    @foreach ($counters as $counter)
                                                        @if ($counter->id == $time->counter_id)
                                                            <select id="dropdown_selector_{{ $queue->id }}"
                                                                class="star-rating"
                                                                data-fruit="{{ $counter->name }} {{ $counter->idcounter }} "
                                                                onchange="changeFunc({{ $queue->id }}, {{ $time->user_id }});">
                                                                <option value=""></option>
                                                                <option value="5">5</option>
                                                                <option value="4">4</option>
                                                                <option value="3">3</option>
                                                                <option value="2">3</option>
                                                                <option value="1">1</option>
                                                            </select>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                            <script type='text/javascript'>
                                                function changeFunc(value, value1) {
                                                    var selectBox = document.getElementById('dropdown_selector_' + value + '');
                                                    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                                                    var selectedValue1 = selectBox.options[selectBox.selectedIndex].text;

                                                    var fruitCount = selectBox.getAttribute('data-fruit');

                                                    //var kredit = option.addClass().attr("class");
                                                    /* setting input box value to selected option value */
                                                    $('#bintang').val(selectedValue);
                                                    $('#nomor').val('' + value + '');
                                                    $('#user_id').val('' + value1 + '');
                                                    $('#loket').val('' + fruitCount + '');


                                                    //var kredit = option.addClass().attr("class");
                                                    /* setting input box value to selected option value */
                                                    $('#idratting').html('Penilaian Pelayanan Untuk ' + fruitCount + '');



                                                    $('#bootstrapBasicModal').modal('show');
                                                }
                                            </script>
                                        @endif
                                        <p class="fst-italic d-block mb-3" href="page-blog-details.html">
                                            @if ($queue->called == '1')
                                            @else
                                                @if (
                                                    $queue->number -
                                                        $queue->where('called', 1)->where('department_id', $queue->department_id)->where('created_at', '>', $datenow->format('Y-m-d 00:00:00'))->get()->count() ==
                                                        '1')
                                                    Giliran anda!
                                                @else
                                                    Menunggu
                                                    {{ $queue->number - $queue->where('called', 1)->where('department_id', $queue->department_id)->where('created_at', '>', $datenow->format('Y-m-d 00:00:00'))->get()->count() - 1 }}
                                                    Orang
                                                @endif
                                            @endif
                                        </p>

                                        @if ($queue->called == '1')
                                            @foreach ($times as $time)
                                                @if ($time->queue_id == $queue->id && $time->number == $queue->number)
                                                    @if ($time->served_time)
                                                        <h6 class="fst-italic d-block mb-3 text-capitalize"
                                                            style="font-size:11px;">
                                                            Dilayani di : @foreach ($counters as $counter)
                                                                @if ($counter->id == $time->counter_id)
                                                                    {{ $counter->name }} {{ $counter->idcounter }}
                                                                @endif
                                                            @endforeach
                                                            <br />
                                                            Waktu dilayani : {{ $time->served_time }} Menit
                                                        </h6>

                                                        <a class="btn btn-sm btn-creative btn-info" href="#"><i
                                                                class="bi-file-person-fill me-2"></i>Dilayani</a>
                                                    @endif

                                                    @if ($time->served_time == '')
                                                        <a class="btn btn-sm btn-creative btn-danger" href="#"><i
                                                                class="bi-calendar2-minus me-2"></i>Tidak Hadir</a>
                                                    @endif
                                                @endif
                                            @endforeach

                                            <a class="btn btn-sm btn-creative btn-primary" href="#"><i
                                                    class="bi bi-check2-circle"></i></a>
                                        @else
                                            @if ($queue->number - $queue->where('called', 1)->where('department_id', $queue->department_id)->get()->count() == '1')
                                                <a class="btn btn-sm btn-creative btn-warning" href="#"><i
                                                        class="bi bi-arrow-repeat me-2"></i>Menunggu</a>
                                            @else
                                                <a class="btn btn-sm btn-creative btn-light" href="#"><i
                                                        class="bi bi-clock-history me-2"></i>Antri</a>
                                            @endif
                                        @endif
                                        @if (!$queue->called == '1')
                                            <span class="btn btn-sm btn-creative btn-secondary" data-target="#loginModal"
                                                onclick="queue_dept({{ $queue->id }})"><i class="bi bi-eye"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Bootstrap Basic Modal -->
        <div class="modal fade" id="bootstrapBasicModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog w-75">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="idratting"></h6>
                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    @if ($errors->has('pesan'))
                        <div class="alert custom-alert-1 alert-danger alert-dismissible fade show" role="alert">
                            <svg class="bi bi-x-circle" width="20" height="20" viewBox="0 0 16 16"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                <path fill-rule="evenodd"
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                </path>
                            </svg>{{ $errors->first('pesan') }}!
                            <button class="btn btn-close position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form id="add" action="{{ route('sendratting') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <input id="bintang" type="hidden" name="bintang" />
                            <input id="nomor" type="hidden" name="nomor" />
                            <input id="user_id" type="hidden" name="user_id" />
                            <input id="loket" type="hidden" name="loket" />
                            <div class="form-group">
                                <textarea class="form-control form-control-clicked" id="pesan" name="pesan" cols="3" rows="5"
                                    placeholder="Tulis penilaian anda..." data-error=".pesan"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Footer Nav -->
        <div class="footer-nav-area" id="footerNav">
            @include('mobile.menu-bar')
        </div>


        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if (session()->has('department_name'))
                            <style>
                                #printarea {
                                    text-align: center
                                }

                                @media print {

                                    #loader-wrapper,
                                    header,
                                    #main,
                                    footer,
                                    #toast-container {
                                        display: none
                                    }

                                    #printarea {
                                        display: block;
                                    }
                                }

                                @page {
                                    margin: 0
                                }
                            </style>
                            <div id="printarea" style="line-height:1.25">
                                <img src="{{ asset('assets/images') }}/{{ $settings->logo }}"
                                    width="{{ $settings->size_logo_print }}"
                                    class="brand-logo-a responsive-img center-align blackprint">
                                <br>
                                <span
                                    style="font-size:{{ $settings->size_company }}px; font-weight: bold">{{ $settings->name }}</span><br>
                                <span style="font-size:25px">{{ session()->get('department_name') }}</span><br>
                                <span style="font-size:20px">No Antrian Anda</span><br>
                                <span>
                                    <h3 style="font-size:70px;font-weight:bold;margin:0;line-height:1.5">
                                        {{ session()->get('number') }}</h3>
                                </span>
                                <span style="font-size:20px">Harap tunggu giliran Anda</span><br>
                                <span style="font-size:20px">{{ session()->get('total') }}</span><br><br><br>
                                <span style="float:left">{{ session()->get('tanggal')->format('d-m-Y') }}</span><span
                                    style="float:right">{{ session()->get('jam')->format('h:i:s A') }}</span><br><br>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <div class="card mb-3">
                            <div class="feature-card mx-auto">
                                <a class="btn m-1 btn-creative btn-warning download" href="#"><i
                                        class="bi bi-arrow-down me-1"></i>Unduh</a>
                                <button class="btn m-1 btn-creative btn-danger close_modal" type="button"
                                    data-bs-dismiss="toast" aria-label="Close">X</button>
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="suksesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="alert custom-alert-3 alert-primary alert-dismissible fade show" role="alert">
                    <svg class="bi bi-check-circle" width="24" height="24" viewBox="0 0 16 16"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path fill-rule="evenodd"
                            d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z">
                        </path>
                    </svg>
                    <div class="alert-text">
                        <h6>Terima Kasih!</h6><span>Terima kasih sudah memberikan penilaian kepada kami!</span>
                    </div>
                    <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script type="text/javascript" src="{{ asset('assets/js/star-rating.min.js') }}"></script>
        <script src="{{ asset('assets/js/html2canvas.min.js') }}"
            integrity="sha256-c3RzsUWg+y2XljunEQS0LqWdQ04X1D3j22fd/8JCAKw=" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/FileSaver.min.js') }}" integrity="sha256-FPJJt8nA+xL4RU6/gsriA8p8xAeLGatoyTjldvQKGdE="
            crossorigin="anonymous"></script>
        <script type="text/javascript">
            var starRatingControls = new StarRating('.star-rating');

            function queue_dept(value) {
                $('body').removeClass('loaded');
                var myForm2 =
                    '<form id="hidfrm2" action="{{ route('antrian_saya_detail') }}" method="post">{{ csrf_field() }}<input type="hidden" name="queueid" value="' +
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
                    url: "{{ url('assets/files/display') }}",
                    cache: false,
                    success: function(response) {
                        s = JSON.parse(response);
                        if (curr != s[0].call_id) {
                            $('#preloader').html(location.reload());

                            curr = s[0].call_id;
                        }
                    }
                });
            }

            window.setInterval(function() {
                checkcall();
            }, 3000);

            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('assets/files/display') }}",
                    cache: false,
                    success: function(response) {
                        s = JSON.parse(response);
                        curr = s[0].call_id;
                    }
                });

                checkcall();
            });
        </script>
        @if (!empty(Session::get('error_code')) && Session::get('error_code') == 5)
            <script>
                $(function() {
                    $('#loginModal').modal('show');
                    $(document).on("click", ".close_modal", function() {
                        $('#loginModal').modal('hide');
                    });



                    $(document).on("click", ".download", function() {
                        //window.print();
                        html2canvas(document.querySelector("#printarea"), {
                            onrendered: function(canvas) {

                                canvas.toBlob(function(blob) {
                                    window.saveAs(blob,
                                        "{{ session()->get('department_name') }}-{{ session()->get('number') }}.png"
                                    )
                                }, 'image/png')
                                //location.reload();
                            },
                            allowTaint: true,
                            imageTimeout: 0,
                            useCORS: true
                        });

                    });
                });
            </script>
        @endif

        @if (!empty(Session::get('sukses')) && Session::get('sukses') == 5)
            <script>
                $(function() {
                    $('#suksesModal').modal('show');
                });
            </script>
        @endif

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

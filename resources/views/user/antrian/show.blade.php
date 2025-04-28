@extends('layouts.homeapp')

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
            <div class="row g-3 justify-content-center">
                @foreach ($queues as $queue)
                    <!-- Single Blog Card -->
                    <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                        <div class="card shadow-sm blog-list-card">
                            <div class="d-flex align-items-center">
                                <div class="card-blog-img position-relative bg-primary"
                                    style="background-image: url('{{ route('beranda') }}/public/img/core-img/2.png')"><span
                                        style="position:absolute;font-size: 5em;
   font-weight: 600;margin:18% 5% 0px;color:#fff;font-family: Arial, Helvetica, sans-serif;">
                                        @foreach ($departments as $department)
                                            @if ($department->id == $queue->department_id)
                                                {{ $department->letter }}{{ $queue->number }}
                                            @endif
                                        @endforeach
                                    </span><span class="badge bg-warning text-dark position-absolute card-badge">
                                        @foreach ($departments as $department)
                                            @if ($department->id == $queue->department_id)
                                                {{ $department->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                                <div class="card-blog-content"  style="padding: 0.3rem"><span
                                        class="badge bg-danger rounded-pill mb-2 d-inline-block">{{ $queue->created_at }}</span>
                                    <p class="fst-italic d-block mb-3" href="page-blog-details.html">
                                        @if ($queue->called == '0')
                                            Menunggu :
                                            {{ $queue->where('called', 0)->where('department_id', $queue->department_id)->get()->count() }}
                                            Orang
                                        @endif
                                    </p>
                                    @if ($queue->called == '1')
                                        <a class="btn btn-sm btn-creative btn-primary" href="#"><i
                                                class="bi bi-check2-circle me-2"></i>Selesai</a>
                                    @else
                                        <a class="btn btn-sm btn-creative btn-light" href="#"><i
                                                class="bi bi-clock-history me-2"></i>Menunggu</a>
                                    @endif
                                    <span class="btn btn-sm btn-creative btn-secondary"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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

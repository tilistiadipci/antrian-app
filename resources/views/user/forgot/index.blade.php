@extends('layouts.homeapp')
@if($mobile)
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
    <!-- Back Button -->
    <div class="login-back-button"><a href="{{ route('beranda') }}">
        <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
        </svg></a></div>
    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
      <div class="custom-container">
        <div class="text-center px-4"><img class="login-intro-img" src="{{ route('beranda') }}/public/img/bg-img/36.png" alt=""></div>
        <!-- Register Form -->
        <div class="register-form mt-4">
          <h6 class="mb-3 text-center">Lupa Password</h6>
          @if(count($errors))
            @foreach ($errors->all() as $error)
                <div class="alert custom-alert-1 alert-danger alert-dismissible fade show" role="alert">
              <svg class="bi bi-x-circle" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
              </svg>{{ $error }}!
              <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
        @endif
        @if($status)
            <div class="alert custom-alert-1 alert-success alert-dismissible fade show" role="alert">
              <svg class="bi bi-check-circle" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
              </svg>{{ trans($status) }}!
              <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
          <form action="{{ route('post_email_member') }}" method="post" onsubmit="return load()">
            {{ csrf_field() }}
            <div class="form-group text-start mb-3">
              <input class="form-control" id="email" type="text" name="email" value="{{ old('email') }}" autofocus placeholder="Masukan Email Anda">
            </div>
            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
          </form>
        </div>
        <!-- Login Meta -->
        <div class="login-meta-data text-center">
          <p class="mb-0">Login? <a class="stretched-link" href="{{ route('get_login_user') }}">Login</a></p>
        </div>
      </div>
    </div>
    
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/materialize-colorpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/chartjs/chart.min.js') }}"></script>  
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
    <div class="cs-newsletter-form modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body p-5">
            <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <div class="coming-soon-wrapper bg-white text-center" style="background-image: url('{{ asset('assets/images') }}/{{ $settings->background }}')">
      <div class="container">
        <div><a href="page-home.html"><img src="{{ asset('assets/images') }}/{{ $settings->logo }}" alt=""></a></div>
        <h2 class="text-black display-3">Antrian {{$settings->name}}</h2>
        <p class="heading-text">Antrian {{$settings->name}} hanya bisa diakses melalui handphone anda.</p>
      </div>
    </div>
@endsection
@endif
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
        <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
          <!-- Logo Wrapper -->
          <div class="logo-wrapper"><a href="{{ route('beranda') }}"><img src="{{ asset('assets/images') }}/{{ $settings->logo }}" alt=""></a></div>
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
          @foreach($queues as $queue)
          <!-- Single Blog Card -->
          <div class="col-12 col-md-8 col-lg-7 col-xl-6">
            <div class="card shadow-sm blog-list-card">
              <div class="d-flex align-items-center">
                <div class="card-blog-img position-relative bg-primary" style="background-image: url('{{ route('beranda') }}/public/img/core-img/2.png')"><span style="position:absolute;font-size: 5em;
   font-weight: 600;margin:18% 5% 0px;color:#fff;font-family: Arial, Helvetica, sans-serif;">@foreach($departments as $department)
                  @if($department->id == $queue->department_id)
                  
                {{$department->letter}}{{$queue->number}}
              @endif
            @endforeach</span><span class="badge bg-warning text-dark position-absolute card-badge">@foreach($departments as $department)
                  @if($department->id == $queue->department_id)
                  
                {{$department->name}}
              @endif
            @endforeach</span>
          </div>
                <div class="card-blog-content"><span class="badge bg-danger rounded-pill mb-2 d-inline-block">{{$queue->  created_at}}</span><p class="fst-italic d-block mb-3" href="page-blog-details.html">@if($queue->called == '0')Menunggu : {{$queue->where('called', 0)->where('department_id', $queue->department_id)->get()->count()}} Orang @endif</p>
                 @if($queue->called == '1')
                <a class="btn btn-sm btn-creative btn-primary" href="#"><i class="bi bi-check2-circle me-2"></i>Selesai</a>
                @else
                <a class="btn btn-sm btn-creative btn-light" href="#"><i class="bi bi-clock-history me-2"></i>Menunggu</a>
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
      <div class="container px-0">
        <!-- =================================== -->
        <!-- Paste your Footer Content from here -->
        <!-- =================================== -->
        <!-- Footer Content -->
        <div class="footer-nav position-relative">
          <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
            <li><a href="{{ route('beranda') }}">
                <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>
                  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"></path>
                </svg><span>Beranda</span></a></li>
            <li class="active"><a href="{{ route('antrian_saya') }}">
                <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                </svg><span>Antrian Saya</span></a></li>
            <li><a href="https://designing-world.com/affan-1.2.0/page-chat-users.html">
                <svg class="bi bi-chat-dots" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                  <path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"></path>
                </svg><span>Pesan</span></a></li>
            <li><a href="{{ route('profile') }}">
                <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                </svg><span>Profile</span></a></li>
          </ul>
        </div>
      </div>
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
            errorElement : 'div',
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

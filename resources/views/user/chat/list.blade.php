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
        <div class="card mb-3 timeline-card">
          <div class="card-body">
      
  

            <div class="row g-3">
                @foreach($users as $user)
                            <div class="col-2">
                
                <div class="feature-card mx-auto text-center">
                 
                  <a class="me-2 badge-avater badge-avater-lg" href="#"  @if($readys->where('to_id', $user->id)->where('re_id', $member->id)->count() == '0') onclick="channel_dept({{ $user->id }})" @endif><img class="img-circle" src="{{ route('beranda') }}/public/img/bg-img/user1.png" alt=""><span class="status bg-success"></span><h6 class="mb-0" style="font-size:10px;">{{ $user->name }}</h6></a>
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
          @foreach($channels as $channel)
          @foreach($users as $user)
          @if($user->id == $channel->to_id)
          <!-- Single Chat User -->
          <li class="p-3 chat-unread"><a class="d-flex" href="{{ route('chat',$user->id) }}">
              <!-- Thumbnail -->
              <div class="chat-user-thumbnail me-3 shadow"><img class="img-circle" src="{{ route('beranda') }}/public/img/bg-img/user1.png" alt=""><span class="active-status"></span></div>
              <!-- Info -->
              <div class="chat-user-info">
                <h6 class="text-truncate mb-0"> 
                  
                  
                  {{ $user->name }}
                  
                </h6>
                <div class="last-chat">
                  <p class="mb-0 text-truncate"> Lihat percakanan!</p>
                  
                </div>
              </div></a>
            <!-- Options -->
            <div class="dropstart chat-options-btn">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
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
            <li><a href="{{ route('antrian_saya') }}">
                <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                </svg><span>Antrian Saya</span></a></li>
            {{-- <li class="active"><a href="{{ route('listchat') }}">
                <svg class="bi bi-chat-dots" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                  <path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"></path>
                </svg><span>Pesan</span></a></li> --}}
            <li><a href="{{ route('profile') }}">
                <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                </svg><span>{{ auth()->user() ? 'Profil' : 'Login' }}</span></li>
          </ul>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
        function channel_dept(value) {
            $('body').removeClass('loaded');
            var myForm2 = '<form id="hidfrm2" action="{{ route('postchannel') }}" method="post">{{ csrf_field() }}<input type="hidden" name="toid" value="'+value+'"></form>';
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
                    if (curr!=response) {
                            
                           
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
                    curr =response;
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
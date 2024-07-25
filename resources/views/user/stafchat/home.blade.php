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
                <div class="single-setting-panel"><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <div class="icon-wrapper bg-danger"><i class="bi bi-box-arrow-right"></i></div></a></div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
        </div>
        <!-- # Header Five Layout End -->
      </div>
    </div>
    <div class="page-content-wrapper py-3 chat-wrapper">
      <div class="container">
       <!-- Chat User List -->
        <ul class="ps-0 chat-user-list">
          @foreach($channels as $channel)
          @foreach($users as $user)
          @if($user->id == $channel->to_id)
          <!-- Single Chat User -->
          <li class="p-3 chat-unread"><a class="d-flex" href="{{ route('stafchat',$channel->re_id) }}">
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
    
@endsection

@section('script')

     <script>
       function checkcall() {
            $.ajax({
                type: "GET",
                url: "{{ url('assets/files/chat') }}",
                cache: false,
                success: function(response) {
                    s = JSON.parse(response);
                    if (curr!=response) {
                            $('#chat').html(location.reload());
                            
                            $("#scrol").append(window.scrollTo(1000,document.body.scrollHeight));
                        curr = response;
                    }

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

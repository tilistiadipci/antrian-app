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
        <!-- Header Content -->
        <div class="header-content position-relative d-flex align-items-center justify-content-between">
          <!-- Chat User Info -->
          <div class="chat-user--info d-flex align-items-center">
            <!-- Back Button -->
            <div class="back-button"><a href="{{ route('listchat') }}">
                <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
                </svg></a></div>
                @foreach($users as $user)
                @if($user->id == $id)
            <!-- User Thumbnail & Name -->
            <div class="user-thumbnail-name"><img src="{{ route('beranda') }}/public/img/bg-img/2.jpg" alt="">
              <div class="info ms-1">
                <p>{{$user->name}}</p><span class="active-status">Customer Service</span>
                <!-- span.offline-status.text-muted Last actived 27m ago-->
              </div>
            </div>
            @endif
            @endforeach
          </div>

        </div>
      </div>
    </div>
    <div id="app">
    <div class="page-content-wrapper py-3 chat-wrapper">
      <div class="container">
        <div class="chat-content-wrap">
          @foreach($datas as $data)
          <!-- Single Chat Item -->
          <div class="single-chat-item {{ $data->type }}">
            <!-- User Avatar -->
            <div class="user-avatar mt-1">
              <!-- If the user avatar isn't available, will visible the first letter of the username. --><span class="name-first-letter">A</span><img src="{{ route('beranda') }}/assets/images/avatar.jpg" alt="">
            </div>
            <!-- User Message -->
            <div class="user-message">
              <div class="message-content">
                <div class="single-message">
                  <p>{{ $data->message }}</p>
                </div>
                <!-- Options -->
                <div class="dropstart">
                  <button class="btn btn-options dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                  <ul class="dropdown-menu">
                    <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
                  </ul>
                </div>
              </div>
              <!-- Time and Status -->
              <div class="message-time-status">
                <div class="sent-time">{{ $data->updated_at->format('H:i:s') }}</div>
              </div>
            </div>
          </div>
          <span id="chat"></span>
          @endforeach
        </div>
      </div>
    </div>
    <div class="chat-footer">
      <div class="container h-100">
        <div class="chat-footer-content h-100 d-flex align-items-center">
          <form action="{{ route('sendchat',$id) }}" method="post">
            {{ csrf_field() }}
            <!-- Message -->
            <input class="form-control" id="message" name="message" type="text" placeholder="Type here...">
            <input class="form-control" id="admin_id" name="admin_id" value="{{$id}}" type="hidden" >
            <input class="form-control" id="type" name="type" value="outgoing" type="hidden" >
            <!-- Send -->
            <button class="btn btn-submit" type="submit">
              <svg class="bi bi-cursor" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"></path>
              </svg>
            </button>
          </form>
        </div>
      </div>
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
                        
                        curr = response;
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

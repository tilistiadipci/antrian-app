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
    <!-- # Sidenav Left -->
    <div class="page-content-wrapper">
      
      <!-- Hero Slides -->
      <div class="owl-carousel-one owl-carousel">
        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-overlay" style="background-image: url('{{ asset('assets/images') }}/bg-an1.jpg')">
          <div class="slide-content h-100 d-flex align-items-center text-center">
            <div class="container">
              <h3 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">{{ $mobiles->slider_jdl1 }}</h3>
              <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">{{ $mobiles->slider_des1 }}</p><a class="btn btn-creative btn-warning" href="http://bpdntt.co.id/" target="_blank" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Tentang Kami</a>
            </div>
          </div>
        </div>
        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-overlay" style="background-image: url('{{ asset('assets/images') }}/bg-an2.jpg')">
          <div class="slide-content h-100 d-flex align-items-center text-center">
            <div class="container">
              <h3 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="500ms">{{ $mobiles->slider_jdl2 }}</h3>
              <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="500ms">{{ $mobiles->slider_des2 }}</p>
            </div>
          </div>
        </div>
        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-overlay" style="background-image: url('{{ asset('assets/images') }}/bg-an3.jpg')">
          <div class="slide-content h-100 d-flex align-items-center text-center">
            <div class="container">
              <h3 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">{{ $mobiles->slider_jdl3 }}</h3>
              <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">{{ $mobiles->slider_des3 }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="pt-3"></div>
     <!-- @if($mobiles->banner2 == '-')
      
      @else
      <div class="container">
        <div class="card mb-3 bg-img">

           <img src="{{ asset('assets/images/banner') }}/{{ $mobiles->banner2 }}">

        </div>
      </div>
      <div class="pb-3"></div>
      @endif
      -->
      @if($member)
      <div class="container direction-rtl">
        <div class="card mb-3 timeline-card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="timeline-text mb-2"><h3>Total Antrian</h3>
              </div>
              <div class="timeline-text mb-2">
               <span class="badge mb-2 rounded-pill"> <span id="dino1"></span> <span id="dino"></span></span>
              </div>
            </div>
            <div class="divider mt-0"></div>

            <div class="row g-3">

                @foreach($departments as $key=>$department)
              <div class="col-3">
                <div class="feature-card mx-auto text-center">
                 
                  <div class="card mx-auto bg-warning">
                    <span class="counter badge" style="color:#fff;font-size:24px;">
                        @if(!$total)
                        {{$total}}
                        @else
                       {{$total->where('called', 0)->where('department_id', $department->id)->where('created_at', '>', $now->format('Y-m-d 00:00:00'))->count()}}
                        @endif
                        
                    </span>
                 </div>
                
                  <h6 class="mb-0" style="font-size:12px;">{{ $department->name }}</h6>
                 
                
                </div>
              </div>

              @endforeach
            </div>
          </div>
        </div>
      </div>
        @else
        
        @endif
      <div class="container">
        <div class="card bg-primary mb-3 bg-img" style="background-image: url('public/img/core-img/1.png')">
          <div class="card-body direction-rtl p-5">
            <h2 class="text-white">{{ $mobiles->sdb2_jdl }}</h2>
            <p class="mb-4 text-white">{{ $mobiles->sdb2_des }}</p> 
          </div>
        </div>
      </div>
      
      <div class="container direction-rtl">
        
        @if($libur == '6')
            <div class="card bg-info coming-soon-card text-center bg-img" style="background-image: url('public/img/core-img/1.png')">
          <div class="card-body p-5">
            <div class="icon-wrap">
              <svg class="bi bi-clock text-info" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"></path>
                <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"></path>
              </svg>
            </div>
            <h2 class="text-white">Hari libur</h2>
            <p class="text-white">Nomor antrian dapat diambil <br/>Senin - Jumat</p>
          </div>
        </div><br/>

        @elseif($libur == '0') 
            <div class="card bg-info coming-soon-card text-center bg-img" style="background-image: url('public/img/core-img/1.png')">
          <div class="card-body p-5">
            <div class="icon-wrap">
              <svg class="bi bi-clock text-info" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"></path>
                <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"></path>
              </svg>
            </div>
            <h2 class="text-white">Hari libur</h2>
            <p class="text-white">Nomor antrian dapat diambil <br/>Senin - Jumat</p>
          </div>
        </div><br/>
         @else    
         
        

        @if($timenow >= $buka && $timenow <= $tutup)
        <div class="card mb-3 text-center">
            <div class="feature-card mx-auto">
            <div class="text-center"><br/>
             <h3>Ambil Antrian</h3>
             <p class="mb-4 text-black">Silahkan klik tombol layanan di bawah untuk mengambil antrian.</p>
            </div>
                 @foreach($departments as $department)

                 @if(!$total)
                 
                 <a class="btn m-1 btn-creative btn-primary open_modal" style="font-size:11px;" href="#" data-target="#loginModal" onclick="queue_dept({{ $department->id }})"><i class="bi bi-receipt me-1"></i>{{ $department->name }}</a>
                 @else
                 @if($total->where('department_id', $department->id)->where('id_member', $member)->count() == $settings->jml_antrian_hari)
                 <a class="btn m-1 btn-creative btn-primary open_modal2" href="#" data-target="#loginModal2"><i class="bi bi-receipt me-1"></i>{{ $department->name }}</a>
                 @else 

                 
                 @if($department->limit_antrian > $total->where('department_id', $department->id)->where('created_at', '>', $now->format('Y-m-d 00:00:00'))->get()->count())
                 <a class="btn m-1 btn-creative btn-primary open_modal" href="#" style="font-size:11px;" data-target="#loginModal" onclick="queue_dept({{ $department->id }})"><i class="bi bi-receipt me-1"></i>{{ $department->name }}</a>
                 @else
                 <a class="btn m-1 btn-creative btn-primary open_modal1" href="#" data-target="#loginModal1"><i class="bi bi-receipt me-1"></i>{{ $department->name }}</a>
                 @endif
                 @endif
                 @endif

                  @endforeach
                   
                  

              </div><br/>
        </div>
              @else
      <div class="card bg-info coming-soon-card text-center bg-img" style="background-image: url('public/img/core-img/1.png')">
          <div class="card-body p-5">
            <div class="icon-wrap">
              <svg class="bi bi-clock text-info" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"></path>
                <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"></path>
              </svg>
            </div>
            <h2 class="text-white">Sedang Tutup</h2>
            <p class="text-white">Nomor antrian dapat diambil <br/>pada pukul {{$buka}} WIB dan tutup pada jam {{$tutup}} WIB</p>
          </div>
        </div><br/>
      @endif
      @endif
      </div>

      <div class="container">
        <div class="card mb-3">
          <div class="card-body">
            <h3>Testimoni Pelanggan</h3>
            <div class="testimonial-slide owl-carousel testimonial-style3">
              @foreach($rattings as $ratting)
              <!-- Single Testimonial Slide -->
              <div class="single-testimonial-slide">
                <div class="text-content">
                  <select class="star-rating">
                  <option value="{{$ratting->bintang}}"></option>
                  <option value="5">5</option>
                  <option value="4">4</option>
                  <option value="3">3</option>
                  <option value="2">3</option>
                  <option value="1">1</option>
              </select>
                  <h6 class="mb-2">{{ $ratting->message }}</h6><span class="d-block">
                @foreach($rattingmembers as $rattingmember)
                @if($rattingmember->id == $ratting->pelanggan_id)
                {{$rattingmember->name}}
                @endif
                @endforeach  

                </span>
                </div>
              </div>

              @endforeach
              
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="card mb-3 bg-img">

           <img src="{{ asset('assets/images/banner') }}/{{ $mobiles->banner1 }}">

        </div>
      </div>
      <div class="pb-3"></div>
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
            <li class="active"><a href="{{ route('beranda') }}">
                <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>
                  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"></path>
                </svg><span>Beranda</span></a></li>
            <li><a href="{{ route('antrian_saya') }}">
                <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                </svg><span>Antrian Saya</span></a></li>
            {{-- <li><a href="{{ route('listchat') }}">
                <svg class="bi bi-chat-dots" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                  <path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"></path>
                </svg><span>Pesan</span></a></li> --}}
            <li><a href="{{ route('profile') }}">
                <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                </svg><span>{{ auth()->user() ? 'Profil' : 'Login' }}</span></a></li>
          </ul>
        </div>
      </div>
    </div>
<!--Login Modal-->
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        @if(session()->has('department_name'))
        <style>#printarea{text-align:center}@media print{#loader-wrapper,header,#main,footer,#toast-container{display:none}#printarea{display:block;}}@page{margin:0}</style>
        <div id="printarea" style="line-height:1.25">
             <img src="{{ asset('assets/images') }}/{{ $settings->logo }}" width="{{ $settings->size_logo_print }}" class="brand-logo-a responsive-img center-align blackprint">
            <br>
            <span style="font-size:{{ $settings->size_company }}px; font-weight: bold">{{ $settings->name }}</span><br>
            <span style="font-size:25px">{{ session()->get('department_name') }}</span><br>
            <span style="font-size:20px">No Antrian Anda</span><br>
            <span><h3 style="font-size:70px;font-weight:bold;margin:0;line-height:1.5">{{ session()->get('number') }}</h3></span>
            <span style="font-size:20px">Harap tunggu giliran Anda</span><br>
            <span style="font-size:20px">Menunggu: {{ session()->get('total')-1 }} orang</span><br><br><br>
            <span style="float:left">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span><span style="float:right">{{ \Carbon\Carbon::now()->format('h:i:s A') }}</span><br><br>
        </div>
        @endif
      </div>
      <div class="modal-footer">
       <div class="card mb-3">
            <div class="feature-card mx-auto">
                                  <a class="btn m-1 btn-creative btn-warning download" href="#"><i class="bi bi-arrow-down me-1"></i>Unduh</a>
                                  <a class="btn m-1 btn-creative btn-primary" href="{{ route('antrian_saya') }}" ><i class="bi bi-collection me-1"></i>Antrian Saya</a>
                                  <button class="btn m-1 btn-creative btn-danger close_modal" type="button" data-bs-dismiss="toast" aria-label="Close">X</button>
          </div><br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog" role="document">
   <div class="toast custom-toast-1 toast-danger" data-bs-autohide="false">
              <div class="toast-body">
                <div class="icon-wrapper bg-danger"><svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-exclamation" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"></path>
</svg>
          </div>
                <div class="toast-text ms-3 me-2">
                  <p class="mb-0 text-white">Antrian sudah habis!.</p><small class="d-block">Antrian sudah habis, coba lagi besok!</small>
                </div>
              </div>
              <button class="btn btn-close btn-close-white position-absolute p-1 close_modal1" type="button" aria-label="Close"></button>
            </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="suksesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="alert custom-alert-3 alert-primary alert-dismissible fade show" role="alert">
              <svg class="bi bi-check-circle" width="24" height="24" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
              </svg>
              <div class="alert-text">
                <h6>Terima Kasih!</h6><span>Terima kasih sudah memberikan penilaian kepada kami!</span>
              </div>
              <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      </div>
    </div>
@endsection

    
     
@section('script')
    <script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
<script src="{{ asset('asset/js/FileSaver.min.js') }}" integrity="sha256-FPJJt8nA+xL4RU6/gsriA8p8xAeLGatoyTjldvQKGdE=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/star-rating.min.js') }}"></script> 
    <script type="text/javascript">
    var starRatingControls = new StarRating( '.star-rating' );
        function queue_dept(value) {
            $('body').removeClass('loaded');
            var myForm2 = '<form id="hidfrm2" action="{{ route('ambil_antrian_online') }}" method="post">{{ csrf_field() }}<input type="hidden" name="department" value="'+value+'"></form>';
            $('body').append(myForm2);
            myForm2 = $('#hidfrm2');
            myForm2.submit();
        }
     

    </script>
    @if($member)
    <script type="text/javascript">
        
var span = document.getElementById('span');

        function time() {
          var d = new Date();
          var s = d.getSeconds();
          var m = d.getMinutes();
          var h = d.getHours();
          //span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
        }
        setInterval(time, 1000);

        window.setTimeout("hari()",0)
        function hari(){
         var namah = new Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
         var namab = new Array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Nov", "Des");
         var tanggal = new Date();
         setTimeout("hari()",0);
         document.getElementById("dino").innerHTML =tanggal.getDate()+" "+namab[tanggal.getMonth()]+" "+tanggal.getFullYear();
         document.getElementById("dino1").innerHTML =namah[tanggal.getDay()];
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
                    if (curr!=s[0].call_id) {
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
    @endif
<script>
$(function() {

    $(document).on("click", ".open_modal1", function () {
        $('#loginModal1').modal('show');
    });

    $(document).on("click", ".close_modal1", function () {
        $('#loginModal1').modal('hide');
    });

    $(document).on("click", ".open_modal2", function () {
        $('#loginModal2').modal('show');
    });

    $(document).on("click", ".close_modal2", function () {
        $('#loginModal2').modal('hide');
    });
});
</script>

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    $('#loginModal').modal('show');
    $(document).on("click", ".close_modal", function () {
        $('#loginModal').modal('hide');
    });

    $(document).on("click", ".download", function () {
                //window.print();
                html2canvas(document.querySelector("#printarea"), {
      onrendered: function(canvas)  
      {

        var img = canvas.toDataURL();
       // $("#result-image").attr('src', img).show();
        canvas.toBlob(function(blob) {
          saveAs(blob, "{{ session()->get('department_name') }}-{{ session()->get('number') }}.png");
        });
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
        <div><a href="{{ url('/login') }}"><img src="{{ asset('assets/images') }}/{{ $settings->logo }}" alt=""></a></div>
        <h2 class="text-black display-3">Antrian {{$settings->name}}</h2>
        <p class="heading-text">Antrian {{$settings->name}} hanya bisa diakses melalui handphone anda.</p>
      </div>
    </div>
@endsection
@endif
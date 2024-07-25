<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>@yield('title') | Antrian</title>
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
        <link href="{{ asset('assets/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
        @yield('css')
        <link href="{{ asset('assets/css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <style>
    body {

    background: url("{{ asset('assets/images') }}/{{ $settings->background }}") no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

.card-panel-a {
  margin: 4% 0 1rem;
  width: 100%;
  position: relative;
  border-radius: 10px 10px 10px 10px;
  background: transparent;
}

.card-panel-b {
  width: 100%;
  position: relative;
  background: transparent;
}

.body-panel {
  width: 100%;
  padding:0px 0px 0px;
  border-radius: 0px 0px 0px 0px;
  background: linear-gradient(135deg, transparent 0px, {{ $settings->background_panel_aa }} 0%, {{ $settings->background_panel_ab }} 100%);
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
}
.ribbon span {
  position: absolute;
  display: block;
  width: 170px;
  height:50px;
margin-left: 0px 50px 0px;
 background: linear-gradient(to bottom right, {{ $settings->background_panel_ca }} 0%, {{ $settings->background_panel_cb }} 100%);
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font-size:36px;
  text-shadow: 0 1px 1px rgba(0,0,0,.2);
  text-transform: uppercase;
  text-align: center;
  left: -0px;

}

.top-panel-a {
  position: center;
  display: block;
  left:100px;
  margin: 0px 0% 0px;
  width: 100%;
  height:55px;
  background: linear-gradient(to bottom right, {{ $settings->background_panel_ca }} 0%, {{ $settings->background_panel_cb }} 100%);
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font-size:36px;
  text-transform: uppercase;
  font-weight: 900;
  text-align: center;
  border-radius: 10px 10px 0px 0px;

}

.top-panel-b {
  position: center;
  display: block;
  left:100px;
  margin: 0px 0% -24px;
  width: 100%;
  height:55px;
  background: linear-gradient(to bottom right, {{ $settings->background_panel_ca }} 0%, {{ $settings->background_panel_cb }} 100%);
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font-size:22px;
  text-transform: uppercase;
  font-weight: 900;
  text-align: center;
  border-radius: 10px 10px 0px 0px;

}


.bottom-panel-a {
  position: center;
  display: block;
  left:100px;
  margin: 0px 0% 0px;
  width: 100%;
  height:100px;
  background: linear-gradient(to bottom right, {{ $settings->background_panel_da }} 0%, {{ $settings->background_panel_db }} 100%);
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font-size:70px;
  text-transform: uppercase;
  font-weight: 900;
  text-align: center;
  border-radius: 0px 0px 10px 10px;

}

.neo-video-player {
    position: relative;
    overflow: hidden;
    width: 100%;
    margin: auto;
    border-radius: 0px 0px 0px 0px;
    box-shadow:  
             0px 0px 0px #ffffff;
}

.bottom-panel-b {
  position: center;
  display: block;
  left:100px;
  margin: 0px 0% 0px;
  width: 100%;
  height:40px;
   background: linear-gradient(to bottom right, {{ $settings->background_panel_da }} 0%, {{ $settings->background_panel_db }} 100%);
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font-size:26px;
  text-transform: uppercase;
  font-weight: 900;
  text-align: center;
  border-radius: 0px 0px 10px 10px;

}

.no-antrian {
   font-size: 12.2em;
   font-weight: 900;
   color:{{ $settings->color_teks_noangka }};
   text-align: center;
  
}


.lower1 {
  margin: 0px 140px 0px;
}
.namalay{
  position: absolute;
  top: 5px;
  width:20%;
  right: 0px;
  margin:0px 0px 0px;
  padding: 0.5rem;
  background: linear-gradient(-90deg, transparent 0px, {{ $settings->background_panel_ba }} 0%, {{ $settings->background_panel_bb }} 100%);
  color: {{ $settings->color_teks_layanan }};
  text-align: right;
  font-family: 'Roboto', sans-serif;
  text-transform: uppercase;
  font-size:26px;
  text-shadow: 0 1px 1px rgba(0,0,0,.2);
}

.logo{
  position: absolute;
  margin:0px 20px 0px;
  padding: 0.5rem;
}

.ml7 {
  display: inline-block;
  overflow: hidden;
  height:auto;
}
.ml7 .anim1 {
  transform-origin: 0 100%;
  display: inline-block;
}

.ml12 {
  text-transform: uppercase;
}

.ml12 .letter {
  display: inline-block;
}

 </style>  
    </head>

    <body>

        <header id="header" class="page-topbar">
            <div class="navbar-fixed1">
                <nav class="navbar-color">
                    
                        <span class="left">
                            <div class="logo"><img src="{{ asset('assets/images') }}/{{ $settings->logo }}" width="{{ $settings->size_logo }}" class="brand-logo-a responsive-img"></div>
                        </span>
                        
                       
                </nav>
                
            </div>
            
        </header>
        
        <div class="namalay">  <span id="dino1"></span> <span id="dino"></span> </div>
                          
        <div id="main" style="padding:15px;padding-bottom:0">
            <div class="wrapper">
                <section id="content">
                    @yield('content')
                </section>
            </div>
        </div>

        <footer class="page-footer" style="padding:0;margin-top:0">
            <div class="footer-copyright" style="background:{{ $settings->background_text }};">
                <div class="container">
                  <div class="ribbon ribbon-top-left"><span> 
                  
                  <span id="span"></span>
                  </span></div>
                    <span class="lower1"><marquee style="margin-bottom:0;font-size:{{ $settings->size }}px;color:{{ $settings->color }}"><b><span id="datetime" ></span>{{ $settings->notification }}<b></marquee></span>
                       
                </div>
            </div>
        </footer>
        @yield('print')
                <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins.min.js') }}"></script>
        <script src="{{ asset('assets/js/anime.min.js') }}"></script>
        @yield('script')
        @include('common.messages')
    </body>
</html>

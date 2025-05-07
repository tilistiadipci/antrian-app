@extends('layouts.mainapptestimoni')

@section('title', trans('messages.issue').' '.trans('messages.display.token'))

@section('css')
    <style>
        .btn-queue{padding:25px;font-size:{{ $settings->size_text_tombol }}px;line-height:36px;height:auto;margin:10px;letter-spacing:0;text-transform:none}
        
        .btngmb1 {
              margin:-25px -10px -30px;
              width:84px;
              height:84px;
              float:right;
            }
        .tombol-testi {
          background: linear-gradient(to bottom right, #71757A 0%, #2E4053 100%);
          color: #fff;
          border-radius: 120px 120px 120px 120px;
          box-shadow: -2px -2px 2px #ffffff;
          text-align: left;
          margin:60px 0px -30px;
          font-size: 2em;
        }

.ml12 .letter {
  display: inline-block;
}
    </style>
@endsection

@section('content2')
    <div class="row">
        <div class="col m12" style="margin-top:50px">
        <div id="callarea" class="col m12 center-align">

                 <h1 class="logo-wrapper"><img src="{{ asset('assets/images') }}/{{ $settings->logo }}" width="{{ $settings->size_logo }}" class="brand-logo-a responsive-img">
                 </h1><br/><br/>
        <div class="ambilant ml12">Harap anda memberikan penilaian terhadap pelayanan kami</div>
        <br>
        <div class="col m6">
            <span class="btn btn-large btn-queue tombol-testi" style="width:100%;" onclick="testi_dept(1)">SANGAT PUAS<img src="{{ asset('assets/images') }}/icons-testimoni/sangat-puas.gif" class="btngmb1"></span>
        </div>

          <div class="col m6">
                <span class="btn btn-large btn-queue tombol-testi" style="width:100%;" onclick="testi_dept1(1)">PUAS<img src="{{ asset('assets/images') }}/icons-testimoni/puas.gif" class="btngmb1"></span>
          </div>    
          <div class="col m6">
            <span class="btn btn-large btn-queue tombol-testi" style="width:100%;" onclick="testi_dept2(1)">CUKUP PUAS<img src="{{ asset('assets/images') }}/icons-testimoni/cukup-puas.gif" class="btngmb1"></span>
        </div>

          <div class="col m6">
                <span class="btn btn-large btn-queue tombol-testi" style="width:100%;" onclick="testi_dept3(1)">TIDAK PUAS<img src="{{ asset('assets/images') }}/icons-testimoni/tidak-puas.gif" class="btngmb1"></span>
          </div>    
        </div> 
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('#main').css({'min-height': $(window).height()-134+'px'});
        });
        $(window).resize(function() {
            $('#main').css({'min-height': $(window).height()-134+'px'});
        });
        function testi_dept(value) {
            $('body').removeClass('loaded');
            var myForm2 = '<form id="hidfrm2" action="{{ route('post_add_testimoni') }}" method="post">{{ csrf_field() }}<input type="hidden" name="testi_sangat_puas" value="'+value+'"></form>';
            $('body').append(myForm2);
            myForm2 = $('#hidfrm2');
            myForm2.submit();
        }
        function testi_dept1(value) {
            $('body').removeClass('loaded');
            var myForm2 = '<form id="hidfrm2" action="{{ route('post_add_testimoni') }}" method="post">{{ csrf_field() }}<input type="hidden" name="testi_puas" value="'+value+'"></form>';
            $('body').append(myForm2);
            myForm2 = $('#hidfrm2');
            myForm2.submit();
        }
        function testi_dept2(value) {
            $('body').removeClass('loaded');
            var myForm2 = '<form id="hidfrm2" action="{{ route('post_add_testimoni') }}" method="post">{{ csrf_field() }}<input type="hidden" name="testi_cukup_puas" value="'+value+'"></form>';
            $('body').append(myForm2);
            myForm2 = $('#hidfrm2');
            myForm2.submit();
        }
        function testi_dept3(value) {
            $('body').removeClass('loaded');
            var myForm2 = '<form id="hidfrm2" action="{{ route('post_add_testimoni') }}" method="post">{{ csrf_field() }}<input type="hidden" name="testi_tidak_puas" value="'+value+'"></form>';
            $('body').append(myForm2);
            myForm2 = $('#hidfrm2');
            myForm2.submit();
        }
        anim2();
        function anim2() {
            // Wrap every letter in a span
            var textWrapper = document.querySelector('.ml12');
            textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

            anime.timeline({loop: true})
              .add({
                targets: '.ml12 .letter',
                translateX: [40,0],
                translateZ: 0,
                opacity: [0,1],
                easing: "easeOutExpo",
                duration: 1200,
                delay: (el, i) => 500 + 30 * i
              })
              .add({
                targets: '.ml12 .letter',
                translateX: [0,-30],
                opacity: [1,0],
                easing: "easeInExpo",
                duration: 1000,
                delay: (el, i) => 1100 + 30 * i
              });

        }
    </script>
@endsection
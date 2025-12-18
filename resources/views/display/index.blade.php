@extends('layouts.mainappqueue')

@section('title', trans('messages.display.display'))

@section('content1')

    <div class="row card-auto" style="line-height:1.23">
        <div class="col m12">

            <div class="col m4">
                <div class="card-panel-a center-align" style="margin-bottom:0">
                    <div class="namalay"><span id="namalayanan0" class="namalaytext anim">{{ $data[0]['namalayanan'] }}</span>
                    </div>
                    <div class="ribbon ribbon-top-left"><span></div>
                    <div class="anim no-antrian blink" id="callarea">
                        <span id="layanan0">{{ $data[0]['layanan'] }}</span><span
                            id="num0">{{ $data[0]['number'] }}</span>
                    </div>
                    <div class="badge red">
                        <div id="cou0" class="circle anim"> {{ $data[0]['counter'] }}</div>
                        <div class="ribbon-a anim" id="namacounter0">{{ $data[0]['namacounter'] }}</div>
                    </div>
                </div>

                <div class="card-panel-a center-align" style="margin-bottom:0">
                    <div class="namalay"><span id="namalayanan1"
                            class="namalaytext anim">{{ $data[1]['namalayanan'] }}</span></div>
                    <div class="ribbon ribbon-top-left"><span></span></div>
                    <div class="anim no-antrian" id="callarea">
                        <span id="layanan1">{{ $data[1]['layanan'] }}</span><span
                            id="num1">{{ $data[1]['number'] }}</span>
                    </div>
                    <div class="badge red">
                        <div id="cou1" class="circle anim"> {{ $data[1]['counter'] }}</div>
                        <div class="ribbon-a anim" id="namacounter1">{{ $data[1]['namacounter'] }}</div>
                    </div>

                </div>

                <div class="card-panel-a center-align" style="margin-bottom:0">
                    <div class="namalay"><span id="namalayanan2"
                            class="namalaytext anim">{{ $data[2]['namalayanan'] }}</span></div>
                    <div class="ribbon ribbon-top-left"><span></span></div>
                    <div class="anim no-antrian" id="callarea">
                        <span id="layanan2">{{ $data[2]['layanan'] }}</span><span
                            id="num2">{{ $data[2]['number'] }}</span>
                    </div>
                    <div class="badge red">
                        <div id="cou2" class="circle anim"> {{ $data[2]['counter'] }}</div>
                        <div class="ribbon-a anim" id="namacounter2">{{ $data[2]['namacounter'] }}</div>
                    </div>

                </div>

                <div class="card-panel-a center-align" style="margin-bottom:0">
                    <div class="namalay"><span id="namalayanan3"
                            class="namalaytext anim">{{ $data[3]['namalayanan'] }}</span></div>
                    <div class="ribbon ribbon-top-left"><span></span></div>
                    <div class="anim no-antrian" id="callarea">
                        <span id="layanan3">{{ $data[3]['layanan'] }}</span><span
                            id="num3">{{ $data[3]['number'] }}</span>
                    </div>
                    <div class="badge red">
                        <div id="cou3" class="circle anim"> {{ $data[3]['counter'] }}</div>
                        <div class="ribbon-a anim" id="namacounter3">{{ $data[3]['namacounter'] }}</div>
                    </div>
                </div>
            </div>

            <div id="callarea" class="col m7 center-align">
                <img src="{{ asset('assets/images') }}/{{ $settings->logo }}" width="{{ $settings->size_logo }}"
                    class="brand-logo-a responsive-img">
            </div>

            <div id="callarea" class="col m7">
                <div class="box text-center" dir="ltr">
                    <div class="neo-video-player" id="popout-video-player">
                        @if (
                            $settings->video == '-' &&
                                $settings->video1 == '-' &&
                                $settings->video2 == '-' &&
                                $settings->video3 == '-' &&
                                $settings->video4 == '-')
                            <img src="{{ asset('assets/images') }}/nosignal.jpg" style="width:100%;">
                        @else
                            <div
                                style="width: 100%; 
								height: 500px;
								overflow: hidden;
								position: relative;">
                                <video class="video-element" id="video-element" preload="auto"
                                    style="width: 100%;
				height: 100%;
				object-fit: contain;
				display: block;">
                                </video>
                            </div>
                        @endif

                    </div>

                    <br />
                    @if ($settings->banner == '-')
                    @else
                        <img src="{{ asset('assets/images') }}/{{ $settings->banner }}" style=""
                            class="responsive-img">
                    @endif
                </div>

                <div class="card-panel-b">
                    <span class="hari" id="dino1"></span>
                    <span class="jam" id="span"></span>
                    <span class="tanggal" id="dino"></span>
                </div>

            </div>

            <div class="lower"
                style="background:{{ $settings->background_text }}; position: fixed; bottom: 0; width: 100%;">
                <marquee style="margin-bottom:0;font-size:{{ $settings->size }}px;color:{{ $settings->color }}">
                    <b>{{ $settings->notification }}<b>
                </marquee>
            </div>


            <footer class="page-footer">

            </footer>
        @endsection

        @section('script')

            <script type="text/javascript" src="{{ asset('assets/js/video.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
            <script>
                var curr;

                function anim() {
                    anime.timeline({
                            loop: false
                        })
                        .add({
                            targets: '.anim',
                            rotateY: [-90, 0],
                            duration: 1300,
                            delay: (el, i) => 45 * i
                        }).add({
                            targets: '.ml10',
                            opacity: 0,
                            duration: false,
                            easing: "easeOutExpo",
                            delay: 1000
                        });
                    for (var i = 900; i < 10000; i = i + 900) {
                        setTimeout("hide()", i);
                        setTimeout("show()", i + 450);
                    }
                }

                function checkcall() {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('assets/files/display') }}",
                        cache: false,
                        success: function(response) {
                            s = JSON.parse(response);
                            if (curr != s[0].call_id) {
                                $("#callarea").fadeOut(function() {
                                    $('#num0').html(s[0].number);
                                    $('#num1').html(s[1].number);
                                    $('#num2').html(s[2].number);
                                    $('#num3').html(s[3].number);
                                    $('#layanan0').html(s[0].layanan);
                                    $('#layanan1').html(s[1].layanan);
                                    $('#layanan2').html(s[2].layanan);
                                    $('#layanan3').html(s[3].layanan);
                                    $('#namalayanan0').html(s[0].namalayanan);
                                    $('#namalayanan1').html(s[1].namalayanan);
                                    $('#namalayanan2').html(s[2].namalayanan);
                                    $('#namalayanan3').html(s[3].namalayanan);
                                    $('#namacounter0').html(s[0].namacounter);
                                    $('#namacounter1').html(s[1].namacounter);
                                    $('#namacounter2').html(s[2].namacounter);
                                    $('#namacounter3').html(s[3].namacounter);
                                    $("#cou0").html(s[0].counter);
                                    $("#cou1").html(s[1].counter);
                                    $("#cou2").html(s[2].counter);
                                    $("#cou3").html(s[3].counter);
                                    anim();
                                    sound();
                                });
                                $("#callarea").fadeIn(0);

                                curr = s[0].call_id;
                            }
                        }
                    });
                }

                window.setInterval(function() {
                    checkcall();

                }, 4000);

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


                function show() {
                    if (document.getElementsByClassName)
                        document.getElementsByClassName("blink")[0].style.visibility = "visible";
                }
                // blink "off" state
                function hide() {
                    if (document.getElementsByClassName)
                        document.getElementsByClassName("blink")[0].style.visibility = "hidden";
                }
                // toggle "on" and "off" states every 450 ms to achieve a blink effect
                // end after 4500 ms (less than five seconds)

                function sound() {
                    if (curr != 0) {
                        var bleep = new Audio();
                        bleep.src = '{{ url('assets/sound/dingdong.mp3') }}';
                        bleep.play();

                        num = s[0].call_number;

                        if (num < 1) {
                            return num;
                        }
                        var si = [{
                                v: 1,
                                s: "1",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 2,
                                s: "2",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 3,
                                s: "3",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 4,
                                s: "4",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 5,
                                s: "5",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 6,
                                s: "6",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 7,
                                s: "7",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 8,
                                s: "8",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 9,
                                s: "9",
                                b: "satuan",
                                p: ""
                            },
                            {
                                v: 10,
                                s: "sepuluh",
                                b: "satuan"
                            },
                            {
                                v: 11,
                                s: "sebelas",
                                b: "satuan"
                            },
                            {
                                v: 12,
                                s: "2",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 13,
                                s: "3",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 14,
                                s: "4",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 15,
                                s: "5",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 16,
                                s: "6",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 17,
                                s: "7",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 18,
                                s: "8",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 19,
                                s: "9",
                                b: "belas",
                                p: ""
                            },
                            {
                                v: 20,
                                s: "2",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 21,
                                s: "2",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 22,
                                s: "2",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 23,
                                s: "2",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 24,
                                s: "2",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 25,
                                s: "2",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 26,
                                s: "2",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 27,
                                s: "2",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 28,
                                s: "2",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 29,
                                s: "2",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 30,
                                s: "3",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 31,
                                s: "3",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 32,
                                s: "3",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 33,
                                s: "3",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 34,
                                s: "3",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 35,
                                s: "3",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 36,
                                s: "3",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 37,
                                s: "3",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 38,
                                s: "3",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 39,
                                s: "3",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 40,
                                s: "4",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 41,
                                s: "4",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 42,
                                s: "4",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 43,
                                s: "4",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 44,
                                s: "4",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 45,
                                s: "4",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 46,
                                s: "4",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 47,
                                s: "4",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 48,
                                s: "4",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 49,
                                s: "4",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 50,
                                s: "5",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 51,
                                s: "5",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 52,
                                s: "5",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 53,
                                s: "5",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 54,
                                s: "5",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 55,
                                s: "5",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 56,
                                s: "5",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 57,
                                s: "5",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 58,
                                s: "5",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 59,
                                s: "5",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 60,
                                s: "6",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 61,
                                s: "6",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 62,
                                s: "6",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 63,
                                s: "6",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 64,
                                s: "6",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 65,
                                s: "6",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 66,
                                s: "6",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 67,
                                s: "6",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 68,
                                s: "6",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 69,
                                s: "6",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 70,
                                s: "7",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 71,
                                s: "7",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 72,
                                s: "7",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 73,
                                s: "7",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 74,
                                s: "7",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 75,
                                s: "7",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 76,
                                s: "7",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 77,
                                s: "7",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 78,
                                s: "7",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 79,
                                s: "7",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 80,
                                s: "8",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 81,
                                s: "8",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 82,
                                s: "8",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 83,
                                s: "8",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 84,
                                s: "8",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 85,
                                s: "8",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 86,
                                s: "8",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 87,
                                s: "8",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 88,
                                s: "8",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 89,
                                s: "8",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 90,
                                s: "9",
                                b: "puluh",
                                p: ""
                            },
                            {
                                v: 91,
                                s: "9",
                                b: "puluh",
                                p: "1"
                            },
                            {
                                v: 92,
                                s: "9",
                                b: "puluh",
                                p: "2"
                            },
                            {
                                v: 93,
                                s: "9",
                                b: "puluh",
                                p: "3"
                            },
                            {
                                v: 94,
                                s: "9",
                                b: "puluh",
                                p: "4"
                            },
                            {
                                v: 95,
                                s: "9",
                                b: "puluh",
                                p: "5"
                            },
                            {
                                v: 96,
                                s: "9",
                                b: "puluh",
                                p: "6"
                            },
                            {
                                v: 97,
                                s: "9",
                                b: "puluh",
                                p: "7"
                            },
                            {
                                v: 98,
                                s: "9",
                                b: "puluh",
                                p: "8"
                            },
                            {
                                v: 99,
                                s: "9",
                                b: "puluh",
                                p: "9"
                            },
                            {
                                v: 100,
                                s: "",
                                b: "seratus",
                                p: "",
                                e: "seratusC"
                            },
                            {
                                v: 101,
                                s: "seratus",
                                b: "seratusB",
                                p: "1"
                            },
                            {
                                v: 102,
                                s: "seratus",
                                b: "seratusB",
                                p: "2"
                            },
                            {
                                v: 103,
                                s: "seratus",
                                b: "seratusB",
                                p: "3"
                            },
                            {
                                v: 104,
                                s: "seratus",
                                b: "seratusB",
                                p: "4"
                            },
                            {
                                v: 105,
                                s: "seratus",
                                b: "seratusB",
                                p: "5"
                            },
                            {
                                v: 106,
                                s: "seratus",
                                b: "seratusB",
                                p: "6"
                            },
                            {
                                v: 107,
                                s: "seratus",
                                b: "seratusB",
                                p: "7"
                            },
                            {
                                v: 108,
                                s: "seratus",
                                b: "seratusB",
                                p: "8"
                            },
                            {
                                v: 109,
                                s: "seratus",
                                b: "seratusB",
                                p: "9"
                            },
                            {
                                v: 110,
                                s: "seratus",
                                b: "sepuluh",
                                p: "",
                                e: "seratusC"
                            },
                            {
                                v: 111,
                                s: "seratus",
                                b: "sebelas",
                                p: "",
                                e: "seratusC"
                            },
                            {
                                v: 112,
                                s: "seratus",
                                b: "2",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 113,
                                s: "seratus",
                                b: "3",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 114,
                                s: "seratus",
                                b: "4",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 115,
                                s: "seratus",
                                b: "5",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 116,
                                s: "seratus",
                                b: "6",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 117,
                                s: "seratus",
                                b: "7",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 118,
                                s: "seratus",
                                b: "8",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 119,
                                s: "seratus",
                                b: "9",
                                p: "belas",
                                e: "seratusD"
                            },
                            {
                                v: 120,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 121,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 122,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 123,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 124,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 125,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 126,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 127,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 128,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 129,
                                s: "seratus",
                                b: "2",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 130,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 131,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 132,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 133,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 134,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 135,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 136,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 137,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 138,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 139,
                                s: "seratus",
                                b: "3",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 140,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 141,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 142,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 143,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 144,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 145,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 146,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 147,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 148,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 149,
                                s: "seratus",
                                b: "4",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 150,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 151,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 152,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 153,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 154,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 155,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 156,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 157,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 158,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 159,
                                s: "seratus",
                                b: "5",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 160,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 161,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 162,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 163,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 164,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 165,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 166,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 167,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 168,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 169,
                                s: "seratus",
                                b: "6",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 170,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 171,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 172,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 173,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 174,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 175,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 176,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 177,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 178,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 179,
                                s: "seratus",
                                b: "7",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 180,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 181,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 182,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 183,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 184,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 185,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 186,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 187,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 188,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 189,
                                s: "seratus",
                                b: "8",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 190,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                e: "seratusD"
                            },
                            {
                                v: 191,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "1",
                                e: "seratusE"
                            },
                            {
                                v: 192,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "2",
                                e: "seratusE"
                            },
                            {
                                v: 193,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "3",
                                e: "seratusE"
                            },
                            {
                                v: 194,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "4",
                                e: "seratusE"
                            },
                            {
                                v: 195,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "5",
                                e: "seratusE"
                            },
                            {
                                v: 196,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "6",
                                e: "seratusE"
                            },
                            {
                                v: 197,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "7",
                                e: "seratusE"
                            },
                            {
                                v: 198,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "8",
                                e: "seratusE"
                            },
                            {
                                v: 199,
                                s: "seratus",
                                b: "9",
                                p: "puluh",
                                c: "9",
                                e: "seratusE"
                            },
                            {
                                v: 200,
                                s: "2",
                                b: "ratus",
                                p: "",
                                e: "seratusC"
                            },
                            {
                                v: 201,
                                s: "2",
                                b: "ratus",
                                p: "1",
                                e: "seratusD"
                            },
                            {
                                v: 202,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                e: "seratusD"
                            },
                            {
                                v: 203,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                e: "seratusD"
                            },
                            {
                                v: 204,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                e: "seratusD"
                            },
                            {
                                v: 205,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                e: "seratusD"
                            },
                            {
                                v: 206,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                e: "seratusD"
                            },
                            {
                                v: 207,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                e: "seratusD"
                            },
                            {
                                v: 208,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                e: "seratusD"
                            },
                            {
                                v: 209,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                e: "seratusD"
                            },
                            {
                                v: 210,
                                s: "2",
                                b: "ratus",
                                p: "sepuluh",
                                e: "seratusD"
                            },
                            {
                                v: 211,
                                s: "2",
                                b: "ratus",
                                p: "sebelas",
                                e: "seratusD"
                            },
                            {
                                v: 212,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 213,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 214,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 215,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 216,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 217,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 218,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 219,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                c: "belas",
                                e: "seratusE"
                            },
                            {
                                v: 220,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 221,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 222,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 223,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 224,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 225,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 226,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 227,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 228,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 229,
                                s: "2",
                                b: "ratus",
                                p: "2",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 230,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 231,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 232,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 233,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 234,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 235,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 236,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 237,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 238,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 239,
                                s: "2",
                                b: "ratus",
                                p: "3",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 240,
                                s: "3",
                                b: "ratus",
                                p: "4",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 241,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 242,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 243,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 244,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 245,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 246,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 247,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 248,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 249,
                                s: "2",
                                b: "ratus",
                                p: "4",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 250,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 251,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 252,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 253,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 254,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 255,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 256,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 257,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 258,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 259,
                                s: "2",
                                b: "ratus",
                                p: "5",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 260,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 261,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 262,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 263,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 264,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 265,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 266,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 267,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 268,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 269,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 270,
                                s: "2",
                                b: "ratus",
                                p: "6",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 271,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 272,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 273,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 274,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 275,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 276,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 277,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 278,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 279,
                                s: "2",
                                b: "ratus",
                                p: "7",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 280,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 281,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 282,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 283,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 284,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 285,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 286,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 287,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 288,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 289,
                                s: "2",
                                b: "ratus",
                                p: "8",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 290,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                c: "puluh",
                                e: "seratusE"
                            },
                            {
                                v: 291,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "1",
                                e: "seratusF"
                            },
                            {
                                v: 292,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "2",
                                e: "seratusF"
                            },
                            {
                                v: 293,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "3",
                                e: "seratusF"
                            },
                            {
                                v: 294,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "4",
                                e: "seratusF"
                            },
                            {
                                v: 295,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "5",
                                e: "seratusF"
                            },
                            {
                                v: 296,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "6",
                                e: "seratusF"
                            },
                            {
                                v: 297,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "7",
                                e: "seratusF"
                            },
                            {
                                v: 298,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "8",
                                e: "seratusF"
                            },
                            {
                                v: 299,
                                s: "2",
                                b: "ratus",
                                p: "9",
                                a: "puluh",
                                c: "9",
                                e: "seratusF"
                            },
                            {
                                v: 300,
                                s: "3",
                                b: "ratus",
                                p: "",
                                e: "seratusC"
                            },

                        ];

                        var i;

                        for (i = si.length - 1; i > 0; i--) {
                            if (num >= si[i].v) {
                                break;
                            }
                        }

                        window.setTimeout(function() {
                            //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                            var antrian = new Audio('assets/sound/Nomor-Antrian.mp3');
                            antrian.play();

                        }, 800);

                        window.setTimeout(function() {
                            //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                            var layanan = new Audio('assets/sound/' + s[0].layanan + '.mp3');
                            layanan.play();

                        }, 2500);


                        window.setTimeout(function() {
                            var noantrian = new Audio('assets/sound/' + si[i].s + '.mp3');
                            noantrian.play();

                        }, 3000);

                        if (si[i].b == "satuan") {
                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, parseInt(s[0].durasi) + parseInt(3700));

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, 5100);
                        }
                        if (si[i].b == "belas") {
                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var belas = new Audio('assets/sound/' + si[i].b + '.mp3');
                                belas.play();

                            }, 3700);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, parseInt(s[0].durasi) + parseInt(4200));

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, 5500);
                        }

                        if (si[i].b == "puluh") {

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var puluh = new Audio('assets/sound/' + si[i].b + '.mp3');
                                puluh.play();

                            }, 3700);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var puluhP = new Audio('assets/sound/' + si[i].p + '.mp3');
                                puluhP.play();

                            }, 4200);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, parseInt(s[0].durasi) + parseInt(4600));

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, 5800);
                        }

                        if (si[i].b == "seratusB") {

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var ratusP = new Audio('assets/sound/' + si[i].p + '.mp3');
                                ratusP.play();

                            }, 3900);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, 4500);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, parseInt(s[0].durasi) + parseInt(5200));
                        }

                        if (si[i].e == "seratusB") {

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var ratusP = new Audio('assets/sound/' + si[i].p + '.mp3');
                                ratusP.play();

                            }, 3700);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, 4200);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, parseInt(s[0].durasi) + parseInt(5200));
                        }

                        if (si[i].e == "seratusC") {
                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var ratus = new Audio('assets/sound/' + si[i].b + '.mp3');
                                ratus.play();

                            }, 3700);


                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, 4300);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, parseInt(s[0].durasi) + parseInt(5000));

                        }

                        if (si[i].e == "seratusD") {
                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var ratus = new Audio('assets/sound/' + si[i].b + '.mp3');
                                ratus.play();

                            }, 3700);

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var ratusP = new Audio('assets/sound/' + si[i].p + '.mp3');
                                ratusP.play();

                            }, 4400);


                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, parseInt(s[0].durasi) + parseInt(4600));

                            window.setTimeout(function() {
                                //msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, 5900);
                        }

                        if (si[i].e == "seratusE") {
                            window.setTimeout(function() {
                                var ratus = new Audio('assets/sound/' + si[i].b + '.mp3');
                                ratus.play();

                            }, 3700);

                            window.setTimeout(function() {
                                var ratusP = new Audio('assets/sound/' + si[i].p + '.mp3');
                                ratusP.play();

                            }, 4400);

                            window.setTimeout(function() {
                                var ratusC = new Audio('assets/sound/' + si[i].c + '.mp3');
                                ratusC.play();

                            }, 5100);


                            window.setTimeout(function() {
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, parseInt(s[0].durasi) + parseInt(5500));

                            window.setTimeout(function() {
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, 6900);
                        }

                        if (si[i].e == "seratusF") {
                            window.setTimeout(function() {
                                var ratus = new Audio('assets/sound/' + si[i].b + '.mp3');
                                ratus.play();

                            }, 3700);

                            window.setTimeout(function() {
                                var ratusP = new Audio('assets/sound/' + si[i].p + '.mp3');
                                ratusP.play();

                            }, 4400);

                            window.setTimeout(function() {
                                var ratusC = new Audio('assets/sound/' + si[i].a + '.mp3');
                                ratusC.play();

                            }, 4900);

                            window.setTimeout(function() {
                                var ratusA = new Audio('assets/sound/' + si[i].c + '.mp3');
                                ratusA.play();

                            }, 5300);


                            window.setTimeout(function() {
                                var loket = new Audio('assets/sound/' + s[0].namacounter + '.mp3');
                                loket.play();

                            }, parseInt(s[0].durasi) + parseInt(5700));

                            window.setTimeout(function() {
                                var loketdata = new Audio('assets/sound/' + s[0].counter + '.mp3');
                                loketdata.play();

                            }, 6900);

                        }

                    }
                }
            </script>
            <script>
                var videos = new Array(
                    @if ($settings->video == '-') @else
                        "{{ asset('assets/video') }}/{{ $settings->video }}",
                    @endif
                    @if ($settings->video1 == '-') @else
                        "{{ asset('assets/video') }}/{{ $settings->video1 }}",
                    @endif
                    @if ($settings->video2 == '-') @else
                        "{{ asset('assets/video') }}/{{ $settings->video2 }}",
                    @endif
                    @if ($settings->video3 == '-') @else
                        "{{ asset('assets/video') }}/{{ $settings->video3 }}",
                    @endif
                    @if ($settings->video4 == '-') @else
                        "{{ asset('assets/video') }}/{{ $settings->video4 }}",
                    @endif
                );
                videos.loop = true;
                var currentVideo = 0;

                function nextVideo() {
                    // get the element
                    videoPlayer = document.getElementById("video-element")
                    // remove the event listener, if there is one
                    videoPlayer.removeEventListener('ended', nextVideo, false);

                    // update the source with the currentVideo from the videos array
                    videoPlayer.src = videos[currentVideo];
                    // play the video
                    videoPlayer.play()

                    // increment the currentVideo, looping at the end of the array
                    currentVideo = (currentVideo + 1) % videos.length

                    // add an event listener so when the video ends it will call the nextVideo function again
                    videoPlayer.addEventListener('ended', nextVideo, false);
                }

                function ooops() {
                    console.log("Error: " + document.getElementById("video-element").error.code)
                    nextVideo();
                }
            </script>
            <script>
                // add error handler for the video element, just to catch any other issues
                document.getElementById("video-element").addEventListener('error', ooops, false);

                // initialize and play the first video
                nextVideo();
            </script>
        @endsection

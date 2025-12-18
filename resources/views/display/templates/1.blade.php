<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Display | Antrian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('assets') }}/css/bootstrap.min.css">

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            overflow: hidden;
            /* matikan scroll */
        }

        /* body {
            background: #062c4f;
            color: #fff;
        } */

        .app {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER + TANGGAL & JAM DI SAMA BAR */
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #00bd1f 0%);
            padding: 10px 20px;
            flex-shrink: 0;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-left img {
            width: 50px;
            /* ukuran logo */
            height: 50px;
            margin-right: 10px;
        }

        .header-left .title {
            font-size: 28px;
            font-weight: bold;
        }

        .datetime-bar {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            /* kanan */
            /* color: #ffd700; */
        }

        .datetime-bar #tanggal {
            font-size: 18px;
            font-weight: 600;
        }

        .datetime-bar #jam-container {
            display: flex;
            align-items: center;
            font-size: 22px;
            font-weight: bold;
            margin-top: 4px;
        }

        .datetime-bar svg {
            margin-right: 6px;
        }

        /* MAIN */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .antrian-utama {
            background: #0151ac;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nomor {
            font-size: 8vw;
            font-weight: bold;
            color: #ffd700;
            line-height: 1;
        }

        .video-box {
            background: #001e3c;
            padding: 0;
        }

        .video-box video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block
        }

        /* FOOTER */
        .footer-box {
            height: 28vh;
            min-height: 140px;
        }

        .bpjs {
            background: #0a4f9c;
        }

        .umum {
            background: #001e3c;
        }

        .footer-box span {
            font-size: 4vw;
            font-weight: bold;
        }

        /* MARQUEE */
        .marquee-box {
            background: #021a33;
            font-size: 22px;
            padding: 8px 0;
            flex-shrink: 0;
        }

        .marquee {
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee span {
            display: inline-block;
            padding-left: 100%;
            animation: scroll 20s linear infinite;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @media (max-width: 768px) {
            .nomor {
                font-size: 14vw;
            }

            .footer-box span {
                font-size: 8vw;
            }

            .datetime-bar #tanggal {
                font-size: 16px;
            }

            .datetime-bar #jam-container {
                font-size: 18px;
            }

            .header-left img {
                width: 40px;
                height: 40px;
            }

            .header-left .title {
                font-size: 22px;
            }
        }

        .video-box,
        .neo-video-player {
            height: 100%;
        }

        .video-box {
            display: flex;
        }

        .neo-video-player {
            width: 100%;
            height: 100%;
        }

        .neo-video-player>div {
            width: 100%;
            height: 100%;
        }

        .video-box video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
</head>

<body>
    <div id="unlockAudio"
     style="position:fixed;inset:0;z-index:9999;
            background:rgba(0,0,0,.85);
            color:#fff;display:flex;
            align-items:center;justify-content:center;
            font-size:22px;cursor:pointer">
    🔊 Klik layar untuk mengaktifkan suara
</div>


    <div class="app">
        <div class="header-bar" style="background: linear-gradient(90deg, {{ $contents['header_background_color'] }} 0%);">
            <div class="header-left">
                <img src="{{ asset('assets/images') }}/{{ $settings->logo }}" alt="Logo Company"
                    style="width: {{ $contents['size_logo'] ?? 30 }}%; height: {{ $contents['size_logo'] ?? 30 }}%; object-fit: contain;">
                <div class="title" style="color: {{ $contents['header_text_color'] }}; font-size: {{ $contents['title_font_size'] ?? '28' }}px">{{ $contents['title'] ?? '' }}</div>
            </div>
            <div class="datetime-bar">
                <div id="tanggal" style="font-size: {{ $contents['title_font_size'] ?? '28' }}px; font-weight: bold; color: {{ $contents['header_date_text_color'] }}"></div>
                <div id="jam-container">
                    <span id="jam" style="font-size: {{ $contents['title_font_size'] ?? '28' }}px; font-weight: bold; color: {{ $contents['header_date_text_color'] }}"></span>
                </div>
            </div>
        </div>

        <!-- MAIN -->
        <div class="main-content">

            <div class="row m-0 flex-grow-1">
                <div class="col-md-6 antrian-utama" style="background-color: {{ $contents['queue_background_color'] }}">
                    <div class="text-center">
                        <h1 class="mb-5 font-weight-bold" style="font-size: {{ $contents['queue_font_size'] ?? '70' }}px; color: {{ $contents['queue_text_color'] }}">ANTRIAN SAAT INI</h1>
                        <div class="font-weight-bold nomor anim blink" id="num0" style="color: {{ $contents['queue_active_text_color'] }}; font-size: {{ $contents['queue_active_font_size'] ?? '100' }}px;">
                            {{ $data[0]['layanan'] }}{{ $data[0]['number'] }}</div>
                        <div id="service0" class="font-weight-bold anim blink" style="font-size: {{ $contents['queue_font_size'] ?? '70' }}px; color: {{ $contents['queue_text_color'] }}">
                            {{ $data[0]['namalayanan'] }}</div>
                    </div>
                </div>

                <div class="col-md-6 video-box">
                    <div class="neo-video-player" id="popout-video-player">
                        @if (
                            $settings->video == '-' &&
                                $settings->video1 == '-' &&
                                $settings->video2 == '-' &&
                                $settings->video3 == '-' &&
                                $settings->video4 == '-')
                            <img src="{{ asset('assets/images') }}/nosignal.jpg"
                                style="width:100%; height:100%; object-fit:contain;">
                        @else
                            <div>
                                <video class="video-element" id="video-element" preload="auto" autoplay muted
                                    playsinline>
                                </video>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row footer-box m-0 text-center border-top">
                <div class="col-6 bpjs d-flex flex-column justify-content-center">
                    <div id="show1">
                        {{-- <h4>PASIEN BPJS</h4>
                    <span>A005</span> --}}
                        @if ($data[1]['namalayanan'] != '-')
                            <h4 id="service1" class="anim blink" style="font-size: {{ $contents['service_font_size'] ?? '50' }}px; font-weight: bold; color: {{ $contents['service_text_color'] }}">PASIEN
                                {{ $data[1]['namalayanan'] }}</h4>
                        @else
                            <h4 id="service1" class="anim blink" style="font-size: {{ $contents['service_font_size'] ?? '50' }}px; font-weight: bold; color: {{ $contents['service_text_color'] }}">
                                {{ $data[1]['namalayanan'] }}</h4>
                        @endif
                        <span id="num1" class="anim blink"
                            style="font-size: {{ $contents['service_font_size'] ?? '50' }}px; color: {{ $contents['service_text_color'] }}">{{ $data[1]['layanan'] }}{{ $data[1]['number'] }}</span>
                    </div>
                </div>
                <div class="col-6 umum d-flex flex-column justify-content-center">
                    <div id="show2">
                        {{-- <h4>PASIEN UMUM</h4>
                    <span>B004</span> --}}
                        @if ($data[2]['namalayanan'] != '-')
                            <h4 id="service2" class="anim blink" style="font-size: {{ $contents['service_font_size'] ?? '50' }}px; font-weight: bold; color: {{ $contents['service_text_color'] }}">PASIEN
                                {{ $data[2]['namalayanan'] }}</h4>
                        @else
                            <h4 id="service2" class="anim blink" style="font-size: {{ $contents['service_font_size'] ?? '50' }}px; font-weight: bold; color: {{ $contents['service_text_color'] }}">
                                {{ $data[2]['namalayanan'] }}</h4>
                        @endif
                        <span id="num2" class="anim blink"
                            style="font-size: {{ $contents['service_font_size'] ?? '50' }}px; color: {{ $contents['service_text_color'] }}">{{ $data[2]['layanan'] }}{{ $data[2]['number'] }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- MARQUEE -->
        <div class="marquee-box border-top"  style="background-color: {{ $contents['footer_background_color'] }}">
            <div class="marquee" style="font-size: {{ $contents['footer_font_size'] ?? '32' }}px; color: {{ $contents['footer_text_color'] }}">
                <span>
                    {{ $contents['text_footer'] }}
                </span>
            </div>
        </div>

    </div>

    <script>
        function pad(n) {
            return n.toString().padStart(2, '0');
        }

        function updateDateTime() {
            const now = new Date();

            const hari = now.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            const tanggal = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
            });

            // FIXED HH:mm:ss (PASTI :)
            const jam = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;

            document.getElementById('tanggal').textContent = `${hari}, ${tanggal}`;
            document.getElementById('jam').textContent = jam;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>



    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/anime.min.js') }}"></script>

    <script>
        var s;
    </script>
    @include('display.templates._js_video')
    @include('display.templates._js_sound')
    <script type="text/javascript">
        $(function() {
            $('#main').css({
                'min-height': $(window).height() - 114 + 'px'
            });
        });
        $(window).resize(function() {
            $('#main').css({
                'min-height': $(window).height() - 114 + 'px'
            });
        });


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

        function anim1() {
            // Wrap every letter in a span
            var textWrapper = document.getElementsByClassName('ml7');
            for (var i = 0; i < textWrapper.length; ++i) {
                var item = textWrapper[i];
                item.innerHTML = item.textContent.replace(/\S/g, "<span class='anim1'>$&</span>");
            }
            anime.timeline({
                    loop: 3
                })
                .add({
                    targets: '.ml7 .anim1',
                    rotateY: [-90, 0],
                    duration: 1300,
                    delay: (el, i) => 45 * i
                }).add({
                    targets: '.ml7',
                    opacity: 0,
                    duration: false,
                    easing: "easeOutExpo",
                    delay: 1000
                });
        }

        function anim2() {
            // Wrap every letter in a span
            var textWrapper = document.querySelector('.ml12');
            textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

            anime.timeline({
                    loop: false
                })
                .add({
                    targets: '.ml12 .letter',
                    translateX: [40, 0],
                    translateZ: 0,
                    opacity: [0, 1],
                    easing: "easeOutExpo",
                    duration: 1200,
                    delay: (el, i) => 500 + 30 * i
                })
                .add({
                    targets: '.ml12 .letter',
                    translateX: [0, -30],
                    opacity: [1, 0],
                    easing: "easeInExpo",
                    duration: false,
                    delay: (el, i) => 1100 + 30 * i
                });

        }

        function safeCall(arr, index) {
            return arr[index] ?? {
                call_id: '-',
                layanan: '',
                number: '-',
                namalayanan: '-'
            };
        }

        function checkcall() {
            $.ajax({
                type: "GET",
                url: "{{ url('assets/files/display_template1') }}",
                cache: false,
                success: function(response) {

                    try {
                        s = JSON.parse(response);
                    } catch (e) {
                        console.error('JSON invalid', e);
                        return;
                    }

                    if (!Array.isArray(s) || s.length === 0) {
                        console.warn('Display template kosong');
                        return;
                    }

                    const c0 = safeCall(s, 0);
                    const c1 = safeCall(s, 1);
                    const c2 = safeCall(s, 2);

                    if (curr !== c0.call_id) {

                        $('#num0').html(`${c0.layanan || ''}${c0.number || '-'}`);
                        $('#num1').html(`${c1.layanan || ''}${c1.number || '-'}`);
                        $('#num2').html(`${c2.layanan || ''}${c2.number || '-'}`);
                        
                        $('#service0').html(c0.namalayanan || '-');

                        if (c1.namalayanan != null && c1.namalayanan != '' && c1.namalayanan != '-') {
                            $('#service1').html('PASIEN ' +c1.namalayanan);
                        } else {
                            $('#service1').html('-');
                        }

                        if (c2.namalayanan != null && c2.namalayanan != '' && c2.namalayanan != '-') {
                            $('#service2').html('PASIEN ' +c2.namalayanan);
                        } else {
                            $('#service2').html('-');
                        }

                        anim();
                        anim1();
                        // anim2();
                        sound();

                        curr = c0.call_id;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        }

        window.setInterval(function() {
            checkcall();
        }, 3000);


        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ url('assets/files/display_template1') }}",
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
</body>

</html>

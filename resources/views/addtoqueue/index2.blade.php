@extends('layouts.mainappqueue')

@section('title', 'Ambil Antrian')

@section('css')
    <link href="{{ asset('assets/css/materializev1.min.css') }}" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: linear-gradient(to bottom, #0b4ea2, #0a3d80);
            font-family: Arial, Helvetica, sans-serif;
            overflow: hidden;
            color: #fff;
        }

        /* ===== HEADER ===== */
        .header-bar {
            height: 90px;
            background: #0a3a74;
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, .4);
        }

        .header-bar img {
            height: 55px;
            margin-right: 20px;
        }

        .header-text {
            line-height: 1.2;
        }

        .header-text .title {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text .subtitle {
            font-size: 18px;
            opacity: .9;
        }

        /* ===== CONTENT ===== */
        .content {
            height: calc(100vh - 400px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* ===== BUTTON ===== */
        .queue-btn {
            width: 500px;
            height: 90px;
            background: linear-gradient(to bottom, #4f93e6, #2f6fc4);
            border-radius: 10px;
            margin: 15px 0;
            display: flex;
            align-items: center;
            position: relative;
            box-shadow: inset 0 2px 0 rgba(255, 255, 255, .3),
                0 6px 12px rgba(0, 0, 0, .4);
            cursor: pointer;
            user-select: none;
        }

        .queue-btn:active {
            transform: scale(.97);
        }

        /* LETTER CIRCLE */
        .queue-letter {
            width: 55px;
            height: 55px;
            background: rgba(255, 255, 255, .2);
            border-radius: 50%;
            margin-left: 15px;
            font-size: 28px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* NAME */
        .queue-name {
            flex: 1;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* TOUCH ICON */
        .queue-touch {
            width: 40px;
            margin-right: 20px;
            opacity: .9;
        }

       /* ===== FOOTER TIME (OUTLINE) ===== */
        .footer-time {
            position: fixed;
            bottom: 15px;
            width: 100%;
            text-align: center;
            font-size: 20px;
            letter-spacing: 1px;
            color: #ffffff;

            /* outline + shadow supaya kebaca di background terang */
            text-shadow:
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px  1px 0 #000,
                1px  1px 0 #000,
                0   2px 4px rgba(0,0,0,.6);
        }

        .footer-time .clock {
            font-size: 28px;
            font-weight: bold;
        }

        .queue-letter {
            width: 70px;
            height: 70px;
            font-size: 34px;
        }

        .queue-name {
            font-size: 32px;
        }

        .queue-touch {
            width: 52px;
        }
    </style>
@endsection

@section('content2')

    <!-- HEADER -->
    <div class="header-bar">
        <img src="{{ asset('assets/images') }}/{{ $settings->logo }}">
        <div class="header-text">
            <div class="title">
                {!! $settings->header_kiosk !!}
            </div>
            <div class="subtitle">
                {{ strtoupper($settings->name ?? '') }}
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @foreach ($departments as $department)
            <div class="queue-btn tombol" onclick="queue_dept({{ $department->id }}, this)">
                <div class="queue-letter">
                    {{ strtoupper($department->letter) }}
                </div>

                <div class="queue-name">
                    {{ strtoupper($department->name) }}
                </div>

                <img src="{{ asset('assets/images') }}/touch.png" class="queue-touch">
            </div>
        @endforeach

    </div>

    <!-- FOOTER JAM & TANGGAL -->
    <div class="footer-time">
        <div class="clock" id="clock">--:--:--</div>
        <div class="date" id="date">----</div>
    </div>


@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/materializev1.min.js') }}"></script>

    <script>
        function updateClock() {
            const now = new Date();

            const days = [
                'Minggu', 'Senin', 'Selasa', 'Rabu',
                'Kamis', 'Jumat', 'Sabtu'
            ];

            const months = [
                'Januari', 'Februari', 'Maret', 'April',
                'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember'
            ];

            const dayName = days[now.getDay()];
            const day = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            document.getElementById('clock').innerText =
                `${hours}:${minutes}:${seconds}`;

            document.getElementById('date').innerText =
                `${dayName}, ${day} ${month} ${year}`;
        }

        // update pertama
        updateClock();
        // update tiap 1 detik
        setInterval(updateClock, 1000);
    </script>


    <script>
        function queue_dept(id, el) {
            $.ajax({
                url: "{{ route('post_add_to_queue') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    department: id
                },
                beforeSend() {
                    $('.tombol').css('pointer-events', 'none');
                    $(el).css('opacity', '.7');
                },
                success(res) {
                    $('.tombol').css('pointer-events', 'auto');
                    $(el).css('opacity', '1');

                    M.toast({
                        html: res.message ?? 'Berhasil',
                        classes: 'green darken-1 bottom-center'
                    });
                },
                error() {
                    $('.tombol').css('pointer-events', 'auto');
                    $(el).css('opacity', '1');
                    alert('Gagal mengambil antrian');
                }
            });
        }
    </script>
@endsection

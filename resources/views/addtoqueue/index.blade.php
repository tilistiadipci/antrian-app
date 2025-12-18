@extends('layouts.mainappqueue')

@section('title', trans('messages.issue') . ' ' . trans('messages.display.token'))

@section('css')
    <link href="{{ asset('assets/css/materializev1.min.css') }}" rel="stylesheet">

    @php
        $sizeText = $settings->size_text_tombol;
    @endphp
    <style>
        .btn-queue {
            padding: 25px;
            font-size: {{ $sizeText }}px;
            line-height: 36px;
            height: auto;
            margin: 10px;
            letter-spacing: 0;
            text-transform: none;
        }

        /* .btngmb {
            margin-top: -15px !important;
            margin-bottom: -15px !important;
        } */

        /* style untuk keyboard */
        .keyboard {
            background-color: #dcdcdc;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: .5px solid #a7a7a7;
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            bottom: 2%;
            width: max-content;
            height: max-content;
            cursor: move;
            z-index: 99999 !important;
            display: none;
        }

        .virtual-keyboard {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #ccc;
            position: absolute;
            top: 50px;
            left: 50px;
            z-index: 999999;
            /* Supaya elemen muncul di atas */
            cursor: move;
        }

        .key-row {
            display: flex;
            justify-content: center;
            margin: 5px 0;
        }

        .keys {
            width: 35px;
            height: 30px;
            margin: 3px;
            background-color: #fff;
            border: 1px solid #bbb;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            user-select: none;
            box-shadow: inset 0 -2px 0 #aaa;
        }

        .keys:hover {
            background-color: #ddd;
        }

        .special-key {
            width: 50px;
        }

        .space-key {
            width: 150px;
        }

        .shift-active {
            background-color: #e0e0e0;
        }

        /* end style untuk keyboard */

        .toast.bottom-center {
            position: fixed !important;
            top: 20px !important;
            right: auto !important;
            bottom: auto !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
        }
    </style>
@endsection

@section('content2')
    <div class="row">
        <div class="col m12" style="margin-top:50px" id="contentantrian">
            <div id="callarea" class="col m12 center-align">
                <h1 class="logo-wrapper">
                    <img src="{{ asset('assets/images') }}/{{ $settings->logo }}" width="{{ $settings->size_logo }}"
                        class="brand-logo-a responsive-img">
                </h1><br /><br />
                <span class="ambilant">Silahkan klik tombol untuk mengambil antrian atau mengisi buku tamu</span>
            </div>
            <div class="card-panel center-align" style="background:transparent;">
                @if (count($departments) <= 2)
                    @foreach ($departments as $department)
                        <span class="btn btn-large btn-queue tombol" style="width:40%;"
                            onclick="queue_dept({{ $department->id }}, this)">
                            {{ $department->name }}
                            <img src="{{ asset('assets/images') }}/touch.png" class="btngmb">
                        </span> <br>
                    @endforeach
                @else
                    @foreach ($departments as $department)
                        <span class="btn btn-large btn-queue tombol" style="width:40%;"
                            onclick="queue_dept({{ $department->id }}, this)">
                            {{ $department->name }}
                            <img src="{{ asset('assets/images') }}/touch.png" class="btngmb">
                        </span>
                    @endforeach
                @endif

                {{-- <span class="btn btn-large btn-queue tombol" style="width:40%;" onclick="openGuestModal()">
                    Buku Tamu
                    <img src="{{ asset('assets/images') }}/touch.png" class="btngmb">
                </span> --}}
            </div>
        </div>
    </div>

    {{-- @include('addtoqueue._buku_tamu') --}}
@endsection

@section('script')
    {{-- Simpan jQuery 1 dari layout global --}}
    <script>
        var jq1 = window.jQuery;
    </script>

    {{-- Load jQuery 3 dan jadikan sementara global --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    {{-- Simpan jQuery 3 ke variabel terpisah --}}
    <script>
        var jq3 = window.jQuery;
    </script>

    {{-- Load Materialize (harus setelah jQuery 3 aktif) --}}
    <script src="{{ asset('assets/js/materializev1.min.js') }}"></script>

    {{-- Kembalikan jQuery 1 sebagai global --}}
    <script>
        window.jQuery = jq1;
        window.$ = jq1;
    </script>

    {{-- Inisialisasi UI pakai jq3 agar Materialize tidak error --}}
    <script>
        jq3(function() {
            M.Modal.init(document.querySelectorAll('.modal'));
            document.querySelectorAll('select').forEach(select => {
                if (!M.FormSelect.getInstance(select)) {
                    M.FormSelect.init(select);
                }
            });
        });
    </script>

    {{-- Script kamu: queue + modal pakai jQuery 1 --}}
    <script>
        $(function() {
            $('#main').css({
                'min-height': $(window).height() - 134 + 'px'
            });

            $(window).resize(function() {
                $('#main').css({
                    'min-height': $(window).height() - 134 + 'px'
                });
            });
        });

        function queue_dept(value, element) {
            $.ajax({
                url: `{{ route('post_add_to_queue') }}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    department: value
                },
                beforeSend: function() {
                    $('.tombol').attr('disabled', true);
                    $(element).css({
                        transform: 'scale(0.95)',
                        opacity: '0.7',
                        boxShadow: 'inset 0 2px 5px rgba(0,0,0,0.2)'
                    });
                },
                success: function(res) {
                    $('.tombol').attr('disabled', false);
                    $(element).css({
                        transform: 'scale(1)',
                        opacity: '1',
                        boxShadow: 'none'
                    });
                    M.toast({
                        html: res.message ?? 'Berhasil',
                        classes: 'green darken-1 white-text bottom-center'
                    });
                },
                error: function() {
                    $('.tombol').attr('disabled', false);
                    $(element).css({
                        transform: 'scale(1)',
                        opacity: '1',
                        boxShadow: 'none'
                    });
                    alert('Cek settingan printer,Gagal mengambil antrian');
                }
            });
        }

        function openGuestModal() {
            resetGuestForm();
            const modal = M.Modal.getInstance(document.getElementById('guestModal'));
            modal.open();
        }

        function resetGuestForm() {
            $('#guestForm')[0].reset();
            M.updateTextFields();

            const select = document.getElementById('sales');
            if (select) {
                const instance = M.FormSelect.getInstance(select);
                if (instance) instance.destroy();
                M.FormSelect.init(select);
            }
        }

        function submitGuest() {
            if (!$('#guestForm')[0].checkValidity()) {
                $('#guestSubmit').attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                M.toast({
                    html: 'Pengisian form belum lengkap',
                    classes: 'red darken-1 white-text bottom-center'
                });
                $('#guestSubmit').attr('disabled', false).html('KIRIM');
                return;
            }

            $.ajax({
                url: '{{ route('guest_register') }}',
                method: 'POST',
                data: $('#guestForm').serialize(),
                beforeSend: function() {
                    $('#guestSubmit').attr('disabled', true).html(
                        '<i class="fa fa-spinner fa-spin"></i> Loading...');
                },
                success: function() {
                    M.Modal.getInstance(document.getElementById('guestModal')).close();
                    M.toast({
                        html: 'Terima kasih telah mengisi buku tamu',
                        classes: 'green darken-1 white-text bottom-center'
                    });
                    resetGuestForm();
                },
                error: function() {
                    M.toast({
                        html: 'Gagal mengirim data',
                        classes: 'red darken-1 white-text bottom-center'
                    });
                },
                complete: function() {
                    $('#guestSubmit').attr('disabled', false).html('KIRIM');
                }
            });
        }
    </script>

    {{-- Virtual Keyboard pakai jq3 agar tidak konflik --}}
    <script>
        jq3(function() {
            let shiftActive = false;
            let activeInput = jq3(".input-keyboard");
            let isDragging = false;
            let offsetX = 0, offsetY = 0;
            let select2Open = false;

            function updateKeys() {
                jq3(".keys").each(function() {
                    const key = jq3(this);
                    const def = key.data("default");
                    const shift = key.data("shift");
                    key.text(shift ? (shiftActive ? shift : def) : (shiftActive ? key.text().toUpperCase() :
                        key.text().toLowerCase()));
                });
            }

            function keyboardWrite(el, key) {
                const k = key.text().trim();
                if (key.is("#backspace")) {
                    el.val(el.val().slice(0, -1));
                } else if (key.is("#space")) {
                    el.val(el.val() + " ");
                } else if (key.is("#shift")) {
                    shiftActive = !shiftActive;
                    key.toggleClass("shift-active", shiftActive);
                    updateKeys();
                } else {
                    el.val(el.val() + k);
                }
                el.trigger("input").focus();
            }

            jq3(document).on("click touchstart", ".keys", function(e) {
                e.stopPropagation();
                if (select2Open) activeInput = jq3(".select2-search__field");
                keyboardWrite(activeInput, jq3(this));
            });

            jq3(document).on("focus touchstart", ".input-keyboard", function() {
                jq3(".keyboard").show();
                activeInput = jq3(this);
                select2Open = false;
            });

            jq3(".js-source-select2").on("select2:open", function() {
                jq3(".keyboard").show();
                select2Open = true;
                setTimeout(() => {
                    const field = jq3(".select2-search__field");
                    field.focus();
                    activeInput = field;
                }, 100);
            });

            jq3(".js-source-select2").on("select2:close", () => {
                jq3(".keyboard").hide();
                select2Open = false;
            });

            jq3(document).on("click touchstart", function(e) {
                if (!jq3(e.target).closest(".input-keyboard, .keyboard").length && !select2Open) {
                    jq3(".keyboard").hide();
                }
            });

            jq3(".keyboard").on("mousedown touchstart", function(e) {
                isDragging = true;

                const keyboard = jq3(this);

                // Dapatkan posisi aktual
                const rect = keyboard[0].getBoundingClientRect();
                const clientX = e.clientX || e.touches[0].clientX;
                const clientY = e.clientY || e.touches[0].clientY;

                offsetX = clientX - rect.left;
                offsetY = clientY - rect.top;

                // Set posisi awal fixed agar tidak transform lagi
                keyboard.css({
                    left: rect.left + "px",
                    top: rect.top + "px",
                    bottom: "auto",
                    transform: "none",
                });
            });

            jq3(document).on("mousemove touchmove", function(e) {
                if (isDragging) {
                    const clientX = e.clientX || e.touches[0].clientX;
                    const clientY = e.clientY || e.touches[0].clientY;

                    jq3(".keyboard").css({
                        left: clientX - offsetX + "px",
                        top: clientY - offsetY + "px"
                    });
                }
            });

            jq3(document).on("mouseup touchend", function() {
                isDragging = false;
            });

            updateKeys();
        });
    </script>
@endsection

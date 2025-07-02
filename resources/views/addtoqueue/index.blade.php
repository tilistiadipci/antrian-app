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

        .btngmb {
            margin-top: -15px !important;
            margin-bottom: -15px !important;
        }

        /* style untuk keyboard */
        .keyboard {
            background-color: #dcdcdc;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: .5px solid #a7a7a7;
            right: 2px;
            bottom: 7%;
            width: max-content;
            height: max-content;
            cursor: move;
            z-index: 99999 !important;
            position: fixed;
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

                <span class="btn btn-large btn-queue tombol" style="width:40%;" onclick="openGuestModal()">
                    Buku Tamu
                    <img src="{{ asset('assets/images') }}/user.png" class="btngmb">
                </span>
            </div>
        </div>
    </div>

    <!-- Modal Buku Tamu -->
    <div id="guestModal" class="modal">
        <div class="modal-content">
            <h5>Form Buku Tamu</h5>
            <br>
            <form id="guestForm">
                @csrf
                <div class="input-field">
                    <select id="sales" name="sales" required>
                        <option value="" disabled selected>Pilih Sales</option>
                        @foreach ($sales as $s)
                            <option value="{{ $s->id }}" {{ $sales_assigned->id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                    <label for="sales">Sales <span style="color: red">*</span></label>
                </div>
                <div class="input-field">
                    <input id="name" class="input-keyboard" name="name" type="text" required autocomplete="off">
                    <label for="name">Nama <span style="color: red">*</span></label>
                </div>
                <div class="input-field">
                    <input id="dinas" class="input-keyboard" name="dinas" type="text" autocomplete="off" required>
                    <label for="dinas">Dinas / Instansi <span style="color: red">*</span></label></label>
                </div>
                <div class="input-field">
                    <input id="email" class="input-keyboard" name="email" type="email" autocomplete="off">
                    <label for="email">Email</label>
                </div>
                <div class="input-field">
                    <input id="no_hp" class="input-keyboard" name="no_hp" type="text" autocomplete="off">
                    <label for="no_hp">No HP</label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-close waves-effect btn-flat">Batal</a>
            <a href="javascript:void(0)" onclick="submitGuest()" class="waves-effect waves-green btn" id="guestSubmit">Kirim</a>
        </div>
    </div>

    {{-- keyboard --}}
    <div class="virtual-keyboard">
        <div class="keyboard">
            <div class="key-row">
                <div class="keys" data-default="1" data-shift="!">1</div>
                <div class="keys" data-default="2" data-shift="@">2</div>
                <div class="keys" data-default="3" data-shift=";">3</div>
                <div class="keys" data-default="4" data-shift="'">4</div>
                <div class="keys" data-default="5" data-shift="%">5</div>
                <div class="keys" data-default="6" data-shift="^">6</div>
                <div class="keys" data-default="7" data-shift="&">7</div>
                <div class="keys" data-default="8" data-shift="*">8</div>
                <div class="keys" data-default="9" data-shift="(">9</div>
                <div class="keys" data-default="0" data-shift=")">0</div>
                <div class="keys special-key" id="backspace">⌫</div>
            </div>
            <div class="key-row">
                <div class="keys">q</div>
                <div class="keys">w</div>
                <div class="keys">e</div>
                <div class="keys">r</div>
                <div class="keys">t</div>
                <div class="keys">y</div>
                <div class="keys">u</div>
                <div class="keys">i</div>
                <div class="keys">o</div>
                <div class="keys">p</div>
            </div>
            <div class="key-row">
                <div class="keys">a</div>
                <div class="keys">s</div>
                <div class="keys">d</div>
                <div class="keys">f</div>
                <div class="keys">g</div>
                <div class="keys">h</div>
                <div class="keys">j</div>
                <div class="keys">k</div>
                <div class="keys">l</div>
            </div>
            <div class="key-row">
                <div class="keys special-key" id="shift">Shift</div>
                <div class="keys">z</div>
                <div class="keys">x</div>
                <div class="keys">c</div>
                <div class="keys">v</div>
                <div class="keys">b</div>
                <div class="keys">n</div>
                <div class="keys">m</div>
                <div class="keys">,</div>
                <div class="keys">.</div>
                <div class="keys">/</div>
            </div>
            <div class="key-row">
                <div class="keys space-key" id="space">Space</div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Materialize JS -->
    <script src="{{ asset('assets/js/materializev1.min.js') }}"></script>

    <script>
        $(function() {
            $('#main').css({
                'min-height': $(window).height() - 134 + 'px'
            });
        });

        $(window).resize(function() {
            $('#main').css({
                'min-height': $(window).height() - 134 + 'px'
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
                },
                error: function() {
                    $('.tombol').attr('disabled', false);
                    $(element).css({
                        transform: 'scale(1)',
                        opacity: '1',
                        boxShadow: 'none'
                    });
                    alert('Gagal mengambil antrian');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            M.Modal.init(document.querySelectorAll('.modal'));

            const selects = document.querySelectorAll('select');
            selects.forEach(select => {
                if (!M.FormSelect.getInstance(select)) {
                    M.FormSelect.init(select);
                }
            });
        });

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
                $('#guestSubmit').attr('disabled', true);
                $('#guestSubmit').html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                M.toast({
                    html: 'Pengisian form belum lengkap',
                    classes: 'red darken-1 white-text bottom-center',
                });
                
                $('#guestSubmit').attr('disabled', false);
                $('#guestSubmit').html('KIRIM');
                return;
            }
            $.ajax({
                url: '{{ route('guest_register') }}',
                method: 'POST',
                data: $('#guestForm').serialize(),
                beforeSend: function() {
                    $('#guestSubmit').attr('disabled', true);
                    $('#guestSubmit').html('<i class="fa fa-spinner fa-spin"></i> Loading...');
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
                        classes: 'red darken-1 white-text bottom-center',
                    });
                },
                complete: function() {
                    $('#guestSubmit').attr('disabled', false);
                    $('#guestSubmit').html('KIRIM');
                },
            });
        }
    </script>

    <script>
        $(function() {
            var select2Open = false;
            let shiftActive = false;
            let activeInput = $(".input-keyboard");
            let isDragging = false;
            let offsetX, offsetY;

            // const isTouch = "ontouchstart" in window || navigator.maxTouchPoints > 0;

            function updateKeys() {
                $(".keys").each(function() {
                    const key = $(this);
                    const defaultKey = key.data("default");
                    const shiftKey = key.data("shift");
                    if (shiftKey) {
                        key.text(shiftActive ? shiftKey : defaultKey);
                    } else {
                        key.text(
                            shiftActive ?
                            key.text().toUpperCase() :
                            key.text().toLowerCase()
                        );
                    }
                });
            }

            function keyboardWrite(element, keypad) {
                const key = keypad.text().trim();

                if (keypad.is("#backspace")) {
                    const val = element.val();
                    element.val(val.slice(0, -1));
                } else if (keypad.is("#space")) {
                    element.val(element.val() + " ");
                } else if (keypad.is("#shift")) {
                    shiftActive = !shiftActive;
                    keypad.toggleClass("shift-active", shiftActive);
                    updateKeys();
                } else {
                    element.val(element.val() + key);
                }

                element.trigger("input").focus();
            }

            $(document).on("click touchstart", ".keys", function(e) {
                e.stopPropagation(); // Mencegah event bubbling
                if (select2Open) {
                    activeInput = $(".select2-search__field");
                }
                keyboardWrite(activeInput, $(this));
            });

            $(document).on("focus touchstart", ".input-keyboard", function() {
                $(".keyboard").show();
                activeInput = $(this);
                select2Open = false;
            });

            $(".js-source-select2").on("select2:open", function() {
                $(".keyboard").show();
                select2Open = true;

                // Fokuskan input pencarian Select2
                setTimeout(function() {
                    const searchField = $(".select2-search__field");
                    searchField.focus(); // Fokus input
                    activeInput = searchField;
                }, 100);
            });

            $(".js-source-select2").on("select2:close", function() {
                $(".keyboard").hide();
                select2Open = false;
            });

            // Menangani klik di luar keyboard untuk menyembunyikan
            $(document).on("click touchstart", function(event) {
                if (
                    !$(event.target).closest(".input-keyboard, .keyboard").length &&
                    !select2Open
                ) {
                    $(".keyboard").hide();
                }
            });

            // Mencegah Select2 tertutup ketika keyboard virtual diklik
            $(".keyboard").on("mousedown touchstart", function(event) {
                event.stopPropagation();
            });

            // Dragging keyboard virtual
            $(".keyboard").on("mousedown touchstart", function(e) {
                isDragging = true;
                const clientX = e.clientX || e.touches[0].clientX;
                const clientY = e.clientY || e.touches[0].clientY;
                offsetX = clientX - $(this).offset().left;
                offsetY = clientY - $(this).offset().top;
                $(this).css("transition", "none");
            });

            $(document).on("mousemove touchmove", function(e) {
                if (isDragging) {
                    const clientX = e.clientX || e.touches[0].clientX;
                    const clientY = e.clientY || e.touches[0].clientY;

                    $(".keyboard").css({
                        position: "fixed",
                        left: clientX - offsetX + "px",
                        top: clientY - offsetY + "px",
                    });
                }
            });

            $(document).on("mouseup touchend", function() {
                isDragging = false;
                $(".keyboard").css("transition", "all 0.3s ease");
            });

            updateKeys();
        });
    </script>
@endsection

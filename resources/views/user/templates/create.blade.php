@extends('layouts.app')

@section('title', 'Tambah Template')

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s6" style="margin:.82rem 0 .656rem">
                        Tambah Template
                    </h5>
                    <ol class="breadcrumbs col s6 right-align">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('templates.index') }}">Template</a></li>
                        <li class="active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2">

                <a class="btn-floating waves-effect waves-light orange tooltipped right"
                    href="{{ route('templates.index') }}" data-tooltip="Kembali">
                    <i class="mdi-navigation-arrow-back"></i>
                </a>

                <form method="POST" action="{{ route('templates.store') }}" enctype="multipart/form-data">

                    @csrf

                    {{-- ========================= --}}
                    {{-- INFORMASI TEMPLATE --}}
                    {{-- ========================= --}}
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Informasi Template</span>

                            <div class="input-field">
                                <input type="text" name="template_name" required>
                                <label>Nama Template</label>
                            </div>

                            <div class="input-field">
                                <label for="">Department/Layanan</label>
                                <select name="department_ids[]" multiple class="browser-default" required>
                                    <option value="">-- Pilih Department / Layanan --</option>
                                    @foreach ($departments ?? [] as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Loket/Counter</label>
                                <select name="counters[]" multiple class="browser-default">
                                    <option value="">-- Pilih Loket / Counter --</option>
                                    @foreach ($counters ?? [] as $counter)
                                        <option value="{{ $counter->id }}">
                                            {{ $counter->name }} 
                                            @if ($counter->call_type == "text")
                                                ({{ str_replace(".mp3", "", $counter->dinamic_call) }})
                                            @else
                                                ({{ $counter->idcounter }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <small class="grey-text">Boleh pilih lebih dari satu</small>
                            </div>

                            <div class="input-field">
                                <label>Text Footer</label>
                                <textarea name="text_footer" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- ========================= --}}
                    {{-- TAMPILAN ANTRIAN --}}
                    {{-- ========================= --}}
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Tampilan Antrian</span>

                            {{-- HEADER --}}
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s4">
                                    <label>Background Header</label>
                                    <input type="color" name="header_background_color" value="#000000">
                                </div>

                                <div class="col s4">
                                    <label>Warna Teks Judul Header</label>
                                    <input type="color" name="header_text_color" value="#ffffff">
                                </div>

                                <div class="col s4">
                                    <label>Warna Teks Date</label>
                                    <input type="color" name="header_date_text_color" value="#ffffff">
                                </div>
                            </div>

                            {{-- ANTRIAN --}}
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s4">
                                    <label>Warna Teks Antrian</label>
                                    <input type="color" name="queue_text_color" value="#ffffff">
                                </div>

                                <div class="col s4">
                                    <label>Background Antrian</label>
                                    <input type="color" name="queue_background_color" value="#000000">
                                </div>

                                <div class="col s4">
                                    <label>Warna Teks Antrian Aktif</label>
                                    <input type="color" name="queue_active_text_color" value="#ff9800">
                                </div>
                            </div>

                            {{-- LAYANAN --}}
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s4">
                                    <label>Warna Teks Layanan</label>
                                    <input type="color" name="service_text_color" value="#ffffff">
                                </div>

                                <div class="col s4">
                                    <label>Background Layanan 1</label>
                                    <input type="color" name="service_background_color_1" value="#000000">
                                </div>

                                <div class="col s4">
                                    <label>Background Layanan 2</label>
                                    <input type="color" name="service_background_color_2" value="#ff9800">
                                </div>
                            </div>

                            {{-- FOOTER --}}
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s4">
                                    <label>Warna Teks Footer</label>
                                    <input type="color" name="footer_text_color" value="#ffffff">
                                </div>

                                <div class="col s4">
                                    <label>Background Footer</label>
                                    <input type="color" name="footer_background_color" value="#000000">
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- ========================= --}}
                    {{-- VIDEO BACKGROUND --}}
                    {{-- ========================= --}}
                    {{-- <div class="card">
                        <div class="card-content">
                            <span class="card-title">Video 1 (Required)</span>

                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Upload Video</span>
                                    <input type="file" name="background_video_1" accept="video/mp4" required>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="MP4">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Video 2 (Optional)</span>

                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Upload Video</span>
                                    <input type="file" name="background_video_2" accept="video/mp4">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="MP4">
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    {{-- ========================= --}}
                    {{-- SUBMIT --}}
                    {{-- ========================= --}}
                    <div class="card">
                        <div class="card-content right-align">
                            <button class="btn waves-effect waves-light">
                                Simpan Template
                                <i class="mdi-content-save left"></i>
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('input[type="file"][name="background_video"]').on('change', function() {
            const file = this.files[0];
            if (!file) return;

            const allowed = ['video/mp4'];
            if (!allowed.includes(file.type)) {
                alert('Hanya video MP4 atau WebM');
                $(this).val('');
            }
        });
    </script>
@endsection

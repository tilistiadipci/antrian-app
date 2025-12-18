@extends('layouts.app')

@section('title', 'Edit Template')

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s12" style="margin:.82rem 0 .656rem">
                        Edit Template
                    </h5>
                    <ol class="breadcrumbs col s12 right-align">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('templates.index') }}">Template</a></li>
                        <li class="active">Edit</li>
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

                <form method="POST" action="{{ route('templates.update', $template->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @php
                        $content = json_decode($template->content, true) ?? [];
                        $selectedDepartments = json_decode($template->department_ids, true) ?? [];
                        $selectedCounters = json_decode($template->counter_ids, true) ?? [];
                    @endphp

                    {{-- ========================= --}}
                    {{-- INFORMASI TEMPLATE --}}
                    {{-- ========================= --}}
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Informasi Template</span>

                            <div class="input-field">
                                <input type="text" name="template_name" required value="{{ $template->name }}">
                                <label class="active">Nama Template</label>
                            </div>

                            <div class="input-field">
                                <label for="">Department/Layanan</label>
                                <select name="department_ids[]" multiple class="browser-default" required>
                                    <option value="">-- Pilih Department / Layanan --</option>
                                    @foreach ($departments ?? [] as $dept)
                                        <option value="{{ $dept->id }}"
                                            @if (in_array($dept->id, $selectedDepartments)) selected @endif>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Loket/Counter</label>
                                <select name="counters[]" multiple class="browser-default">
                                    <option value="">-- Pilih Loket / Counter --</option>
                                    @foreach ($counters ?? [] as $counter)
                                        <option value="{{ $counter->id }}"
                                            @if (in_array($counter->id, $selectedCounters)) selected @endif>
                                            {{ $counter->name }}
                                            @if ($counter->call_type == 'text')
                                                ({{ str_replace('.mp3', '', $counter->dinamic_call) }})
                                            @else
                                                ({{ $counter->idcounter }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-field">
                                <textarea name="title" id="" cols="30" rows="10" class="materialize-textarea">PUSKESMAS JAKARTA BARAT</textarea>
                                <label>Title</label>
                            </div>

                            <div class="input-field">
                                <textarea name="text_footer" id="" cols="30" rows="10" class="materialize-textarea">Selamat Datang di Puskesmas Jakarta Barat - Mohon menunggu antrian anda selanjutnya dengan tertib</textarea>
                                <label>Text Footer</label>
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
                                <div class="col s12">
                                    <label>Size Logo (%)</label>
                                    <input type="number" name="size_logo" value="{{ $content['size_logo'] ?? '30' }}">
                                </div>
                                <div class="col s12">
                                    <label>Title Font Size (px)</label>
                                    <input type="number" name="title_font_size"
                                        value="{{ $content['title_font_size'] ?? '28' }}">
                                </div>
                                <div class="col s12">
                                    <label>Service Font Size (px)</label>
                                    <input type="number" name="service_font_size"
                                        value="{{ $content['service_font_size'] ?? '50' }}">
                                </div>
                                <div class="col s12">
                                    <label>Queue Font Size (px)</label>
                                    <input type="number" name="queue_font_size"
                                        value="{{ $content['queue_font_size'] ?? '72' }}">
                                </div>
                                <div class="col s12">
                                    <label>Queue Active Font Size (px)</label>
                                    <input type="number" name="queue_active_font_size"
                                        value="{{ $content['queue_active_font_size'] ?? '100' }}">
                                </div>
                                <div class="col s12">
                                    <label>Footer Font Size (px)</label>
                                    <input type="number" name="footer_font_size"
                                        value="{{ $content['footer_font_size'] ?? '32' }}">
                                </div>
                            </div>

                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s12 mb-2" style="margin-bottom: 10px">
                                    <label>Background Header</label>
                                    <input type="color" name="header_background_color"
                                        value="{{ $content['header_background_color'] ?? '#000000' }}">
                                </div>
                                <div class="col s12 mb-2" style="margin-bottom: 10px">
                                    <label>Warna Teks Judul Header</label>
                                    <input type="color" name="header_text_color"
                                        value="{{ $content['header_text_color'] ?? '#ffffff' }}">
                                </div>
                                <div class="col s12 mb-2" style="margin-bottom: 10px">
                                    <label>Warna Teks Date</label>
                                    <input type="color" name="header_date_text_color"
                                        value="{{ $content['header_date_text_color'] ?? '#ffffff' }}">
                                </div>
                            </div>

                            {{-- ANTRIAN --}}
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Warna Teks Antrian</label>
                                    <input type="color" name="queue_text_color"
                                        value="{{ $content['queue_text_color'] ?? '#ffffff' }}">
                                </div>
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Background Antrian</label>
                                    <input type="color" name="queue_background_color"
                                        value="{{ $content['queue_background_color'] ?? '#0151ac' }}">
                                </div>
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Warna Teks Antrian Aktif</label>
                                    <input type="color" name="queue_active_text_color"
                                        value="{{ $content['queue_active_text_color'] ?? '#ffd700' }}">
                                </div>
                            </div>

                            {{-- LAYANAN --}}
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Warna Teks Layanan</label>
                                    <input type="color" name="service_text_color"
                                        value="{{ $content['service_text_color'] ?? '#ffffff' }}">
                                </div>
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Background Layanan 1</label>
                                    <input type="color" name="service_background_color_1"
                                        value="{{ $content['service_background_color_1'] ?? '#0151ac' }}">
                                </div>
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Background Layanan 2</label>
                                    <input type="color" name="service_background_color_2"
                                        value="{{ $content['service_background_color_2'] ?? '#001e3c' }}">
                                </div>
                            </div>

                            {{-- FOOTER --}}
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Warna Teks Footer</label>
                                    <input type="color" name="footer_text_color"
                                        value="{{ $content['footer_text_color'] ?? '#ffffff' }}">
                                </div>
                                <div class="col s12" style="margin-bottom: 10px">
                                    <label>Background Footer</label>
                                    <input type="color" name="footer_background_color"
                                        value="{{ $content['footer_background_color'] ?? '#021a33' }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="card">
                        <div class="card-content right-align">
                            <button class="btn waves-effect waves-light">
                                Update Template
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
        $('input[type="file"][name="background_video_1"], input[type="file"][name="background_video_2"]').on('change',
            function() {
                const file = this.files[0];
                if (!file) return;

                const allowed = ['video/mp4'];
                if (!allowed.includes(file.type)) {
                    alert('Hanya video MP4 yang diperbolehkan');
                    $(this).val('');
                }
            });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deptSelect = document.getElementById('departmentSelect');

            deptSelect.addEventListener('change', function() {
                const selected = Array.from(this.selectedOptions);

                if (selected.length > 2) {
                    // batalkan pilihan terakhir
                    selected[selected.length - 1].selected = false;

                    alert('Maksimal hanya boleh memilih 2 Department');
                }
            });
        });
    </script>
@endsection

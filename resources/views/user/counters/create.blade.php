@extends('layouts.app')

@section('title', trans('messages.add') . ' ' . trans('messages.mainapp.menu.counter'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">
                        {{ trans('messages.add') }} {{ trans('messages.mainapp.menu.counter') }}
                    </h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('counters.index') }}">{{ trans('messages.mainapp.menu.counter') }}</a></li>
                        <li class="active">{{ trans('messages.add') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @php
        $counters = [
            'Loket' => 0,
            'Counter' => 100,
            'Teller' => 100,
            'CS' => 100,
            'Kasir' => 0,
            'Meja' => 0,
            'Lantai' => 0,
            'Apotik' => 0,
            'Service' => 0,
            'Ruang' => 0,
            'Bagian' => 0,
            'Administrasi' => 0,
        ];

        $textOptions = [
            'Poli' => 'Poli.mp3',
            'Poli Anak' => 'Poli-Anak.mp3',
            'Poli Gigi' => 'Poli-Gigi.mp3',
            'Poli Kandungan' => 'Poli-Kandungan.mp3',
            'Poli Mata' => 'Poli-Mata.mp3',
            'Poli THT' => 'Poli-THT.mp3',
            'Pendaftaran' => 'Loket-Pendaftaran.mp3',
            'Administrasi' => 'Administrasi.mp3',
            // 'Other' => 'Other.mp3',
        ];
    @endphp

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3 py-2">
                <a class="btn-floating waves-effect waves-light orange tooltipped right"
                    href="{{ route('counters.index') }}" data-tooltip="{{ trans('messages.cancel') }}">
                    <i class="mdi-navigation-arrow-back"></i>
                </a>

                <form id="add" action="{{ route('counters.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col s12">

                            {{-- Jenis Counter --}}
                            <label>Jenis Counter</label>
                            <select id="dropdown_selector" class="browser-default">
                                <option value="">- Pilih -</option>
                                @foreach ($counters as $name => $value)
                                    <option value="{{ $value }}">{{ $name }}</option>
                                @endforeach
                            </select>

                            {{-- Call Type --}}
                            <label class="mt-2">Call Type</label>
                            <select id="call_type_toggle" class="browser-default" name="call_type">
                                <option value="angka" selected>Angka</option>
                                <option value="text">Text</option>
                            </select>

                            {{-- Angka --}}
                            <div id="angka_field" class="mt-2">
                                <label>No Counter</label>
                                <select name="idcounter" class="browser-default">
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Text --}}
                            <div id="text_field" class="mt-2" style="display:none;">
                                <label>Teks Panggilan</label>
                                <select name="text_call" id="text_call_dropdown" class="browser-default" style=" width: 100%">
                                    @foreach ($textOptions as $label => $file)
                                        <option value="{{ $file }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Upload Audio --}}
                            <div id="audio_upload" class="mt-2" style="display:none;">
                                <label>Upload Audio (MP3 saja)</label>
                                <input type="file" 
                                    name="audio_file" 
                                    accept=".mp3,audio/mpeg">
                            </div>

                            {{-- Hidden --}}
                            <input type="hidden" id="name" name="name">
                            <input type="hidden" id="durasi" name="durasi">

                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right">
                                {{ trans('messages.save') }}
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
    $('input[name="audio_file"]').on('change', function () {
        const file = this.files[0];
        if (!file) return;

        const isMp3 =
            file.type === 'audio/mpeg' ||
            file.name.toLowerCase().endsWith('.mp3');

        if (!isMp3) {
            alert('Hanya file MP3 yang diperbolehkan!');
            $(this).val('');
        }
    });
    </script>
    <script>
        
        $(document).ready(function() {

            function toggleFields() {
                let type = $('#call_type_toggle').val();

                if (type === 'text') {
                    $('#angka_field').hide();
                    $('#text_field').show();

                    if ($('#text_call_dropdown').val() === 'Other.mp3') {
                        $('#audio_upload').show();
                    } else {
                        $('#audio_upload').hide();
                    }
                } else {
                    $('#angka_field').show();
                    $('#text_field').hide();
                    $('#audio_upload').hide();
                }
            }

            $('#call_type_toggle').change(toggleFields);
            $('#text_call_dropdown').change(toggleFields);

            $('#dropdown_selector').change(function() {
                let opt = $(this).find('option:selected');
                $('#name').val(opt.text());
                $('#durasi').val(opt.val());
            });

        });
    </script>
@endsection

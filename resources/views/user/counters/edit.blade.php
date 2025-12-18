@extends('layouts.app')

@section('title', trans('messages.edit') . ' ' . trans('messages.mainapp.menu.counter'))

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
                        <li class="active">{{ trans('messages.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3 py-2">
                <a class="btn-floating waves-effect waves-light orange tooltipped right"
                    href="{{ route('counters.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}">
                    <i class="mdi-navigation-arrow-back"></i>
                </a>

                <form id="edit" action="{{ route('counters.update', $counter->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                            'Poli' => "Poli.mp3",
                            'Poli Anak' => "Poli-ANak.mp3",
                            'Poli Gigi' => "Poli-Gigi.mp3",
                            'Poli Kandungan' => "Poli-Kandungan.mp3",
                            'Poli Mata' => "Poli-Mata.mp3",
                            'Poli THT' => "Poli-THT.mp3",
                            'Pendaftaran' => "Loket-Pendaftaran.mp3",
                            'Administrasi' => "Administrasi.mp3",
                            // 'Other' => "Other.mp3",
                        ];
                        $isText = !empty($counter->dinamic_call);
                    @endphp

                    <div class="row">
                        <div class="col s12">
                            <label for="dropdown_selector">Jenis Counter</label>
                            <select id="dropdown_selector" class="browser-default" data-error=".name">
                                @foreach ($counters as $name => $value)
                                    <option value="{{ $counter->name === $name ? $counter->durasi : $value }}"
                                        {{ $counter->name === $name ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>

                            <label>Call Type</label>
                            <select id="call_type_toggle" class="browser-default" name="call_type">
                                <option value="angka" {{ empty($counter->dinamic_call)?'selected':'' }}>Angka</option>
                                <option value="text" {{ !empty($counter->dinamic_call)?'selected':'' }}>Text</option>
                            </select>


                            <!-- Dropdown No Counter -->
                            <div id="angka_field" class="mt-2" style="{{ $isText ? 'display:none;' : '' }}">
                                <label for="idcounter">No Counter</label>
                                <select id="idcounter" class="browser-default" name="idcounter">
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}"
                                            {{ $counter->idcounter == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Dropdown Text Options -->
                            <div id="text_field" class="mt-2" style="{{ $isText ? '' : 'display:none;' }}">
                                <label for="text_call">Teks Panggilan</label>
                                <select name="text_call" id="text_call_dropdown" class="browser-default" style="width: 100%">
                                    @foreach ($textOptions as $opt => $filename)
                                        <option value="{{ $filename }}"
                                            {{ $counter->dinamic_call == $opt ? 'selected' : '' }}>{{ $opt }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Upload Audio jika pilih Other -->
                            <div id="audio_upload" class="mt-2"
                                style="{{ $counter->dinamic_call != 'Other' ? 'display:none;' : '' }}">
                                <label for="audio_file">Upload Audio (opsional)</label>
                                <input type="file" name="audio_file" id="audio_file" accept="audio/*">
                            </div>

                            <input id="name" type="hidden" value="{{ $counter->name }}" name="name" />
                            <input id="durasi" type="hidden" value="{{ $counter->durasi }}" name="durasi" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" type="submit">
                                {{ trans('messages.update') }} <i class="mdi-action-swap-vert left"></i>
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
        $(document).ready(function(){

            // Ambil nilai dinamic_call dari DB
            var dinamicCall = "{{ $counter->dinamic_call ?? '' }}";

            function toggleFields() {
                // Tentukan call type berdasarkan dropdown toggle atau dinamicCall
                var callType = $('#call_type_toggle').val() || (dinamicCall ? 'text' : 'angka');

                if(callType === 'text') {
                    $('#angka_field').hide();
                    $('#text_field').show();

                    var textVal = $('#text_call_dropdown').val() || dinamicCall;
                    if(textVal === 'Other') {
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

            // Jalankan saat load
            toggleFields();

            // Trigger saat dropdown call type toggle berubah
            $('#call_type_toggle').change(function(){
                toggleFields();
            });

            // Trigger saat text dropdown berubah
            $('#text_call_dropdown').change(function(){
                toggleFields();
            });

            // Dropdown Jenis Counter
            $('#dropdown_selector').change(function(){
                var option = $(this).find('option:selected');
                $('#name').val(option.text());
                $('#durasi').val(option.val());
            });

        });
        </script>
    </script>
@endsection

@extends('layouts.mainappqueue')

@section('title', trans('messages.issue') . ' ' . trans('messages.display.token'))

@section('css')
    @php
        $sizeText = $settings->size_text_tombol;
    @endphp
    <style>
        .btn-queue {
            padding: 25px;
            font-size: @php echo $sizeText.'px';
        @endphp
        ;
        line-height: 36px;
        height: auto;
        margin: 10px;
        letter-spacing: 0;
        text-transform: none
        }
    </style>
@endsection

@section('content2')
    <div class="row">
        <div class="col m12" style="margin-top:50px">
            <div id="callarea" class="col m12 center-align">

                <h1 class="logo-wrapper"><img src="{{ asset('assets/images') }}/{{ $settings->logo }}"
                        width="{{ $settings->size_logo }}" class="brand-logo-a responsive-img">
                </h1><br /><br />
                <span class="ambilant">Sentuh tombol dibawah untuk mengambil nomor antrian</span>
            </div>
            <div class="card-panel center-align" style="background:transparent;">

                @foreach ($departments as $department)
                    <span class="btn btn-large btn-queue tombol" style="width:40%;"
                        onclick="queue_dept({{ $department->id }})">{{ $department->name }}<img
                            src="{{ asset('assets/images') }}/touch.png" class="btngmb"></span>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
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

        function queue_dept(value) {
            $.ajax({
                url: `{{ route('post_add_to_queue') }}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    department: value
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Setting printer failed!');
                }
            })
            // $('body').removeClass('loaded');
            // var myForm2 =
            //     '<form id="hidfrm2" action="{{ route('post_add_to_queue') }}" method="post">{{ csrf_field() }}<input type="hidden" name="department" value="' +
            //     value + '"></form>';
            // $('body').append(myForm2);
            // myForm2 = $('#hidfrm2');
            // myForm2.submit();
        }
    </script>
@endsection

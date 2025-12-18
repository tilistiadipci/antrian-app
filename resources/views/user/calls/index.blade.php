@extends('layouts.app')
@if (!$user->is_admin)
    @section('title', trans('messages.mainapp.menu.call'))
@endif
@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet"
        media="screen,projection">
    @if (!$user->is_admin)
        <style>
            .dataTables_filter {
                display: none;
            }
        </style>
        <style>
            body {

                background: url("{{ asset('assets/images') }}/{{ $background }}") no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>
    @endif
@endsection

@section('content')
    @if ($user->is_admin)
        <div id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">
                            {{ trans('messages.mainapp.menu.call') }}</h5>
                        <ol class="breadcrumbs col s7 right-align">
                            <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                            <li class="active">{{ trans('messages.mainapp.menu.call') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        @if ($user->is_admin)
            <div class="row">
                @foreach ($departments as $department)
                    <div class="btn green blue" style="margin:10px 20px 0px;">
                        <i class="mdi-social-people left" style="margin:-1px 5px 0px;"></i> {{ $department->name }} <span
                            id="count{{ $department->id }}">0</span>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="btn blue right" style="margin:10px 20px 0px;" id="call_count">
                        <i class="mdi-social-people left" style="margin:-1px 5px 0px;"></i> 0
                    </div>
                    <div class="card-content">
                        @if ($user->is_admin)
                            <span class="card-title" style="line-height:0;font-size:22px">
                                {{ trans('messages.call.new_call') }}
                            </span>
                        @else
                            <span class="card-title" style="line-height:0;font-size:22px">
                                {{ trans('messages.call.new_call') }} 
                                @if ($userdata->counter_user->call_type == 'text')
                                    {{ str_replace('-', ' ', str_replace('.mp3', '', $userdata->counter_user->dinamic_call)) }}
                                @else
                                    {{ $userdata->counter_user->name  }} {{ $userdata->counter_user->idcounter  }}
                                @endif
                            </span>
                        @endif

                        <div class="divider" style="margin:10px 0 10px 0"></div>
                        <div class="card-panel center-align" style="margin-bottom:0">
                            <span style="font-size:30px">{{ trans('messages.call.number') }}
                                {{ trans('messages.display.token') }}</span><br>
                            <span id="num0" style="font-size:125px;color:red;font-weight:bold;line-height:1.0">
                                @if ($data[0]['user_id'] == $user->id)
                                    {{ $data[0]['layanan'] }}{{ $data[0]['number'] }}
                                @endif
                            </span><br>

                        </div>

                        <form id="new_call" action="{{ route('post_call') }}" method="post">
                            {{ csrf_field() }}

                            <input type="hidden" id="user" name="user" value="{{ $user->id }}" readonly>

                            @if ($user->is_admin)
                                @include('user.calls._admin-call')
                            @endif
                            @if (!$user->is_admin)
                                @include('user.calls._staff-call')
                            @endif


                            <div class="row">
                                @if (!$user->is_admin)
                                    <div class="input-field col s12">
                                        <button class="btn btn-large waves-effect waves-light center" type="button"
                                            id="callAntrian"
                                            style="width:100%;background:#555;border-radius: 20px 20px 20px 20px;">
                                            {{ trans('messages.call.call_next') }} {{ $userdata->department->name ?? '' }}<i
                                                class="mdi-navigation-arrow-forward right"></i>
                                        </button>
                                    </div>
                                @endif

                                @if ($user->is_admin)
                                    <div class="input-field col s12">
                                        <button type="button" class="btn waves-effect waves-light right" id="callAntrian">
                                            {{ trans('messages.call.call_next') }}<i
                                                class="mdi-navigation-arrow-forward right"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content" style="font-size:14px">
                        <span class="card-title" style="line-height:0;font-size:22px">Panggil Ulang</span>
                        <div class="divider" style="margin:10px 0 10px 0"></div>
                        <table id="call-table" class="display" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ trans('messages.call.number') }}</th>
                                    <th>{{ trans('messages.call.called') }}</th>
                                    <th>{{ trans('messages.mainapp.menu.counter') }}</th>
                                    <th width="10%">Panggil Ulang</th>
                                </tr>
                            </thead>
                        </table>
                        @if (!$user->is_admin)
                            <br />
                            <td>
                                {{-- <a class="btn waves-effect orange left" href="{{ route('testimoni') }}">
                                    Testimoni<i class="mdi-maps-rate-review left"></i>
                                </a> --}}
                                <a class="btn waves-effect red right frmsubmit" href="{{ route('logout') }}"
                                    message="false" method="post">
                                    Logout<i class="mdi-hardware-keyboard-tab left"></i>
                                </a>
                            </td>
                            <br />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('print')
    @if (session()->has('department_name'))
        <style>
            #printarea {
                display: none;
                text-align: center
            }

            @media print {

                #loader-wrapper,
                header,
                #main,
                footer,
                #toast-container {
                    display: none
                }

                #printarea {
                    display: block;
                }
            }

            @page {
                margin: 0
            }
        </style>
        <div id="printarea" style="line-height:1.25">
            <span style="font-size:27px; font-weight: bold">{{ $company_name }}</span><br>
            <span style="font-size:25px">{{ session()->get('department_name') }}</span><br>
            <span style="font-size:20px">Your Token Number</span><br>
            <span>
                <h3 style="font-size:70px;font-weight:bold;margin:0;line-height:1.5">{{ session()->get('number') }}</h3>
            </span>
            <span style="font-size:20px">Please wait for your turn</span><br>
            <span style="font-size:20px">Total customer(s) waiting: {{ session()->get('total') - 1 }}</span><br>
            <span style="float:left">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span><span
                style="float:right">{{ \Carbon\Carbon::now()->format('h:i:s A') }}</span>
        </div>
        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    @endif
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        const adm = '{{ $user->is_admin }}';
        const departmentId = `{{ $user->departments ?? '' }}`;

        $("#new_call").validate({
            rules: {
                user: {
                    required: true,
                    digits: true
                },
                department: {
                    required: true,
                    digits: true
                },
                counter: {
                    required: true,
                    digits: true
                },
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });

        function call_dept(value) {
            $('body').removeClass('loaded');
            var myForm1 = '<form id="hidfrm1" action="{{ url('calls/dept') }}/' + value +
                '" method="post">{{ csrf_field() }}</form>';
            $('body').append(myForm1);
            myForm1 = $('#hidfrm1');
            myForm1.submit();
        }

        function recall(call_id) {
            $('body').removeClass('loaded');
            var data = 'call_id=' + call_id + '&_token={{ csrf_token() }}';
            $.ajax({
                type: "POST",
                url: "{{ route('post_recall') }}",
                data: data,
                cache: false,
                beforeSend: function() {
                    $('.btn-recall').prop('disabled', true);
                    $('.btn-recall').html('LOADING...');
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#call-table').DataTable().ajax.reload(null, false);
                        $('#num0').html(response.call_number);
                    }

                    $('.btn-recall').prop('disabled', false);
                    $('.btn-recall').html('RECALL');
                }
            });
        }

        $(function() {
            var data = [];
            for (var i = 0; i < 50; i++) {
                data.push({
                    'Ya': i % 2 == 0 ? 'Ya' : 'Tidak'
                })
            }

            var calltable = $('#call-table').dataTable({
                "info": adm == 1 ? true : false,
                "lengthMenu": [
                    [6, 15, 20, 50, -1],
                    [6, 15, 20, 50, "All"]
                ],
                "search": {
                    "search": "@foreach ($counters as $counter)@if ($counter->id == $user->counter){{ $counter->name }}{{ $counter->idcounter }}@endif @endforeach"
                },
                "oLanguage": {
                    "sLengthMenu": "Show _MENU_",
                    "sSearch": "Cari"
                },
                "columnDefs": [{
                    "targets": [-1],
                    "searchable": false,
                    "orderable": false
                }],
                "ajax": "{{ url('assets/files/call') }}",

                "columns": [{
                        "data": "number"
                    },
                    {
                        "data": "called",
                        "title": "Ya"
                    },
                    {
                        "data": "counter"
                    },
                    {
                        "data": "recall",
                        "className": "center",
                    }
                ],
                drawCallback: function(res) {
                    var active = 0;
                    if (adm == 1) {
                        // reset semua count department ke 0
                        @foreach ($departments as $department)
                            $('#count{{ $department->id }}').text(0);
                        @endforeach

                        this.api().rows({
                            'filter': 'applied'
                        }).every(function() {
                            var data = this.data();
                            if (data.called == 'Tidak') {
                                active++; // total sisa antrian

                                // update count per department
                                $('#count' + data.department_id).text(
                                    parseInt($('#count' + data.department_id).text()) + 1
                                );
                            }
                        });

                        // tetap menampilkan total sisa antrian
                        $('#call_count').html(
                            `<i class="mdi-social-people left" style="margin:-1px 5px 0px;"></i> Total Sisa Antrian : ${active}`
                        );

                    } else {
                        console.log(res.json);
                        if (res.json && res.json.data.length > 0) {
                            for (var i = 0; i < res.json.data.length; i++) {
                                var item = res.json.data[i];
                                if (item.called == 'Tidak' && item.department_id == departmentId) {
                                    active++;
                                }
                            }
                        }

                        $('#call_count').html(
                            `<i class="mdi-social-people left" style="margin:-1px 5px 0px;"></i> Sisa Antrian : ${active}`
                        );
                    }
                }
            });

            setInterval(function() {
                calltable.api().ajax.reload(null, false);
            }, 3000);
        });

        $('#callAntrian').click(function() {
            const user = $('#user').val();
            const department = $('#department').val();
            const counter = $('#counter').val();

            if (department == '') {
                swal({
                    title: 'Peringatan!',
                    text: 'Silahkan pilih Layanan terlebih dahulu',
                    type: 'warning',
                    icon: 'warning'
                });
                return;
            }

            if (counter == '') {
                swal({
                    title: 'Peringatan!',
                    text: 'Silahkan pilih Loket/Counter terlebih dahulu',
                    type: 'warning',
                    icon: 'warning'
                });
                return;
            }

            $.ajax({
                url: "{{ route('post_call') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    user: user,
                    department: department,
                    counter: counter
                },
                beforeSend: function() {
                    $('#callAntrian').attr('disabled', true);
                    $('#callAntrian').html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                },
                complete: function() {
                    $('#callAntrian').attr('disabled', false);
                    $('#callAntrian').html(`{{ trans('messages.call.call_next') }}`);

                    if (adm == 1) {
                        $('#department').val('').trigger('change');
                        $('#counter').val('').trigger('change');
                    }
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#num0').html(response.data.call_number);
                        $('#call-table').DataTable().ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    $('#callAntrian').html(`{{ trans('messages.call.call_next') }}`);
                }
            });
        })
    </script>
@endsection

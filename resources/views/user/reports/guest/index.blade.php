@extends('layouts.app')

@section('title', 'Laporan Tamu')


@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">
                        Laporan Tamu
                    </h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li>{{ trans('messages.mainapp.menu.reports.reports') }}</li>
                        <li class="active">Tamu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="input-field col s12 m3">
                                <label for="sdate">{{ trans('messages.starting') }} {{ trans('messages.date') }}</label>
                                <input id="sdate" name="sdate" class="date" type="text" placeholder="dd-mm-yyyy"
                                    value="{{ request()->sdate ?? date('d-m-Y') }}">
                            </div>
                            <div class="input-field col s12 m3">
                                <label for="edate">{{ trans('messages.ending') }} {{ trans('messages.date') }}</label>
                                <input id="edate" name="edate" class="date" type="text" placeholder="dd-mm-yyyy"
                                    value="{{ request()->edate ?? date('d-m-Y') }}">
                            </div>
                            <div class="input-field col s12 m5">
                                <label for="sales" class="active">Sales</label>
                                <select id="sales" name="sales" class="browser-default">
                                    <option value="all">{{ trans('messages.all') }}</option>
                                    @foreach ($sales as $sale)
                                        <option value="{{ $sale->id }}" {{ request()->sales == $sale->id ? 'selected' : '' }}>
                                            {{ $sale->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-field col s12 m1">
                                <button type="submit" class="btn waves-effect waves-light right">{{ trans('messages.go') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <span style="line-height:0;font-size:22px;font-weight:300">{{ trans('messages.report') }}</span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="report-table" class="display" cellspacing="0">
                        <thead style="background-color: #00aa9a; color: #fff">
                            <tr>
                                <th style="width:40px">#</th>
                                <th>Nama</th>
                                <th>Sales</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th width="15%">Waktu Berkunjung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guests as $call)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $call->name }}</td>
                                    <td>{{ $call->sales->name }}</td>
                                    <td>{{ $call->email }}</td>
                                    <td>{{ $call->no_hp }}</td>
                                    <td>{{ $call->created_at->format('d/M/Y h:i:s A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function() {
            from_$input = $('#sdate').pickadate({
                selectMonths: true,
                selectYears: 15,
                format: 'dd-mm-yyyy',
                clear: false,
                // onSet: function(ele) {
                //     if(ele.select) {
                //         this.close();
                //     }
                // },
                closeOnSelect: true,
                onClose: function() {
                    document.activeElement.blur();
                }
            });

            to_$input = $('#edate').pickadate({
                selectMonths: true,
                selectYears: 15,
                format: 'dd-mm-yyyy',
                clear: false,
                // onSet: function(ele) {
                //     if(ele.select) {
                //         this.close();
                //     }
                // },
                closeOnSelect: true,
                onClose: function() {
                    document.activeElement.blur();
                }
            });

            from_picker = from_$input.pickadate('picker');
            to_picker = to_$input.pickadate('picker');

            if (from_picker.get('value')) {
                to_picker.set('min', from_picker.get('select'));
            }
            if (to_picker.get('value')) {
                from_picker.set('max', to_picker.get('select'));
            }

            from_picker.on('set', function(event) {
                if (event.select) {
                    to_picker.set('min', from_picker.get('select'));
                } else if ('clear' in event) {
                    to_picker.set('min', false);
                }
            });
            to_picker.on('set', function(event) {
                if (event.select) {
                    from_picker.set('max', to_picker.get('select'));
                } else if ('clear' in event) {
                    from_picker.set('max', false);
                }
            });
        });

        $('#sdate, #edate, #sales').change(function(event) {
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();
            var sales = $('#sales').val();

            if (sdate == '' || edate == '' || sales == '') {
                $('#gobtn').addClass('disabled');
            } else {
                $('#gobtn').removeClass('disabled');
            }
        });

        // function gobtn() {
        //     if (!$('#gobtn').hasClass('disabled')) {
        //         $('body').removeClass('loaded');
        //         window.location = action;
        //     }
        // }

        $('#report-table').DataTable({
            "oLanguage": {
                "sLengthMenu": "Show _MENU_",
                "sSearch": "Search"
            }
        });
    </script>
@endsection

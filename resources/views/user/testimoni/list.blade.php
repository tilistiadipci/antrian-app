@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.users'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">Penilaian Pelayanan</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">Penilaian</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <table id="user-table" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>{{ trans('messages.name') }}</th>
                                <th>Layanan</th>
                                <th>Loket</th>
                                <th>Sangat Puas</th>
                                <th>Puas</th>
                                <th>Cukup Puas</th>
                                <th>Tidak Puas</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $tuser)
                                <tr{!! ($tuser->id==$user->id)?' class="orange lighten-4"':'' !!}>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tuser->name }}</td>
                                    <td>@foreach($departments as $department)
                                        @if($department->id==$tuser->departments)
                                                   {{ $department->name }}
                                        @endif      
                                         @endforeach</td>
                                    <td>@foreach($counters as $counter)
                                                @if($counter->id==$tuser->counter)
                                                   {{ $counter->name }}  {{ $counter->idcounter }}
                                                @endif
                                        @endforeach
                                        </td>
                                    <td>{{ $tuser->testi_sangat_puas }}</td>
                                    <td>{{ $tuser->testi_puas }}</td>
                                    <td>{{ $tuser->testi_cukup_puas }}</td>
                                    <td>{{ $tuser->testi_tidak_puas }}</td>
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
            $('#user-table').DataTable({
                "oLanguage": {
                    "sLengthMenu": "Show _MENU_",
                    "sSearch": "Search"
                },
                "columnDefs": [{
                    "targets": [ -1 ],
                    "searchable": false,
                    "orderable": false
                }]
            });
        });
    </script>
@endsection

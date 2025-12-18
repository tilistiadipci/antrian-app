@extends('layouts.app')

@section('title', 'Templates')

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">Template</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">Template</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    {{-- <a class="btn-floating waves-effect waves-light tooltipped" href="{{ route('templates.create') }}" data-position="top" data-tooltip="Add Template"><i class="mdi-content-add left"></i></a> --}}
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="template-table" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:40px" class="center">#</th>
                                <th>Name</th>
                                <th>Counter/Loket</th>
                                <th>Service</th>
                                <th style="width:63px" class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                                <tr>
                                    <td class="center">{{ $loop->iteration }}</td>
                                    <td>{{ $template['name'] ?? '' }}</td>
                                    <td>{{ $template['counters'] }}</td>
                                    <td>{{ $template['departments'] }}</td>
                                    <td class="center">
                                        <a class="btn-floating btn-action waves-effect waves-light green tooltipped" href="{{ url('display/show/1')  }}" target="_blank" data-position="top" data-tooltip="Preview"><i class="mdi-image-remove-red-eye"></i></a>
                                        <a class="btn-floating btn-action waves-effect waves-light orange tooltipped" href="{{ route('templates.edit', ['templates' => $template['id']]) }}" data-position="top" data-tooltip="{{ trans('messages.edit') }}"><i class="mdi-editor-mode-edit"></i></a>
                                        {{-- <a class="btn-floating btn-action waves-effect waves-light red tooltipped frmsubmit" href="{{ route('templates.destroy', ['templates' => $template->id]) }}" data-position="top" data-tooltip="{{ trans('messages.delete') }}" method="DELETE"><i class="mdi-action-delete"></i></a> --}}
                                    </td>
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
            $('#template-table').DataTable({
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

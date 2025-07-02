@extends('layouts.app')

@section('title', 'Sales')

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5">Sales</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">Sales</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <a href="{{ route('sales.create') }}" class="btn-floating waves-effect waves-light tooltipped" data-position="top" data-tooltip="Tambah sales">
                        <i class="mdi-content-add left"></i>
                    </a>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="sales-table" class="display">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp / Whatsapp</th>
                                <th>Shift Sekarang</th>
                                <th width="10%" class="center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td class="center">{{ $loop->iteration }}</td>
                                    <td>{{ $sale->name }}</td>
                                    <td>{{ $sale->email }}</td>
                                    <td>{{ $sale->no_hp }}</td>
                                    <td>{{ $sale->is_sales_assigned == 1 ? 'Ya' : 'Tidak' }}</td>
                                    <td class="center">
                                        <a class="btn-floating btn-action orange tooltipped" href="{{ route('sales.edit', ['sales' => $sale->id]) }}" data-position="top" data-tooltip="Edit">
                                            <i class="mdi-editor-mode-edit"></i>
                                        </a>
                                        <a class="btn-floating btn-action waves-effect waves-light red tooltipped frmsubmit" href="{{ route('sales.destroy', ['sales' => $sale->id]) }}" data-position="top" data-tooltip="{{ trans('messages.delete') }}" method="DELETE"><i class="mdi-action-delete"></i></a>
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

    <!-- DataTables -->
    <script src="{{ asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js') }}"></script>

    <script>
        $(function () {
            $('#sales-table').DataTable({
                oLanguage: {
                    sLengthMenu: "Tampilkan _MENU_",
                    sSearch: "Cari"
                },
                columnDefs: [{
                    targets: [-1],
                    searchable: false,
                    orderable: false
                }]
            });
        });
    </script>
@endsection

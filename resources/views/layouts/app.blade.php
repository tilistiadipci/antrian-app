@extends('layouts.mainapp')

@section('menu')
@if($user->is_admin)
    <li class="bold{!! Request::is('dashboard*') ? ' active' : '' !!}"><a href="{{ route('dashboard') }}" class="waves-effect waves-cyan truncate">
        <i class="mdi-hardware-laptop"></i> {{ trans('messages.mainapp.menu.dashboard') }}</a>
    </li>
    <li class="bold{!! Request::is('sales*') ? ' active' : '' !!}"><a href="{{ url('sales') }}" class="waves-effect waves-cyan truncate">
        <i class="mdi-action-account-box"></i> Sales</a>
    </li>
@endif    
    <li class="bold{!! Request::is('calls*') ? ' active' : '' !!}"><a href="{{ route('calls') }}" class="waves-effect waves-cyan truncate">
        <i class="mdi-communication-chat"></i> {{ trans('messages.mainapp.menu.call') }}</a>
    </li>

    @can('access', \App\Models\Department::class)
        <li class="bold{!! Request::is('departments*') ? ' active' : '' !!}"><a href="{{ route('departments.index') }}" class="waves-effect waves-cyan truncate">
            <i class="mdi-communication-business"></i> {{ trans('messages.mainapp.menu.department') }}</a>
        </li>
    @endcan

    @can('access', \App\Models\Counter::class)
        <li class="bold{!! Request::is('counters*') ? ' active' : '' !!}"><a href="{{ route('counters.index') }}" class="waves-effect waves-cyan truncate">
            <i class="mdi-action-view-quilt"></i> {{ trans('messages.mainapp.menu.counter') }}</a>
        </li>
    @endcan

    @can('access', \App\Models\User::class)
        <li>
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan truncate{!! Request::is('reports*') ? ' active' : '' !!}"><i class="mdi-editor-insert-chart"></i> {{ trans('messages.mainapp.menu.reports.reports') }}</a>
                    <div class="collapsible-body">
                        <ul>
                            <li{!! Request::is('reports/user*') ? ' class="active"' : '' !!}><a href="{{ route('reports::user') }}" class="truncate"> {{ trans('messages.mainapp.menu.reports.user_report') }}</a></li>
                            <li{!! Request::is('reports/queuelist*') ? ' class="active"' : '' !!}><a href="{{ route('reports::queue_list', ['date' => \Carbon\Carbon::now()->format('d-m-Y')]) }}" class="truncate"> {{ trans('messages.mainapp.menu.reports.queue_list') }}</a></li>
                            <li{!! Request::is('reports/monthly*') ? ' class="active"' : '' !!}><a href="{{ route('reports::monthly') }}" class="truncate"> {{ trans('messages.mainapp.menu.reports.monthly') }}</a></li>
                            <li{!! Request::is('reports/guest*') ? ' class="active"' : '' !!}><a href="{{ route('reports::guest') }}" class="truncate"> Tamu</a></li>
                            <li{!! Request::is('reports/statistical*') ? ' class="active"' : '' !!}><a href="{{ route('reports::statistical') }}" class="truncate"> {{ trans('messages.mainapp.menu.reports.statistical') }}</a></li>
                            <li{!! Request::is('reports/missed-overtime*') ? ' class="active"' : '' !!}><a href="{{ route('reports::missed') }}" class="truncate"> {{ trans('messages.mainapp.menu.reports.missed') }} / {{ trans('messages.mainapp.menu.reports.overtime') }}</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
    @endcan

    
    @can('access', \App\Models\User::class)    
        <li class="bold{!! Request::is('list/testimoni*') ? ' active' : '' !!}"><a href="{{ route('listtestimoni') }}" class="waves-effect waves-cyan truncate">
        <i class="mdi-action-stars"></i> Penilaian</a>
        </li>
        <li class="bold{!! Request::is('users*') ? ' active' : '' !!}"><a href="{{ route('users.index') }}" class="waves-effect waves-cyan truncate">
            <i class="mdi-action-account-circle"></i> Staff</a>
        </li>
        <li class="bold{!! Request::is('members*') ? ' active' : '' !!}"><a href="{{ route('members.index') }}" class="waves-effect waves-cyan truncate">
            <i class="mdi-action-account-box"></i> Pengguna</a>
        </li>
    @endcan

     <li>
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan truncate{!! Request::is('settings*', 'mobiles*') ? ' active' : '' !!}"><i class="mdi-action-settings"></i> {{ trans('messages.settings') }}</a>
                    <div class="collapsible-body">
                        <ul>
                            <li{!! Request::is('settings*') ? ' class="active"' : '' !!}><a href="{{ route('settings') }}" class="truncate"> Dasar</a></li>
                            <li{!! Request::is('mobiles*') ? ' class="active"' : '' !!}><a href="{{ route('mobiles') }}" class="truncate"> Pengaturan Mobile</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
    </li>
    <br><br>
@endsection

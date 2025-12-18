@extends('layouts.app')

@section('title', trans('messages.settings'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.settings') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">{{ trans('messages.settings') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"
                            style="line-height:0;font-size:22px">{{ trans('messages.mainapp.menu.account') }}</span>
                        <div class="divider" style="margin:10px 0 10px 0"></div>
                        <form id="account" action="{{ route('post_settings') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="name">{{ trans('messages.name') }}</label>
                                    <input id="name" type="text" name="name"
                                        placeholder="{{ trans('messages.name') }}" value="{{ $user->name }}"
                                        data-error=".name">
                                    <div class="name">
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="username">{{ trans('messages.users.username') }}</label>
                                    <input id="username" type="text" name="username"
                                        placeholder="{{ trans('messages.users.username') }}" value="{{ $user->username }}"
                                        data-error=".username">
                                    <div class="username">
                                        @if ($errors->has('username'))
                                            <div class="error">{{ $errors->first('username') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="role">{{ trans('messages.users.role') }}</label>
                                    <input id="role" type="text" placeholder="{{ trans('messages.users.role') }}"
                                        value="{{ $user->role_text }}" data-error=".role" readonly>
                                    <div class="role">
                                        @if ($errors->has('role'))
                                            <div class="error">{{ $errors->first('role') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="email">{{ trans('messages.users.email') }}</label>
                                    <input id="email" type="text" name="email"
                                        placeholder="{{ trans('messages.users.email') }}" value="{{ $user->email }}"
                                        data-error=".email">
                                    <div class="email">
                                        @if ($errors->has('email'))
                                            <div id="name-error" class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="password">{{ trans('messages.users.password') }}</label>
                                    <input id="password" type="password" name="password"
                                        placeholder="{{ trans('messages.users.password') }}" value="{{ old('password') }}"
                                        data-error=".password">
                                    <div class="password">
                                        @if ($errors->has('password'))
                                            <div id="name-error" class="error">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="password_confirmation">{{ trans('messages.users.confirm') }}
                                        {{ trans('messages.users.password') }}</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        placeholder="{{ trans('messages.users.confirm') }} {{ trans('messages.users.password') }}"
                                        value="{{ old('password_confirmation') }}" data-error=".password_confirmation">
                                    <div class="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                            <div id="name-error" class="error">
                                                {{ $errors->first('password_confirmation') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right" type="submit">
                                        {{ trans('messages.update') }}<i class="mdi-action-swap-vert left"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @can('access', $settings)
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.settings') }}
                                {{ trans('messages.company.company') }} </span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <form id="company" action="{{ route('post_company') }}" method="post"
                                enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <img src="{{ asset('assets/images') }}/{{ $settings->logo }}" width="150"
                                            class="brand-logo-a responsive-img"><br />
                                        Logo* <input type='file' name='filelogo' />
                                        @if ($settings->logo != '')
                                            <input type='hidden' id='logo' name='logo'
                                                value="{{ $settings->logo }}" />
                                        @else
                                            <input type='hidden' id='logo' name='logo' value="-" />
                                        @endif
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="name">{{ trans('messages.name') }}</label>
                                        <input id="name" type="text" name="name"
                                            placeholder="{{ trans('messages.name') }}" value="{{ $settings->name }}"
                                            data-error=".cname">
                                        <div class="cname">
                                            @if ($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="email">{{ trans('messages.users.email') }}</label>
                                        <input id="email" type="text" name="email"
                                            placeholder="{{ trans('messages.users.email') }}" value="{{ $settings->email }}"
                                            data-error=".cemail">
                                        <div class="cemail">
                                            @if ($errors->has('email'))
                                                <div id="name-error" class="error">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="address">{{ trans('messages.company.address') }}</label>
                                        <textarea id="address" class="materialize-textarea" name="address"
                                            placeholder="{{ trans('messages.company.address') }}" data-error=".address" style="min-height:67px">{{ $settings->address }}</textarea>
                                        <div class="address">
                                            @if ($errors->has('address'))
                                                <div class="error">{{ $errors->first('address') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="phone">{{ trans('messages.company.phone') }}</label>
                                        <input id="phone" type="text" name="phone"
                                            placeholder="{{ trans('messages.company.phone') }}"
                                            value="{{ $settings->phone }}" data-error=".phone">
                                        <div class="phone">
                                            @if ($errors->has('phone'))
                                                <div id="name-error" class="error">{{ $errors->first('phone') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="location">{{ trans('messages.company.location') }}</label>
                                        <input id="location" type="text" name="location"
                                            placeholder="{{ trans('messages.company.location') }}"
                                            value="{{ $settings->location }}" data-error=".location">
                                        <div class="location">
                                            @if ($errors->has('location'))
                                                <div id="name-error" class="error">{{ $errors->first('location') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="header_kiosk">Header Kiosk</label>
                                        <textarea name="header_kiosk" class="materialize-textarea" id="header_kiosk" cols="30" rows="10">{{ $settings->header_kiosk }}</textarea>
                                        <div class="header_kiosk">
                                            @if ($errors->has('header_kiosk'))
                                                <div id="name-error" class="error">{{ $errors->first('header_kiosk') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit"
                                            name="but_upload_logo">
                                            {{ trans('messages.update') }}<i class="mdi-action-swap-vert left"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endcan
        </div>
        @can('access', $settings)
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.set') }} Durasi
                                {{ trans('messages.mainapp.menu.reports.missed') }} {{ trans('messages.and') }}
                                {{ trans('messages.mainapp.menu.reports.overtime') }}</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <form id="overmissed" action="{{ route('post_over_missed') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="over_time">{{ trans('messages.mainapp.menu.reports.overtime') }}
                                            ({{ trans('messages.in_seconds') }})</label>
                                        <input id="over_time" type="text" name="over_time"
                                            placeholder="{{ trans('messages.in_seconds') }}"
                                            value="{{ $settings->over_time }}" data-error=".over_time">
                                        <div class="over_time">
                                            @if ($errors->has('over_time'))
                                                <div class="error">{{ $errors->first('over_time') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="missed_time">{{ trans('messages.mainapp.menu.reports.missed') }}
                                            {{ trans('messages.time') }} ({{ trans('messages.in_seconds') }})</label>
                                        <input id="missed_time" type="text" name="missed_time"
                                            placeholder="{{ trans('messages.in_seconds') }}"
                                            value="{{ $settings->missed_time }}" data-error=".missed_time">
                                        <div class="missed_time">
                                            @if ($errors->has('missed_time'))
                                                <div class="error">{{ $errors->first('missed_time') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="missed_time">Batas pengambilan antrian / orang</label>
                                        <input id="jml_antrian_hari" type="number" name="jml_antrian_hari"
                                            placeholder="Jumlah Antrian perhari" value="{{ $settings->jml_antrian_hari }}"
                                            data-error=".missed_time">
                                        <div class="missed_time">
                                            @if ($errors->has('missed_time'))
                                                <div class="error">{{ $errors->first('missed_time') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="jam_buka">Jam buka</label><br />
                                        <input id="jam_buka" type="time" name="jam_buka"
                                            value="{{ $settings->jam_buka }}" data-error=".jam_buka">
                                        <div class="jam_buka">
                                            @if ($errors->has('jam_buka'))
                                                <div class="error">{{ $errors->first('jam_buka') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="jam_tutup">Jam tutup</label><br />
                                        <input id="jam_tutup" type="time" name="jam_tutup"
                                            placeholder="{{ trans('messages.in_seconds') }}"
                                            value="{{ $settings->jam_tutup }}" data-error=".jam_tutup">
                                        <div class="jam_tutup">
                                            @if ($errors->has('jam_tutup'))
                                                <div class="error">{{ $errors->first('jam_tutup') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit">
                                            {{ trans('messages.update') }}<i class="mdi-action-swap-vert left"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Setting Printer</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <p>Setting  koneksi printer yang digunakan</p>
                            <form action="{{ route('post_printer') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="printer_type" id="printer_type" class="browser-default" onchange="selectPrinterType()">
                                            <option value="USB" @if ($settings->printer_type == 'USB') selected @endif>
                                                USB
                                            </option>
                                            <option value="LAN" @if ($settings->printer_type == 'LAN') selected @endif>
                                                LAN
                                            </option>
                                        </select>
                                    </div>
                                    <div class="input-field col s12 port-usb" style="display: @if ($settings->printer_type == 'USB') block @else none @endif">
                                        <label for="port_usb">Port USB</label>
                                        <input id="port_usb" type="text" name="port_usb"
                                            value="{{ $settings->port_usb ?? '' }}" placeholder="TM-T82">
                                    </div>
                                    <div class="input-field col s12 ip-address" style="display: @if ($settings->printer_type == 'LAN') block @else none @endif">
                                        <label for="printer_port">IP Address</label>
                                        <input id="ip_address" type="text" name="ip_address"
                                            value="{{ $settings->ip_address ?? '' }}" placeholder="192.169.0.0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit"
                                            name="but_upload">
                                            Simpan<i class="mdi-action-swap-vert left"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">

                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Video</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <div class="col m2" style="width:103px;height:60px;">
                                @if ($settings->video != '-')
                                    <form class="hapusvideo" action="{{ route('hapus_video') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type='hidden' id='video' name='video' value="-" />
                                        <input type='hidden' id='videohap' name='videohap'
                                            value="{{ $settings->video }}" />
                                        <button class="btn-floating btn-action waves-effect waves-light red" type="submit"><i
                                                class="mdi-action-delete"></i></button>
                                    </form>
                                    <video width="100" preload="auto"
                                        src="{{ asset('assets/video') }}/{{ $settings->video }}"></video>
                                @else
                                    <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100">
                                @endif

                            </div>

                            <div class="col m2" style="width:103px;height:60px;">
                                @if ($settings->video1 != '-')
                                    <form class="hapusvideo" action="{{ route('hapus_video1') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type='hidden' id='video1' name='video1' value="-" />
                                        <input type='hidden' id='video1hap' name='video1hap'
                                            value="{{ $settings->video1 }}" />
                                        <button class="btn-floating btn-action waves-effect waves-light red" type="submit"><i
                                                class="mdi-action-delete"></i></button>
                                    </form>
                                    <video width="100" preload="auto"
                                        src="{{ asset('assets/video') }}/{{ $settings->video1 }}"></video>
                                @else
                                    <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100">
                                @endif
                            </div>

                            <div class="col m2" style="width:103px;height:60px;">
                                @if ($settings->video2 != '-')
                                    <form class="hapusvideo" action="{{ route('hapus_video2') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type='hidden' id='video2' name='video2' value="-" />
                                        <input type='hidden' id='video2hap' name='video2hap'
                                            value="{{ $settings->video2 }}" />
                                        <button class="btn-floating btn-action waves-effect waves-light red" type="submit"><i
                                                class="mdi-action-delete"></i></button>
                                    </form>
                                    <video width="100" preload="auto"
                                        src="{{ asset('assets/video') }}/{{ $settings->video2 }}"></video>
                                @else
                                    <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100">
                                @endif
                            </div>

                            <div class="col m2" style="width:103px;height:60px;">
                                @if ($settings->video3 != '-')
                                    <form class="hapusvideo" action="{{ route('hapus_video3') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type='hidden' id='video3' name='video3' value="-" />
                                        <input type='hidden' id='video3hap' name='video3hap'
                                            value="{{ $settings->video3 }}" />
                                        <button class="btn-floating btn-action waves-effect waves-light red" type="submit"><i
                                                class="mdi-action-delete"></i></button>
                                    </form>
                                    <video width="100" preload="auto"
                                        src="{{ asset('assets/video') }}/{{ $settings->video3 }}"></video>
                                @else
                                    <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100">
                                @endif
                            </div>

                            <div class="col m2" style="width:103px;height:60px;">
                                @if ($settings->video4 != '-')
                                    <form class="hapusvideo" action="{{ route('hapus_video4') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type='hidden' id='video4' name='video4' value="-" />
                                        <input type='hidden' id='video4hap' name='video4hap'
                                            value="{{ $settings->video4 }}" />
                                        <button class="btn-floating btn-action waves-effect waves-light red" type="submit"><i
                                                class="mdi-action-delete"></i></button>
                                    </form>
                                    <video width="100" preload="auto"
                                        src="{{ asset('assets/video') }}/{{ $settings->video4 }}"></video>
                                @else
                                    <img src="{{ asset('assets/images') }}/nosignal.jpg" width="100">
                                @endif
                            </div>

                            <form id="video" action="{{ route('post_video') }}" method="post"
                                enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        Video 1* <input type="file" name="file1">
                                        @if ($settings->video != '')
                                            <input type='hidden' id='video' name='video'
                                                value="{{ $settings->video }}" />
                                        @else
                                            <input type='hidden' id='video' name='video' value="-" />
                                        @endif
                                    </div>
                                    <div class="input-field col s12">
                                        Video 2* <input type="file" name="file2">
                                        @if ($settings->video1 != '')
                                            <input type='hidden' id='video' name='video1'
                                                value="{{ $settings->video1 }}" />
                                        @else
                                            <input type='hidden' id='video' name='video1' value="-" />
                                        @endif
                                    </div>
                                    <div class="input-field col s12">
                                        Video 3* <input type="file" name="file3">
                                        @if ($settings->video2 != '')
                                            <input type='hidden' id='video2' name='video2'
                                                value="{{ $settings->video2 }}" />
                                        @else
                                            <input type='hidden' id='video2' name='video2' value="-" />
                                        @endif
                                    </div>
                                    <div class="input-field col s12">
                                        Video 4* <input type="file" name="file4">
                                        @if ($settings->video3 != '')
                                            <input type='hidden' id='video3' name='video3'
                                                value="{{ $settings->video3 }}" />
                                        @else
                                            <input type='hidden' id='video3' name='video3' value="-" />
                                        @endif
                                    </div>
                                    <div class="input-field col s12">
                                        Video 5* <input type="file" name="file5">
                                        @if ($settings->video4 != '')
                                            <input type='hidden' id='video4' name='video4'
                                                value="{{ $settings->video4 }}" />
                                        @else
                                            <input type='hidden' id='video4' name='video4' value="-" />
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit" name="but_upload">
                                            Simpan<i class="mdi-action-swap-vert left"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="col s12 m6">

                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Banner/Gambar Background</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <div class="col m2" style="width:103px;height:60px;">
                                @if ($settings->background != '-')
                                    <form class="hapusvideo" action="{{ route('hapus_background') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type='hidden' id='background' name='background' value="-" />
                                        <input type='hidden' id='backgroundhap' name='backgroundhap'
                                            value="{{ $settings->background }}" />
                                        <button class="btn-floating btn-action waves-effect waves-light red" type="submit"><i
                                                class="mdi-action-delete"></i></button>
                                    </form>
                                    <img src="{{ asset('assets/images') }}/{{ $settings->background }}" width="100">
                                @else
                                    <img src="{{ asset('assets/images') }}/noimage.jpg" width="70">
                                @endif

                            </div>

                            <div class="col m2" style="width:103px;height:60px;">
                                @if ($settings->banner != '-')
                                    <form class="hapusvideo" action="{{ route('hapus_banner') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type='hidden' id='banner' name='banner' value="-" />
                                        <input type='hidden' id='bannerhap' name='bannerhap'
                                            value="{{ $settings->banner }}" />
                                        <button class="btn-floating btn-action waves-effect waves-light red" type="submit"><i
                                                class="mdi-action-delete"></i></button>
                                    </form>
                                    <img src="{{ asset('assets/images') }}/{{ $settings->banner }}" width="100">
                                @else
                                    <img src="{{ asset('assets/images') }}/noimage.jpg" width="70">
                                @endif
                            </div>

                            <form id="video" action="{{ route('post_gambar') }}" method="post"
                                enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <div class="input-field col s12">
                                    Background* <input type="file" name="filebackground">
                                    @if ($settings->background != '')
                                        <input type='hidden' id='background' name='background'
                                            value="{{ $settings->background }}" />
                                    @else
                                        <input type='hidden' id='background' name='background' value="-" />
                                    @endif
                                </div>
                                <div class="input-field col s12">
                                    Banner Iklan* <input type="file" name="filebanner">
                                    @if ($settings->banner != '')
                                        <input type='hidden' id='banner' name='banner'
                                            value="{{ $settings->banner }}" />
                                    @else
                                        <input type='hidden' id='banner' name='banner' value="-" />
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit"
                                            name="but_upload_gambar">
                                            Simpan<i class="mdi-action-swap-vert left"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">Reset Data</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <p>Ini akan menghapus semua data antrian, termasuk antrian yaang sudah dan belum dipanggil! </p>
                            <form action="{{ route('reset') }}" method="post">
                                {{ csrf_field() }}
                                <button class="btn waves-effect waves-light orange right" type="submit"
                                    name="but_upload_gambar">
                                    Reset<i class="mdi-action-delete left"></i>
                                </button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection

@section('script')
    <script>

        function selectPrinterType () {
            var type = $('#printer_type').val();
            if (type == 'USB') {
                $('.port-usb').show();
                $('.ip-address').hide();
            } else {
                $('.port-usb').hide();
                $('.ip-address').show();
            }
        }

        $("#account").validate({
            rules: {
                name: {
                    required: true
                },
                username: {
                    required: true,
                    minlength: 6
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 6
                },
                password_confirmation: {
                    minlength: 6,
                    equalTo: "#password"
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
        @can('access', $settings)
            $("#company").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        email: true
                    }
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
            $("#overmissed").validate({
                rules: {
                    over_time: {
                        required: true,
                        digits: true
                    },
                    missed_time: {
                        required: true,
                        digits: true
                    }
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
            $("#video").validate({
                ules: {
                    video: {
                        required: true
                    }
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
            $("#languagefrm").validate({
                rules: {
                    language: {
                        required: true,
                        digits: true
                    }
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
        @endcan
    </script>
@endsection

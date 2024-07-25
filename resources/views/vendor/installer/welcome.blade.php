@extends('vendor.installer.layouts.master')

@section('title', trans('messages.welcome.title'))
@section('container')
    <p class="paragraph">Fitur terbaru antrian v3.0.0 :<p>
    	<ul style="font-size:16px;">
    <li>Dashboard</li>
    <li>Display antrian (tampilan Elegan)</li>
    <li>Pemanggil antrian android (Caller)</li>
    <li>1 Staf 1 loket/counter</li>
    <li>Desain tampilan sesuai keinginan</li>
    <li>Login per staf/loket/counter</li>
    <li>1 Layanan bisa beberapa loket/counter</li>
    <li>Print antrian cepat</li>
    <li>Suara antrian bisa disesuaikan</li>
    <li>Video player (Bisa tambahkan 5 video)</li>
    <li>Teks berjalan</li>
    <li>Laporan</li>

</ul>
    	
    <div class="buttons">
        <a href="{{ route('LaravelInstaller::environment') }}" class="button">{{ trans('messages.next') }}</a>
    </div>
@stop
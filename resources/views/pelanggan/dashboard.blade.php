@extends('layouts.pelanggan')

@section('content')
    <h3>Dashboard Pelanggan</h3>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <div class="alert alert-info">
        Ini adalah dashboard khusus pelanggan.
    </div>
@endsection

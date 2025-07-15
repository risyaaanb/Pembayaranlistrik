@extends('layouts.admin')

@section('content')
    <h3>Dashboard Admin</h3>
    <p>Halo {{ auth()->user()->name }}, selamat datang di admin panel.</p>
@endsection
@extends('layouts.pelanggan')

@section('content')
    <h4 class="mb-3">Profil Saya</h4>

    <div class="card">
        <div class="card-body">
            <h5>Informasi Akun</h5>
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            <hr>

            <h5>Data Pelanggan</h5>
            @if ($user->pelanggan)
                <p><strong>Nama Pelanggan:</strong> {{ $user->pelanggan->nama }}</p>
                <p><strong>Alamat:</strong> {{ $user->pelanggan->alamat }}</p>
                <p><strong>Nomor Meteran:</strong> {{ $user->pelanggan->nomor_meteran }}</p>
            @else
                <div class="alert alert-warning">
                    Data pelanggan belum tersedia.
                </div>
            @endif
        </div>
    </div>
@endsection

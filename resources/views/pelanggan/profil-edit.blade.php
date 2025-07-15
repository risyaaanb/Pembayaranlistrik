@extends('layouts.pelanggan')

@section('content')
    <h3 class="mb-4">Edit Profil</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pelanggan.profil.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $pelanggan->alamat ?? '') }}" required>

        </div>

        <div class="mb-3">
            <label>Nomor Meteran</label>
            <input type="text" name="nomor_meteran" class="form-control" value="{{ old('nomor_meteran', $pelanggan->nomor_meteran ?? '') }}" required>

        </div>

        <div class="mb-3">
            <label>Password Baru <small class="text-muted">(Opsional)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection

@extends('layouts.pelanggan')

@section('content')
    <h3>Tambah Pelanggan</h3>

    <form action="{{ url('/admin/pelanggan') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="nomor_meteran" class="form-label">Nomor Meteran</label>
            <input type="text" name="nomor_meteran" class="form-control" value="{{ old('nomor_meteran') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('/admin/pelanggan') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection

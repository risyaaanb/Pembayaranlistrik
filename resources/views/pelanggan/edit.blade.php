@extends('layouts.pelanggan')

@section('content')
<h3>Edit Pelanggan</h3>

<form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $pelanggan->nama }}" required>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" required>{{ $pelanggan->alamat }}</textarea>
    </div>

    <div class="mb-3">
        <label for="nomor_meteran" class="form-label">Nomor Meteran</label>
        <input type="text" name="nomor_meteran" class="form-control" value="{{ $pelanggan->nomor_meteran }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection

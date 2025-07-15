@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Pembayaran</h3>

    <div class="card p-4 shadow-sm">
        <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="penggunaan_listrik_id" class="form-label">Penggunaan</label>
                <select name="penggunaan_listrik_id" id="penggunaan_listrik_id" class="form-select">
                    @foreach ($penggunaan as $p)
                        <option value="{{ $p->id }}"
                            {{ $pembayaran->penggunaan_listrik_id == $p->id ? 'selected' : '' }}>
                            {{ $p->pelanggan->nama }} - {{ $p->bulan }}/{{ $p->tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control"
                       value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar) }}">
            </div>

            <div class="mb-3">
                <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control"
                       value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}">
            </div>

            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="form-control"
                       value="{{ old('metode_pembayaran', $pembayaran->metode_pembayaran) }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

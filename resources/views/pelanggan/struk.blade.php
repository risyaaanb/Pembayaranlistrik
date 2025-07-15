@extends('layouts.pelanggan')

@section('content')
    <h3 class="mb-4">Struk Pembayaran</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $pembayaran->penggunaan->pelanggan->nama }}</p>
            <p><strong>Nomor Meteran:</strong> {{ $pembayaran->penggunaan->pelanggan->nomor_meteran }}</p>
            <p><strong>Bulan:</strong> {{ $pembayaran->penggunaan->bulan }}</p>
            <p><strong>Tahun:</strong> {{ $pembayaran->penggunaan->tahun }}</p>
            <p><strong>Jumlah KWH:</strong> {{ $pembayaran->penggunaan->jumlah_kwh }}</p>
            <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($pembayaran->jumlah_bayar) }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode_pembayaran }}</p>
            <p><strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y H:i') }}</p>

            <hr>

            <a href="{{ route('pelanggan.riwayat') }}" class="btn btn-secondary">← Kembali ke Riwayat</a>
            <button onclick="window.print()" class="btn btn-primary">🖨 Cetak Struk</button>
        </div>
    </div>
@endsection

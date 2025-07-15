@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tagihan Belum Dibayar</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>No. Meteran</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Jumlah KWH</th>
                    <th>Estimasi Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tagihan as $t)
                    <tr>
                        <td>{{ $t->pelanggan->nama }}</td>
                        <td>{{ $t->pelanggan->nomor_meteran }}</td>
                        <td>{{ $t->bulan }}</td>
                        <td>{{ $t->tahun }}</td>
                        <td>{{ $t->jumlah_kwh }} kWh</td>
                        <td>Rp {{ number_format($t->jumlah_kwh * 1500) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada tagihan yang belum dibayar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

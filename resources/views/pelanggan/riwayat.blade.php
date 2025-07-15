@extends('layouts.pelanggan')

@section('content')
    <h3 class="mb-4">Riwayat Pembayaran</h3>

    @if ($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada riwayat pembayaran.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah KWH</th>
                        <th>Jumlah Bayar</th>
                        <th>Tanggal Bayar</th>
                        <th>Metode Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $r)
                        <tr>
                            <td>{{ $r->bulan }}</td>
                            <td>{{ $r->tahun }}</td>
                            <td>{{ $r->jumlah_kwh }}</td>
                            <td>Rp {{ number_format($r->pembayaran->jumlah_bayar ?? 0) }}</td>
                            <td>{{ \Carbon\Carbon::parse($r->pembayaran->tanggal_bayar ?? null)->format('d-m-Y') }}</td>
                            <td>{{ $r->pembayaran->metode_pembayaran ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

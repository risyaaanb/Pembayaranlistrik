@extends('layouts.pelanggan')

@section('content')
    <h3 class="mb-4">Tagihan Bulan Ini</h3>

    @if ($penggunaan->isEmpty())
        <div class="alert alert-info">Belum ada tagihan yang harus dibayar.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Jumlah KWH</th>
                    <th>Total Tagihan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penggunaan as $p)
                    <tr>
                        <td>{{ $p->bulan }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>{{ $p->jumlah_kwh }}</td>
                        <td>Rp {{ number_format($p->tagihan) }}</td>
                        <td>
                            <a href="{{ route('pelanggan.bayar', $p->id) }}" class="btn btn-sm btn-primary">Bayar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

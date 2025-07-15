@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">Data Pembayaran</h3>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tombol Tambah --}}
    <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Pembayaran
    </a>

    {{-- Tabel Pembayaran --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>No. Meteran</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Bayar</th>
                    <th>Metode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $p)
                    <tr>
                        <td>{{ $p->penggunaan->pelanggan->nama ?? '-' }}</td>
                        <td>{{ $p->penggunaan->pelanggan->nomor_meteran ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_bayar)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar) }}</td>
                        <td>{{ $p->metode_pembayaran ?? '-' }}</td>
                        <td>
                            <a href="{{ route('pembayaran.edit', $p->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('pembayaran.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

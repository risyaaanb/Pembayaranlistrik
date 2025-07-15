@extends('layouts.pelanggan')

@section('content')
    <h4>Form Pembayaran</h4>

    <div class="card">
        <div class="card-body">
            <p><strong>Bulan:</strong> {{ \Carbon\Carbon::create()->month($penggunaan->bulan)->format('F') }}</p>
            <p><strong>Tahun:</strong> {{ $penggunaan->tahun }}</p>
            <p><strong>Jumlah KWH:</strong> {{ $penggunaan->jumlah_kwh }}</p>

            {{-- Simulasi form --}}
            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Metode Pembayaran</label>
                    <select class="form-select" name="metode_pembayaran">
                        <option value="transfer">Transfer</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
            </form>
        </div>
    </div>
@endsection

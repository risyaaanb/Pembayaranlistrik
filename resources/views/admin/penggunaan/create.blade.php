@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Penggunaan Listrik</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penggunaan.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="pelanggan_id" class="block font-medium mb-1">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="w-full border-gray-300 rounded shadow-sm" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->nomor_meteran }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="bulan" class="block font-medium mb-1">Bulan</label>
            <input type="number" name="bulan" id="bulan" class="w-full border-gray-300 rounded shadow-sm" min="1" max="12" required>
        </div>

        <div class="mb-4">
            <label for="tahun" class="block font-medium mb-1">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="w-full border-gray-300 rounded shadow-sm" min="2020" required>
        </div>

        <div class="mb-4">
            <label for="jumlah_kwh" class="block font-medium mb-1">Jumlah KWH</label>
            <input type="number" name="jumlah_kwh" id="jumlah_kwh" class="w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('penggunaan.index') }}" class="text-gray-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection

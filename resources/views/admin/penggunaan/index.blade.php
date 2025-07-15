@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Data Penggunaan Listrik</h1>
        <a href="{{ route('penggunaan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('penggunaan.index') }}" method="GET" class="mb-4 flex flex-wrap gap-4 items-center">
    <div>
        <label for="bulan" class="block text-sm">Bulan</label>
        <select name="bulan" id="bulan" class="border rounded px-2 py-1">
            <option value="">Semua</option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                </option>
            @endfor
        </select>
    </div>

    <div>
        <label for="tahun" class="block text-sm">Tahun</label>
        <input type="number" name="tahun" id="tahun" value="{{ request('tahun') }}" class="border rounded px-2 py-1">
    </div>

    <div class="pt-6">
        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Filter</button>
        <a href="{{ route('penggunaan.index') }}" class="text-sm text-gray-600 ml-2">Reset</a>
    </div>
</form>
<a href="{{ url('/admin/penggunaan/export/excel?' . http_build_query(request()->only('bulan', 'tahun'))) }}"
   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
    Export Excel
</a>


    @if ($penggunaan->isEmpty())
        <div class="text-gray-600">Belum ada data penggunaan listrik.</div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border">#</th>
                    <th class="py-2 px-4 border">Nama Pelanggan</th>
                    <th class="py-2 px-4 border">Bulan</th>
                    <th class="py-2 px-4 border">Tahun</th>
                    <th class="py-2 px-4 border">Jumlah KWH</th>
                    <th class="py-2 px-4 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penggunaan as $item)
                    <tr class="text-center">
                        <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border">{{ $item->pelanggan->nama }}</td>
                        <td class="py-2 px-4 border">{{ $item->bulan }}</td>
                        <td class="py-2 px-4 border">{{ $item->tahun }}</td>
                        <td class="py-2 px-4 border">{{ $item->jumlah_kwh }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('penggunaan.edit', $item->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded mr-1">
                                Edit
                            </a>
                            <form action="{{ route('penggunaan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

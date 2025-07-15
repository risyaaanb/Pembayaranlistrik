@extends('layouts.app')

@section('content')
<a href="{{ route('rekap.kwh') }}" class="block py-2.5 px-4 hover:bg-gray-700 rounded">
    Rekap KWH
</a>

<div class="max-w-4xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Rekap Total KWH per Pelanggan</h2>

    <form method="GET" class="flex gap-4 items-end mb-4">
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
            <input type="number" name="tahun" id="tahun" class="border rounded px-2 py-1"
                   value="{{ request('tahun') }}">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Pelanggan</th>
                    <th class="px-4 py-2">Nomor Meteran</th>
                    <th class="px-4 py-2">Total KWH</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $row)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $row['nama'] }}</td>
                        <td class="px-4 py-2 text-center">{{ $row['nomor_meteran'] }}</td>
                        <td class="px-4 py-2 text-center">{{ $row['total_kwh'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

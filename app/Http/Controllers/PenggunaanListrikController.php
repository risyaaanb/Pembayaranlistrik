<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\PenggunaanListrik;
use Illuminate\Http\Request;

class PenggunaanListrikController extends Controller
{
    /**
     * Tampilkan daftar penggunaan listrik dengan filter bulan/tahun.
     */
    public function index(Request $request)
    {
        $query = PenggunaanListrik::with('pelanggan');

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $penggunaan = $query->orderByDesc('tahun')->orderByDesc('bulan')->get();

        return view('admin.penggunaan.index', compact('penggunaan'));
    }

    /**
     * Tampilkan form tambah penggunaan.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('admin.penggunaan.create', compact('pelanggan'));
    }

    /**
     * Simpan data penggunaan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'jumlah_kwh' => 'required|integer|min:0',
        ]);

        PenggunaanListrik::create($request->all());

        return redirect('/admin/penggunaan')->with('success', 'Data penggunaan berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit penggunaan.
     */
    public function edit(string $id)
    {
        $penggunaan = PenggunaanListrik::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('admin.penggunaan.edit', compact('penggunaan', 'pelanggan'));
    }

    /**
     * Update data penggunaan.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'jumlah_kwh' => 'required|integer|min:0',
        ]);

        $penggunaan = PenggunaanListrik::findOrFail($id);
        $penggunaan->update($request->all());

        return redirect('/admin/penggunaan')->with('success', 'Data penggunaan berhasil diperbarui!');
    }

    /**
     * Hapus data penggunaan.
     */
    public function destroy(string $id)
    {
        $penggunaan = PenggunaanListrik::findOrFail($id);
        $penggunaan->delete();

        return redirect('/admin/penggunaan')->with('success', 'Data penggunaan berhasil dihapus!');
    }

    /**
     * Tampilkan rekap total KWH per pelanggan.
     */
    public function rekap(Request $request)
    {
        $query = Pelanggan::with(['penggunaan' => function ($q) use ($request) {
            if ($request->filled('tahun')) {
                $q->where('tahun', $request->tahun);
            }
            if ($request->filled('bulan')) {
                $q->where('bulan', $request->bulan);
            }
        }])->get();

        $data = $query->map(function ($p) {
            return [
                'nama' => $p->nama,
                'nomor_meteran' => $p->nomor_meteran,
                'total_kwh' => $p->penggunaan->sum('jumlah_kwh'),
            ];
        });

        return view('admin.penggunaan.rekap', [
            'data' => $data,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
    }
}

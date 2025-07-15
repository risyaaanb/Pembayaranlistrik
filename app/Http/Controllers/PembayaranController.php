<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PenggunaanListrik;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('penggunaan.pelanggan')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua penggunaan listrik yang belum ada pembayaran
        $penggunaan = PenggunaanListrik::doesntHave('pembayaran')->with('pelanggan')->get();

        return view('admin.pembayaran.create', compact('penggunaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'penggunaan_listrik_id' => 'required|exists:penggunaan_listrik,id',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|integer|min:0',
            'metode_pembayaran' => 'nullable|string|max:50',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $pembayaran = Pembayaran::findOrFail($id);
        $penggunaan = PenggunaanListrik::with('pelanggan')->get();

        return view('admin.pembayaran.edit', compact('pembayaran', 'penggunaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'penggunaan_listrik_id' => 'required|exists:penggunaan_listrik,id',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|integer|min:0',
            'metode_pembayaran' => 'nullable|string|max:50',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran dihapus.');
    
    }
}

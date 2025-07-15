<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nama'           => 'required|string|max:255',
            'alamat'         => 'required|string|max:255',
            'nomor_meteran'  => 'required|string|max:50|unique:pelanggan,nomor_meteran',
        ]);

        Pelanggan::create([
            'nama'           => $request->nama,
            'alamat'         => $request->alamat,
            'nomor_meteran'  => $request->nomor_meteran,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
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
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'nomor_meteran' => 'required|string|unique:pelanggan,nomor_meteran,' . $id,
    ]);

    $pelanggan = Pelanggan::findOrFail($id);
    $pelanggan->update($request->all());

    return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $pelanggan = Pelanggan::findOrFail($id);
    $pelanggan->delete();

    return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}



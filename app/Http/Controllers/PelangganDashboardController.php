<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\PenggunaanListrik;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PelangganDashboardController extends Controller
{
    public function dashboard()
    {
        $pelanggan = auth()->user()->pelanggan;

    // Tambahkan penggunaan otomatis jika belum ada
    if ($pelanggan && $pelanggan->penggunaan->isEmpty()) {
        \App\Models\PenggunaanListrik::create([
            'pelanggan_id' => $pelanggan->id,
            'bulan' => now()->month,
            'tahun' => now()->year,
            'jumlah_kwh' => 123,
        ]);
    }

    return view('pelanggan.dashboard');
    }

    public function tagihan()
    {
       $pelanggan = auth()->user()->pelanggan;

    if (!$pelanggan) {
        return redirect()->route('dashboard')->with('error', 'Data pelanggan tidak ditemukan.');
    }

    // Ambil penggunaan listrik yang belum dibayar
    $penggunaan = $pelanggan->penggunaan()->doesntHave('pembayaran')->get();

    return view('pelanggan.tagihan', compact('penggunaan'));
    }

    public function riwayat()
    {
        $pelanggan = auth()->user()->pelanggan;

        if (!$pelanggan) {
            return redirect()->route('dashboard')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $riwayat = PenggunaanListrik::with('pembayaran')
            ->where('pelanggan_id', $pelanggan->id)
            ->whereHas('pembayaran')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        return view('pelanggan.riwayat', compact('riwayat'));
    }

    public function bayar($id)
    {
        $penggunaan = PenggunaanListrik::with('pelanggan')->findOrFail($id);

        if ($penggunaan->pelanggan->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('pelanggan.bayar', compact('penggunaan'));
    }

    public function storePembayaran(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        $penggunaan = PenggunaanListrik::with('pelanggan')->findOrFail($id);

        if ($penggunaan->pelanggan->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        Pembayaran::create([
            'penggunaan_listrik_id' => $penggunaan->id,
            'tanggal_bayar' => Carbon::now(),
            'jumlah_bayar' => $penggunaan->jumlah_kwh * 1500, // tarif per kWh
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('pelanggan.tagihan')->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function profil()
    {
        $user = auth()->user();
        return view('pelanggan.profil', compact('user'));
    }

    public function editProfil()
    {
        $user = auth()->user();
        $pelanggan = $user->pelanggan;

        return view('pelanggan.profil-edit', compact('user', 'pelanggan'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        $pelanggan = $user->pelanggan;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string|max:255',
            'nomor_meteran' => 'required|string|max:50',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // update user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        dd($user);
        $user->save();

        // update pelanggan
        $pelanggan->alamat = $request->alamat;
        $pelanggan->nomor_meteran = $request->nomor_meteran;
        $pelanggan->save();

        return redirect()->route('pelanggan.profil.edit')->with('success', 'Profil berhasil diperbarui!');
    }
    public function struk($id)
{
    $pembayaran = \App\Models\Pembayaran::with('penggunaan.pelanggan')->findOrFail($id);

    // Cek apakah pembayaran ini milik user yang sedang login
    if ($pembayaran->penggunaan->pelanggan->user_id !== auth()->id()) {
        abort(403, 'Akses ditolak.');
    }

    return view('pelanggan.struk', compact('pembayaran'));
}

}

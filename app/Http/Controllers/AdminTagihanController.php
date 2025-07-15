<?php

namespace App\Http\Controllers;

use App\Models\PenggunaanListrik;
use Illuminate\Http\Request;

class AdminTagihanController extends Controller
{
      public function index()
    {
        $tagihan = PenggunaanListrik::with('pelanggan')
            ->doesntHave('pembayaran') // belum dibayar
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        return view('admin.tagihan.index', compact('tagihan'));
    }
}

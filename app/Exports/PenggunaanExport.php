<?php

namespace App\Exports;

use App\Models\PenggunaanListrik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenggunaanExport implements FromCollection, WithHeadings
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = PenggunaanListrik::with('pelanggan');

        if ($this->bulan) {
            $query->where('bulan', $this->bulan);
        }

        if ($this->tahun) {
            $query->where('tahun', $this->tahun);
        }

        return $query->get()->map(function ($item) {
            return [
                'Nama Pelanggan' => $item->pelanggan->nama,
                'Bulan' => $item->bulan,
                'Tahun' => $item->tahun,
                'Jumlah KWH' => $item->jumlah_kwh,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Pelanggan', 'Bulan', 'Tahun', 'Jumlah KWH'];
    }
}
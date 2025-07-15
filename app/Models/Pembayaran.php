<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';

    protected $fillable = [
        'penggunaan_listrik_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode_pembayaran',
    ];
     public function penggunaan()
    {
        return $this->belongsTo(\App\Models\PenggunaanListrik::class, 'penggunaan_listrik_id');
    }

}


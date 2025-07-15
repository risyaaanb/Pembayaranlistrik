<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanListrik extends Model
{
    use HasFactory;
    protected $table = 'penggunaan_listrik';

    protected $fillable = ['pelanggan_id', 'bulan', 'tahun', 'jumlah_kwh'];


public function pelanggan()
{
    return $this->belongsTo(\App\Models\Pelanggan::class, 'pelanggan_id');
}

    public function pembayaran()
{
    return $this->hasOne(\App\Models\Pembayaran::class);
}
public function getTagihanAttribute()
{
    return $this->jumlah_kwh * 1500;
}

}

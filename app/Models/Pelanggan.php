<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model

{
    public function user()
{
    return $this->belongsTo(User::class);
}
    use HasFactory;
    protected $table = 'pelanggan';
     protected $fillable = ['nama', 'alamat', 'nomor_meteran', 'user_id'];
     
public function penggunaan()
{
    return $this->hasMany(\App\Models\PenggunaanListrik::class);
}
}
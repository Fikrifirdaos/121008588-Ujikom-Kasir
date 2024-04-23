<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_date',
        'total',
        'pelanggan_id'
    ];

    public function Pelanggan(){
        return $this->belongsTo(Pelanggans::class);
    }

    public function DetailPenjualan()
    {
        return $this->hasOne(DetailPenjualan::class);
    }
    public function Produk()
    {
        return $this->belongsTo(Produks::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'produk_total',
        'subtotal'
    ];


    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produks::class, 'produk_id');
    }
    
}

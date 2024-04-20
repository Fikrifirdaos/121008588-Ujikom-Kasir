<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_sale',
        'total',
        'pelanggan_id'
    ];

    public function pelanggan(){
        return $this->hasMany(Pelanggans::class);
    }

    public function detailProduk(){
        return $this->hasMany(DetailPenjualan::class);
    }
}

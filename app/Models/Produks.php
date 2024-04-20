<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produks extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_produk',
        'stock',
        'price',
        'code'
    ];

    public function detailPenjualan(){
        return $this->hasMany(DetailPenjualan::class);
    }
}

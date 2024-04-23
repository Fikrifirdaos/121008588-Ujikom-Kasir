<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggans extends Model
{
    use HasFactory;
    protected $fillable = ([
        'name_staff',
        'address',
        'no_hp'
    ]);

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

}

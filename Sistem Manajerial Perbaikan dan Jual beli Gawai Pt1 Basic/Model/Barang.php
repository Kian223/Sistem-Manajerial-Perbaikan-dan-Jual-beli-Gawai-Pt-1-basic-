<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kd_barang';
    public $timestamps = false;
    protected $fillable = [
        'nama_barang',
        'merek'
    ];

    public function varian()
    {
        return $this->hasMany(BarangVarian::class, 'kd_barang');
    }
}

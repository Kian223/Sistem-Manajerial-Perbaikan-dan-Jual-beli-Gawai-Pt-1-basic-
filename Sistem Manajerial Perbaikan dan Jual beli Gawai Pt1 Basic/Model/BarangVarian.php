<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangVarian extends Model
{
    protected $table = 'barang_varian';
    protected $primaryKey = 'id_varian';
    public $timestamps = false;
    protected $fillable = [
        'kd_barang',
        'ram',
        'harga',
        'stok'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kd_barang');
    }
}

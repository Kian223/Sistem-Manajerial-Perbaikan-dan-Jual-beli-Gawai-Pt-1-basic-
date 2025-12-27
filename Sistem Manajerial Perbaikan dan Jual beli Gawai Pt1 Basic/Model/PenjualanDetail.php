<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PenjualanDetail extends Model
{
    protected $table = 'penjualan_detail';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_penjualan',
        'kd_barang',
        'id_varian',
        'jumlah',
        'harga',
        'imei',
        'garansi_sampai'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kd_barang');
    }

    public function varian()
    {
        return $this->belongsTo(BarangVarian::class, 'id_varian');
    }
}

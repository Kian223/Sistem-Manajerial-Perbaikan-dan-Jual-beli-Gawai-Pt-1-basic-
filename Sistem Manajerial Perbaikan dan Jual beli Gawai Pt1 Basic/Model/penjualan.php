<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'tanggal',
        'total_harga'
    ];

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id_service';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'id_master_service',
        'imei',
        'tanggal_masuk',
        'tanggal_selesai',
        'garansi_sampai',
        'status',
        'total_biaya'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function masterService()
    {
        return $this->belongsTo(MasterService::class, 'id_master_service');
    }
}

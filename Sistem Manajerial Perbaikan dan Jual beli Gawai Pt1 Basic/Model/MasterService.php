<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterService extends Model
{
    protected $table = 'master_service';
    protected $primaryKey = 'id_master_service';
    public $timestamps = false;

    protected $fillable = [
        'nama_service',
        'harga'
    ];
}

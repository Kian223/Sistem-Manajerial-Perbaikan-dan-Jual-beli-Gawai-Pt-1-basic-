<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    public $timestamps = false;
    protected $fillable = [
        'kode_customer',
        'nama',
        'kontak',
        'alamat'
    ];
}


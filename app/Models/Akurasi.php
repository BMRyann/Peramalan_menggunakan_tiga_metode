<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akurasi extends Model
{
    use HasFactory;
    protected $table = 'akurasi';
    protected $primaryKey = 'id_akurasi';
    public $timestamps = false;

    protected $fillable = [
        'metode_peramalan',
        'mape',
        'mad',
        'mse',
        'kategori_mape',
        'id_peramalan'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peramalan extends Model
{
    use HasFactory;

    protected $table = 'peramalan';
    protected $primaryKey = 'id_peramalan';
    public $timestamps = false;


    protected $fillable = [
        'id_siswa',
        'tahun',
        'CF',
        'SES',
        'regresi_linier',
        'id_user'
    ];
}

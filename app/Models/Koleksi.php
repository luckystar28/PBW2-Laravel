<?php

namespace App\Models;
/**
 * Togi Samuel Simarmata
 * 6706223067
 * D3 RPLA 46-03
 */
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;

    protected $table = 'koleksi';

    protected $fillable = [
        'namaKoleksi',
        'jenisKoleksi',
        'jumlahKoleksi',
        'jumlahKeluar',
        'jumlahSisa'
    ];
}

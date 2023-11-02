<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'userIdPetugas',
        'userIdPeminjaman',
        'tanggalPinjam',
        'tanggalSelesai',
    ];

    // Definisikan relasi ke DetailTransaction jika ada
    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $table = 'detail_transactions';
    protected $fillable = [
        'id',
        'transaction_id',
        'collection_id',
        'tanggal_kembali',
        'status',
        'keterangan',
        // tambahkan kolom-kolom lain yang sesuai
    ];

    // Definisikan relasi ke Transaction jika ada
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}

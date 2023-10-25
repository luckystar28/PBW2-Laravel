<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Nama     : Togi Samuel Simarmata
     * NIM      : 6706223067
     * Kelas    : D3RPLA-4603
     */
    public function up(): void
    {
        Schema::table('koleksi', function (Blueprint $table) {
            $table->integer('jumlahKeluar');
            $table->integer('jumlahSisa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koleksi', function (Blueprint $table) {
            //
        });
    }
};

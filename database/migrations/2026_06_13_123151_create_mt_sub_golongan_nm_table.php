<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mt_sub_golongan_nm', function (Blueprint $table) {
            $table->string('kode_sub_gol', 6);
            $table->string('nama_sub_golongan', 50);

            $table->primary(['kode_sub_gol'], 'pk_mt_sub_golongan_nm_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_sub_golongan_nm');
    }
};

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
        if (Schema::hasTable('lap_kunjungan_ok_temp')) {
            return;
        }

        Schema::create('lap_kunjungan_ok_temp', function (Blueprint $table) {
            $table->integer('kecil')->nullable();
            $table->integer('sedang')->nullable();
            $table->integer('besar')->nullable();
            $table->integer('besar_khusus')->nullable();
            $table->integer('umum')->nullable();
            $table->integer('BpjsPbi')->nullable();
            $table->integer('BpjsCob')->nullable();
            $table->integer('BpjsNonPbi')->nullable();
            $table->integer('BpjsKtngkrja')->nullable();
            $table->integer('jamkesda')->nullable();
            $table->integer('pt')->nullable();
            $table->integer('asuransi')->nullable();
            $table->integer('tglnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
            $table->string('kode_bagian', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_ok_temp');
    }
};

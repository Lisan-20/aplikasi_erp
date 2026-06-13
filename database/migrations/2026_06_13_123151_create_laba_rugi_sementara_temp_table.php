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
        if (Schema::hasTable('laba_rugi_sementara_temp')) {
            return;
        }

        Schema::create('laba_rugi_sementara_temp', function (Blueprint $table) {
            $table->string('kode_bagian', 10)->nullable();
            $table->string('nama_bagian', 20)->nullable();
            $table->decimal('nominal', 19, 4)->nullable();
            $table->string('acc_no', 8)->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('bulan')->nullable();
            $table->string('acc_type', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laba_rugi_sementara_temp');
    }
};

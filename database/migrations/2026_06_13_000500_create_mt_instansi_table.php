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
        if (Schema::hasTable('mt_instansi')) {
            return;
        }

        Schema::create('mt_instansi', function (Blueprint $table) {
            $table->integer('id_mt_instansi');
            $table->string('nama_instansi', 100)->nullable();
            $table->string('nm_klinik', 50)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->decimal('telp', 18, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_instansi');
    }
};

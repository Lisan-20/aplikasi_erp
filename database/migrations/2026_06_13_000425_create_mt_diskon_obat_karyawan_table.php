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
        if (Schema::hasTable('mt_diskon_obat_karyawan')) {
            return;
        }

        Schema::create('mt_diskon_obat_karyawan', function (Blueprint $table) {
            $table->increments('id_mt_diskon');
            $table->string('nama_diskon')->nullable();
            $table->decimal('diskon', 18, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_diskon_obat_karyawan');
    }
};

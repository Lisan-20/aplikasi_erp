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
        Schema::create('ks_mt_shift', function (Blueprint $table) {
            $table->increments('kode_shift');
            $table->string('nama_shift', 50);
            $table->time('dari_jam', 4)->nullable();
            $table->time('sampai_jam', 4)->nullable();
            $table->time('range_waktu_awal', 4)->nullable();
            $table->time('range_waktu_akhir', 4)->nullable();

            $table->primary(['kode_shift'], 'pk__ks_mt_shift__41255a6c');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ks_mt_shift');
    }
};

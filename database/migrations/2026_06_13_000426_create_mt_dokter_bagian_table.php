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
        if (Schema::hasTable('mt_dokter_bagian')) {
            return;
        }

        Schema::create('mt_dokter_bagian', function (Blueprint $table) {
            $table->increments('id_mt_dokter_bagian');
            $table->string('kode_dokter', 50)->nullable();
            $table->string('kd_bagian', 50)->nullable();
            $table->string('flag_potongan', 1)->nullable();

            $table->primary(['id_mt_dokter_bagian'], 'pk_mt_dokter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_dokter_bagian');
    }
};

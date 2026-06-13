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
        Schema::create('tc_sisa_makanan_kg', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tgl_hari_ini')->nullable();
            $table->decimal('pagi_jml_sisa', 19, 4)->nullable();
            $table->decimal('pagi_jml_pasien', 19, 4)->nullable();
            $table->integer('pagi_id_user')->nullable();
            $table->dateTime('pagi_tgl_entry')->nullable();
            $table->decimal('siang_jml_sisa', 19, 4)->nullable();
            $table->decimal('siang_jml_pasien', 19, 4)->nullable();
            $table->integer('siang_id_user')->nullable();
            $table->dateTime('siang_tgl_entry')->nullable();
            $table->decimal('sore_jml_sisa', 19, 4)->nullable();
            $table->decimal('sore_jml_pasien', 19, 4)->nullable();
            $table->integer('sore_id_user')->nullable();
            $table->dateTime('sore_tgl_entry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_sisa_makanan_kg');
    }
};

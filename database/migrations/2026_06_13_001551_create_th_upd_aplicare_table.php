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
        if (Schema::hasTable('th_upd_aplicare')) {
            return;
        }

        Schema::create('th_upd_aplicare', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_klas_bpjs', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('nama_bagian', 50)->nullable();
            $table->integer('jml_bed')->nullable();
            $table->integer('jml_kosong')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_upd_aplicare');
    }
};

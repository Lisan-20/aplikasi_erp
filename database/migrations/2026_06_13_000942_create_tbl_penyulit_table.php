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
        if (Schema::hasTable('tbl_penyulit')) {
            return;
        }

        Schema::create('tbl_penyulit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sewa_kamar')->nullable();
            $table->integer('jasa_dokter')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('referensi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_penyulit');
    }
};

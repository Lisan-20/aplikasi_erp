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
        Schema::create('tbl_update_tarif', function (Blueprint $table) {
            $table->increments('id_upd');
            $table->string('kode_bagian_update', 8)->nullable();
            $table->integer('flag')->nullable();
            $table->dateTime('tgl_update')->nullable();
            $table->integer('persen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_update_tarif');
    }
};

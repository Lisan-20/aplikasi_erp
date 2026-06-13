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
        Schema::create('tc_pemakaian_brg_nm', function (Blueprint $table) {
            $table->increments('id_tc_pemakaian');
            $table->string('kode_brg', 20)->nullable();
            $table->string('nama_brg', 200)->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->decimal('jumlah', 18)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemakaian_brg_nm');
    }
};

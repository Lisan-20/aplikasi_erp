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
        Schema::create('tc_peminjaman_status', function (Blueprint $table) {
            $table->increments('id_tc_peminjaman');
            $table->dateTime('tgl_pinjam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->text('als_pinjam')->nullable();
            $table->string('no_reg', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->dateTime('tgl_kembali')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('nama_peminjaman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_peminjaman_status');
    }
};

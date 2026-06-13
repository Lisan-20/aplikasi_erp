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
        Schema::create('tc_rekon_admisi', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->text('nama_obat')->nullable();
            $table->text('dosis')->nullable();
            $table->text('wk_pemberian')->nullable();
            $table->text('alasan')->nullable();
            $table->string('lanjut_ri', 50)->nullable();
            $table->text('lanjut_pulang')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_rekon_admisi');
    }
};

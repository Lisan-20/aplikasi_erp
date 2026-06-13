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
        Schema::create('tc_cppt', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->text('hp_s')->nullable();
            $table->text('instruksi')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->text('hp_o')->nullable();
            $table->text('hp_a')->nullable();
            $table->text('hp_p')->nullable();
            $table->text('hasil_kes')->nullable();
            $table->text('hasil_t')->nullable();
            $table->text('hasil_n')->nullable();
            $table->text('hasil_s')->nullable();
            $table->text('hasil_p')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('profesi', 50)->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cppt');
    }
};

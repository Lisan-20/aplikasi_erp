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
        if (Schema::hasTable('tc_hand_over_shift_detail')) {
            return;
        }

        Schema::create('tc_hand_over_shift_detail', function (Blueprint $table) {
            $table->increments('no_urut');
            $table->integer('kode_shift')->nullable();
            $table->integer('no_induk_kirim')->nullable();
            $table->integer('no_induk_terima')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('bag_pas', 50)->nullable();
            $table->integer('Id_per')->nullable();
            $table->integer('Id_dok')->nullable();
            $table->text('notes')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('dr_merawat')->nullable();
            $table->integer('no_urut_over')->nullable();
            $table->dateTime('dok_tgl_jam')->nullable();
            $table->text('dok_hp_s')->nullable();
            $table->text('dok_hp_o')->nullable();
            $table->text('dok_hp_a')->nullable();
            $table->text('dok_hp_p')->nullable();
            $table->text('dok_instruksi')->nullable();
            $table->dateTime('tgl_jam_per')->nullable();
            $table->text('hp_s')->nullable();
            $table->text('hp_o')->nullable();
            $table->text('hp_a')->nullable();
            $table->text('hp_p')->nullable();
            $table->text('instruksi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hand_over_shift_detail');
    }
};

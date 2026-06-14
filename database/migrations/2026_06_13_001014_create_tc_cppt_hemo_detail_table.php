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
        if (Schema::hasTable('tc_cppt_hemo_detail')) {
            return;
        }

        Schema::create('tc_cppt_hemo_detail', function (Blueprint $table) {
            $table->increments('no_urut');
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('qb', 50)->nullable();
            $table->string('tek_arteri', 50)->nullable();
            $table->string('tek_vena', 50)->nullable();
            $table->string('tmp', 50)->nullable();
            $table->string('ufr', 50)->nullable();
            $table->string('ufv', 50)->nullable();
            $table->string('td', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('suhu', 50)->nullable();
            $table->string('nafas', 50)->nullable();
            $table->string('ket', 50)->nullable();
            $table->integer('id_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cppt_hemo_detail');
    }
};

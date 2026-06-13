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
        if (Schema::hasTable('tc_Emedical_record')) {
            return;
        }

        Schema::create('tc_Emedical_record', function (Blueprint $table) {
            $table->increments('id_erekam_medis');
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->string('tekanan_darah', 15)->nullable();
            $table->string('nadi', 15)->nullable();
            $table->string('pernafasan', 15)->nullable();
            $table->string('suhu', 15)->nullable();
            $table->string('kepala', 150)->nullable();
            $table->string('thorax', 150)->nullable();
            $table->string('abdomen', 150)->nullable();
            $table->string('extermitas', 150)->nullable();
            $table->string('status_lokalis', 150)->nullable();
            $table->string('pengobatan', 150)->nullable();
            $table->string('instruksi', 150)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('kesadaran_pasien', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_Emedical_record');
    }
};

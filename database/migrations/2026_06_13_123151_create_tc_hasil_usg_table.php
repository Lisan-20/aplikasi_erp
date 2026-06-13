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
        Schema::create('tc_hasil_usg', function (Blueprint $table) {
            $table->increments('id_usg');
            $table->integer('no_kunjungan')->nullable();
            $table->string('kesimpulan', 250)->nullable();
            $table->string('nama_file', 250)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->string('h_m', 250)->nullable();
            $table->string('letak', 250)->nullable();
            $table->string('akt_gerakan', 250)->nullable();
            $table->string('tanda', 250)->nullable();
            $table->string('plasenta', 250)->nullable();
            $table->string('gr', 250)->nullable();
            $table->string('air_ketuban', 250)->nullable();
            $table->string('index_empat', 250)->nullable();
            $table->string('biometri', 250)->nullable();
            $table->string('crl', 250)->nullable();
            $table->string('bpd', 250)->nullable();
            $table->string('fl', 250)->nullable();
            $table->string('fac', 250)->nullable();
            $table->string('hamil', 250)->nullable();
            $table->string('janin', 250)->nullable();
            $table->string('perkem_aktv', 250)->nullable();
            $table->string('tbbj', 250)->nullable();
            $table->string('peluang_sex', 250)->nullable();
            $table->string('taksiran_partus', 250)->nullable();
            $table->string('anjuran', 250)->nullable();
            $table->string('gs', 250)->nullable();
            $table->string('crl2', 250)->nullable();
            $table->string('ys', 250)->nullable();
            $table->string('ac', 250)->nullable();
            $table->string('hc', 250)->nullable();
            $table->text('hasil_usg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hasil_usg');
    }
};

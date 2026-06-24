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
        Schema::table('mt_karyawan', function (Blueprint $table) {
            $table->dropColumn([
                'kode_dokter', 'kode_paramedis', 'flag_paramedis', 'gf_dokter', 'ket_gf_dokter',
                'STRx', 'SIPx', 'STR', 'SIP',
                'kodeDPJP', 'kode_dokter_hfis', 'kredential'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_karyawan', function (Blueprint $table) {
            $table->integer('kode_dokter')->nullable();
            $table->integer('kode_paramedis')->nullable();
            $table->integer('flag_paramedis')->nullable();
            $table->decimal('gf_dokter', 18, 2)->nullable();
            $table->string('ket_gf_dokter')->nullable();
            $table->integer('STRx')->nullable();
            $table->integer('SIPx')->nullable();
            $table->string('STR')->nullable();
            $table->string('SIP')->nullable();
            $table->string('kodeDPJP')->nullable();
            $table->string('kode_dokter_hfis')->nullable();
            $table->string('kredential')->nullable();
        });
    }
};

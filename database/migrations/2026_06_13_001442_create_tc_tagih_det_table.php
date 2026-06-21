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
        if (Schema::hasTable('tc_tagih_det')) {
            return;
        }

        Schema::create('tc_tagih_det', function (Blueprint $table) {
            $table->increments('id_tc_tagih_det');
            $table->integer('kode_tc_trans_kasir');
            $table->integer('id_tc_tagih')->nullable();
            $table->dateTime('tgl_kui')->nullable();
            $table->string('no_mr', 20)->nullable();
            $table->string('nama_pasien')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->decimal('jumlah_billing', 19, 4)->nullable()->default(0);
            $table->decimal('jumlah_dijamin', 19, 4)->nullable();
            $table->decimal('jumlah_tagih', 19, 4)->nullable()->default(0);
            $table->integer('jenis_tagih')->nullable();
            $table->integer('kode_bank')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('jenis_pasien')->nullable();
            $table->integer('status_batal')->nullable();
            $table->decimal('materai', 19, 4)->nullable();
            $table->decimal('diskon', 19, 4)->nullable();
            $table->bigInteger('no_registrasi')->nullable();

            $table->primary(['id_tc_tagih_det'], 'pk_tc_tagih_det');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_tagih_det');
    }
};

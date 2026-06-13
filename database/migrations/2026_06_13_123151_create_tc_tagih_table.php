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
        if (Schema::hasTable('tc_tagih')) {
            return;
        }

        Schema::create('tc_tagih', function (Blueprint $table) {
            $table->increments('id_tc_tagih');
            $table->string('no_invoice_tagih', 20)->nullable();
            $table->integer('jenis_tagih')->nullable();
            $table->dateTime('tgl_tagih')->nullable();
            $table->decimal('jumlah_tagih2', 18, 0)->nullable();
            $table->decimal('diskon', 18, 0)->nullable();
            $table->string('nama_tertagih', 100)->nullable();
            $table->integer('id_tertagih')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_jt_tempo')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('no_invoice')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('tahun')->nullable();
            $table->dateTime('periode_1')->nullable();
            $table->dateTime('periode_2')->nullable();
            $table->integer('jenis_pasien')->nullable();
            $table->integer('status_batal')->nullable();
            $table->dateTime('tgl_batal')->nullable();
            $table->integer('user_batal')->nullable();
            $table->decimal('diskon_bayar', 19, 4)->nullable();
            $table->string('keterangan_non_rs')->nullable();
            $table->string('keterangan_tolak')->nullable();
            $table->integer('id_bank')->nullable();
            $table->decimal('jumlah_tagih', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_tagih');
    }
};

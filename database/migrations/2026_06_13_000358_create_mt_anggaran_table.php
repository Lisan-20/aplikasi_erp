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
        if (Schema::hasTable('mt_anggaran')) {
            return;
        }

        Schema::create('mt_anggaran', function (Blueprint $table) {
            $table->increments('id_master_agg');
            $table->string('agg_no', 10);
            $table->string('agg_nama');
            $table->integer('level_agg');
            $table->string('referensi', 10);
            $table->string('kode_utama', 1);
            $table->string('kode_golongan', 2);
            $table->string('kode_jenis_agg', 2);
            $table->string('kode_agg_pembantu', 2);
            $table->string('kode_agg_detail', 3);
            $table->string('sub_ledger', 2)->nullable();
            $table->string('acc_type', 50)->nullable();
            $table->string('kode_bagian', 18)->nullable();

            $table->primary(['agg_no'], 'pk_mt_anggaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_anggaran');
    }
};

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
        Schema::create('mt_account', function (Blueprint $table) {
            $table->integer('id_master_account');
            $table->string('acc_no', 8);
            $table->string('acc_no_rs', 12);
            $table->string('acc_nama');
            $table->integer('level_coa');
            $table->string('referensi', 8);
            $table->string('kode_utama', 1);
            $table->string('kode_golongan', 1);
            $table->string('kode_jenis_akun', 2);
            $table->string('kode_akun_pembantu', 2);
            $table->string('kode_akun_detail', 2);
            $table->string('sub_ledger', 2)->nullable();
            $table->string('acc_type', 50)->nullable();
            $table->integer('urutan_lap')->nullable();
            $table->integer('id_biaya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_account');
    }
};

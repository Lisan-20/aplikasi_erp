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
        if (Schema::hasTable('tc_report')) {
            return;
        }

        Schema::create('tc_report', function (Blueprint $table) {
            $table->increments('id_report');
            $table->dateTime('tgl_report')->nullable();
            $table->string('alasan_permintaan', 500)->nullable();
            $table->string('pengirim', 50)->nullable();
            $table->char('flag', 10)->nullable();
            $table->string('group_pengirim', 40)->nullable();
            $table->char('nama_file', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('permintaan', 500)->nullable();
            $table->string('submodul', 500)->nullable();
            $table->string('nama_modul2', 500)->nullable();
            $table->text('nama_modul')->nullable();
            $table->text('nama_file_respon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_report');
    }
};

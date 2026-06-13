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
        if (Schema::hasTable('tc_publik_sharing')) {
            return;
        }

        Schema::create('tc_publik_sharing', function (Blueprint $table) {
            $table->increments('id_sharing');
            $table->string('nama_file', 250)->nullable();
            $table->string('folder', 250)->nullable();
            $table->integer('status_share')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->dateTime('tgl_share')->nullable();
            $table->integer('jml_di_download')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('judul', 100)->nullable();
            $table->integer('id_jenis')->nullable();

            $table->primary(['id_sharing'], 'pk_tc_publik_sharing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_publik_sharing');
    }
};

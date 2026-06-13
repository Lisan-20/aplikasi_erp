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
        if (Schema::hasTable('tanggapan')) {
            return;
        }

        Schema::create('tanggapan', function (Blueprint $table) {
            $table->increments('id_tanggapan');
            $table->integer('id_topik')->nullable();
            $table->string('username', 50)->nullable();
            $table->text('isi_tanggapan')->nullable();
            $table->dateTime('tgl_tanggapan')->nullable();
            $table->string('publish', 1)->nullable();

            $table->primary(['id_tanggapan'], 'pk_tanggapan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};

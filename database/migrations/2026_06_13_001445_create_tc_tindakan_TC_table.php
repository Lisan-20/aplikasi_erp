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
        if (Schema::hasTable('tc_tindakan_TC')) {
            return;
        }

        Schema::create('tc_tindakan_TC', function (Blueprint $table) {
            $table->increments('id_tc_tindakan_TC');
            $table->integer('nomer_tind')->nullable();
            $table->integer('no')->nullable();
            $table->text('nama_jenis')->nullable();
            $table->text('nama_tindakan')->nullable();
            $table->decimal('penggunaan', 18, 0)->nullable();
            $table->decimal('harga', 19, 4)->nullable();
            $table->string('kode_bagian', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_tindakan_TC');
    }
};

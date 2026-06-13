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
        if (Schema::hasTable('kategori_forum')) {
            return;
        }

        Schema::create('kategori_forum', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->string('nama_kategori', 250)->nullable();
            $table->string('kategori_seo', 250)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('aktif', 1)->nullable();

            $table->primary(['id_kategori'], 'pk_kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_forum');
    }
};

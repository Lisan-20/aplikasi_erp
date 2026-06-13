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
        if (Schema::hasTable('topik')) {
            return;
        }

        Schema::create('topik', function (Blueprint $table) {
            $table->increments('id_topik');
            $table->integer('id_kategori')->nullable();
            $table->string('username', 50)->nullable();
            $table->string('subjek', 250)->nullable();
            $table->string('subjek_seo', 250)->nullable();
            $table->text('isi_topik')->nullable();
            $table->dateTime('tgl_topik')->nullable();
            $table->integer('dibaca')->nullable();
            $table->string('publish', 1)->nullable();

            $table->primary(['id_topik'], 'pk_topik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topik');
    }
};

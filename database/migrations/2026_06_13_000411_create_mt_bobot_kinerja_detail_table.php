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
        if (Schema::hasTable('mt_bobot_kinerja_detail')) {
            return;
        }

        Schema::create('mt_bobot_kinerja_detail', function (Blueprint $table) {
            $table->increments('id_bobot_det');
            $table->integer('id_bobot')->nullable();
            $table->integer('nilai')->nullable();
            $table->decimal('bobot', 18)->nullable();
            $table->text('bobot_kinerja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_bobot_kinerja_detail');
    }
};

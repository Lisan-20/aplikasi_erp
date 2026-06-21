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
        if (Schema::hasTable('mt_rl_310')) {
            return;
        }

        Schema::create('mt_rl_310', function (Blueprint $table) {
            $table->increments('id_rl_310');
            $table->string('jenis_kegiatan', 50)->nullable();
            $table->text('kode_tarif')->nullable();

            $table->primary(['id_rl_310'], 'pk_mt_rl_310_x');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rl_310');
    }
};

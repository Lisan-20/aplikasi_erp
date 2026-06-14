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
        if (Schema::hasTable('ks_mt_loket')) {
            return;
        }

        Schema::create('ks_mt_loket', function (Blueprint $table) {
            $table->increments('kode_loket');
            $table->string('nama_loket', 50);

            $table->primary(['kode_loket'], 'pk__ks_mt_loket__3f3d11fa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ks_mt_loket');
    }
};

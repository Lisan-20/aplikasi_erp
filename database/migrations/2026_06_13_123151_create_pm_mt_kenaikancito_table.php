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
        Schema::create('pm_mt_kenaikancito', function (Blueprint $table) {
            $table->integer('kode_kenaikan_cito');
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('prosentase')->nullable();

            $table->primary(['kode_kenaikan_cito'], 'pk_pm_mt_kenaikancito');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_mt_kenaikancito');
    }
};

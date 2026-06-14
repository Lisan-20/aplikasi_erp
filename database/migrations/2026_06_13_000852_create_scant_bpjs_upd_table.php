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
        if (Schema::hasTable('scant_bpjs_upd')) {
            return;
        }

        Schema::create('scant_bpjs_upd', function (Blueprint $table) {
            $table->float('F1', 53, 0)->nullable();
            $table->string('tarif')->nullable();
            $table->float('vvip', 53, 0)->nullable();
            $table->float('vip', 53, 0)->nullable();
            $table->float('klas1', 53, 0)->nullable();
            $table->float('klas2', 53, 0)->nullable();
            $table->float('klas3', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scant_bpjs_upd');
    }
};

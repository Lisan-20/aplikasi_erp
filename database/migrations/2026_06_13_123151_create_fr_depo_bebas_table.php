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
        Schema::create('fr_depo_bebas', function (Blueprint $table) {
            $table->increments('id_fr_depo_bebas');
            $table->string('kode_brg', 20)->nullable();
            $table->integer('jml_sat_kcl')->nullable();
            $table->decimal('harga_beli', 18, 0)->nullable();
            $table->decimal('harga_jual', 18, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_depo_bebas');
    }
};

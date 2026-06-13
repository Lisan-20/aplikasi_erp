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
        Schema::create('fr_depo_cito', function (Blueprint $table) {
            $table->integer('id_fr_depo_cito');
            $table->string('kode_brg', 20)->nullable();
            $table->integer('jml_sat_kcl')->nullable();
            $table->decimal('harga_beli', 18, 0)->nullable();
            $table->decimal('harga_jual', 18, 0)->nullable();
            $table->string('kode_bagian', 10)->nullable();

            $table->primary(['id_fr_depo_cito'], 'pk_fr_depo_cito');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_depo_cito');
    }
};

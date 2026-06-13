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
        Schema::create('fr_far_resep_ri_display', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_brg', 50)->nullable();
            $table->string('nama_brg', 250)->nullable();
            $table->string('satuan_kecil', 50)->nullable();
            $table->decimal('jml_bag1', 19, 4)->nullable();
            $table->decimal('jml_bag2', 19, 4)->nullable();
            $table->decimal('jml_bag3', 19, 4)->nullable();
            $table->decimal('jml_bag4', 19, 4)->nullable();
            $table->decimal('jml_bag5', 19, 4)->nullable();
            $table->decimal('jml_bag6', 19, 4)->nullable();
            $table->decimal('jml_bag7', 19, 4)->nullable();
            $table->decimal('jml_bag8', 19, 4)->nullable();
            $table->decimal('jml_bag9', 19, 4)->nullable();
            $table->decimal('jml_bag10', 19, 4)->nullable();
            $table->decimal('jml_bag11', 19, 4)->nullable();
            $table->decimal('jml_bag12', 19, 4)->nullable();
            $table->decimal('jml_bag13', 19, 4)->nullable();
            $table->decimal('jml_bag14', 19, 4)->nullable();
            $table->decimal('jml_bag15', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_far_resep_ri_display');
    }
};

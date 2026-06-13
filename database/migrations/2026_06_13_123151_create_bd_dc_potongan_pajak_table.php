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
        if (Schema::hasTable('bd_dc_potongan_pajak')) {
            return;
        }

        Schema::create('bd_dc_potongan_pajak', function (Blueprint $table) {
            $table->increments('id_bd_dc_potongan_pajak');
            $table->string('nama_potongan', 100)->nullable();
            $table->decimal('persentase_potongan', 18)->nullable();
            $table->string('keterangan', 100)->nullable();

            $table->primary(['id_bd_dc_potongan_pajak'], 'pk_bd_dc_potongan_pajak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_dc_potongan_pajak');
    }
};

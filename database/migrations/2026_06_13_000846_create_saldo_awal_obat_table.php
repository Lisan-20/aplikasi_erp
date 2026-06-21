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
        if (Schema::hasTable('saldo_awal_obat')) {
            return;
        }

        Schema::create('saldo_awal_obat', function (Blueprint $table) {
            $table->bigIncrements('id_saldo_awal_obat');
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('stok_awal', 18)->nullable();
            $table->decimal('harga_satuan', 19, 4)->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->decimal('pemasukan', 18)->nullable();
            $table->decimal('pengeluaran', 18)->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_awal_obat');
    }
};

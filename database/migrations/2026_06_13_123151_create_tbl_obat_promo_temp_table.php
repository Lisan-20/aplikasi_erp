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
        Schema::create('tbl_obat_promo_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kode_trans_far')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->char('jml_sat_kcl', 10)->nullable();
            $table->string('satuan_kecil', 50)->nullable();
            $table->decimal('harga', 19, 4)->nullable();
            $table->decimal('margin', 19, 4)->nullable();
            $table->decimal('total_harga', 19, 4)->nullable();
            $table->dateTime('tgl')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('kode_brg_promo', 50)->nullable();
            $table->integer('status_kirim')->nullable();
            $table->integer('kd_tr_resep')->nullable();
            $table->char('jml_per_tablet', 10)->nullable();
            $table->integer('satuan_per_tablet')->nullable();
            $table->char('jumlah', 10)->nullable();
            $table->decimal('jumlah_kirim', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_obat_promo_temp');
    }
};

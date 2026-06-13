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
        Schema::create('tc_po_nm', function (Blueprint $table) {
            $table->increments('id_tc_po');
            $table->string('no_po', 50);
            $table->integer('no_urut_periodik')->nullable();
            $table->dateTime('tgl_po')->nullable();
            $table->decimal('ppn', 18)->nullable();
            $table->decimal('total_sbl_ppn', 18)->nullable();
            $table->decimal('total_stl_ppn', 18)->nullable();
            $table->decimal('discount_harga', 18)->nullable();
            $table->decimal('discount_lain', 18)->nullable();
            $table->string('term_of_pay')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('kirim_via')->nullable();
            $table->string('di_kirim_ke')->nullable();
            $table->string('petugas', 50)->nullable();
            $table->integer('ongkos_angkut')->nullable();
            $table->integer('status_kirim')->nullable();
            $table->string('barang_untuk')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->string('diajukan_oleh')->nullable();
            $table->string('sipa')->nullable();
            $table->string('disetujui_oleh')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('user_batal')->nullable();
            $table->dateTime('tgl_batal')->nullable();
            $table->dateTime('batas_tgl_kirim')->nullable();
            $table->dateTime('tgl_closing')->nullable();
            $table->integer('user_closing')->nullable();
            $table->integer('status_ver')->nullable();
            $table->dateTime('tgl_acc')->nullable();
            $table->string('no_acc', 50)->nullable();
            $table->string('ket_acc', 100)->nullable();
            $table->integer('user_id_acc')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->string('diketahui_oleh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_po_nm');
    }
};

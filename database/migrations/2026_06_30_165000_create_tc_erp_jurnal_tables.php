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
        Schema::create('tc_erp_jurnal_header', function (Blueprint $table) {
            $table->id();
            $table->string('no_jurnal', 50)->unique();
            $table->date('tgl_jurnal');
            $table->string('keterangan', 255);
            $table->string('referensi', 100)->nullable();
            $table->decimal('total_debit', 18, 2)->default(0);
            $table->decimal('total_kredit', 18, 2)->default(0);
            $table->integer('id_dd_user')->nullable(); // user pembuat
            $table->timestamps();
        });

        Schema::create('tc_erp_jurnal_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jurnal_header')->constrained('tc_erp_jurnal_header')->onDelete('cascade');
            $table->bigInteger('id_coa'); // Mengacu pada mt_erp_coa
            $table->decimal('debit', 18, 2)->default(0);
            $table->decimal('kredit', 18, 2)->default(0);
            $table->string('keterangan_detail', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_erp_jurnal_detail');
        Schema::dropIfExists('tc_erp_jurnal_header');
    }
};

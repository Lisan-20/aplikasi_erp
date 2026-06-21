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
        if (Schema::hasTable('pm_tc_hasilpenunjang')) {
            return;
        }

        Schema::create('pm_tc_hasilpenunjang', function (Blueprint $table) {
            $table->integer('kode_tc_hasilpenunjang');
            $table->integer('kode_trans_pelayanan')->nullable();
            $table->string('kode_mt_hasilpm', 18)->nullable();
            $table->text('hasil')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->text('kesan')->nullable();
            $table->string('nilai_normal_rujukan')->nullable();
            $table->dateTime('waktu_sampel')->nullable();
            $table->dateTime('tgl_isihasil')->nullable();

            $table->primary(['kode_tc_hasilpenunjang'], 'pk_pm_tc_hasilpenunjang_ok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_tc_hasilpenunjang');
    }
};

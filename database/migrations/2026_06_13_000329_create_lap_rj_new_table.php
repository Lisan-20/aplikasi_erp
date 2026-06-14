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
        if (Schema::hasTable('lap_rj_new')) {
            return;
        }

        Schema::create('lap_rj_new', function (Blueprint $table) {
            $table->increments('id_lap_rj');
            $table->integer('ank_laki')->nullable();
            $table->integer('ank_prmp')->nullable();
            $table->integer('dws_laki')->nullable();
            $table->integer('dws_prmp')->nullable();
            $table->integer('dalam')->nullable();
            $table->integer('bedah')->nullable();
            $table->integer('obgyn')->nullable();
            $table->integer('anak')->nullable();
            $table->integer('mata')->nullable();
            $table->integer('ortho')->nullable();
            $table->integer('tht')->nullable();
            $table->integer('saraf')->nullable();
            $table->integer('urolog')->nullable();
            $table->integer('sp_umum')->nullable();
            $table->integer('gigi')->nullable();
            $table->integer('rehab_medik')->nullable();
            $table->integer('lama_anak')->nullable();
            $table->integer('baru_anak')->nullable();
            $table->integer('umum')->nullable();
            $table->integer('BpjsPbi')->nullable();
            $table->integer('BpjsNonPbi')->nullable();
            $table->integer('BpjsKtngkrja')->nullable();
            $table->integer('jamkesda')->nullable();
            $table->integer('pt')->nullable();
            $table->integer('asuransi')->nullable();
            $table->string('bagian', 15)->nullable();
            $table->integer('tglnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
            $table->integer('respon_time')->nullable();
            $table->integer('doe')->nullable();
            $table->integer('insiden_ksm')->nullable();
            $table->integer('lama_dws')->nullable();
            $table->integer('baru_dws')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_rj_new');
    }
};

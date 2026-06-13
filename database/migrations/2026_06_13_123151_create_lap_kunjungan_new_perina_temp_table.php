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
        Schema::create('lap_kunjungan_new_perina_temp', function (Blueprint $table) {
            $table->increments('id_lap_ri');
            $table->integer('by_sht')->nullable();
            $table->integer('by_skt')->nullable();
            $table->integer('bedah')->nullable();
            $table->integer('anak')->nullable();
            $table->integer('lama')->nullable();
            $table->integer('baru')->nullable();
            $table->integer('pas1')->nullable();
            $table->integer('pas2')->nullable();
            $table->integer('pas3')->nullable();
            $table->integer('lama1')->nullable();
            $table->integer('lama2')->nullable();
            $table->integer('lama3')->nullable();
            $table->integer('hari1')->nullable();
            $table->integer('hari2')->nullable();
            $table->integer('hari3')->nullable();
            $table->integer('blpl1')->nullable();
            $table->integer('blpl2')->nullable();
            $table->integer('blpl3')->nullable();
            $table->integer('aps1')->nullable();
            $table->integer('aps2')->nullable();
            $table->integer('aps3')->nullable();
            $table->integer('ref1')->nullable();
            $table->integer('ref2')->nullable();
            $table->integer('ref3')->nullable();
            $table->integer('min481')->nullable();
            $table->integer('min482')->nullable();
            $table->integer('min483')->nullable();
            $table->integer('plus481')->nullable();
            $table->integer('plus482')->nullable();
            $table->integer('plus483')->nullable();
            $table->integer('umum')->nullable();
            $table->integer('BpjsPbi')->nullable();
            $table->integer('BpjsNonPbi')->nullable();
            $table->integer('BpjsKtngkrja')->nullable();
            $table->integer('jamkesda')->nullable();
            $table->integer('pt')->nullable();
            $table->integer('asuransi')->nullable();
            $table->integer('tglnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
            $table->string('bagian', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_new_perina_temp');
    }
};

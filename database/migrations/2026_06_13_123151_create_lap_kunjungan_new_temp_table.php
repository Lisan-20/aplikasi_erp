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
        Schema::create('lap_kunjungan_new_temp', function (Blueprint $table) {
            $table->increments('id_lap_ri');
            $table->integer('ank_laki')->nullable();
            $table->integer('ank_prmp')->nullable();
            $table->date('date')->nullable();
            $table->integer('dws_laki')->nullable();
            $table->integer('dws_prmp')->nullable();
            $table->date('date_dws')->nullable();
            $table->integer('dalam')->nullable();
            $table->integer('bedah')->nullable();
            $table->integer('obgyn')->nullable();
            $table->integer('anak')->nullable();
            $table->integer('mata')->nullable();
            $table->integer('ortho')->nullable();
            $table->integer('tht')->nullable();
            $table->integer('saraf')->nullable();
            $table->integer('urolog')->nullable();
            $table->integer('lama')->nullable();
            $table->integer('baru')->nullable();
            $table->integer('pasvvip')->nullable();
            $table->integer('pasvip')->nullable();
            $table->integer('pas1')->nullable();
            $table->integer('pas2a')->nullable();
            $table->integer('pas2b')->nullable();
            $table->integer('pas3')->nullable();
            $table->integer('pasiso')->nullable();
            $table->integer('pas3anak')->nullable();
            $table->integer('lamavvip')->nullable();
            $table->integer('lamavip')->nullable();
            $table->integer('lama1')->nullable();
            $table->integer('lama2a')->nullable();
            $table->integer('lama2b')->nullable();
            $table->integer('lama3')->nullable();
            $table->integer('lamaiso')->nullable();
            $table->integer('lama3anak')->nullable();
            $table->integer('harivvip')->nullable();
            $table->integer('harivip')->nullable();
            $table->integer('hari1')->nullable();
            $table->integer('hari2a')->nullable();
            $table->integer('hari2b')->nullable();
            $table->integer('hari3')->nullable();
            $table->integer('hariiso')->nullable();
            $table->integer('hari3anak')->nullable();
            $table->integer('blplvvip')->nullable();
            $table->integer('blplvip')->nullable();
            $table->integer('blpl1')->nullable();
            $table->integer('blpl2a')->nullable();
            $table->integer('blpl2b')->nullable();
            $table->integer('blpl3')->nullable();
            $table->integer('blpliso')->nullable();
            $table->integer('blpl3anak')->nullable();
            $table->integer('apsvvip')->nullable();
            $table->integer('apsvip')->nullable();
            $table->integer('aps1')->nullable();
            $table->integer('aps2a')->nullable();
            $table->integer('aps2b')->nullable();
            $table->integer('aps3')->nullable();
            $table->integer('apsiso')->nullable();
            $table->integer('aps3anak')->nullable();
            $table->integer('refvvip')->nullable();
            $table->integer('refvip')->nullable();
            $table->integer('ref1')->nullable();
            $table->integer('ref2a')->nullable();
            $table->integer('ref2b')->nullable();
            $table->integer('ref3')->nullable();
            $table->integer('refiso')->nullable();
            $table->integer('ref3anak')->nullable();
            $table->integer('min48vvip')->nullable();
            $table->integer('min48vip')->nullable();
            $table->integer('min481')->nullable();
            $table->integer('min482a')->nullable();
            $table->integer('min482b')->nullable();
            $table->integer('min483')->nullable();
            $table->integer('min48iso')->nullable();
            $table->integer('min483anak')->nullable();
            $table->integer('plus48vvip')->nullable();
            $table->integer('plus48vip')->nullable();
            $table->integer('plus481')->nullable();
            $table->integer('plus482a')->nullable();
            $table->integer('plus482b')->nullable();
            $table->integer('plus483')->nullable();
            $table->integer('plus48iso')->nullable();
            $table->integer('plus483anak')->nullable();
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
        Schema::dropIfExists('lap_kunjungan_new_temp');
    }
};

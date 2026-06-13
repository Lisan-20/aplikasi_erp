<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW dbo.trflab_v
AS
SELECT     kode_tarif, kode_tindakan, nama_tarif, tingkatan, ket, kode_bagian, referensi, jenis_tindakan, paket_askes, kode_perusahaan, kode_grup_tindakan, paket_mcu, rl_lab, 
                      flag_rujukan, flag_insentif, flag_reg, flag_paket, fee_dr
FROM         dbo.mt_master_tarif_old
WHERE     (kode_bagian = '050101') AND (kode_tarif = 501010101)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trflab_v]");
    }
};

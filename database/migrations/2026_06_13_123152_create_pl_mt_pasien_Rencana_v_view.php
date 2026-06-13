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
        DB::statement("CREATE VIEW dbo.pl_mt_pasien_Rencana_v
AS
SELECT     dbo.tc_kontrol_bpjs.noKartu, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_kontrol_bpjs.tglRencanaKontrol, dbo.tc_kontrol_bpjs.namaDokter, dbo.tc_kontrol_bpjs.nama, dbo.tc_kontrol_bpjs.flag_wa, 
                      dbo.tc_kontrol_bpjs.noSuratKontrol, dbo.mt_master_pasien.no_mr, dbo.tc_kontrol_bpjs.id_kontrol_bpjs
FROM         dbo.tc_kontrol_bpjs INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kontrol_bpjs.noKartu = dbo.mt_master_pasien.nik
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_pasien_Rencana_v]");
    }
};

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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_tarif_nkBPJS
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.nk_perusahaan, 
                      dbo.tc_trans_kasir.nk_bpjs
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok IN (8, 9, 10)) AND (dbo.tc_trans_kasir.nk_bpjs > dbo.tc_trans_kasir.nk_perusahaan)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tarif_nkBPJS]");
    }
};

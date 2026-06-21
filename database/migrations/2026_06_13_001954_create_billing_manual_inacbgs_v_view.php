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
        DB::statement("CREATE OR ALTER VIEW dbo.billing_manual_inacbgs_v
AS
SELECT     dbo.GROUPER_INACBG_REST.no_mr, dbo.GROUPER_INACBG_REST.NoPeserta AS noKartuPeserta, dbo.GROUPER_INACBG_REST.NoSep, 
                      MONTH(dbo.GROUPER_INACBG_REST.TglKeluar) AS bln, YEAR(dbo.GROUPER_INACBG_REST.TglKeluar) AS thn, dbo.GROUPER_INACBG_REST.Tarif, 
                      dbo.mt_master_pasien.nama_pasien, dbo.GROUPER_INACBG_REST.JenisRawat, dbo.GROUPER_INACBG_REST.TglKeluar, 
                      dbo.GROUPER_INACBG_REST.StayInd
FROM         dbo.GROUPER_INACBG_REST INNER JOIN
                      dbo.mt_master_pasien ON dbo.mt_master_pasien.no_mr = dbo.GROUPER_INACBG_REST.no_mr
GROUP BY dbo.GROUPER_INACBG_REST.no_mr, dbo.GROUPER_INACBG_REST.NoPeserta, dbo.GROUPER_INACBG_REST.NoSep, 
                      MONTH(dbo.GROUPER_INACBG_REST.TglKeluar), YEAR(dbo.GROUPER_INACBG_REST.TglKeluar), dbo.GROUPER_INACBG_REST.Tarif, 
                      dbo.mt_master_pasien.nama_pasien, dbo.GROUPER_INACBG_REST.JenisRawat, dbo.GROUPER_INACBG_REST.TglKeluar, 
                      dbo.GROUPER_INACBG_REST.StayInd
HAVING      (NOT (dbo.GROUPER_INACBG_REST.NoSep IN
                          (SELECT     noSep
                            FROM          dbo.tc_registrasi AS tc_registrasi_1
                            WHERE      (noSep IS NOT NULL)))) AND (YEAR(dbo.GROUPER_INACBG_REST.TglKeluar) >= 2016)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [billing_manual_inacbgs_v]");
    }
};

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
        DB::statement("CREATE OR ALTER VIEW dbo.sep_rj_manual_v
AS
SELECT        dbo.tc_trans_kasir.seri_kuitansi, dbo.registrasi_simrs_v.TglMasuk, dbo.registrasi_simrs_v.TglKeluar, dbo.registrasi_simrs_v.noSep, dbo.registrasi_simrs_v.tglSep, dbo.registrasi_simrs_v.noKartuPeserta, 
                         dbo.registrasi_simrs_v.no_mr, dbo.tc_trans_kasir.plafon, dbo.tc_trans_kasir.nk_bpjs, dbo.registrasi_simrs_v.no_registrasi
FROM            dbo.registrasi_simrs_v INNER JOIN
                         dbo.tc_trans_kasir ON dbo.registrasi_simrs_v.no_registrasi = dbo.tc_trans_kasir.no_registrasi AND dbo.registrasi_simrs_v.no_mr = dbo.tc_trans_kasir.no_mr
WHERE        (dbo.tc_trans_kasir.seri_kuitansi = 'AJ') AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.registrasi_simrs_v.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sep_rj_manual_v]");
    }
};

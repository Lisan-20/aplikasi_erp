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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_sep_rawat_inap_v
AS
SELECT     dbo.GROUPER_INACBG_REST.no_mr, dbo.tc_trans_kasir.no_mr AS Expr1, dbo.GROUPER_INACBG_REST.TariffRS, dbo.tc_trans_kasir.nk_perusahaan, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.GROUPER_INACBG_REST.Tglklr, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.noSep, 
                      dbo.GROUPER_INACBG_REST.NoSep AS NoSep_up
FROM         dbo.GROUPER_INACBG_REST INNER JOIN
                      dbo.tc_trans_kasir ON dbo.GROUPER_INACBG_REST.no_mr = dbo.tc_trans_kasir.no_mr AND 
                      dbo.GROUPER_INACBG_REST.TariffRS = dbo.tc_trans_kasir.nk_perusahaan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.seri_kuitansi = 'AI') AND (dbo.tc_registrasi.noSep IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_sep_rawat_inap_v]");
    }
};

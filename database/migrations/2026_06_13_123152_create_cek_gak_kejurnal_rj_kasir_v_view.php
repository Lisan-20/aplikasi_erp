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
        DB::statement("CREATE VIEW dbo.cek_gak_kejurnal_rj_kasir_v
AS
SELECT     YEAR(tgl_jam) AS Expr1, kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, status_batal, flag_jurnal, tgl_ver, no_registrasi, MONTH(tgl_jam) AS Expr2
FROM         dbo.tc_trans_kasir
WHERE     (YEAR(tgl_jam) >= 2021) AND (seri_kuitansi IN ('AJ', 'RJ')) AND (NOT (kode_tc_trans_kasir IN
                          (SELECT     kode_tc_trans_kasir
                            FROM          dbo.tx_harian
                            WHERE      (YEAR(tx_tgl) >= 2021) AND (kel_jurnal = 1)))) AND (status_batal IS NULL) AND (flag_jurnal IS NOT NULL) AND (tgl_ver IS NOT NULL) AND (no_registrasi > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_gak_kejurnal_rj_kasir_v]");
    }
};

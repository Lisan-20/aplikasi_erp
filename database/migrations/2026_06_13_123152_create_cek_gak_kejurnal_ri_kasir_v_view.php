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
        DB::statement("CREATE VIEW dbo.cek_gak_kejurnal_ri_kasir_v
AS
SELECT     YEAR(tgl_jam) AS Expr1, kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, status_batal, flag_jurnal, MONTH(tgl_jam) AS Expr2, no_registrasi
FROM         dbo.tc_trans_kasir
WHERE     (YEAR(tgl_jam) >= 2021) AND (seri_kuitansi IN ('AI', 'RI')) AND (NOT (kode_tc_trans_kasir IN
                          (SELECT     kode_tc_trans_kasir
                            FROM          dbo.tx_harian
                            WHERE      (YEAR(tx_tgl) >= 2021) AND (kel_jurnal = 2)))) AND (status_batal IS NULL) AND (flag_jurnal IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_gak_kejurnal_ri_kasir_v]");
    }
};

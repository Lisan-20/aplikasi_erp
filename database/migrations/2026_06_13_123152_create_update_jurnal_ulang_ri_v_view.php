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
        DB::statement("CREATE VIEW dbo.update_jurnal_ulang_ri_v
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_registrasi, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, dbo.tc_trans_kasir.tgl_ver, dbo.tc_trans_kasir.flag_jurnal, 
                      dbo.tc_trans_pelayanan.tgl_ver AS Expr1, dbo.tc_trans_pelayanan.flag_jurnal AS flag_jurnal_pel
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir
WHERE     (YEAR(dbo.tc_trans_kasir.tgl_jam) = 2017) AND (dbo.tc_trans_kasir.seri_kuitansi IN ('AI', 'RI')) AND (dbo.tc_trans_kasir.tgl_ver IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_jurnal_ulang_ri_v]");
    }
};

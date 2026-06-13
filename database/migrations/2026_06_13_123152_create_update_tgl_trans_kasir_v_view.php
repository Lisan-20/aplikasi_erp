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
        DB::statement("CREATE VIEW dbo.update_tgl_trans_kasir_v
AS
SELECT     dbo.ri_tc_rawatinap.tgl_keluar, dbo.tc_kunjungan.tgl_keluar AS Expr1, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.status_batal, MONTH(dbo.ri_tc_rawatinap.tgl_keluar) AS Expr2, MONTH(dbo.tc_trans_kasir.tgl_jam) AS Expr3
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_kunjungan.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_trans_kasir.seri_kuitansi = 'AI') AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (MONTH(dbo.ri_tc_rawatinap.tgl_keluar) = 2) AND 
                      (MONTH(dbo.tc_trans_kasir.tgl_jam) <> 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tgl_trans_kasir_v]");
    }
};

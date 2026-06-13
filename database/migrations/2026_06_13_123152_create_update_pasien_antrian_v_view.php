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
        DB::statement("CREATE VIEW dbo.update_pasien_antrian_v
AS
SELECT     dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.status_keluar, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.no_registrasi, 
                      dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_trans_kasir.tgl_jam, YEAR(dbo.tc_kunjungan.tgl_masuk) AS Expr1, 
                      MONTH(dbo.tc_kunjungan.tgl_masuk) AS Expr2, DAY(dbo.tc_trans_kasir.tgl_jam) AS Expr3
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_kunjungan.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_kunjungan.tgl_keluar IS NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '01%') AND (dbo.tc_kunjungan.status_batal IS NULL) AND 
                      (YEAR(dbo.tc_kunjungan.tgl_masuk) = 2016)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_pasien_antrian_v]");
    }
};

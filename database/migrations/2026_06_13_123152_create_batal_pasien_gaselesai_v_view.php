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
        DB::statement("CREATE VIEW dbo.batal_pasien_gaselesai_v
AS
SELECT     TOP (100) PERCENT dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_trans_kasir.no_registrasi AS Expr1, dbo.tc_registrasi.status_batal, 
                      dbo.tc_trans_kasir.status_batal AS Expr2, dbo.tc_registrasi.tgl_jam_keluar, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS Expr3, dbo.tc_registrasi.respon_addantrian, 
                      YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS Expr4, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.status_batal AS Expr5, dbo.tc_registrasi.alasan_batal, 
                      dbo.tc_kunjungan.kode_bagian_tujuan
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi LEFT OUTER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.no_registrasi IS NULL) AND (dbo.tc_registrasi.tgl_jam_keluar IS NULL) AND 
                      (YEAR(dbo.tc_registrasi.tgl_jam_masuk) <= YEAR(GETDATE())) AND (MONTH(dbo.tc_registrasi.tgl_jam_masuk) < MONTH(GETDATE()))
ORDER BY dbo.tc_registrasi.tgl_jam_masuk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_pasien_gaselesai_v]");
    }
};

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
        DB::statement("CREATE VIEW dbo.dash_pasien_blm_selesai_kasir_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) AS RS, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1) AS DR1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_dr2) AS DR2, dbo.tc_registrasi.kode_bagian_masuk, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.status_registrasi, 
                      dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.kode_bagian_keluar, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) AS Expr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL OR
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0) AND (dbo.tc_trans_pelayanan.status_selesai = 2) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL)
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_registrasi.kode_bagian_masuk, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.tgl_jam_keluar, 
                      dbo.tc_registrasi.kode_bagian_keluar
HAVING      (dbo.tc_registrasi.status_registrasi = 1) AND (NOT (dbo.tc_trans_pelayanan.no_registrasi IN
                          (SELECT     reg_igd
                            FROM          dbo.cek_billing_RI_IGD_v)))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_pasien_blm_selesai_kasir_v]");
    }
};

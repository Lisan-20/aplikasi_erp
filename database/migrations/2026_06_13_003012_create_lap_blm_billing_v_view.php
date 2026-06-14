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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_blm_billing_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, SUM(dbo.tc_trans_pelayanan.bill_rs) AS RS, SUM(dbo.tc_trans_pelayanan.bill_dr1) AS DR1, 
                      SUM(dbo.tc_trans_pelayanan.bill_dr2) AS DR2, dbo.tc_registrasi.kode_bagian_masuk, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_trans_pelayanan.status_selesai = 2) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND 
                      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_registrasi.tgl_jam_masuk BETWEEN '20160302' AND '20160302') AND 
                      (dbo.tc_registrasi.kode_bagian_masuk NOT LIKE '03%')
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_registrasi.kode_bagian_masuk, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.tc_registrasi.kode_kelompok
HAVING      (dbo.tc_registrasi.status_registrasi = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_blm_billing_v]");
    }
};

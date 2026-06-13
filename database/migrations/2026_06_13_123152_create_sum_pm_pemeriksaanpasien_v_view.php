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
        DB::statement("CREATE VIEW dbo.sum_pm_pemeriksaanpasien_v
AS
SELECT     TOP (100) PERCENT dbo.pm_pasienpm_v.jen_kelamin, dbo.pm_pasienpm_v.nama_pasien, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.pm_pasienpm_v.kode_kelompok, dbo.pm_pasienpm_v.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_batal, 
                      YEAR(dbo.pm_pasienpm_v.tgl_masuk) AS thn, MONTH(dbo.pm_pasienpm_v.tgl_masuk) AS bln, DAY(dbo.pm_pasienpm_v.tgl_masuk) AS tgl
FROM         dbo.pm_pasienpm_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasienpm_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang
GROUP BY dbo.pm_pasienpm_v.jen_kelamin, dbo.pm_pasienpm_v.nama_pasien, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.pm_pasienpm_v.kode_kelompok, dbo.pm_pasienpm_v.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_batal, 
                      YEAR(dbo.pm_pasienpm_v.tgl_masuk), MONTH(dbo.pm_pasienpm_v.tgl_masuk), DAY(dbo.pm_pasienpm_v.tgl_masuk), 
                      CAST(dbo.tc_trans_pelayanan.tgl_transaksi AS DATE)
HAVING      (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (CAST(dbo.tc_trans_pelayanan.tgl_transaksi AS DATE) BETWEEN '2015-06-29' AND 
                      '2015-06-29') AND (dbo.tc_trans_pelayanan.status_selesai >= 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_pm_pemeriksaanpasien_v]");
    }
};

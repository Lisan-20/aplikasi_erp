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
        DB::statement("CREATE VIEW dbo.sum_pm_pemeriksaanpasienluar_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.pm_pasienluar_v.nama_pasien, dbo.pm_pasienluar_v.jen_kelamin, 
                      YEAR(dbo.pm_pasienluar_v.tgl_masuk) AS thn, MONTH(dbo.pm_pasienluar_v.tgl_masuk) AS bln, DAY(dbo.pm_pasienluar_v.tgl_masuk) AS tgl, 
                      dbo.pm_pasienluar_v.status_batal, dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.pm_pasienluar_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasienluar_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.pm_pasienluar_v.nama_pasien, dbo.pm_pasienluar_v.jen_kelamin, 
                      YEAR(dbo.pm_pasienluar_v.tgl_masuk), MONTH(dbo.pm_pasienluar_v.tgl_masuk), DAY(dbo.pm_pasienluar_v.tgl_masuk), 
                      dbo.pm_pasienluar_v.status_batal, dbo.tc_trans_pelayanan.tgl_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_pm_pemeriksaanpasienluar_v]");
    }
};

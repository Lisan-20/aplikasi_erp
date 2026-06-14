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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pm_v
AS
SELECT DISTINCT 
                      TOP (100) PERCENT dbo.tc_trans_pelayanan.no_kunjungan, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bulan, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.stat_pasien
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_kunjungan.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_v]");
    }
};

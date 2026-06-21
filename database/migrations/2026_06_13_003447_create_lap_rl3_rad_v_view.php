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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rl3_rad_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, COUNT(dbo.tc_trans_pelayanan.kode_tarif) AS jumlah, dbo.mt_master_tarif.referensi, 
                      dbo.tingkatan_4_rad_v.nama_tarif, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.status_selesai, YEAR(dbo.tc_kunjungan.tgl_masuk) AS thn, MONTH(dbo.tc_kunjungan.tgl_masuk) 
                      AS bln, dbo.mt_master_tarif.rl_lab, dbo.tc_kunjungan.tgl_masuk
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr RIGHT OUTER JOIN
                      dbo.mt_master_tarif INNER JOIN
                      dbo.tingkatan_4_rad_v ON dbo.mt_master_tarif.referensi = dbo.tingkatan_4_rad_v.kode_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
GROUP BY dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.referensi, dbo.tingkatan_4_rad_v.nama_tarif, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.tc_trans_pelayanan.status_selesai, YEAR(dbo.tc_kunjungan.tgl_masuk), MONTH(dbo.tc_kunjungan.tgl_masuk), dbo.mt_master_tarif.rl_lab, dbo.tc_kunjungan.tgl_masuk
HAVING      (dbo.mt_master_tarif.kode_bagian = '050201') AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.status_selesai >= 2) AND 
                      (dbo.mt_master_tarif.referensi <> 502010600)
ORDER BY dbo.mt_master_tarif.rl_lab
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rl3_rad_v]");
    }
};

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
        DB::statement("CREATE OR ALTER VIEW dbo.rl_1_3_det_v
AS
SELECT     dbo.mt_bagian.nama_bagian, YEAR(dbo.tc_kunjungan.tgl_masuk) AS tahun, dbo.mt_ruangan.keterangan, dbo.mt_bagian.jumlah_kamar, dbo.mt_ruangan.kode_bagian, 
                      dbo.mt_ruangan.flag_aktif
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_ruangan ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_ruangan.kode_bagian RIGHT OUTER JOIN
                      dbo.mt_bagian ON dbo.mt_ruangan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.mt_bagian.nama_bagian, YEAR(dbo.tc_kunjungan.tgl_masuk), dbo.mt_ruangan.keterangan, dbo.mt_bagian.jumlah_kamar, dbo.mt_ruangan.kode_bagian, dbo.mt_ruangan.flag_aktif
HAVING      (dbo.mt_ruangan.flag_aktif IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_1_3_det_v]");
    }
};

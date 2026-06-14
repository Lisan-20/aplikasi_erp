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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_lap_pendapatan_far_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.mt_bagian.validasi, dbo.tc_trans_pelayanan.kode_bagian, 
                      YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, DAY(dbo.tc_trans_kasir.tgl_jam) AS tgl, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.mt_bagian.validasi, dbo.tc_trans_pelayanan.kode_bagian, 
                      YEAR(dbo.tc_trans_kasir.tgl_jam), MONTH(dbo.tc_trans_kasir.tgl_jam), DAY(dbo.tc_trans_kasir.tgl_jam), dbo.tc_trans_kasir.kode_tc_trans_kasir
HAVING      (dbo.mt_bagian.validasi = '060001')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_pendapatan_far_v]");
    }
};

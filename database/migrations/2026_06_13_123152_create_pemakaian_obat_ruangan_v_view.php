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
        DB::statement("CREATE VIEW dbo.pemakaian_obat_ruangan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.nama_bagian, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bulan, SUM(dbo.tc_trans_pelayanan.bill_rs_jatah) 
                      AS bill_rs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 7) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) BETWEEN 
                      7 AND 9) AND (dbo.tc_trans_pelayanan.kode_kelompok = 3) AND (dbo.tc_trans_pelayanan.kode_bagian IN ('020101', '030901', '030501', '030601', '031001', '032001', 
                      '010101')) AND (dbo.tc_trans_pelayanan.bill_rs_jatah > 0) AND (dbo.tc_trans_pelayanan.kode_perusahaan > 0)
GROUP BY dbo.mt_bagian.nama_bagian, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi)
ORDER BY dbo.mt_bagian.nama_bagian, bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pemakaian_obat_ruangan_v]");
    }
};

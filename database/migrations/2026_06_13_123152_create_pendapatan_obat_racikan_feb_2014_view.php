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
        DB::statement("CREATE VIEW dbo.pendapatan_obat_racikan_feb_2014
AS
SELECT     dbo.tc_trans_pelayanan.kode_kelompok, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs_jatah) AS bill_rs_jatah, SUM((CASE WHEN status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) AS uang_r, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bulan, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.nama_tindakan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_kelompok, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_trans_pelayanan.kode_barang, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.nama_tindakan
HAVING      (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) IN (1, 2, 12)) AND (dbo.tc_trans_pelayanan.kode_barang <> 'D38A0186') AND 
                      (SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) >= 2000)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pendapatan_obat_racikan_feb_2014]");
    }
};

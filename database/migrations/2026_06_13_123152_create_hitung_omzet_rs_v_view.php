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
        DB::statement("CREATE OR ALTER VIEW dbo.hitung_omzet_rs_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) 
                      - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_rs IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_rs END) AS bill_rs, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1) - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_dr1 IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr1 END) AS bill_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr2) 
                      - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_dr2 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr2 END) AS bill_dr2, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, dbo.mt_bagian.validasi, 
                      dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_profit, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_kasir.status_batal AS Expr1, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_kasir.tgl_jam AS tgl_transaksi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.mt_bagian.validasi, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_profit, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_trans_pelayanan.jenis_tindakan
HAVING      (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_omzet_rs_v]");
    }
};

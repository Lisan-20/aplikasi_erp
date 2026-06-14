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
        DB::statement("CREATE OR ALTER VIEW dbo.transaksi_blm_terbayar
AS
SELECT     COUNT(kode_kelompok) AS Expr1, kode_tarif, nama_tindakan, SUM(bill_rs) AS bill_rs, SUM(bill_dr1) AS bill_dr1, SUM(bill_dr2) AS bill_dr2, SUM(bill_rs_jatah) 
                      AS bill_rs_jatah, SUM(bill_dr1_jatah) AS bill_dr1_jatah, SUM(bill_dr2_jatah) AS bill_dr2_jatah, COUNT(kode_penunjang) AS jum_pasien, kode_kelompok
FROM         dbo.pm_pemeriksaanpasienluar_v
WHERE     (kode_bagian = '050101') AND (tgl_transaksi BETWEEN '2013-07-01 00:00:00' AND '2013-07-31 23:59:59') AND (status_selesai = 2) AND 
                      (kode_penunjang NOT IN
                          (SELECT     kode_penunjang
                            FROM          dbo.pm_tc_penunjang
                            WHERE      (status_batal = 1)))
GROUP BY kode_tarif, nama_tindakan, kode_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_blm_terbayar]");
    }
};

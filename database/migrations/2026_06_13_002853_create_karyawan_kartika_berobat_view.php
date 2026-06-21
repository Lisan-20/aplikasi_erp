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
        DB::statement("CREATE OR ALTER VIEW dbo.karyawan_kartika_berobat
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.nama_pasien, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr2, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, dbo.tc_trans_pelayanan.kode_perusahaan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_trans_pelayanan.kode_perusahaan IN (93, 94, 95)) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND 
                      (dbo.tc_trans_pelayanan.no_registrasi NOT IN (117841, 117863, 118255, 118669, 127705, 127727, 129163, 129476, 129485, 129955, 129956, 130099, 130101, 
                      134316, 134317, 134624, 134628, 134629, 134630, 134631, 134632, 134636, 134637, 134650, 134653, 134654, 139531, 141489, 141496, 141502, 144062, 145433, 
                      152835, 160788, 160790, 160806, 160820, 161874, 163300, 163304, 166804, 166814, 166821, 166822))
GROUP BY MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.mt_master_pasien.nama_pasien
HAVING      (SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) = 82707430)
ORDER BY dbo.tc_trans_pelayanan.kode_perusahaan, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [karyawan_kartika_berobat]");
    }
};

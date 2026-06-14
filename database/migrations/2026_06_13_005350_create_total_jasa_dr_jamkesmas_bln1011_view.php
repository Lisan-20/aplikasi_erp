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
        DB::statement("CREATE OR ALTER VIEW dbo.total_jasa_dr_jamkesmas_bln1011
AS
SELECT     TOP (100) PERCENT MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, YEAR(dbo.tc_trans_kasir.tgl_jam) AS tahun, dbo.tc_trans_pelayanan.nama_tindakan, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr2
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_registrasi.kode_kelompok = 7) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_trans_pelayanan.kode_bagian NOT LIKE '03%') AND 
                      (MONTH(dbo.tc_trans_kasir.tgl_jam) = 12)
GROUP BY MONTH(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam), dbo.tc_trans_pelayanan.nama_tindakan
ORDER BY bulan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [total_jasa_dr_jamkesmas_bln1011]");
    }
};

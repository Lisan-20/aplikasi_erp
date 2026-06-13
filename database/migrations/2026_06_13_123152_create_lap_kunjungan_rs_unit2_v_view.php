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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_rs_unit2_v
AS
SELECT     SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_rs IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_rs END)) 
                      AS bill_rs, SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr1 IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr1 END)) AS bill_dr1, SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr2 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr2 END)) AS bill_dr2, SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr3 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr3 END)) AS bill_dr3, 
                      SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.lain_lain IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.lain_lain END)) 
                      AS lain_lain, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.no_mr, dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.umur
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi AND dbo.tc_trans_pelayanan.no_mr = dbo.tc_registrasi.no_mr
GROUP BY dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.no_mr, dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.umur
HAVING      (NOT (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL)) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_perusahaan IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_rs_unit2_v]");
    }
};

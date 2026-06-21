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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kinerja_rs_unit_v
AS
SELECT     SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_rs IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_rs END)) 
                      AS bill_rs, SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr1 IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr1 END)) AS bill_dr1, SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr2 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr2 END)) AS bill_dr2, SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr3 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr3 END)) AS bill_dr3, 
                      SUM((CASE WHEN dbo.tc_trans_pelayanan.status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.lain_lain IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.lain_lain END)) 
                      AS lain_lain, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.no_registrasi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_kasir.no_registrasi
HAVING      (NOT (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL)) AND (dbo.tc_trans_kasir.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kinerja_rs_unit_v]");
    }
};

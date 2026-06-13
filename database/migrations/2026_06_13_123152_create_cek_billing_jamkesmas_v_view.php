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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_billing_jamkesmas_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.kode_kelompok, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) 
                      AS bill_rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr2, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) 
                      AS lain_lain, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.jenis_tindakan
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok = 7) AND (dbo.tc_trans_kasir.kode_bagian NOT LIKE '03%')
GROUP BY dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.jenis_tindakan
ORDER BY dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.jenis_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_billing_jamkesmas_v]");
    }
};

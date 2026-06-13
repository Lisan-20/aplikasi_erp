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
        DB::statement("CREATE VIEW dbo.CEK_TINDAKAN_SKTM_V
AS
SELECT     TOP (100) PERCENT SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1) + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, 
                      SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 1, 4) AS kobag, dbo.tc_trans_pelayanan.jenis_tindakan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.CEK_PASIEN_BEDAH_SKTM_V ON dbo.tc_trans_pelayanan.no_registrasi = dbo.CEK_PASIEN_BEDAH_SKTM_V.no_registrasi
GROUP BY dbo.tc_trans_pelayanan.jenis_tindakan, SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 1, 4), dbo.tc_trans_pelayanan.status_batal
HAVING      (dbo.tc_trans_pelayanan.jenis_tindakan IS NOT NULL)
ORDER BY dbo.tc_trans_pelayanan.jenis_tindakan, kobag
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [CEK_TINDAKAN_SKTM_V]");
    }
};

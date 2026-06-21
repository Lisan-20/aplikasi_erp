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
        DB::statement("CREATE OR ALTER VIEW dbo.bill_jkn_v
AS
SELECT     dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.status_kredit, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs) + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.lain_lain) AS billing, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.mt_plafon_bpjs_detail.persen, SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 1, 2) AS kobag, dbo.mt_plafon_bpjs_detail.kode_plafon
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_plafon_bpjs_detail ON dbo.tc_trans_pelayanan.jenis_tindakan = dbo.mt_plafon_bpjs_detail.jenis_tindakan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi AND 
                      dbo.mt_plafon_bpjs_detail.kode_plafon = dbo.tc_registrasi.kode_plafon
GROUP BY dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.status_kredit, 
                      dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.mt_plafon_bpjs_detail.persen, SUBSTRING(dbo.tc_trans_pelayanan.kode_bagian, 1, 2), dbo.mt_plafon_bpjs_detail.kode_plafon
HAVING      (dbo.tc_trans_pelayanan.jenis_tindakan NOT IN (1)) AND (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_jkn_v]");
    }
};
